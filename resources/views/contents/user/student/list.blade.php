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
            <h4 class="card-title">Daftar Mahasiswa</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="unverified-tab" data-toggle="tab" href="#unverified" aria-controls="unverified" role="tab" aria-selected="false">
                            <i class="bx bx-user align-middle"></i>
                            <span class="align-middle">Belum Terverifikasi</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="verified-tab" data-toggle="tab" href="#verified" aria-controls="verified" role="tab" aria-selected="false">
                            <i class="bx bx-user-check align-middle"></i>
                            <span class="align-middle">Sudah Terverifikasi</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="unverified" aria-labelledby="unverified-tab" role="tabpanel">
                        <table class="table mb-0 table-hover" id="student-unverified-table" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>NAMA</th>
                                    <th>NIM</th>
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
                    <div class="tab-pane" id="verified" aria-labelledby="verified-tab" role="tabpanel">
                        <table class="table mb-0 table-hover" id="student-verified-table" style="width: 100%">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>NAMA</th>
                                    <th>NIM</th>
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
            </div>
            
        </div>
    </section>
</div>

<div class="modal fade" id="student-detail" tabindex="-1" role="dialog" aria-labelledby="studentDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title white">Rincian Mahasiswa</h5>
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
                <button type="button" class="btn btn-primary ml-1 verification" onclick="detailVerify()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><i class="bx bx-check mr-1"></i>Verifikasi</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('template-default/app-assets/js/scripts/navs/navs.js') }}"></script>
    <script>
        let unverified_table;
        let verified_table;

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
                        data: 'student.major.name',
                        name: 'student.major.name'
                    },
                    {
                        data: 'student.major.faculty.name',
                        name: 'student.major.faculty.name'
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

            verified_table = $('#student-verified-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.student.data') }}',
                    data: function (params) {
                        params.is_verified = true;
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
                        data: 'student.major.name',
                        name: 'student.major.name'
                    },
                    {
                        data: 'student.major.faculty.name',
                        name: 'student.major.faculty.name'
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
                modal_detail.find('.modal-body').html(result);
                
                verified = modal_detail.find('input[name=verified_at]').val();
                if (verified == null) {
                    modal_detail.find('.verification').show();
                } else {
                    modal_detail.find('.verification').hide();
                }

                modal_detail.modal('show');
            });
        }

        const detailVerify = () => {
            let id = modal_detail.find('input[type=hidden]').val();

            if (id > 0) {
                verifyUser(id);
                modal_detail.modal('hide');
            }
        }

        const verifyUser = (id) => {
            $.post("{{ route('user.student.verify.submit') }}", {
                _token: "{{ csrf_token() }}",
                id
            }).done((result) => {
                if (result.status == 'error') {
                    toastr.error(result.message, 'Perhatian');
                } else {
                    toastr.success(result.message, 'Berhasil');
                    
                    unverified_table.draw(false);
                }
            });
        }
    </script>
@endpush