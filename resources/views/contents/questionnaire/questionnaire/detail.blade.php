@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Rincian Kuesioner</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('questionnaire.list') }}">Kuesioner</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Rincian
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <section class="card">
        <div class="card-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-xl-4 col-md-12">
                        <span class="invoice-number mr-50">Status: <span class="text-{{ $questionnaire->is_active ? 'success' : 'danger' }} mr-1">{{ $questionnaire->is_active ? 'Aktif' : 'Tidak Aktif' }}</span></span>
                        <span>Kode: {{ $questionnaire->code }}</span>
                    </div>
                    <div class="col-xl-8 col-md-12">
                        <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                            <div class="mr-3">
                                <small class="text-muted">Dibuat Pada:</small>
                                <span>{{ \Carbon\Carbon::parse($questionnaire->created_at)->formatLocalized("%d %B %Y") }}</span>
                            </div>
                            <div>
                                <small class="text-muted">Diubah Pada:</small>
                                <span>{{ $questionnaire->updated_at == $questionnaire->created_at ? '-' : \Carbon\Carbon::parse($questionnaire->updated_at)->formatLocalized("%d %B %Y") }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- logo and title -->
                <div class="row mt-2">
                    <div class="col-12">
                        <h4 class="text-primary">{{ $questionnaire->name }}</h4>
                        <span>Dibuat oleh {{ $questionnaire->user->name }}</span>                        
                    </div>
                    <div class="col-12">
                        <p class="mt-1"><span class="text-bold-600">Petunjuk :</span> {{ $questionnaire->guide_text }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-secondary mr-1 mb-1 pull-right" data-toggle="modal" data-target="#modal-update"><i class="bx bx-pencil"></i> Ubah Kuesioner</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mb-1">
        <a href="{{ route('questionnaire.question.form.create', ['questionnaire' => $questionnaire->id]) }}" class="btn btn-primary glow"><i class="bx bx-plus"></i> Pertanyaan Baru</a>
    </div>
    <section class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="card-title">Daftar Pertanyaan</h4>
            {{-- <ul class="list-inline d-flex mb-0">
                <li class="d-flex align-items-center">
                    <i class='bx bxs-cog font-medium-3 mr-50'></i>
                    <div class="dropdown">
                        <div class="dropdown-toggle mr-1" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pengaturan
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="javascript:;">Standar Tipe Jawaban</a>
                        </div>
                    </div>
                </li>
            </ul> --}}
        </div>
        <div class="card-content">
            <div class="card-body">
                <table class="table mb-0 table-hover" id="questions-table" style="width: 100%">
                    <thead class="thead-light">
                        <tr>
                            <th>NO.</th>
                            <th>PERTANYAAN</th>
                            <th>AKSI</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                <hr>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end ">
                        <a href="{{ route('questionnaire.list') }}" class="btn btn-light-secondary mr-1 mb-1">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Formulir Perubahan Kuesioner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('questionnaire.update.submit') }}" method="POST" class="row" id="form-update">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $questionnaire->id }}">
                    <div class="col-12">
                        <fieldset class="form-group">
                            <label>Nama Kuesioner <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Tuliskan nama" name="name" value="{{ $questionnaire->name }}" required>
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Kode Kuesioner</label>
                            <small class="text-muted">(opsional)</small>
                            <input type="text" class="form-control" placeholder="Tuliskan kode" name="code" value="{{ $questionnaire->code }}">
                        </fieldset>
                        <fieldset class="form-group">
                            <label>Teks Petunjuk</label>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan petunjuk" name="guide_text">{{ $questionnaire->guide_text }}</textarea>
                        </fieldset> 
                        <fieldset class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="is_active" id="is_active_true" value="1" {{ $questionnaire->is_active ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="is_active_true">Aktif</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" name="is_active" id="is_active_false" value="0" {{ $questionnaire->is_active ? '' : 'checked' }}>
                                            <label class="custom-control-label" for="is_active_false">Tidak Aktif</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
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
                <button type="button" class="btn btn-primary ml-1" onclick="submitUpdate()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Simpan</span>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="question-modal-detail" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Rincian Pertanyaan</h5>
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
        const questionnaire_id = "{{ $questionnaire->id }}";
        let question_table;

        $(function () {
            question_table = $('#questions-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 25,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('questionnaire.question.data') }}',
                    data: function (params) {
                        params.questionnaire_id = questionnaire_id;
                    }
                },
                order: [
                    [3, 'asc']
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [2]
                    },
                    {
                        className: 'text-center',
                        targets: [2]
                    },
                    {
                        visible: false,
                        targets: [3]
                    }
                ],
                columns: [
                    {
                        data: 'order',
                        name: 'order'
                    },
                    {
                        data: 'text',
                        name: 'text'
                    },                                                        
                    {
                        data: 'action',
                        name: 'action'
                    },
                    {
                        data: 'order',
                        name: 'order'
                    }
                ]      
            });
        });

        const form_update = $('#form-update');

        const submitUpdate = () => {
            form_update.find(':submit').click();
        }

        question_modal_detail = $('#question-modal-detail');
        const showDetail = (id) => {
            $.get("{{ route('questionnaire.question.detail.modal') }}", {
                id
            }).done((result) => {
                question_modal_detail.find('.modal-body').html(result);

                question_modal_detail.modal('show');
            });
        }

        const submitDelete = (id) => {
            $.post('{{ route('questionnaire.question.delete.submit') }}', {
                _token: '{{ csrf_token() }}',
                _method: 'DELETE',
                id
            }).done(result => {
                if (result.status == 'error') {
                    toastr.error(result.message, 'Perhatian');
                } else {
                    toastr.success(result.message, 'Berhasil');
                    
                    question_table.draw(false);
                }
            });
        }

        const actionDelete = (id) => {
            toastr.warning(`Yakin menghapus pertanyaan ini?
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