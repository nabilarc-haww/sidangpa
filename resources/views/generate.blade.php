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
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Proyek Akhir</h5>
            <p>Anda dapat melihat data proyek disini diantaranya judul proyek akhir, mahasiswa dan dosen pembimbingnya.</p>

            <!-- Form untuk filter data -->
            <form action="{{ route('proyek-akhir.getData') }}" method="GET">
              @csrf
            <!-- End Form -->

            <!-- Table untuk menampilkan data -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Judul</th>
                  <th>Pembimbing 1</th>
                  <th>Pembimbing 2</th>
                  <th>Pembimbing 3</th>
                </tr>
              </thead>
              <tbody>
                @foreach($proyek_akhir as $item)
                <tr>
                  <td>{{ $item['nama_mahasiswa'] }}</td>
                  <td>{{ $item['judul_pa'] }}</td>
                  <td>{{ $item['dosen_pembimbing1'] }}</td>
                  <td>{{ $item['dosen_pembimbing2'] }}</td>
                  <td>{{ $item['dosen_pembimbing3'] }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table -->

          </div>
        </div>

      </div>
    </div>
  </section>

</main><!-- End #main -->

@include('footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>
