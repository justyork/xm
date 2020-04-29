<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FormTest extends TestCase
{
    private $request;


    /** @test */
    public function customer_can_view_the_form (): void
    {
        $this->get(route('home'))
            ->assertStatus(200)
            ->assertSee('Search');
    }

    /** @test */
    public function customer_will_get_an_error_if_form_is_empty(): void
    {

        $this->postJson(route('validate'), [
            'ticker' => '',
            'date_from' => '',
            'date_to' => '',
        ])->assertSessionHasErrors([
            'ticker' => 'The ticker field is required.',
            'date_from' => 'The date from field is required.',
            'date_to' => 'The date to field is required.',
        ]);
    }

    /** @test */
    public function customer_will_get_an_error_if_data_is_incorrect(): void
    {
        $this->postJson(route('validate'), [
            'ticker' => '123',
            'date_from' => '123',
            'date_to' => '123',
        ])->assertSessionHasErrors([
            'ticker' => 'Ticker is incorrect.',
            'date_from' => 'The date from is not a valid date.',
            'date_to' => 'The date to is not a valid date.',
        ]);
    }

    /** @test */
    public function customer_doesnt_get_any_errors_with_correct_data(): void
    {
        $this->postJson(route('validate'), [
            'ticker' => 'AAPL',
            'date_from' => '2013-01-01',
            'date_to' => '2013-04-01',
        ])->assertSessionHasNoErrors();
    }
}
