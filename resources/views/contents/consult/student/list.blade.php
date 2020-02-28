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
<div class="alert alert-primary alert-dismissible mb-2" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex align-items-center">
        <i class="bx bx-error-circle"></i>
        <span>
            Aplikasi sangat merahasiakan data Anda, Dosen tidak dapat mengetahui data diri Anda.
        </span>
    </div>
</div>
<div class="card widget-notification">
    <div class="card-header border-bottom">
        <h4 class="card-title d-flex align-items-center">Chat</h4>
        <div class="heading-elements">
            <button type="button" onclick="location.href = '{{ route('consult.student.select.lecturer') }}';" class="btn btn-sm btn-primary">Kontrak Dosen</button>
        </div>
    </div>
    <div class="card-content">
        <div class="card-body p-0">
            @if (count($consults) > 0)
            <ul class="list-group list-group-flush">
                @foreach ($consults as $item)
                <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between" onclick="location.href = '{{ route('consult.student.chat', ['id' => $item->id]) }}';">
                    <div class="list-left d-flex">
                        <div class="list-icon mr-1">
                            <div class="avatar bg-rgba-primary m-0 p-25">
                                <div class="avatar-content">
                                    <i class="bx bx-user text-primary font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                        <div class="list-content">
                            <span class="list-title">{{ $item->lecturer->full_name }} {!! $item->messages_count > 0 ? '<span class="danger ml-1">( '.$item->messages_count.' pesan baru)</span>' : '' !!}</span>
                            <small class="text-muted d-block">{{ $item->schedule->day->name }}, {{ $item->schedule->start_time }} - {{ $item->schedule->end_time }}</small>
                        </div>
                    </div>

                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center mt-3 mb-3">
                <span class="font-medium-1">Belum ada Chat.</span>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection