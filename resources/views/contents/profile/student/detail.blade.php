@extends('layouts.template-default')

@include('plugins.select2')
@include('plugins.toastr')

@push('styles')
    <style>
        .table-borderless td {
            padding: 0px 0px 10px 0px;
        }
    </style>
@endpush

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Profil</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Profil
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="users-view">
        <div class="row">
            <div class="col-12 col-sm-7">
                <div class="media mb-2">
                    <a class="mr-1" href="#">
                        <img src="{{ asset('img/user.png') }}" alt="users view avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                    </a>
                    <div class="media-body pt-25">
                        <h4 class="media-heading"><span class="users-view-name">{{ $user->student->full_name }} </span><span class="text-muted font-medium-1"></span><span class="users-view-username text-muted font-medium-1 ">Mahasiswa</span></h4>
                        <span>ID:</span>
                        <span class="users-view-id">{{ sprintf('%03d', $user->student->id) }}</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-5 px-0 d-flex justify-content-end align-items-center px-1 mb-2">
                <a href="javascript:;" onclick="showForm()" class="btn btn-sm btn-primary">Ubah</a>
            </div>
        </div>

        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Terdaftar:</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->formatLocalized("%d %B %Y") }}</td>
                                    </tr>
                                    <tr>
                                        <td>NIM:</td>
                                        <td class="users-view-latest-activity">{{ $user->student->student_id_number }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fakultas:</td>
                                        <td class="users-view-verified">{{ $user->student->major->faculty->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Program Studi:</td>
                                        <td class="users-view-role">{{ $user->student->major->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Semester/Kelas:</td>
                                        <td>{{ $user->student->profile->semester }} / {{ $user->student->profile->classroom }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-12 col-md-6">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>Email:</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Umur:</td>
                                        <td>{{ $user->student->profile->age }} Tahun</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin:</td>
                                        <td>{{ $user->student->profile->gender->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td><span class="badge badge-light-success users-view-status">Aktif</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="card" style="display: none" id="card-update">
            <div class="card-header">
                <h4 class="card-title">Formulir Ubah Profil</h4>
            </div>
            <div class="card-content">
                <div class="card-body">
                    <form action="{{ route('profile.student.update.submit') }}" method="POST" enctype="multipart/form-data" class="row" id="form-update">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="student_id" value="{{ $user->student->id }}">
                        <div class="col-md-6 col-sm-12">
                            <fieldset class="form-group">
                                <label>Nama Depan <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Tuliskan nama depan" name="first_name" value="{{ $user->student->first_name }}" required>
                            </fieldset>
    
                            <fieldset class="form-group">
                                <label>Nama Belakang <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Tuliskan nama belakang" name="last_name" value="{{ $user->student->last_name }}" required>
                            </fieldset>
    
                            <fieldset class="form-group">
                                <label>NIM <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="Nomor induk mahasiswa" name="student_id_number" value="{{ $user->student->student_id_number }}" required>
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <fieldset class="form-group">
                                <label>Fakultas <span class="text-danger">*</span></label>
                                <select class="select2 form-control" name="faculty_id" required style="width: 100%">
                                    <option value="{{ $user->student->major->faculty->id }}">{{ $user->student->major->faculty->name }}</option>
                                </select>
                            </fieldset>
    
                            <fieldset class="form-group">
                                <label>Program Studi <span class="text-danger">*</span></label>
                                <select class="select2 form-control" name="major_id" required style="width: 100%">
                                    <option value="{{ $user->student->major->id }}">{{ $user->student->major->name }}</option>
                                </select>
                            </fieldset>
    
                            <fieldset class="form-group">
                                <label for="helpInputTop">Email <span class="text-danger">*</span></label>
                                <small class="text-muted">contoh: <i>someone@example.com</i></small>
                                <input type="email" class="form-control" placeholder="Tuliskan email" name="email" value="{{ $user->email }}" required>
                            </fieldset>
    
                            <fieldset class="form-group">
                                <label>Kata Sandi</label>
                                <small class="text-muted">(Diisi jika ingin mengubah password)</small>
                                <input type="password" class="form-control" placeholder="Tuliskan kata sandi" name="password">
                            </fieldset>
                        </div>                        
                        <div class="col-12 d-flex justify-content-end mt-1">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Simpan</button>
                            <a href="javascript:;" onclick="hideForm()" class="btn btn-light-secondary mr-1 mb-1">Batalkan</a>
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

        const card_update = $('#card-update');
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
        });

        const showForm = () => {
            card_update.slideDown('slow');
        }

        const hideForm = () => {
            card_update.slideUp('slow');
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