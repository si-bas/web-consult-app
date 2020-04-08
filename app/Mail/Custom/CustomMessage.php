<?php

namespace App\Mail\Custom;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $full_name, $text;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($full_name, $text)
    {
        $this->full_name = $full_name;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Informasi')->view('layouts.email-new.custom', [
            'full_name' => $this->full_name,
            'text' => $this->text
        ]);

        return $email;
    }
}
