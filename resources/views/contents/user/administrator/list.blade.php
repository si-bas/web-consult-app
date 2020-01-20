@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Administrator</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Administrator
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="mb-1">
        <button type="button" class="btn btn-primary glow" data-toggle="modal" data-target="#modal-create"><i class="bx bx-plus"></i> Administrator Baru</button>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Administrator</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <table class="table mb-0 table-hover" id="administrator-table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>STATUS</th>
                            <th>TERDAFTAR</th>                                
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

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Formulir Administrator Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.administrator.create.submit') }}" method="POST" class="row" id="form-create">
                    @csrf
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label for="basicInput">Nama Administrator <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama lengkap" name="name" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">Email Administrator <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Tuliskan email" name="email" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">Kata Sandi <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Tuliskan kata sandi" name="password" required>
                        </fieldset>
                    </div>

                    <button type="submit" style="display: none"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batalkan</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" onclick="submitCreate()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Formulir Perubahan Administrator</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('user.administrator.update.submit') }}" method="POST" class="row" id="form-update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label for="basicInput">Nama Administrator <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama lengkap" name="name" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">Email Administrator <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Tuliskan email" name="email" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">Kata Sandi</label>
                            <small class="text-muted">diisi apabila ingin mengubah kata sandi sebelumnya</small>
                            <input type="password" class="form-control" placeholder="Tuliskan kata sandi" name="password">
                        </fieldset>
                    </div>

                    <button type="submit" style="display: none"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batalkan</span>
                </button>
                <button type="button" class="btn btn-primary ml-1" onclick="submitUpdate()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let administrator_table; 

        $(function () {
            administrator_table = $('#administrator-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.administrator.data') }}',
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
                        data: 'email',
                        name: 'email'
                    },                                                        
                    {
                        data: 'verified_at',
                        name: 'verified_at'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    }
                ]      
            });
        });

        const form_create = $('#form-create');
        const submitCreate = () => {
            let email = form_create.find('input[name=email]').val();

            $.get("{{ route('user.administrator.check.email') }}", {
                email
            }).done((result) => {
                let alert_section = form_create.parent();
                removeAlert(alert_section);
                
                if (result > 0) {
                    showAlert('danger', 'bx-error', 'Error! Email telah digunakan, silahkan gunakan email lain.', alert_section);
                } else {
                    form_create.find(':submit').click();
                }
            });
        }

        const form_update = $('#form-update');
        const modal_update = $('#modal-update');
        const showFormUpdate = id => {
            form_update.trigger('reset');

            $.get("{{ route('user.administrator.get.data') }}", {
                id
            }).done(result => {
                $.map(result, (value, index) => {
                    bindInputValue(form_update.find(`input[name=${index}]`), value);
                });

                modal_update.modal('show');
            });
        }

        const submitUpdate = () => {
            form_update.find(':submit').click();
        }

        const submitDeactive = (id) => {
            $.post('{{ route('user.administrator.switch.status') }}', {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                id
            }).done(result => {
                if (result.status == 'error') {
                    toastr.error(result.message, 'Perhatian');
                } else {
                    toastr.success(result.message, 'Berhasil');
                    
                    administrator_table.draw(false);
                }
            });
        }

        const deactiveRow = (id, name, status) => {
            toastr.warning(`Yakin ${status} ${name}?
            <br/>
            <br/>
            <button type="button" class="btn btn-secondary clear" onclick="submitDeactive(${id})">Ya, hapus!</button><button type="button" class="btn btn-light clear ml-1">Tidak</button>`, 'Perhatian', {
                positionClass: 'toast-top-right',
            });
        }
    </script>
@endpush

@if (Session::has('success'))
    @push('scripts')
        <script>
            toastr.success("{{ Session::get('success') }}", 'Berhasil');
        </script>
    @endpush
@endif

@if (Session::has('error'))
    @push('scripts')
        <script>
            toastr.error("{{ Session::get('error') }}", 'Gagal');
        </script>
    @endpush
@endif