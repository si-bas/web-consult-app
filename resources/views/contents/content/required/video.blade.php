@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Konten</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item">
                            Konten
                        </li>
                        <li class="breadcrumb-item active">
                            Video
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
            <h4 class="card-title">{{ $video->title }}</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
               <p>Lihat video dibawah ini hingga selesai, kemudian klik selanjutnya.</p> 
               <hr>
               <video width="100%" controls autoplay>
                    <source src="{{ asset($video->path.$video->filename) }}">                    
                    Your browser does not support HTML5 video.
                </video>
                <hr>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end ">
                        <button type="submit" class="btn btn-primary mt-2" onclick="location.href='{{ route('content.required.next.video', ['video' => Crypt::encrypt($video->id)]) }}';">Selanjutnya</button> 
                    </div>
                </div>
            </div>                        
        </div>
    </section>
</div>
@endsection