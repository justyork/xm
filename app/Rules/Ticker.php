<?php

namespace App\Rules;

use App\Url;
use Illuminate\Contracts\Validation\Rule;

class Ticker implements Rule
{
    private $pingUrl = 'https://www.quandl.com/api/v3/datasets/WIKI/';

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $endpoint = $this->pingUrl.$value.'.json';
        return (new Url($endpoint))
            ->params(['api_key' => env('QUANDL_API_KEY'), 'rows' => 1])
            ->isFound();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ticker is incorrect.';
    }

}
