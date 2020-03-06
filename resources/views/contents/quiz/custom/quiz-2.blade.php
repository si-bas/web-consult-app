@extends('layouts.template-default')

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
                            Kuis Kedua
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
            <h4 class="card-title">Kuis #2</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('quiz.required.quiz.two.submit') }}" method="POST" enctype="multipart/form-data" id="form-quiz">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                    <fieldset class="form-group mb-3">
                        <p class="text-bold-400">1. Ada pengalaman yang buruk dihina teman, sakit hati: pilihlah dengan memilih checklist (√) salah satunya:</p>
                        <div class="row">
                            <div class="col-md-6">
                                <h6>Kasus A</h6>
                                <ol>
                                    <li>Sadar ada yang berbuat buruk pada saya,</li>
                                    <li>Saya mengambil keputusan untuk membalasnya</li>
                                    <li>Saya tidak mempunyai pilihan untuk melakukan hal yang baik </li>
                                    <li>Saya sulit bisa berkarya dan berprestasi dengan membiarkan orang yang menyakiti saya </li> 
                                    <li>Ada rasa mengganjal dihati dan membuat susah tidur, nyesek dihati</li>                                        
                                </ol>
                            </div>
                            <div class="col-md-6">
                                <h6>Kasus B</h6>
                                <ol>
                                    <li>Sadar ada yang berbuat buruk pada saya,</li>
                                    <li>Saya mengambil keputusan untuk tidak membalasnya</li>
                                    <li>Saya mempunyai pilihan untuk melakukan hal yang baik </li>
                                    <li>Saya bisa berkarya dan berprestasi dengan memaafkan, mengikhlaskan orang yang menyakiti saya  </li>
                                    <li>Ploong / lega
                                </ol>
                            </div>
                        </div>
                        <p class="text-bold-400">Dari kasus diatas anda lebih cenderung seperti:</p>
                        <ul class="list-unstyled mb-0">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="case-1" name="case" value="Kasus A" required>
                                        <label class="custom-control-label" for="case-1">Kasus A</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="case-2" name="case" value="Kasus B" required>
                                        <label class="custom-control-label" for="case-2">Kasus B</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <hr>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400">2. Pendapat anda dengan apa yang anda alami diatas sikap anda: (pilih salah satu):</p>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Rasa marah</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-1-1" name="component[A][0]" value="1" required>
                                            <label class="custom-control-label" for="custom-1-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-1-2" name="component[A][0]" value="0" required>
                                            <label class="custom-control-label" for="custom-1-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Sedih</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-2-1" name="component[A][1]" value="1" required>
                                            <label class="custom-control-label" for="custom-2-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-2-2" name="component[A][1]" value="0" required>
                                            <label class="custom-control-label" for="custom-2-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Kecewa dengan Tuhan dan orang lain</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-3-1" name="component[A][2]" value="1" required>
                                            <label class="custom-control-label" for="custom-3-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-3-2" name="component[A][2]" value="0" required>
                                            <label class="custom-control-label" for="custom-3-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Dendam</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-4-1" name="component[A][3]" value="1" required>
                                            <label class="custom-control-label" for="custom-4-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-4-2" name="component[A][3]" value="0" required>
                                            <label class="custom-control-label" for="custom-4-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Membalas</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-5-1" name="component[A][4]" value="1" required>
                                            <label class="custom-control-label" for="custom-5-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-5-2" name="component[A][4]" value="0" required>
                                            <label class="custom-control-label" for="custom-5-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Memaafkan</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-6-1" name="component[B][0]" value="1" required>
                                            <label class="custom-control-label" for="custom-6-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-6-2" name="component[B][0]" value="0" required>
                                            <label class="custom-control-label" for="custom-6-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Mengikhlaskan</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-7-1" name="component[B][1]" value="1" required>
                                            <label class="custom-control-label" for="custom-7-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-7-2" name="component[B][1]" value="0" required>
                                            <label class="custom-control-label" for="custom-7-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Bersyukur</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-8-1" name="component[B][2]" value="1" required>
                                            <label class="custom-control-label" for="custom-8-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-8-2" name="component[B][2]" value="0" required>
                                            <label class="custom-control-label" for="custom-8-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                        <fieldset class="form-group mb-1">
                            <p class="text-bold-400">Sabar</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-9-1" name="component[B][3]" value="1" required>
                                            <label class="custom-control-label" for="custom-9-1">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="custom-9-2" name="component[B][3]" value="0" required>
                                            <label class="custom-control-label" for="custom-9-2">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
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