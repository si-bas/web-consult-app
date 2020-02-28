<?php

namespace App\Jobs\Chat;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;

# Models
use App\Models\Consultation\Reader;

class SaveReadMessages implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $message_ids, $user_id, $datetime;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message_ids, $user_id, $datetime)
    {
        $this->message_ids = $message_ids;
        $this->user_id = $user_id;
        $this->datetime = $datetime;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (is_array($this->message_ids)) {
            foreach ($this->message_ids as $id) {
                Reader::updateOrCreate([
                    'message_id' => $id, 'user_id' => $this->user_id 
                ], [
                    'read_at' => $this->datetime
                ]);
            }
        } else {
            Log::warning('SaveReadMessages - Invalid array of message id');
        }
    }

    public function failed(\Exception $exception)
    {
        Log::error($exception->getMessage());
    }
}
