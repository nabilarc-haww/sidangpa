@extends('main')
<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Penjadwalan Sidang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="container">
      <div class="row g-2">
        @foreach($headers as $header)
        <div class="col-6">
          <div class="card card-body">
            <small class="text-muted mt-3" style="font-size: 12px">
            <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($header['created_at'])->locale('id')->isoFormat('DD MMMM YYYY') }}
            </small>
            <h4 class="card-title m-0 py-3">{{ $header['judul'] }}</h4>
            <div class="row mb-2">
              <div class="col-4">
                <strong>Jurusan</strong>
              </div>
              <div class="col-8">
                : {{ $header['prodi'] }}
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-4">
                <strong>Tahapan</strong>
              </div>
              <div class="col-8">
                : {{ $header['tahapan_sidang'] }}
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-4">
                <strong>Waktu</strong>
              </div>
              <div class="col-8">
                : {{ \Carbon\Carbon::parse($header['tanggal'])->locale('id')->isoFormat('DD MMMM YYYY') }} | {{ $header['waktu']}} WIB
              </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
             <a href="{{ url('/proyek-akhir/download-pdf/'.$header['id_header']) }}" class="btn btn-success me-2" style="background-color: #04BC00;border: none; font-size: 14px;">Download</a>
              <a href="{{ url('/proyek-akhir/generate-hasil/'.$header['id_header'])  }}" class="btn btn-primary" style="font-size: 14px;">Lihat Hasil</a>
            </div>
          </div>     
        </div>
        @endforeach
      </div>                
    </div>
  </section>

</main><!-- End #main -->

@include('footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>
