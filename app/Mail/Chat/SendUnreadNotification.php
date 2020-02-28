<?php

namespace App\Mail\Chat;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

# Models
use App\User;
use App\Models\Consultation\Message;

class SendUnreadNotification extends Mailable
{
    use Queueable, SerializesModels;

    protected $user, $message;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->user = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $role = $this->user->role->name;

        $url = route('consult.'.$role.'.list');

        return $this->subject("Anda mendapatkan chat baru")->view('layouts.email.unread-message', [
            'name' => $this->user->name,
            'url' => $url
        ]);
    }
}
