<?php

namespace App\Jobs\Report;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

# Models
use App\Models\Profile\Student;
use App\Models\Questionnaire\Questionnaire;

# Mails
use App\Mail\Report\QuestionnaireResult;

class QuestionairreScoreExcel implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email, $category;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $category)
    {
        $this->email = $email;
        $this->category = strtolower($category);

        $this->queue = 'default';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attachments = [];
        switch ($this->category) {
            case 'pre':
            case 'post':
                $attachments[] = $this->generate($this->category);
                break;
            case 'all': 
                $attachments[] = $this->generate('pre');
                $attachments[] = $this->generate('post');
                break;
            default:
                # nothin happen...
                break;
        }

        Mail::to($this->email)->send(new QuestionnaireResult($attachments));
    }

    public function generate($category)
    {
        $questionnaires = Questionnaire::where('is_active', true)->orderBy('code', 'ASC')->get();

        $students = Student::has('profile')->with([
            'profile.gender', 'filled_questionnaires' => function($query) use($category) {
                $query->withCount([
                    'student_answers AS score_sum' => function($query) use($category) {
                        $query->select(DB::raw('SUM(questionnaire_answers.poin) as scoresum'))->join('questionnaire_answers', 'student_questionnaire_answer.answer', '=', 'questionnaire_answers.id');
                    }
                ])->where('status', $category);
            }
        ])->get();

        $alphas = range('A', 'Z');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'NIM');
        $sheet->setCellValue('B1', 'NAMA LENGKAP');
        $sheet->setCellValue('C1', 'JENIS KELAMIN');
        $sheet->setCellValue('D1', 'UMUR');
        $sheet->setCellValue('E1', 'SEMESTER');
        $sheet->setCellValue('F1', 'TERDAFTAR PADA');
        $sheet->setCellValue('G1', 'STATUS');
        $sheet->setCellValue('H1', 'RIWAYA KEKERASAN FISIK/SEKSUAL');        
        $sheet->setCellValue('I1', 'JIKA ADA MASALAH');        

        $start_column = 9;
        
        foreach ($questionnaires as $i => $column) {
            $sheet->setCellValue($alphas[$i+$start_column].'1', $column->name);
        }

        foreach ($students as $row_number => $row) {
            $sheet->setCellValue('A'.($row_number+2), $row->student_id_number);
            $sheet->setCellValue('B'.($row_number+2), $row->full_name);
            $sheet->setCellValue('C'.($row_number+2), $row->profile->gender->name);
            $sheet->setCellValue('D'.($row_number+2), $row->profile->age);
            $sheet->setCellValue('E'.($row_number+2), $row->profile->semester);
            $sheet->setCellValue('F'.($row_number+2), $row->created_at);
            $sheet->setCellValue('G'.($row_number+2), $row->need_consult ? 'Kuning' : 'Hijau');
            $sheet->setCellValue('H'.($row_number+2), $row->profile->has_history_violence ? 'Ya' : 'Tidak');
            $sheet->setCellValue('I'.($row_number+2), implode(', ', $row->profile->solving_options->pluck('name')->toArray()));
            
            foreach ($questionnaires as $i => $column) {
                $result = $row->filled_questionnaires->where('questionnaire_id', $column->id)->first();

                if (!empty($result)) {
                    $sheet->setCellValue($alphas[$i+$start_column].($row_number+2), $result->score_sum);
                } else {
                    $sheet->setCellValue($alphas[$i+$start_column].($row_number+2), '-');
                    if ($i == 0) {
                        $sheet->setCellValue('G'.($row_number+2), '');
                    }
                }    
            }
        }

        $filename = "Laporan-Hasil-Kuesioner-$category-".Str::slug(Carbon::now()->formatLocalized("%d %B %Y"), '-').'.xlsx';
        $writer = new Xlsx($spreadsheet);
        $path = storage_path('files/report/'.$filename);
        $writer->save($path);

        return $path;
    }
}
