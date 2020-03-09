<?php

namespace App\Jobs\Quesionnaire;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

# Models
use App\User;

# Mail
use App\Mail\Questionnaire\SendCongratulation;

class EmailCongratulation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $user_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = User::find($this->user_id);

        if (!empty($user)) {
            Mail::to($user)->send(new SendCongratulation($user));
        }
    }
}
