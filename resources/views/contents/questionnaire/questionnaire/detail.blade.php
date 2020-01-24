@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Kuesioner</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('questionnaire.list') }}">Kuesioner</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Rincian
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        <span class="invoice-number mr-50">Rincian</span>
                        <span>#{{ $questionnaire->code }}</span>
                    </div>
                    <div class="col-xl-8 col-md-12">
                        <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                            <div class="mr-3">
                                <small class="text-muted">Dibuat Pada:</small>
                                <span>{{ \Carbon\Carbon::parse($questionnaire->created_at)->formatLocalized("%d %B %Y") }}</span>
                            </div>
                            <div>
                                <small class="text-muted">Diubah Pada:</small>
                                <span>{{ $questionnaire->updated_at == $questionnaire->created_at ? '-' : \Carbon\Carbon::parse($questionnaire->updated_at)->formatLocalized("%d %B %Y") }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- logo and title -->
                <div class="row mt-2">
                    <div class="col-6">
                        <h4 class="text-primary">{{ $questionnaire->name }}</h4>
                        <span>{{ $questionnaire->user->name }}</span>
                    </div>
                    <div class="col-6 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-1 mb-1"><i class="bx bx-pencil"></i> Ubah Kuesioner</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mb-1">
        <a href="{{ route('questionnaire.question.form.create', ['questionnaire' => $questionnaire->id]) }}" class="btn btn-primary glow"><i class="bx bx-plus"></i> Pertanyaan Baru</a>
    </div>
    <section class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Pertanyaan</h4>
            <ul class="list-inline d-flex mb-0">
                <li class="d-flex align-items-center">
                    <i class='bx bxs-cog font-medium-3 mr-50'></i>
                    <div class="dropdown">
                        <div class="dropdown-toggle mr-1" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pengaturan
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:;">Standar Tipe Jawaban</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-content">
            <div class="card-body">
                <table class="table mb-0 table-hover" id="questions-table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>NO.</th>
                            <th>PERTANYAAN</th>                            
                            <th>WAJIB</th>
                            <th>AKSI</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection