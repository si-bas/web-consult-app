@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')
@include('plugins.quill')

@section('content')
    <div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Aktifitas Mahasiswa</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Laporan
                        </li>
                        <li class="breadcrumb-item active">
                            Aktifitas Mahasiswa
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="mb-1">
        <button type="button" class="btn btn-primary glow" data-toggle="modal" data-target="#modal-email"><i class="bx bx-mail-send"></i> Kirim Email ke Mahasiswa</button>
    </div>
    <section class="card">
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="card-title">Daftar Mahasiswa</h4>
            <ul class="list-inline d-flex mb-25 mb-sm-0">                
                <li class="d-flex align-items-center">
                    <i class='bx bxs-info-circle mr-50 font-medium-3'></i>
                    <div class="dropdown">
                        <div class="cursor-pointer" role="button" data-toggle="modal" data-target="#information">Keterangan Simbol</div>                        
                    </div>
                </li>
            </ul>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="row" id="filter">
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="" selected disabled>Pilih status</option>
                                    <option value="0">Hijau</option>
                                    <option value="1">Kuning</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <fieldset class="form-group">
                                <label>Nama/NIM</label>
                                <input type="text" class="form-control" name="name_nim" placeholder="Tuliskan nama atau NIM">
                            </fieldset>
                        </div>
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary mr-1 mb-1 mt-2" onclick="submitFilter()">Cari</button>
                            <button type="button" class="btn btn-light-secondary mr-1 mb-1 mt-2" onclick="resetFilter()">Reset</button>
                        </div>
                    </div>
                    <table class="table mb-0 table-hover" id="student-table" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>STATUS</th>
                                <th>KUESIONER<br>PRA</th>
                                <th>KONSULTASI</th>                                 
                                <th>KUESIONER<br>PASCA</th>
                                <th>AKSI</th>
                                <th></th>
                                <th></th>
                                <th>Evaluasi</th>
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

<div class="modal fade text-left" id="information" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Keterangan Simbol</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>Berikut keterangan simbol yang terdapat pada tabel:</p>
                <table class="table table-bordered">
                    <thead>
                        <tr>                            
                            <th class="text-center">Simbol</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>                            
                            <td class="text-center">
                                <i class="bx bx-check"></i>
                            </td>
                            <td> Telah menyelesaikan tahapan.</td>
                        </tr>
                        <tr>                            
                            <td class="text-center">
                                <i class="bx bx-conversation"></i>
                            </td>
                            <td> Dalam proses konsultasi.</td>
                        </tr>
                        <tr>                            
                            <td class="text-center">
                                <i class="bx bx-x"></i>
                            </td>
                            <td> Belum menyelesaikan tahapan.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>                
            </div>
        </div>
    </div>
</div>

<div class="modal fade text-left" id="modal-email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel17" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel17">Formulir Kirim Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('report.activity.send.submit') }}" method="POST" id="form-email">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Status Mahasiswa <span class="text-danger">*</span></label>
                                <select class="form-control" name="status" required>
                                    <option value="" selected disabled>Pilih status</option>
                                    <option value="0">Hijau</option>
                                    <option value="1">Kuning</option>
                                    <option value="all">Semua Status</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Ketentuan <span class="text-danger">*</span></label>
                                <select class="form-control" name="requirement" required>
                                    <option value="" selected disabled>Pilih ketentuan</option>
                                    <option value="1">Telah Menyelesaikan</option>
                                    <option value="0">Belum Menyelesaikan</option>
                                    <option value="all">Semua Ketentuan</option>
                                </select>
                            </fieldset>
                        </div>
                        <div class="col-md-6">
                            <fieldset class="form-group">
                                <label>Tahapan <span class="text-danger">*</span></label>
                                <select class="form-control" name="step" required>
                                    <option value="" selected disabled>Pilih ketentuan</option>
                                    <option value="count_pre">Kuesioner Pra</option>
                                    <option value="is_done">Konsultasi</option>
                                    <option value="count_post">Kuesioner Pasca</option>
                                    <option value="evaluation">Evaluasi</option>
                                    <option value="all">Semua Tahapan</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset class="form-group">
                                <label>Teks</label>
                                <div id="editor" style="height: 300px">
                                    
                                </div>
                                <textarea name="text" style="display: none"></textarea>
                            </fieldset>
                        </div>
                    </div>     
                    
                    <button type="submit" style="display: none"></button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Tutup</span>
                </button>     
                <button type="button" class="btn btn-primary ml-1" onclick="submitEmail()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Kirim</span>
                </button>           
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        const form_email = $('#form-email');

        var student_table;
        var quill;

        $(function () {
            quill = new Quill('#editor', {                
                theme: 'snow'
            });

            student_table = $('#student-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('report.activity.data') }}',
                    data: function (params) {
                        params.status = $('#filter').find('select[name=status]').val();
                        params.name_nim = $('#filter').find('input[name=name_nim]').val();
                    }
                },
                order: [
                    [8, 'asc'],
                    [9, 'asc'],
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0, 7]
                    },
                    {
                        className: 'text-center',
                        targets: [4, 5, 6, 10]
                    },
                    {
                        visible: false,
                        targets: [8, 9, 0, 7]
                    }
                ],
                columns: [{
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'full_name',
                        name: 'full_name'
                    },
                    {
                        data: 'student_id_number',
                        name: 'student_id_number'
                    },                                                        
                    {
                        data: 'need_consult',
                        name: 'need_consult'
                    },
                    {
                        data: 'count_pre',
                        name: 'count_pre'
                    },
                    {
                        data: 'is_done',
                        name: 'is_done'
                    },
                    {
                        data: 'count_post',
                        name: 'count_post'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'first_name',
                        name: 'first_name'
                    },
                    {
                        data: 'last_name',
                        name: 'last_name'
                    },
                    {
                        data: 'evaluation_count',
                        name: 'evaluation_count',
                        searchable: false
                    }
                ]      
            });

            $('.dataTables_filter').hide();
        });

        const submitFilter = () => {            
            student_table.draw();
        }

        const resetFilter = () => {
            $('#filter').find("input[type=text], select").val("");
            student_table.draw();
        }

        const submitEmail = () => {            
            form_email.find('textarea[name=text]').val(quill.root.innerHTML);
            form_email.find(':submit').click();
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