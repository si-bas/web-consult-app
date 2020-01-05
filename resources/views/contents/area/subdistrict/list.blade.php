@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.select2')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Kecamatan</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="javascript:;">Wilayah</a>
                        </li>
                        <li class="breadcrumb-item active">Kecamatan
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="mb-1">
        <button type="button" class="btn btn-primary glow" data-toggle="modal" data-target="#modal-create"><i class="bx bx-plus"></i> Kecamatan Baru</button>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Kecamatan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="subdistrict-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>KODE</th>
                                <th>NAMA KABUPATEN</th>
                                <th>JML DESA</th>
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
    </section>
</div>

<div class="modal fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Formulir Kecamatan Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('area.subdistrict.create.submit') }}" method="POST" class="row" id="form-create">
                    @csrf
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label for="basicInput">Nama Kecamatan</label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama" name="name" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">Kode Kecamatan</label>
                            <input type="text" class="form-control" placeholder="Tuliskan kode" name="code" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Pilih Kabupaten</label>
                            <select class="select2 form-control" name="district_id" required style="width: 100%">
                                <option></option>
                            </select>
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Formulir Perubahan Kecamatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('area.subdistrict.update.submit') }}" method="POST" class="row" id="form-update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label for="basicInput">Nama Kecamatan</label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama" name="name" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label for="basicInput">Kode Kecamatan</label>
                            <input type="text" class="form-control" placeholder="Tuliskan kode" name="code" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Pilih Kabupaten</label>
                            <select class="select2 form-control" name="district_id" required style="width: 100%">
                                <option></option>
                            </select>
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
        let subdistrict_table;

        $(function () {
            subdistrict_table = $('#subdistrict-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('area.subdistrict.data') }}',
                    data: function (params) {
                        
                    }
                },
                order: [
                    [6, 'asc']
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0]
                    },
                    {
                        className: 'text-center',
                        targets: [4, 5]
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
                        data: 'code',
                        name: 'code'
                    },                                    
                    {
                        data: 'district.name',
                        name: 'district.name'
                    },
                    {
                        data: 'villages_count',
                        name: 'villages_count',
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    }
                ]      
            });
        });

        const modal_create = $('#modal-create');
        const form_create = $('#form-create');
        const select_district_create = form_create.find('select[name=district_id]');
        
        const modal_update = $('#modal-update');
        const form_update = $('#form-update');
        const select_district_update = form_update.find('select[name=district_id]');

        $(function () {
            select_district_create.select2({
                dropdownParent: modal_create,
                placeholder: 'Pilih kabupaten',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('area.subdistrict.get.districts') }}",
                    dataType: 'json',
                    type: "GET",
                    quietMillis: 50,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });

            select_district_update.select2({
                dropdownParent: modal_update,
                placeholder: 'Pilih kabupaten',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('area.subdistrict.get.districts') }}",
                    dataType: 'json',
                    type: "GET",
                    quietMillis: 50,
                    data: function(params) {
                        return {
                            search: params.term
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });

            form_create.submit(e => {
                e.preventDefault();

                let form_data = form_create.serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                $.post(form_create.attr('action'), form_data).done(result => {
                    let modal_body = modal_create.find('.modal-body');
                    
                    removeAlert(modal_body);

                    if (result.status == 'error') {
                        showAlert('danger', 'bx-error', result.message, modal_body);
                    } else {
                        toastr.success(result.message, 'Berhasil');

                        form_create.trigger('reset');
                        select_district_create.val('').trigger('change');

                        modal_create.modal('hide');

                        subdistrict_table.draw(false);
                    }
                });
            });

            form_update.submit(e => {
                e.preventDefault();

                let form_data = form_update.serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                $.post(form_update.attr('action'), form_data).done(result => {
                    let modal_body = modal_update.find('.modal-body');
                    
                    removeAlert(modal_body);

                    if (result.status == 'error') {
                        showAlert('danger', 'bx-error', result.message, modal_body);
                    } else {
                        toastr.success(result.message, 'Berhasil');

                        form_update.trigger('reset');
                        modal_update.modal('hide');

                        subdistrict_table.draw(false);
                    }
                });
            });
        });

        const submitCreate = () => {
            form_create.find(':submit').click();
        }
        
        const showFormUpdate = id => {
            form_update.trigger('reset');

            $.get("{{ route('area.subdistrict.get.data') }}", {
                id
            }).done(result => {
                $.map(result, (value, index) => {
                    bindInputValue(form_update.find(`input[name=${index}]`), value);
                });

                if (typeof result.district != 'undefined') {
                    bindSelect2Value(select_district_update, result.district.id, result.district.name);
                }

                modal_update.modal('show');
            });
        }

        const submitUpdate = () => {
            form_update.find(':submit').click();
        }

        const submitDelete = id => {
            $.post('{{ route('area.subdistrict.delete.submit') }}', {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE',
                id
            }).done(result => {
                if (result.status == 'error') {
                    toastr.error(result.message, 'Perhatian', {positionClass: 'toast-top-right'});
                } else {
                    toastr.success(result.message, 'Berhasil', {positionClass: 'toast-top-right'});
                    
                    subdistrict_table.draw(false);
                }
            });;
        }

        const deleteRow = (id, name) => {
            toastr.warning(`Yakin menghapus ${name}?
            <br/>
            <br/>
            <button type="button" class="btn btn-secondary clear" onclick="submitDelete(${id})">Ya, hapus!</button><button type="button" class="btn btn-light clear ml-1">Tidak</button>`, 'Perhatian', {
                positionClass: 'toast-top-right',
            });
        }
    </script>
@endpush