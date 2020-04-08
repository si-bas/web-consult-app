<?php

namespace App\Http\Controllers\Questionnaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\StreamedResponse;

# Models
use App\Models\Questionnaire\Questionnaire;
use App\Models\Questionnaire\Student_questionnaire;

class RespondentController extends Controller
{
    public function list()
    {
        return view('contents.questionnaire.respondent.list');
    }

    public function data(Request $request)
    {
        $respondents = Student_questionnaire::select(DB::raw('student_questionnaire.*'))->with([
            'student.user', 'questionnaire'
        ]);

        return DataTables::of($respondents)
        ->editColumn('status', function($respondent) {
            $status = '';
            switch (strtolower($respondent->status)) {
                case 'pre':
                    $status = 'PRA';
                    break;
                case 'post':
                    $status = 'PASCA';
                    break;
                default:
                    $status = 'Tidak Diketahui';
                    break;
            }

            return $status;
        })
        ->addColumn('action', function($respondent) {
            return '<a href="'.route('questionnaire.respondent.download', ['id' => $respondent->id]).'" class="btn btn-success btn-sm">Unduh</a>';
        })
        ->rawColumns([
            'action'
        ])
        ->make(true);
    }

    public function download(Request $request)
    {
        $respondent = Student_questionnaire::where('id', $request->id)->with([                        
            'student.profile.gender',
            'questionnaire',
            'result', 
            'student_answers' => function($query) {
                $query->with([
                    'question',
                    'questionnaire_answer'
                ]);
            },
        ])->first();

        $styleArrayBorder = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $row_start = 0;

        $sheet->setCellValue('A'.++$row_start, 'NIM'); 
        $sheet->setCellValue('B'.$row_start, $respondent->student->student_id_number);
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'NAMA LENGKAP'); 
        $sheet->setCellValue('B'.$row_start, $respondent->student->full_name);
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'JENIS KELAMIN'); 
        $sheet->setCellValue('B'.$row_start, $respondent->student->profile->gender->name);
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'UMUR'); 
        $sheet->setCellValue('B'.$row_start, $respondent->student->profile->age.' tahun');
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'SEMESTER'); 
        $sheet->setCellValue('B'.$row_start, $respondent->student->profile->semester.' ');
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'TERDAFTAR PADA'); 
        $sheet->setCellValue('B'.$row_start, $respondent->student->created_at);      
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'KESIONER'); 
        $sheet->setCellValue('B'.$row_start, $respondent->questionnaire->name);
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->setCellValue('A'.++$row_start, 'HASIL');
        $sheet->setCellValue('B'.$row_start, $respondent->result->information);
        $sheet->getStyle('A'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('B'.$row_start)->applyFromArray($styleArrayBorder);

        foreach(range('A','Z') as $columnID) {
            $sheet->getColumnDimension($columnID)
                ->setAutoSize(true);
        }

        $sheet->getStyle('A1:A'.$row_start)->applyFromArray([
            'font' => [
                'bold' => true,
            ]
        ]);        

        $row_start = 1;

        $sheet->setCellValue('D'.$row_start, 'NO'); 
        $sheet->setCellValue('E'.$row_start, 'PERTANYAAN/PERNYATAAN'); 
        $sheet->setCellValue('F'.$row_start, 'JAWABAN'); 
        $sheet->setCellValue('G'.$row_start, 'POIN'); 
        
        $sheet->getStyle('D'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('E'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('F'.$row_start)->applyFromArray($styleArrayBorder);
        $sheet->getStyle('G'.$row_start)->applyFromArray($styleArrayBorder);

        $sheet->getStyle('D'.$row_start.':G'.$row_start)->applyFromArray([
            'font' => [
                'bold' => true,
            ]
        ]);        

        foreach ($respondent->student_answers->sortBy(function($answer) {
            return $answer->question->order;
        }) as $i => $answer) {
            $row_current = $i+1;

            $sheet->setCellValue('D'.($row_start+$row_current), $row_current); 
            $sheet->setCellValue('E'.($row_start+$row_current), $answer->question->text); 
            $sheet->setCellValue('F'.($row_start+$row_current), $answer->questionnaire_answer->text); 
            $sheet->setCellValue('G'.($row_start+$row_current), $answer->questionnaire_answer->poin); 

            $row_end = $row_start+$row_current;
            $sheet->getStyle('D'.$row_end)->applyFromArray($styleArrayBorder);
            $sheet->getStyle('E'.$row_end)->applyFromArray($styleArrayBorder);
            $sheet->getStyle('F'.$row_end)->applyFromArray($styleArrayBorder);
            $sheet->getStyle('G'.$row_end)->applyFromArray($styleArrayBorder);
        }        

        $filename = Str::slug($respondent->student->student_id_number.' '.$respondent->student->full_name.' '.$respondent->questionnaire->name, '-').'-'.Carbon::now()->format('Ymdhis').'.xlsx';
        $writer = new Xlsx($spreadsheet);
        
        $response =  new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            }
        );
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="'.$filename.'"');
        $response->headers->set('Cache-Control','max-age=0');
        return $response;
    }
}
