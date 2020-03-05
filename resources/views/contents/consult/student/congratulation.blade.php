@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Konsultasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
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
<div>
    <div class="card">
        <div class="card-header">
            <h3 class="greeting-text">Terima Kasih!</h3>
            <p class="mb-0">Telah mengisi kuesioner dan kuis, serta melihat konten yang telah disediakan.</p>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="dashboard-content-right">
                    <img src="{{ asset('template-default/app-assets/images/icon/cup.png') }}" height="220" width="220" class="img-fluid" alt="thanks">
                </div>        
                <p class="mt-1">Anda akan mendapatkan notifikasi via Email untuk mengisi kuesioner kembali.</p>    
            </div>
        </div>
    </div>
</div>
@endsection