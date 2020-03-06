@extends('layouts.template-default')

@push('styles')
    <style>
        .radio input[type="radio"], .checkbox input[type="checkbox"] {
            display: block;
            opacity: 0;
            position: absolute;
        }

        .select2-container--default .select2-selection--single {
            background-color: #fff;
            border: 1px solid #aaa;
            border-radius: 4px;
        }
        
        .select2-container--classic.select2-container--focus, .select2-container--default.select2-container--focus {
            border: 1px solid wheat;
        }
    </style>
@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Kuis</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Kuis
                        </li>
                        <li class="breadcrumb-item">
                            Kuis Ketiga
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
            <h4 class="card-title">Kuis #3</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('quiz.required.quiz.three.submit') }}" method="POST" enctype="multipart/form-data" id="form-quiz">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <fieldset class="form-group mb-3">
                        <p><b>Afirmasi</b> adalah latihan untuk pernyataan/ penetapan/ penegasan/ peneguhan yang positif dengan kata-kata positif secara berulang-ulang untuk berpikir dan bertindak dengan cara yang baru dan mempengaruhi pikiran bawah sadar</p>
                        <p><b>Contoh:</b> saya bisa melakukannya, saya kuat, saya sehat, saya sanggup menghadapinya.</p>
                        <p class="text-bold-400">1. Apakah anda pernah melakukan afirmasi?</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-1-1" name="affirmation_boolean" value="1" required>
                                        <label class="custom-control-label" for="custom-1-1">Ya</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-1-2" name="affirmation_boolean" value="0" required>
                                        <label class="custom-control-label" for="custom-1-2">Tidak</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <hr>
                    <fieldset class="form-group mb-3">
                        <p class="text-bold-400">2. Isilah dibawah ini tanggapan rasional dan afirmasi yang akan anda lakukan sesuai apa yang anda alami?</p>
                        
                        <p class="text-bold-400 mb-0"><b>Contoh: Saya tidak pernah benar</b></p>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional">Saya juga pernah melakukan hal yang baik</textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi">Saya bisa</textarea>                                                        
                        </fieldset>
                        
                        <p class="text-bold-400 mb-0 mt-3"><b>Saya selalu sial</b></p>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional" name="rational[0]" required></textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi" name="affirmation[0]" required></textarea>                                                        
                        </fieldset>

                        <p class="text-bold-400 mb-0 mt-3"><b>Tidak ada orang yang peduli dengan saya</b></p>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional" name="rational[1]" required></textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi" name="affirmation[1]" required></textarea>                                                        
                        </fieldset>

                        <p class="text-bold-400 mb-0 mt-3"><b>Saya selalu dapat nilai yang jelek</b></p>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional" name="rational[2]" required></textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi" name="affirmation[2]" required></textarea>                                                        
                        </fieldset>

                        <p class="text-bold-400 mb-0 mt-3"><b>Saya selalu sulit berteman</b></p>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional" name="rational[3]" required></textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi" name="affirmation[3]" required></textarea>                                                        
                        </fieldset>

                        <p class="text-bold-400 mb-0 mt-3"><b>Saya krisis kepercayaan dengan teman</b></p>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional" name="rational[4]" required></textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi" name="affirmation[4]" required></textarea>                                                        
                        </fieldset>

                        <p class="text-bold-400 mb-0 mt-3"><b>Isi yang lain jika ada ………….</b></p>
                        <fieldset class="form-group">                            
                            <textarea class="form-control" rows="3" placeholder="Tuliskan lainnya" name="distortion_other"></textarea>                                                        
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Tanggapan Rasional</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Tanggapan Rasional" name="rational_other"></textarea>                                                        
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Afirmasi</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan Afirmasi" name="affirmation_other"></textarea>                                                        
                        </fieldset>
                    </fieldset>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mr-1 mb-1" >Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection