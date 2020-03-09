@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Evaluasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Evaluasi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir Evaluasi</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p><b>Keterangan;</b> Kondisi perasaan:</p>
                <ul>
                    <li>0	=	Tidak Galau</li>
                    <li>1-3	=	Ringan</li>
                    <li>4-6	=	Sedang </li>
                    <li>7-8	=	Berat </li>
                    <li>9-10	=	Galau Sekali/Sangat Berat</li>
                </ul>
                <p><b>Keterangan;</b> Kemampuan mengatasi masalah:</p>
                <ul>
                    <li>0	=	Tidak mampu mengatasi masalah </li>
                    <li>1-3	=	Kurang mampu mengatasi masalah </li>
                    <li>4-6	=	Agak mampu mengatasi masalah </li>
                    <li>7-8	=	Mampu mengatasi masalah </li>
                    <li>9-10	=	Sangat mampu mengatasi masalah</li>
                </ul>
                <hr>
                <form class="row" action="{{ route('evaluation.form.submit') }}" method="POST" enctype="multipart/form-data">
                   @csrf
                   <div class="col-12">
                    <p class="text-bold-400"><b>1. Sebelumnya anda masuk skala rentang berapa?</b></p>
                    <fieldset class="form-group mb-1">
                         <p class="text-bold-400 mb-0">Kondisi Perasaan</p>
                         <select class="form-control mb-1" name="feeling_before" required>  
                             <option value="" selected disabled>Silhkan Pilih</option>                          
                             @for ($i = 0; $i <= 10; $i++)
                                 <option value="{{ $i }}">{{ $i }}</option>
                             @endfor
                         </select>
                    </fieldset>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400 mb-0">Kemampuan Mengatasi Masalah</p>
                        <select class="form-control mb-1" name="ability_before" required>  
                            <option value="" selected disabled>Silhkan Pilih</option>                          
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                   </fieldset>
                   <hr>

                   <p class="text-bold-400"><b>2. Sekarang berada di rentang angka berapa?</b></p>
                    <fieldset class="form-group mb-1">
                         <p class="text-bold-400 mb-0">Kondisi Perasaan</p>
                         <select class="form-control mb-1" name="feeling_after" required>  
                             <option value="" selected disabled>Silhkan Pilih</option>                          
                             @for ($i = 0; $i <= 10; $i++)
                                 <option value="{{ $i }}">{{ $i }}</option>
                             @endfor
                         </select>
                    </fieldset>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400 mb-0">Kemampuan Mengatasi Masalah</p>
                        <select class="form-control mb-1" name="ability_after" required>  
                            <option value="" selected disabled>Silhkan Pilih</option>                          
                            @for ($i = 0; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                   </fieldset>
                   <hr>
                   <fieldset class="form-group mb-1">
                        <p class="text-bold-400"><b>3. Apakah anda puas dengan web ini?</b></p>
                        <ul class="list-unstyled mb-0">
                            <li class="mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-6-1" name="satisfaction" value="puas" required>
                                        <label class="custom-control-label" for="custom-6-1">Puas</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-6-2" name="satisfaction" value="kurang puas" required>
                                        <label class="custom-control-label" for="custom-6-2">Kurang Puas</label>
                                    </div>
                                </fieldset>
                            </li>
                            <li class="mr-2 mb-1">
                                <fieldset>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="custom-6-3" name="satisfaction" value="tidak puas" required>
                                        <label class="custom-control-label" for="custom-6-3">Tidak Puas</label>
                                    </div>
                                </fieldset>
                            </li>
                        </ul>
                    </fieldset>
                    <hr>
                    <fieldset class="form-group mb-1">
                        <p class="text-bold-400"><b>4. Kritik & Saran</b></p>
                        <textarea class="form-control" rows="3" placeholder="Tuliskan disini" name="suggestions"></textarea>
                    </fieldset>
                   </div>
                   <div class="col-12 d-flex justify-content-end ">
                        <button type="submit" class="btn btn-primary mr-1 mb-1">Simpan</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection