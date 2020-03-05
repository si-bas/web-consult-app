@extends('layouts.template-default')

@section('content')
<div class="content-header row">
    <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Informasi</h5>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active">
                            Informasi
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content-body">
    <div class="card collapse-header">
        <div id="headingCollapse1" class="card-header text-center" data-toggle="collapse" role="button" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1">
            <h4 class="card-title">Informasi Penelitian <br> (Klik untuk melihat)</h4>
        </div>
        <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1" class="collapse">
            <div class="card-content">
                <div class="card-body">
                    <p>Bermaksud melaksanakan penelitian dalam rangka penyusunan tugas akhir. Bersama ini saya akan menjelaskan beberapa hal, yaitu:</p>
                    <ol>
                        <li>Tujuan dari penelitian ini adalah untuk menganalisis Pengaruh Spiritual <i>Problem Solving</i> berbasis <i>Web</i> pada Mahasiswa</li>
                        <li>Manfaat penelitian ini adalah membantu menyelesaikan masalah, dan mempunyai koping yang adaptif saat menghadapi masalah</li>
                        <li>Peneliti akan merahasiakan identitas, data dan semua informasi yang berkaitan dengan keikutsertaan reponden terhadap orang yang tidak berhak.</li>
                        <li>Penelitian tidak bertujuan komersil, artinya peneliti atau pihak lain tidak menggunakan hasil penelitian ini untuk tujuan penjualan produk, baik berupa barang maupun jasa, untuk kepentingan bisnis.</li>
                        <li>Semua reponden akan diberikan perlindungan dan perlakuan yang sama, dan kesediaan menjadi subyek penelitian dengan menandatangani lembar persetujuan.</li>
                        <li>
                            Tahapan saat mengunjungi <i>Problem Solving</i> berbasis <i>Web</i> yaitu:
                            <ul>
                                <li>Melakukan registrasi dengan Email dan NIM </li>
                                <li>Mengisi kuesinoer A</li>
                                <li>Mengikuti kuis</li>
                                <li>Curhat dengan mengisi ada link form kuesioner  (khusus responden terpilih)</li>
                                <li>Manajemen strees ( Power Point, video )</li>
                                <li>Konsultasi (chatting / meeting) melakukan kontrak (khusus responden terpilih)</li>
                                <li>Mengisi kuesinoer B</li>
                                <li>Kuesioner evaluasi mengikuti web</li>
                            </ul>
                        </li>
                        <li>Sebagai reward/penghargaan pada responden, akan diberikan souvenir sebagai cinderamata.</li>
                    </ol>
                    <p>Demikian penjelasan dari Saya (sebagai peneliti), dengan penjelasan ini besar harapan saya agar Saudara/i bersedia berpartisipasi dalam penelitian yang saya laksanakan.</p>
                    <p>Akhir kata, saya ucapkan  terima kasih atas kesediaan dan partisipasi Saudara/i dalam penelitian ini.</p>
                </div>
            </div>
        </div>
    </div>
    {{-- <section class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Informasi Penelitian</h4>
        </div>
        <div class="card-content">
            <div class="card-body" style="overflow-y: scroll; height: 200px;">
                <p>Bermaksud melaksanakan penelitian dalam rangka penyusunan tugas akhir. Bersama ini saya akan menjelaskan beberapa hal, yaitu:</p>
                    <ol>
                        <li>Tujuan dari penelitian ini adalah untuk menganalisis Pengaruh Spiritual <i>Problem Solving</i> berbasis <i>Web</i> pada Mahasiswa</li>
                        <li>Manfaat penelitian ini adalah membantu menyelesaikan masalah, dan mempunyai koping yang adaptif saat menghadapi masalah</li>
                        <li>Peneliti akan merahasiakan identitas, data dan semua informasi yang berkaitan dengan keikutsertaan reponden terhadap orang yang tidak berhak.</li>
                        <li>Penelitian tidak bertujuan komersil, artinya peneliti atau pihak lain tidak menggunakan hasil penelitian ini untuk tujuan penjualan produk, baik berupa barang maupun jasa, untuk kepentingan bisnis.</li>
                        <li>Semua reponden akan diberikan perlindungan dan perlakuan yang sama, dan kesediaan menjadi subyek penelitian dengan menandatangani lembar persetujuan.</li>
                        <li>
                            Tahapan saat mengunjungi <i>Problem Solving</i> berbasis <i>Web</i> yaitu:
                            <ul>
                                <li>Melakukan registrasi dengan Email dan NIM </li>
                                <li>Mengisi kuesinoer A</li>
                                <li>Mengikuti kuis</li>
                                <li>Curhat dengan mengisi ada link form kuesioner  (khusus responden terpilih)</li>
                                <li>Manajemen strees ( Power Point, video )</li>
                                <li>Konsultasi (chatting / meeting) melakukan kontrak (khusus responden terpilih)</li>
                                <li>Mengisi kuesinoer B</li>
                                <li>Kuesioner evaluasi mengikuti web</li>
                            </ul>
                        </li>
                        <li>Sebagai reward/penghargaan pada responden, akan diberikan souvenir sebagai cinderamata.</li>
                    </ol>
                    <p>Demikian penjelasan dari Saya (sebagai peneliti), dengan penjelasan ini besar harapan saya agar Saudara/i bersedia berpartisipasi dalam penelitian yang saya laksanakan.</p>
                    <p>Akhir kata, saya ucapkan  terima kasih atas kesediaan dan partisipasi Saudara/i dalam penelitian ini.</p>
            </div>                        
        </div>
    </section> --}}
    <section class="card">
        <div class="card-header">
            <h4 class="card-title text-center">Persetujuan Setelah Penjelasan</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <p>Setelah mendapatkan penjelasan yang telah saya mengerti dan pahami dengan baik, saya dengan suka rela memberikan izin untuk berpartisipasi sebagai responden dalam penelitian ini</p>
                <div class="row">
                    <div class="col-6 text-center">
                        <button type="submit" class="btn btn-primary mr-4 mt-2" onclick="location.href='{{ route('information.consent.agree') }}';">Setuju</button> 
                    </div>
                    <div class="col-6 text-center">
                        <button type="submit" class="btn btn-danger pull-right mt-2" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Tidak Setuju</button>
                    </div>                    
                </div>
            </div>                        
        </div>
    </section>
</div>
@endsection

@push('scripts')

@endpush