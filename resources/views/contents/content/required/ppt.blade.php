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
                            Powerpoint
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
            <h4 class="card-title">Powerpoint</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
               <p>Pelajari terlebih dahulu powerpoint dibawah ini, kemudian klik selanjutnya.</p> 
               <hr>
               <iframe src="https://onedrive.live.com/embed?resid=D59BB4CB45A630CF%218996&amp;authkey=%21AG8JxxtZ2NvWzk4&amp;em=2&amp;wdAr=1.3333333333333333" width="100%" height="400px" frameborder="0">This is an embedded <a target="_blank" href="https://office.com">Microsoft Office</a> presentation, powered by <a target="_blank" href="https://office.com/webapps">Office</a>.</iframe>
                <hr>
                <div class="row">
                    {{-- <div class="col-6">
                        <button type="submit" class="btn btn-secondary mt-2" onclick="location.href='{{ route('content.required.powerpoint.download') }}';">Unduh PPT</button> 
                    </div> --}}
                    <div class="col-6 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-2" onclick="location.href='{{ route('content.required.check') }}';">Selanjutnya</button> 
                    </div>
                </div>
                            
            </div>                        
        </div>
    </section>
    
</div>
@endsection