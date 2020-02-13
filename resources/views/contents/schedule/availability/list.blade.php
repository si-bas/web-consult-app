@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')


@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Jadwal Tersedia</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">Jadwal Tersedia
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="mb-1">
        <a href="{{ route('schedule.availability.form.create') }}" class="btn btn-primary glow"><i class="bx bx-plus"></i> Jadwal Tersedia Baru</a>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Jadwal</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="availability-table" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>HARI</th>
                                <th>DARI</th>
                                <th>HINGGA</th>
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
        var schedule_table;
        $(function () {
            schedule_table = $('#availability-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('schedule.availability.data') }}',
                    data: function (params) {
                        
                    }
                },
                order: [
                    [5, 'asc']
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0, 4]
                    },
                    {
                        className: 'text-center',
                        targets: [2, 3, 4]
                    },
                    {
                        visible: false,
                        targets: [5]
                    }
                ],
                columns: [{
                        data: 'id',
                        render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'day.name',
                        name: 'day.id'
                    },
                    {
                        data: 'start_time',
                        name: 'start_time'
                    },                                                        
                    {
                        data: 'end_time',
                        name: 'end_time'
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'day.id',
                        name: 'day.id'
                    }
                ]      
            });
        });

        const submitDelete = (id) => {
            $.post('{{ route('schedule.availability.delete.submit') }}', {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE',
                id
            }).done(result => {
                if (result.status == 'error') {
                    toastr.error(result.message, 'Perhatian');
                } else {
                    toastr.success(result.message, 'Berhasil');
                    
                    schedule_table.draw(false);
                }
            });
        }

        const actionDelete = (id) => {
            toastr.warning(`Yakin menghapus jadwal ini?
            <br/>
            <br/>
            <button type="button" class="btn btn-secondary clear" onclick="submitDelete(${id})">Ya, hapus!</button><button type="button" class="btn btn-light clear ml-1">Tidak</button>`, 'Perhatian', {
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