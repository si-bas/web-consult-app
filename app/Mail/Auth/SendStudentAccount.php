<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

# Models
use App\User;

class SendStudentAccount extends Mailable
{
    use Queueable, SerializesModels;

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
        $name = $this->user->name;
        $email = $this->user->email;

        try {
            $password = Crypt::decrypt($this->user->password_hint);
        } catch (\Exception $e) {
            $password = 'Silahkan hubungi Administrator';
            
            Log::error($e->getMessage());
        }

        return $this
        ->subject("Registrasi ".config('app.name'))
        ->view('layouts.email.registration-student', [
            'name' => $name,
            'email' => $email,
            'password' => $password
        ]);
    }
}
