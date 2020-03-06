@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Konsultasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Konsultasi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@if (!$has_schedule)
<div class="alert alert-danger alert-dismissible mb-2" role="alert" id="schedule-alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bxs-error"></i>
        <span>
            Anda tidak memiliki jadwal tersedia, silahkan buat jadwal ketersediaan terlebih dahulu dengan klik disini.
        </span>
    </div>
</div>
@push('scripts')
    <script>
        $(function () {
            $('#schedule-alert').click(function () {
                window.location = "{{ route('schedule.availability.form.create', ['url' => Crypt::encrypt(Request::url())]) }}";
            });
        });
    </script>
@endpush
@endif
<div class="alert alert-primary alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-error-circle"></i>
        <span>
            Dosen/Konselor tidak dapat mengetahui data diri Mahasiswa, kecuali mahasiswa memberitahu informasi tentang dirinya sendiri.
        </span>
    </div>
</div>
<div class="card widget-notification">
    <div class="card-header border-bottom">
        <h4 class="card-title d-flex align-items-center">Percakapan</h4>
    </div>
    <div class="card-content">
        <div class="card-body p-0">
            @if (count($consults->where('is_meeting', 0)) > 0)
            <ul class="list-group list-group-flush">
                @foreach ($consults->where('is_meeting', 0) as $item)
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between" onclick="location.href = '{{ route('consult.lecturer.chat', ['id' => $item->id]) }}';">
                    <div class="list-left d-flex">
                        <div class="list-icon mr-1">
                            <div class="avatar bg-rgba-primary m-0 p-25">
                                <div class="avatar-content">
                                    <i class="bx bx-user text-primary font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="list-content">
                            <span class="list-title">Mahasiswa #{{ $item->student->id }} {!! $item->messages_count > 0 ? '<span class="danger ml-1">( '.$item->messages_count.' pesan baru)</span>' : '' !!}</span>
                            <small class="text-muted d-block">{{ $item->schedule->day->name }}, {{ $item->schedule->start_time }} - {{ $item->schedule->end_time }}</small>
                            <small class="text-muted d-block">{{ $item->is_done ? 'Status Selesai' : 'Status Belum Selesai' }}</small>
                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center mt-3 mb-3">
                <span class="font-medium-1">Belum ada Percakapan.</span>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="card widget-notification">
    <div class="card-header border-bottom">
        <h4 class="card-title d-flex align-items-center">Pertemuan</h4>
    </div>
    <div class="card-content">
        <div class="card-body p-0">
            @if (count($consults->where('is_meeting', 1)) > 0)
            <ul class="list-group list-group-flush">
                @foreach ($consults->where('is_meeting', 1) as $item)
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between" onclick="location.href = '{{ route('consult.lecturer.chat', ['id' => $item->id]) }}';">
                    <div class="list-left d-flex">
                        <div class="list-icon mr-1">
                            <div class="avatar bg-rgba-primary m-0 p-25">
                                <div class="avatar-content">
                                    <i class="bx bx-user text-primary font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="list-content">
                            <span class="list-title">{{ $item->student->full_name }} {!! $item->messages_count > 0 ? '<span class="danger ml-1">( '.$item->messages_count.' pesan baru)</span>' : '' !!}</span>
                            <small class="text-muted d-block">{{ $item->schedule->day->name }}, {{ $item->schedule->start_time }} - {{ $item->schedule->end_time }}</small>
                            <small class="text-muted d-block">{{ $item->is_done ? 'Status Selesai' : 'Status Belum Selesai' }}</small>
                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center mt-3 mb-3">
                <span class="font-medium-1">Belum ada permintaan bertemu.</span>
            </div>
            @endif            
        </div>
    </div>
</div>
@endsection