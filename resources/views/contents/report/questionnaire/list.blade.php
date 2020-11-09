@extends('layouts.template-default')

@include('plugins.datatables')
@include('plugins.toastr')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Hasil Kuesioner</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Laporan
                        </li>
                        <li class="breadcrumb-item active">
                            Hasil Kuesioner
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="mb-1">
        <button type="button" class="btn btn-success glow" data-toggle="modal" data-target="#modal-generate"><i class="bx bxs-archive-in"></i> Unduh Rekap (Excel)</button>
    </div>
    <section class="card">
        <div class="card-header">
            <h4 class="card-title">Daftar Responden</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 table-hover" id="result-table" style="width: 100%">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>NAMA</th>
                                <th>NIM</th>
                                <th>KUESIONER</th>
                                <th>SKOR</th>
                                <th>HASIL</th>                                
                                <th>UNDUH</th>
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

<div class="modal fade text-left" id="modal-generate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myModalLabel1">Formulir Unduh Rekap</h3>
                <button type="button" class="close rounded-pill" data-dismiss="modal" aria-label="Close">
                    <i class="bx bx-x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert bg-rgba-primary alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center">
                        <i class="bx bxs-info-circle"></i>
                        <span>
                            Hasil rekap kuesioner akan dikirimkan ke e-mail yang anda cantumkan dalam waktu 10-20 menit.
                        </span>
                    </div>
                </div>
                <form action="{{ route('report.questionnaire.generate.submit') }}" method="POST" id="form-generate">
                    @csrf
                    <fieldset class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" placeholder="Tuliskan email" name="email" required>
                    </fieldset> 
                    <fieldset class="form-group">
                        <label>Kategori Kuesioner <span class="text-danger">*</span></label>
                        <select class="form-control" name="category" required>
                            <option value="" selected disabled hidden>Pilih</option>
                            <option value="pre">Kuesioner Pra</option>
                            <option value="post">Kuesioner Pasca</option>
                            <option value="all">Semua</option>
                        </select>
                    </fieldset> 
                    <button type="submit" style="display: none"></button>
                </form>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Batalkan</span>
                </button>
                <button type="submit" class="btn btn-primary ml-1" onclick="submitCreate()">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Kirim</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        var result_table;

        const modal_generate = $('#modal-generate');
        const form_generate = $('#form-generate');

        $(function () {
            result_table = $('#result-table').DataTable({
                language: defaultLang,
                searching: true,
                pageLength: 10,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('report.questionnaire.data') }}',
                    data: function (params) {
                        
                    }
                },
                order: [
                    [7, 'desc']
                ],
                columnDefs: [
                    {
                        orderable: false,
                        searchable: false,
                        targets: [0, 6]
                    },
                    {
                        className: 'text-center',
                        targets: [6]
                    },
                    {
                        visible: false,
                        targets: [7, 0]
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
                        data: 'sum_score',
                        name: 'sum_score',
                        searchable: false,
                    },
                    {
                        data: 'result.information',
                        name: 'result.information'
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

            form_generate.submit(e => {
                e.preventDefault();

                let form_data = form_generate.serializeArray().reduce((obj, item) => {
                    obj[item.name] = item.value;
                    return obj;
                }, {});

                $.post(form_generate.attr('action'), form_data).done(result => {
                    let modal_body = modal_generate.find('.modal-body');
                    
                    removeAlert(modal_body);

                    if (result.status == 'error') {
                        showAlert('danger', 'bx-error', result.message, modal_body);
                    } else {
                        toastr.success(result.message, 'Berhasil');

                        form_generate.trigger('reset');
                        modal_generate.modal('hide');                        
                    }

                }).fail((xhr, textStatus, error) => {
                    
                });
            });
        });

        const submitCreate = () => {
            form_generate.find(':submit').click();
        }
    </script>
@endpush