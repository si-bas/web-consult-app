<?php

namespace App\Jobs\Chat;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

# Models
use App\User;
use App\Models\Consultation\Message;

# Mails
use App\Mail\Mail\Chat\SendUnreadNotification;

class EmailUnreadMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $from_user_id, $to_user_id, $message_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($from_user_id, $to_user_id, $message_id)
    {
        $this->from_user_id = $from_user_id;
        $this->to_user_id = $to_user_id;
        $this->message_id = $message_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $message = Message::where('id', $this->message_id)->whereDoesntHave('readers', function($query) {
            $query->where('user_id', $this->to_user_id);
        })->first();

        $user = User::find($this->to_user_id);

        if (!empty($user) && !empty($message)) {
            Mail::to($user)->send(new SendUnreadNotification($user, $message));
        }
    }

    public function failed(\Exception $exception)
    {
        Log::error($exception->getMessage());
    }
}
