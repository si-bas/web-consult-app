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
                <table class="table mb-0 table-hover" id="student-verified-table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>NAMA</th>
                            <th>NIM</th>
                            <th>UMUR</th>
                            <th>SEMESTER</th>                                
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

<div class="modal fade" id="student-update" tabindex="-1" role="dialog" aria-labelledby="studentUpdate" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title white">Formulir Perubahan Data Mahasiswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.student.update.submit') }}" method="POST">

                </form>
            </div>
            <div class="modal-footer">                
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batalkan</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" onclick="updateSubmit()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block"><i class="bx bx-check mr-1"></i>Simpan</span>
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

        let modal_update = $('#student-update');
        let form_update = modal_update.find('form');

        $(function () {
            // unverified_table = $('#student-unverified-table').DataTable({
            //     language: defaultLang,
            //     searching: true,
            //     pageLength: 10,
            //     processing: true,
            //     serverSide: true,
            //     ajax: {
            //         url: '{{ route('user.student.data') }}',
            //         data: function (params) {
                        
            //         }
            //     },
            //     order: [
            //         [6, 'desc']
            //     ],
            //     columnDefs: [
            //         {
            //             orderable: false,
            //             searchable: false,
            //             targets: [0, 5, 3, 4]
            //         },
            //         {
            //             className: 'text-center',
            //             targets: [5]
            //         },
            //         {
            //             visible: false,
            //             targets: [6, 0]
            //         }
            //     ],
            //     columns: [{
            //             data: 'id',
            //             render: function (data, type, row, meta) {
            //                 return meta.row + meta.settings._iDisplayStart + 1;
            //             }
            //         },
            //         {
            //             data: 'name',
            //             name: 'name'
            //         },
            //         {
            //             data: 'student.student_id_number',
            //             name: 'student.student_id_number'
            //         },                                                        
            //         {
            //             data: 'major_name',
            //             name: 'major_name',
                       
            //         },
            //         {
            //             data: 'faculty_name',
            //             name: 'faculty_name'
            //         },
            //         {
            //             data: 'action_verify',
            //             name: 'action_verify'
            //         },
            //         {
            //             data: 'created_at',
            //             name: 'created_at'
            //         }
            //     ]      
            // });

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
                        targets: [0, 5, 3, 4]
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
                        data: 'student.profile.age',
                        name: 'student.profile.age',
                       
                    },
                    {
                        data: 'student.profile.semester',
                        name: 'student.profile.semester'
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

            form_update.submit(e => {
                e.preventDefault();

                let form_data = form_update.serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                modal_update.modal('hide');

                $.post(form_update.attr('action'), form_data).done(result => {
                    let modal_body = modal_update.find('.modal-body');
                    
                    removeAlert(modal_body);

                    if (result.status == 'error') {
                        showAlert('danger', 'bx-error', result.message, modal_body);
                    } else {
                        toastr.success(result.message, 'Berhasil');

                        form_update.trigger('reset');

                        faculty_table.draw(false);
                    }
                });
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

        const updateForm = (id) => {
            $.get("{{ route('user.student.update.form') }}", {
                id
            }).done(function (result) {
                form_update.html(result);
                modal_update.modal('show');
            });
        }

        const updateSubmit = () => {            
            $.get("{{ route('user.student.check.email') }}", {
                id: modal_update.find('input[name=id]').val(),
                email: modal_update.find('input[name=email]').val()
            }).done(function (result) {
                if (result > 0) {                    
                    toastr.error('Email sudah digunakan oleh akun lain!', 'Perhatian');
                } else {
                    modal_update.find(':submit').click();
                }
            });

        }
    </script>
@endpush