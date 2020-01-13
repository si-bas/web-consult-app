@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Mahasiswa</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Mahasiswa
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
            <h4 class="card-title">Mahasiswa Belum Terverifikasi</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                {{-- <div class="table-responsive"> --}}
                    <table class="table mb-0 table-hover" id="student-unverified-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>FAKULTAS</th>                                
                                <th>JURUSAN</th>
                                <th>AKSI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                {{-- </div> --}}
            </div>
            
        </div>
    </section>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Mahasiswa Sudah Terverifikasi</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                {{-- <div class="table-responsive"> --}}
                    <table class="table mb-0 table-hover" id="student-verified-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>FAKULTAS</th>                                
                                <th>JURUSAN</th>
                                <th>AKSI</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                {{-- </div> --}}
            </div>
            
        </div>
    </section>
</div>

<div class="modal fade" id="student-detail" tabindex="-1" role="dialog" aria-labelledby="studentDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Rincian Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>
                <button type="button" class="btn btn-primary ml-1">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><i class="bx bx-check mr-1"></i>Verifikasi</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let unverified_table;

        $(function () {
            unverified_table = $('#student-unverified-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.student.data') }}',
                    data: function (params) {
                        
                    }
                },
                order: [
                    [6, 'desc']
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0, 5]
                    },
                    {
                        className: 'text-center',
                        targets: [5]
                    },
                    {
                        visible: false,
                        targets: [6, 0]
                    }
                ],
                columns: [{
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'student.student_id_number',
                        name: 'student.student_id_number'
                    },                                    
                    {
                        data: 'student.major.faculty.name',
                        name: 'student.major.faculty.name'
                    },
                    {
                        data: 'student.major.name',
                        name: 'student.major.name'
                    },
                    {
                        data: 'action_verify',
                        name: 'action_verify'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]      
            });
        });

        const modal_detail = $('#student-detail');

        const showDetail = (id) => {
            $.get("{{ route('user.student.detail') }}", {
                id
            }).done((result) => {
                // modal_detail.find('.modal-body').html(result);
                // modal_detail.modal('show');
                console.log(result);
                
            });
        }
    </script>
@endpush