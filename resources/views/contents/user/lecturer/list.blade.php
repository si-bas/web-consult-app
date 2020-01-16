@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Dosen</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Dosen
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="mb-1">
        <a href="{{ route('user.lecturer.form.create') }}" class="btn btn-primary glow"><i class="bx bx-plus"></i> Dosen Baru</a>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Dosen</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <table class="table mb-0 table-hover" id="student-unverified-table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>NAMA</th>
                            <th>NIP</th>
                            <th>JURUSAN</th>
                            <th>FAKULTAS</th>                                
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