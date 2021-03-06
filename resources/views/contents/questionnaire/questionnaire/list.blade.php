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
                        <li class="breadcrumb-item">
                            Kuesioner
                        </li>
                        <li class="breadcrumb-item active">
                            Daftar Kuesioner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="mb-1">
        <button type="button" class="btn btn-primary glow" data-toggle="modal" data-target="#modal-create"><i class="bx bx-plus"></i> Kuesioner Baru</button>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Kuesioner</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="questionnaire-table" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>STATUS</th>
                                <th>TERISI</th>
                                <th>JML PERTANYAAN</th>                                
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
                <h5 class="modal-title" id="exampleModalCenterTitle">Formulir Kuesioner Baru</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('questionnaire.create.submit') }}" method="POST" class="row" id="form-create">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Nama Kuesioner <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama" name="name" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Kode Kuesioner</label>
                            <small class="text-muted">(opsional)</small>
                            <input type="text" class="form-control" placeholder="Tuliskan kode" name="code">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Teks Petunjuk</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan petunjuk" name="guide_text"></textarea>
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
@endsection

@push('scripts')
    <script>
        let questionnaire_table;
        $(function () {
            questionnaire_table = $('#questionnaire-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('questionnaire.list.data') }}',
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
                        data: 'is_active',
                        name: 'is_active'
                    },                                                        
                    {
                        data: 'student_questionnaire_count',
                        name: 'student_questionnaire_count'
                    },
                    {
                        data: 'questions_count',
                        name: 'questions_count',
                        searchable: false
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
            form_create.find(':submit').click();
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