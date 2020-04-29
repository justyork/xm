<?php

namespace Tests\Feature;

use App\Mail\TickerEmail;
use App\Ticker\Ticker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailTest extends TestCase
{

    /** @test */
    public function user_can_send_an_email(): void
    {
        Mail::fake();


        $this->post(route('validate'), [
            'ticker' => 'AAPL',
            'date_from' => '2012-12-21',
            'date_to' => '2012-12-22',
            'email' => 'yorkshp@gmail.com'
        ]);

        Mail::assertSent(TickerEmail::class);
    }


}
