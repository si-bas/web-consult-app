@extends('layouts.template-default')

@include('plugins.select2')

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
                            Kuis Pertama
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
            <h4 class="card-title">Kuis #1</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('quiz.required.quiz.one.submit') }}" method="POST" enctype="multipart/form-data" id="form-quiz">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <fieldset class="form-group mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Kasus A</h6>
                                <p class="mt-0">Agus setelah konsultasi skripsi atau tugas kuliah mendapat 5 coretan</p>
                                <ul>
                                    <li>Respon yang ada pada agus; langsung berfikir “ saya bodoh, saya tidak mampu”</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>Kasus B</h6>
                                <p class="mt-0">Ani setelah konsultasi skripsi atau tugas kuliah mendapat 5 coretan</p>
                                <ul>
                                    <li>Respon yang ada pada Ani; langsung berfikir “ untung saya mendapatkan beberapa coretan dikoreksi keseluruhan sehingga saya bisa memperbaiki apa yang kurang dan menjadi lebih baik, lebih sempurna</li>
                                </ul>
                            </div>
                        </div>
                        <p class="text-bold-400">Dari kasus diatas anda lebih cenderung seperti:</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-1-1" name="case" value="Kasus A" required>
                                        <label class="custom-control-label" for="custom-1-1">Agus (Kasus A)</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-1-2" name="case" value="Kasus B" required>
                                        <label class="custom-control-label" for="custom-1-2">Ani (Kasus B)</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <hr>
                    <p>Berikut ini adalah kalimat-kalimat distorsi kognitif/pikiran negatif dan checklist yang pernah anda alami:</p>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400">A. Saya selalu sial</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-2-1" name="distortion[A]" value="1" required>
                                        <label class="custom-control-label" for="custom-2-1">Ya</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-2-2" name="distortion[A]" value="0" required>
                                        <label class="custom-control-label" for="custom-2-2">Tidak</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400">B. Tidak ada orang yang peduli dengan saya</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-3-1" name="distortion[B]" value="1" required>
                                        <label class="custom-control-label" for="custom-3-1">Ya</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-3-2" name="distortion[B]" value="0" required>
                                        <label class="custom-control-label" for="custom-3-2">Tidak</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400">C. Saya selalu dapat nilai yang jelek</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-4-1" name="distortion[C]" value="1" required>
                                        <label class="custom-control-label" for="custom-4-1">Ya</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-4-2" name="distortion[C]" value="0" required>
                                        <label class="custom-control-label" for="custom-4-2">Tidak</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400">D. Saya selalu sulit berteman</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-5-1" name="distortion[D]" value="1" required>
                                        <label class="custom-control-label" for="custom-5-1">Ya</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-5-2" name="distortion[D]" value="0" required>
                                        <label class="custom-control-label" for="custom-5-2">Tidak</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400">E. Saya krisis kepercayaan dengan teman</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-6-1" name="distortion[E]" value="1" required>
                                        <label class="custom-control-label" for="custom-6-1">Ya</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-6-2" name="distortion[E]" value="0" required>
                                        <label class="custom-control-label" for="custom-6-2">Tidak</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <fieldset class="form-group mb-3">
                        <p class="text-bold-400">F. Isi yang lain jika ada ………….</p>
                        <textarea class="form-control" rows="3" placeholder="Tuliskan disini" name="distortion[F]"></textarea>
                    </fieldset>
                    <hr>
                    <fieldset class="form-group mb-3">
                        <p class="text-bold-400">Skala rentang angka distorsi kognitif atau pikiran negatif yang dialami adalah? (1-10) </p>
                        <select class="form-control mb-1" name="distortion_scale" required>  
                            <option value="" selected disabled>Silhkan Pilih</option>                          
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <p><b>Keterangan;</b> Distorsi Kognitif/Pikiran Negatif</p>
                        <ul>
                            <li>0	=	Tidak terdapat distorsi kognitif/pikiran negatif</li>
                            <li>1-3	=	Distorsi kognitif muncul sedikit (sesekali)</li>
                            <li>4-6	=	Distorsi kognitif muncul kadang </li>
                            <li>7-8	=	Distorsi kognitif muncul sering </li>
                            <li>9-10	=	Terdapat distorsi kognitif yang selalu muncul (setiap saat)</li>
                        </ul>
                    </fieldset>
                    <button type="submit" style="display: none"></button>
                    <div class="col-12 d-flex justify-content-end">
                        <button type="button" class="btn btn-primary mr-1 mb-1" onclick="submitForm()">Selanjutnya</button>
                    </div>
                </form>
                <div class="text-center">
                    <h5 style="display: none" id="message-quiz">Selama kamu tidak menyetop fikiran negatif/distorsi kogitif, dan tidak merubah cara berfikir kamu anda akan sulit untuk berubah lebih baik</h5>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $(".select2").select2({
                // the following code is used to disable x-scrollbar when click in select input and
                // take 100% width in responsive also
                dropdownAutoWidth: true,
                width: '100%'
            });

            let do_once = true;

            $('#form-quiz').submit( function(event) { 
                let form = $('#form-quiz');                  
                let message = $('#message-quiz');            
                
                if (do_once) {
                    event.preventDefault();

                    $(this).fadeOut('slow', function () { 
                        message.fadeIn();

                        setTimeout( function () { 
                            do_once = false;
                            form.submit();
                        }, 3000);
                    });
                }
            }); 
        });
        
        const submitForm = () => {
            let form = $('#form-quiz');
            form.find(':submit').click();            
        }
    </script>
@endpush