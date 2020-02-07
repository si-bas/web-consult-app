@extends('layouts.template-default')

@include('plugins.select2')

@push('styles')
    <style>
        .radio input[type="radio"], .checkbox input[type="checkbox"] {
            display: block;
            opacity: 0;
            position: absolute;
        }
    </style>
@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Kuesioner</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Kuesioner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Karakteristik Demografi</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('profile.student.create.submit') }}" class="row" method="POST" enctype="multipart/form-data" id="form-create">
                    @csrf
                    <div class="col-md-6 col-sm-12">
                        <fieldset class="form-group">
                            <label>Umur <span class="text-danger">*</span></label>
                            <small class="text-muted">(tahun)</small>
                            <input type="text" class="form-control number-only" placeholder="Tuliskan angka" name="age" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <ul class="list-unstyled mb-0 mt-1">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="radio radio-primary">
                                            <input type="radio" name="gender_id" id="gender_male" value="M" required>
                                            <label for="gender_male">Laki-laki</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="radio radio-primary">
                                            <input type="radio" name="gender_id" id="gender_female" value="F" required>
                                            <label for="gender_female">Perempuan</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Agama <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan agama" name="religion" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Semester <span class="text-danger">*</span></label>
                            <input type="text" class="form-control number-only" placeholder="Tuliskan angka" name="semester" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Program Studi <span class="text-danger">*</span></label>
                            <select class="select2 form-control" name="major_id" required style="width: 100%">
                                <option></option>
                            </select>
                        </fieldset>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <fieldset class="form-group">
                            <label>Kelas <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan kelas" name="classroom" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Apa yang anda lakukan jika ada masalah sebelum pergi ke dosen PA (boleh isi lebih dari 1) <span class="text-danger">*</span></label>
                            <ul class="list-unstyled mb-0 mt-1">
                                @foreach ($solving_options as $option)
                                <li class="mb-1">
                                    <fieldset>
                                        <div class="checkbox">
                                            <input type="checkbox" class="checkbox-input" id="checkbox_{{ $option->id }}" name="options[]" value="{{ $option->id }}" required>
                                            <label for="checkbox_{{ $option->id }}">{{ $option->name }}</label>
                                        </div>
                                    </fieldset>
                                </li>
                                @endforeach
                            </ul>                            
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Riwayat kekerasan fisik dan seksual? <span class="text-danger">*</span></label>
                            <ul class="list-unstyled mb-0 mt-1">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="radio radio-primary">
                                            <input type="radio" name="has_history_violence" id="has_history_violence_yes" value="1" required>
                                            <label for="has_history_violence_yes">Ya</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="radio radio-primary">
                                            <input type="radio" name="has_history_violence" id="has_history_violence_no" value="0" required>
                                            <label for="has_history_violence_no">Tidak</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>
                    </div>
                    <div class="col-12 d-flex justify-content-end ">
                        <button type="submit" class="btn btn-primary mr-1 mb-1">Selanjutnya</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        (function ($) {
            $.fn.inputFilter = function (inputFilter) {
                return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function () {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            };
        }(jQuery));

        const select_major = $('select[name=major_id]');
        let cbx_group = $("input:checkbox[name='options[]']");

        $(function () {
            $(".number-only").inputFilter(function(value) {
                return /^\d*$/.test(value);    // Allow digits only, using a RegExp
            });

            select_major.select2({
                placeholder: 'Pilih Program Studi',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('user.lecturer.get.majors') }}",
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

            $('button[type="submit"]').on('click', function() {
                cbx_group.prop('required', true);
                if (cbx_group.is(":checked")) {
                    cbx_group.prop('required', false);
                }
            });
        });
    </script>
@endpush