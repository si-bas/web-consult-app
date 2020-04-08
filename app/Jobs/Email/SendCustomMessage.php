<?php

namespace App\Jobs\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

# Models
use App\Models\View\Student_activity;
use App\Models\Questionnaire\Questionnaire;

# Mails
use App\Mail\Custom\CustomMessage;

class SendCustomMessage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = (object) $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit', '-1'); ini_set('max_execution_time', 0); set_time_limit(0);

        foreach ($this->getStudents() as $student) {
            Log::info($student->full_name." : ".$student->student->user->email);

            Mail::to('umum.saifi@gmail.com')->send(new CustomMessage($student->full_name, $this->data->text));   
        }
    }

    private function getStudents()
    {
        $count_questionnaire = Questionnaire::count();
        $students = Student_activity::select(DB::raw('student_activity.*, CONCAT(first_name, \' \',last_name) as full_name'))->with([
            'student.user'
        ]);

        if ($this->data->status != 'all') {
            $students->where('need_consult', $this->data->status);
        }

        switch ($this->data->step) {
            case 'count_pre':                
                if ($this->data->requirement != 'all') {
                    $students->where('count_pre', $this->data->requirement ? '=' : '<', $count_questionnaire);
                }
                break;
            case 'is_done':
                if ($this->data->requirement != 'all') {
                    $students->where('is_done', $this->data->requirement);
                } else {
                    $students->whereNotNull('is_done');
                }
                break;
            case 'count_post':
                if ($this->data->requirement != 'all') {
                    $students->where('count_post', $this->data->requirement ? '=' : '<', $count_questionnaire);
                }
                break;
            case 'evaluation':
                if ($this->data->requirement != 'all') {
                    if ($this->data->requirement) $students->has('evaluation');
                }
                break;
            default:
                # code...
                break;
        }

        return $students->get();
    }
}
