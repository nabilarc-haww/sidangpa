@extends('main')

<body>
@include('header')
@include('sidebar')
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Pengumuman Detail</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ url('/pengumuman') }}">Pengumuman</a></li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $pengumuman[0]['judul_pengumuman'] }}</h5>
              <p class="card-text">{!! nl2br(e($pengumuman[0]['deskripsi'])) !!}</p>
              
              @if(isset($pengumuman[0]['attachment']) && count($pengumuman[0]['attachment']) > 0)
                <h5 class="card-title">Lampiran:</h5>
                <ul>
                  @foreach($pengumuman[0]['attachment'] as $attachment)
                    <li><a href="{{ $attachment['path'] }}" target="_blank">{{ $attachment['nama_file'] }}</a></li>
                  @endforeach
                </ul>
              @endif

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  @include('footer')
</body>
