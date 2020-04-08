<?php

namespace App\Mail\Report;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionnaireResult extends Mailable
{
    use Queueable, SerializesModels;
    
    public $files;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($files)
    {
        $this->files = $files;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject('Rekap Hasil Kuesioner')->view('layouts.email-new.report');

        foreach($this->files as $filePath){
            $email->attach($filePath);
        }

        return $email;
    }
}
