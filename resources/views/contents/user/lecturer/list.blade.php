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
                        <li class="breadcrumb-item active">
                            Dosen
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
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="lecturer-table" style="width: 100%">
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
        </div>
    </section>
</div>

<div class="modal fade" id="student-detail" tabindex="-1" role="dialog" aria-labelledby="studentDetail" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title white">Rincian Dosen</h5>
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
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        let lecture_table;

        $(function () {
            lecture_table = $('#lecturer-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('user.lecturer.data') }}',
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
                        data: 'lecturer.nip',
                        name: 'lecturer.nip'
                    },                                                        
                    {
                        data: 'lecturer.major.name',
                        name: 'lecturer.major.name'
                    },
                    {
                        data: 'lecturer.major.faculty.name',
                        name: 'lecturer.major.faculty.name'
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

        const modal_detail = $('#student-detail');

        const showDetail = (id) => {
            $.get("{{ route('user.lecturer.detail') }}", {
                id
            }).done((result) => {
                modal_detail.find('.modal-body').html(result);
                modal_detail.modal('show');
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