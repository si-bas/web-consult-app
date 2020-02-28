@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Responden</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Kuesioner
                        </li>
                        <li class="breadcrumb-item active">
                            Daftar Responden
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>   
<div class="content-body">
    <div class="mb-1">
        <button type="button" class="btn btn-success glow"><i class="bx bxs-archive-in"></i> Unduh Rekap (Excel)</button>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Responden</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="respondent-table" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>KUESIONER</th>
                                <th>DIISI PADA</th>                                
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
@endsection

@push('scripts')
    <script>
        var respondent_table;

        $(function () {
            respondent_table = $('#respondent-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('questionnaire.respondent.data') }}',
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
                        data: 'student.user.name',
                        name: 'student.user.name'
                    },
                    {
                        data: 'student.student_id_number',
                        name: 'student.student_id_number'
                    },                                                        
                    {
                        data: 'questionnaire.name',
                        name: 'questionnaire.name'
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
    </script>
@endpush