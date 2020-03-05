@extends('layouts.template-default')

@include('plugins.repeater')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Formulir Perubahan Pertanyaan</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('questionnaire.list') }}">Kuesioner</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('questionnaire.detail', [
                            'id' => $question->id
                        ]) }}">Rincian</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Formulir Pertanyaan
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Formulir</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('questionnaire.question.update.submit') }}" method="POST" enctype="multipart/form-data" id="form-create">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $question->id }}">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="row">
                                <div class="col-6 col-md-6 col-sm-12">
                                    <fieldset class="form-group">
                                        <label>Nomor Pertanyaan <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Tuliskan nomor" name="order" value="{{ $question->order }}" required>
                                    </fieldset> 
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <label>Teks Pertanyaan <span class="text-danger">*</span></label>
                                <textarea class="form-control" rows="3" placeholder="Tuliskan pertanyaan" name="text" required>{{ $question->text }}</textarea>
                            </fieldset> 
                            <fieldset class="form-group">
                                <label>Tipe Pertanyaan <span class="text-danger">*</span></label>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($question->questionnaire->question_types as $value => $label)
                                    <li class="d-inline-block mr-2 mb-1">
                                        <fieldset>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="type" id="type_{{ $value }}" value="{{ $value }}" {{ $question->type == $value ? 'checked' : '' }} required>
                                                <label class="custom-control-label" for="type_{{ $value }}">{{ $label }}</label>
                                            </div>
                                        </fieldset>
                                    </li>
                                    @endforeach
                                </ul>
                            </fieldset> 
                            <hr class="mt-2">
                            <div class="repeater-default">
                                <div data-repeater-list="answers">
                                    @if ($question->answers()->exists())
                                        @foreach ($question->answers as $answer)
                                        <div data-repeater-item>
                                            <div class="row justify-content-between">
                                                <div class="col-md-8 col-sm-12 form-group">
                                                    <input type="hidden" name="answer_id" value="{{ $answer->id }}">
                                                    <label>Pilihan Jawaban </label>
                                                    <input type="text" class="form-control answers" placeholder="Tuliskan teks pilihan" name="answer_text" value="{{ $answer->text }}" required>
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group">                                                    
                                                    <label>Nilai </label>
                                                    <input type="text" class="form-control answers" placeholder="Skor" name="answer_poin" value="{{ $answer->poin }}" required>
                                                </div>
                                                <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                                    <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        @endforeach
                                    @else
                                    <div data-repeater-item>
                                        <div class="row justify-content-between">
                                            <div class="col-md-8 col-sm-12 form-group">
                                                <label>Pilihan Jawaban </label>
                                                <input type="text" class="form-control answers" placeholder="Tuliskan teks pilihan" name="answer_text" required>
                                            </div>
                                            <div class="col-md-2 col-sm-12 form-group">                                                    
                                                <label>Nilai </label>
                                                <input type="text" class="form-control answers" placeholder="Skor" name="answer_poin" required>
                                            </div>
                                            <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                                <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"> <i class="bx bx-x"></i>
                                                    Hapus
                                                </button>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <div class="col p-0">
                                        <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                            Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" style="display: none"></button>
                        <div class="col-12 d-flex justify-content-end ">
                            <button type="button" class="btn btn-primary mr-1 mb-1" onclick="submitForm()">Simpan</button>
                            <a href="{{ route('questionnaire.detail', [
                                'id' => $question->questionnaire->id
                            ]) }}" class="btn btn-light-secondary mr-1 mb-1">Batalkan</a>
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
            $('.file-repeater, .contact-repeater, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });

            $('input[name=type]').change(function (e) {
                let repeater = $('.repeater-default');               
                if (this.value == 'free_text') {
                    $('.answers').each(function (e) {
                        $(this).removeAttr('required');
                    });

                    repeater.fadeOut('slow');
                } else {
                    $('.answers').each(function (e) {
                        $(this).attr('required');
                    });

                    repeater.fadeIn('slow');
                }
            });
        });

        const form_create = $('#form-create');

        const submitForm = () => {
            form_create.find(':submit').click();
        }
    </script>
@endpush