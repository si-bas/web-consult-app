@extends('layouts.template-default')

@include('plugins.select2')
@include('plugins.datepicker')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Formulir Perubahan Jadwal Tersedia</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('schedule.availability.list') }}">Jadwal Tersedia</a>
                        </li>
                        <li class="breadcrumb-item active">Formulir
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="alert alert-primary alert-dismissible mb-2" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-flex align-items-center">
            <i class="bx bx-error-circle"></i>
            <span>
                Pastikan jadwal yang anda ubah sesuai dengan jadwal ketersediaan anda.
            </span>
        </div>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('schedule.availability.update.submit') }}" method="POST" enctype="multipart/form-data" class="row" id="form-update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $schedule->id }}">
                    <div class="col-md-6 col-sm-12">
                        <fieldset class="form-group">
                            <label>Pilih Hari</label>
                            <select class="select2 form-control" name="day_id" required style="width: 100%" required>
                                <option value="{{ $schedule->day_id }}">{{ $schedule->day->name }}</option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <fieldset class="form-group">
                                    <label for="basicInput">Waktu Awal</label>
                                    <input type="text" class="form-control pickatime" placeholder="Pilih waktu awal" name="start_time" value="{{ $schedule->start_time }}" required>
                                </fieldset>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <fieldset class="form-group">
                                    <label for="basicInput">Waktu Akhir</label>
                                    <input type="text" class="form-control pickatime" placeholder="Pilih waktu akhir" name="end_time" value="{{ $schedule->end_time }}" required>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <button type="submit" style="display: none"></button>
                    <div class="col-12 d-flex justify-content-end mt-1">
                        <button type="button" class="btn btn-primary mr-1 mb-1" onclick="submitForm()">Simpan</button>
                        <a href="{{ route('schedule.availability.list') }}" class="btn btn-light-secondary mr-1 mb-1">Batalkan</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>

@endsection

@push('scripts')
    <script>
        const form_update = $('#form-update');

        const select_day_update = form_update.find('select[name=day_id]');

        $(function () {
            $('.pickatime').pickatime({
                format: 'HH:i',
                formatLabel: 'HH:i',
                formatSubmit: 'HH:i',
            });
            
            select_day_update.select2({
                dropdownParent: form_update.parent(),
                placeholder: 'Pilih hari',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('schedule.availability.get.days') }}",
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
        });

        const submitForm = () => {
            let alert_section = form_update.parent();
            removeAlert(alert_section);

            let beginningTime = moment(form_update.find('input[name=start_time]').val(), 'HH:i');
            let endTime = moment(form_update.find('input[name=end_time]').val(), 'HH:i');

            if (beginningTime.isAfter(endTime)) {
                showAlert('danger', 'bx-error', 'Error! Waktu awal tidak boleh lebih besar dari waktu akhir.', alert_section);
            } else {
                form_update.find(':submit').click();
            }
        }
    </script>
@endpush