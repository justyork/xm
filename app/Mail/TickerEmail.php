<?php

namespace App\Mail;

use App\Ticker\Ticker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TickerEmail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Ticker
     */
    private $ticker;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticker $ticker)
    {
        $this->ticker = $ticker;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('example@example.com')
            ->subject($this->ticker->getName())
            ->markdown('emails.ticker', $this->ticker->fields());
    }
}
