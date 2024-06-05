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
    <div class="row justify-content-center">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Proyek Akhir</h5>
            <!-- <p>Anda dapat melihat data proyek disini diantaranya judul proyek akhir, mahasiswa dan dosen pembimbingnya.</p> -->

            
            @foreach($finalResult as $header)
            <h2 class="text-center">{{ $header['judul'] }}</h2>
            <p class="text-center">Prodi: {{ $header['prodi'] }}</p>
            <p class="text-center">Tanggal: {{ $header['tanggal'] }} </p>
            <p class="text-center">Jam: {{ $header['waktu'] }} - Selesai </p>
            <p class="text-center">Tahapan Sidang: {{ $header['tahapan_sidang'] }}</p>
            
            @foreach($header['data_generate'] as $ruang)
            <h5>{{ $ruang['nama_ruang'] }} ({{ $ruang['kode_ruang'] }} - {{ $ruang['letak'] }})</h5>
            <!-- Table untuk menampilkan data -->
            <table class="table table-bordered">
              <thead  class="table-light">
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Judul</th>
                  <th>Pembimbing 1</th>
                  <th>Pembimbing 2</th>
                  <th>Pembimbing 3</th>
                  <th>Penguji 1</th>
                  <th>Penguji 2</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ruang['data_generate'] as $data)
                <tr>
                  <td>{{ $data['id_mhs']['nama_mahasiswa'] }}</td>
                  <td>{{ $data['id_mhs']['judul_pa'] }}</td>
                  <td>{{ $data['id_mhs']['dosen_pembimbing1']['nama_dosen'] }}</td>
                  <td>{{ $data['id_mhs']['dosen_pembimbing2']['nama_dosen'] }}</td>
                  <td>{{ $data['id_mhs']['dosen_pembimbing3']['nama_dosen'] }}</td>
                  <td>{{ $data['penguji_1']['nama_dosen'] ?? "kosong"}} </td>
                  <td>{{ $data['penguji_2']['nama_dosen'] ?? "kosong" }} </td>
                </tr>
                @endforeach
              </tbody>
            </table>
            <!-- End Table -->
            @endforeach
            
            @endforeach

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
