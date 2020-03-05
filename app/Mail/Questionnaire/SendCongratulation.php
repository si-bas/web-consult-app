<?php

namespace App\Mail\Questionnaire;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

# Models
use App\User;

class SendCongratulation extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject("Ucapan Selamat dari Aplikasi ".config('app.name'))
        ->view('layouts.email.questionnaire-congrats', [
            'user' => $this->user
        ]);
    }
}
