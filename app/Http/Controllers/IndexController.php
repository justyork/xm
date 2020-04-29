<?php

namespace App\Http\Controllers;

use App\Mail\TickerEmail;
use App\Ticker\Ticker;
use App\Ticker\ChartTickerData;
use App\Ticker\TableTickerData;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;

class IndexController extends Controller
{

    /**
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        $ticker = (new Ticker($request->old('ticker')))
            ->dateFrom($request->old('date_from'))
            ->dateTo($request->old('date_to'));

        $table = $chart = null;
        if ($request->old('ticker')) {
            $table = $ticker->render(new TableTickerData());
            $chart = $ticker->render(new ChartTickerData());
        }

        return view('index', compact('ticker', 'table', 'chart'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function validateData(Request $request): RedirectResponse
    {
        $rules = $this->validationRules();
        $validator = Validator::make($request->all(), $rules);
        if ($request->has('send-email')) {
            $rules += ['email' => 'email:rfc,dns'];
            $validator = Validator::make($request->all(), $rules);
        }

        // return error
        if ($validator->fails()) {
            return redirect()
                ->route('home')
                ->withErrors($validator)
                ->withInput();
        }

        // send email
        if ($request->has('email')) {
            $this->sendEmail($request);
        }

        //return data if ok
        return redirect()
            ->route('home')
            ->withInput();
    }

    /**
     * @return array
     */
    private function validationRules(): array
    {
        return [
            'ticker' => ['required', new \App\Rules\Ticker],
            'date_from' => 'required|date',
            'date_to' => 'required|date',
        ];
    }

    /**
     * @param $request
     * @return void
     */
    private function sendEmail(Request $request): void
    {
        $ticker = (new Ticker($request->post('ticker')))
            ->dateFrom($request->post('date_from'))
            ->dateTo($request->post('date_to'));

        Mail::to($request->post('email'))->send(new TickerEmail($ticker));
        $request->session()->flash('message', 'Email was sent');
    }

}
