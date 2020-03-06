@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Konsultasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Konsultasi
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
            <h3 class="greeting-text text-center">Selamat!</h3>            
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="text-center">
                    <img src="{{ asset('template-default/app-assets/images/icon/cup.png') }}" height="180" width="180" class="img-fluid" alt="thanks">
                </div>        
                <p class="mb-1 mt-1">
                    @if (Auth::user()->student->need_consult)
                    Selamat anda telah bergabung di Website ini. Silahkan anda membaca website mengikuti kuis,  Power Point  dan video. Anda wajib mengunjungi  konsultasi, silahkan memilih chatting atau meeting / pertemuan dengan konselor. Kerahasiaan akan dijaga atau dijamin oleh konselor.
                    @else
                        Selamat anda telah bergabung di Website ini. Silahkan membaca website mengikuti kuis,  Power Point  dan video.
                    @endif
                </p>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end ">
                        <button type="submit" class="btn btn-primary mt-2" onclick="location.href='{{ route('quiz.required.check') }}';">Selanjutnya</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection