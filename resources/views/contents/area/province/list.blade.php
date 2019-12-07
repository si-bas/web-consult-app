@extends('layouts.template-default')

@include('plugins.datatables')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Provinsi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="sk-layout-2-columns.html"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Wilayah</a>
                        </li>
                        <li class="breadcrumb-item active">Provinsi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="card">
        {{-- <div class="card-header">
            <h4 class="card-title">Daftar Provinsi</h4>
        </div> --}}
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0" id="province-table">
                        <thead class="thead-dark">
                            <tr>
                                <th>NAMA</th>
                                <th>KODE</th>
                                <th>JML KABUPATEN</th>
                                <th>JML KECAMATAN</th>
                                <th>JML KELURAHAN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-bold-500">Michael Right</td>
                                <td class="text-bold-500">UI/UX</td>
                                <td>$15/hr</td>
                                <td>$15/hr</td>
                                <td>$15/hr</td>
                                <td><a href="#"><i class="badge-circle badge-circle-light-secondary bx bx-pencil font-medium-1"></i></a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        $(function () {
            $('#province-table').DataTable({
                language: defaultLang
            });
        });
    </script>
@endpush