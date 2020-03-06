@extends('layouts.template-default')

@push('styles')
    <style>
        .radio input[type="radio"], .checkbox input[type="checkbox"] {
            display: block;
            opacity: 0;
            position: absolute;
        }
    </style>
@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Kuesioner</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Kuesioner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Kuesioner Pasca #{{ $questionnaire->code }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="row" action="{{ route('questionnaire.post.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="questionnaire_id" value="{{ $questionnaire->id }}">
                    <div class="col-12">
                        @foreach ($questionnaire->questions->sortBy('order') as $question)
                        <fieldset class="form-group mb-3">
                            <p class="text-bold-400">{{ $question->order }}. {{ $question->text }}</p>
                            @if ($question->answers()->exists())
                            <ul class="list-unstyled mb-0">
                                @foreach ($question->answers as $answer)
                                <li class="mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-{{ $answer->type }}">
                                            <input type="{{ $answer->type }}" class="custom-control-input" id="{{ $answer->type }}_{{ $answer->id }}" name="answers[{{ $question->id }}]{{ $question->type == 'multiple_select' ? '[]' : '' }}" value="{{ $answer->id }}" required>
                                            <label class="custom-control-label" for="{{ $answer->type }}_{{ $answer->id }}">{{ $answer->text }}</label>
                                        </div>
                                    </fieldset>
                                </li>
                                @endforeach
                            </ul>
                            @else
                            <fieldset class="form-group">
                                <label>Jawaban</label>
                                <textarea class="form-control" rows="3" placeholder="Tuliskan jawaban" name="answers[{{ $question->id }}]{{ $question->type == 'multiple_select' ? '[]' : '' }}" required></textarea>
                            </fieldset> 
                            @endif
                        </fieldset>
                        @endforeach
                        <div class="col-12 d-flex justify-content-end ">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Selanjutnya</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            
        });
    </script>
@endpush