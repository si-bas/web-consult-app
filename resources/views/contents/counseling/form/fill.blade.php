@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Konsultasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item">
                            <a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Konseling
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Formulir Konseling</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <form class="row" action="{{ route('counseling.form.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col-12">
                        @foreach ($questions as $question)
                        <fieldset class="form-group mb-3">
                            <p class="text-bold-400">{{ $question->order }}. {{ $question->text }}</p>
                            <textarea class="form-control" rows="3" placeholder="Tuliskan disini" name="{{ $question->id }}" required></textarea>
                        </fieldset>
                        @endforeach
                    </div>
                    <div class="col-12 d-flex justify-content-end ">
                        <button type="submit" class="btn btn-primary mr-1 mb-1">Selanjutnya</button>
                    </div>
                </form>                
            </div>
        </div>
    </div>
</div>
@endsection