@extends('layouts.template-default')

@include('plugins.select2')
@include('plugins.inputmask')

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
                        <li class="breadcrumb-item"><a href="{{ route('user.lecturer.list') }}">Dosens</a>
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
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir Perubahan Data Dosen</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form action="{{ route('user.lecturer.update.submit') }}" method="POST" enctype="multipart/form-data" class="row" id="form-update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label>Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama lengkap" name="full_name" value="{{ $user->lecturer->full_name }}" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>NIP <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan NIP" name="nip" value="{{ $user->lecturer->nip }}" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Jenis Kelamin <span class="text-danger">*</span></label>
                            <ul class="list-unstyled mb-0 mt-1">
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="radio radio-primary">
                                            <input type="radio" name="gender_id" id="gender_male" value="M" {{ $user->lecturer->gender->code == 'M' ? 'checked' : '' }} required>
                                            <label for="gender_male">Laki-laki</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2">
                                    <fieldset>
                                        <div class="radio radio-primary">
                                            <input type="radio" name="gender_id" id="gender_female" {{ $user->lecturer->gender->code == 'F' ? 'checked' : '' }} value="F">
                                            <label for="gender_female">Perempuan</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" placeholder="Tuliskan tempat lahir" name="place_of_birth" value="{{ $user->lecturer->place_of_birth }}">
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Tanggal Lahir</label>
                            <input type="text" class="form-control inputmask" placeholder="dd/mm/yyyy" name="date_of_birth" value="{{ $user->lecturer->date_of_birth_format }}">
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan alamat lengkap" name="address">{{ $user->lecturer->address }}</textarea>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="form-group">
                            <label>Fakultas <span class="text-danger">*</span></label>
                            <select class="select2 form-control" name="faculty_id" required style="width: 100%">
                                <option value="{{ $user->lecturer->major->faculty->id }}">{{ $user->lecturer->major->faculty->name }}</option>
                            </select>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Program Studi <span class="text-danger">*</span></label>
                            <select class="select2 form-control" name="major_id" required style="width: 100%">
                                <option value="{{ $user->lecturer->major->id }}">{{ $user->lecturer->major->name }}</option>
                            </select>
                        </fieldset>

                        <fieldset class="form-group">
                            <label for="helpInputTop">Email <span class="text-danger">*</span></label>
                            <small class="text-muted">contoh: <i>someone@example.com</i></small>
                            <input type="email" class="form-control" placeholder="Tuliskan email" name="email" value="{{ $user->email }}" required>
                        </fieldset>

                        <fieldset class="form-group">
                            <label>Kata Sandi</label>
                            <small class="text-muted">diisi apabila ingin mengubah kata sandi sebelumnya</small>
                            <input type="password" class="form-control" placeholder="Tuliskan kata sandi" name="password">
                        </fieldset>
                    </div>
                    <button type="submit" style="display: none"></button>
                    <div class="col-12 d-flex justify-content-end ">
                        <button type="button" class="btn btn-primary mr-1 mb-1" onclick="submitForm()">Simpan</button>
                        <a href="{{ route('user.lecturer.list') }}" class="btn btn-light-secondary mr-1 mb-1">Batalkan</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        const select_faculty = $('select[name=faculty_id]');
        const select_major = $('select[name=major_id]');

        const form_registration = $('#registration');

        $(function () {
            select_faculty.select2({
                placeholder: 'Pilih Fakultas',
                minimumInputLength: 0,
                ajax: {
                    url: "{{ route('user.lecturer.get.faculties') }}",
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
                            search: params.term,
                            id: select_faculty.val()
                        }
                    },
                    processResults: function (data, page) {
                        return {
                            results: data
                        };
                    },
                }
            });

            $('.inputmask').inputmask({
                alias: "datetime", inputFormat: "dd/mm/yyyy"
            });
        });
        
        var form_update = $('#form-update');
        const submitForm = () => {
            let email = form_update.find('input[name=email]').val();
            let id = form_update.find('input[name=id]').val();

            $.get("{{ route('user.lecturer.check.email') }}", {
                id, email
            }).done((result) => {
                let alert_section = form_update.parent();
                removeAlert(alert_section);
                
                if (result > 0) {
                    showAlert('danger', 'bx-error', 'Error! Email telah digunakan, silahkan gunakan email lain.', alert_section);
                } else {
                    form_update.find('button[type=submit]').click();
                }
            });
        }
    </script>
@endpush