@extends('layouts.app')

@section('content')
<header class="hero">
    <div class="overlay"></div>
    <div class="container text-center text-white d-flex flex-column justify-content-center align-items-center" style="height: 100%;">
        <h1 class="display-5 fw-bold">Selamat Datang di</h1>
        <h2 class="display-6 fw-semibold">Sistem E-Arsip DLH Kabupaten Bogor</h2>
        <h3 class="display-8 fw-semibold">Bidang Penataan Hukum Lingkungan dan Pengelolaan Limbah B3</h3>
        <p class="lead">Simpan, Kelola, dan Akses Dokumen Lingkungan Hidup dengan Mudah</p>
        <div class="mt-4">
            <a href="arsip" class="btn btn-outline-light btn-lg mx-2"><i class="fa-solid fa-file-lines"></i> Lihat Arsip</a>
            <a href="#elang-info" class="btn btn-outline-light btn-lg mx-2"><i class="fa-solid fa-circle-info"></i> Informasi Mengenai ELANG</a>
        </div>
    </div>
</header>

<section id="elang-info" class="elang-section text-center fade-in">
<div class="container mx-auto" style="max-width: 800px;">
    <h2 class="fw-bold mb-1 text-center">ELANG</h2>
    <h3 class="fw-bold mb-3 text-center">Elektronik Arsip Lingkungan</h3>    

    <p class="fs-5" style="text-align: justify;">
            ELANG adalah sistem informasi digital untuk menyimpan, mengelola, dan mengakses dokumen lingkungan hidup dengan mudah dan cepat. 
        Melalui platform ini, Dinas Lingkungan Hidup Kabupaten Bogor berupaya meningkatkan pelayanan publik dengan mengurangi penggunaan kertas, 
        mempercepat pencarian data, serta memastikan keamanan dan keakuratan arsip lingkungan. 
        Dengan ELANG, seluruh pihak dapat mengakses arsip penting dari mana saja secara aman dan transparan, 
        mendukung inisiatif digitalisasi ramah lingkungan dan berkelanjutan.
    </p>
        <div class="row mt-5 fade-in"> 
    <div class="col-md-4 text-center mb-4">
        <div class="p-4 shadow-sm bg-white rounded h-100">
            <div class="mb-3 fs-1 text-success"><i class="fa-solid fa-file-lines"></i></div>
            <h5 class="fw-bold">Pengelolaan Arsip</h5>
            <p>Menyimpan dokumen Berita Acara dan Pengawasan Lingkungan Hidup secara digital dan aman.</p>
        </div>
    </div>
    <div class="col-md-4 text-center mb-4">
        <div class="p-4 shadow-sm bg-white rounded h-100">
            <div class="mb-3 fs-1 text-success"><i class="fa-solid fa-file"></i><i class="fa-solid fa-arrow-down ms-1"></i></div>
            <h5 class="fw-bold">Download Otomatis</h5>
            <p>Setiap dokumen dapat diunduh dalam format PDF dengan cepat dan efisien.</p>
        </div>
    </div>
    <div class="col-md-4 text-center mb-4">
        <div class="p-4 shadow-sm bg-white rounded h-100">
            <div class="mb-3 fs-1 text-success"><i class="fa-solid fa-universal-access"></i></div>
            <h5 class="fw-bold">Akses Mudah</h5>
            <p>Cari dan akses arsip kapan saja, di mana saja secara online.</p>
        </div>
    </div>
</div>

    </>
</section>
@endsection
