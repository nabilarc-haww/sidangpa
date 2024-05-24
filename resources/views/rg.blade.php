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
            <h5 class="card-title">Daftar Riset Group</h5>
            <p>Anda dapat melihat data riset group beserta dosen yang menjadi anggotanya</p>

          <!-- Table untuk menampilkan data -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>Nama Riset Group</th>
                  <th>NIP</th>
                  <th>Nama Dosen</th>
                </tr>
              </thead>
              <tbody>
                @foreach($riset_group as $item)
                <tr>
                  <td>{{ $item['riset_group'] }}</td>
                  <td>
                    @foreach ($item['dosen'] as $dosen)
                    {{ $dosen['nip'] }} <br>
                    @endforeach
                   
                </td>
                <td>
                @foreach ($item['dosen'] as $dosen)
                    {{ $dosen['nama_dosen'] }}<br>
                    @endforeach
                </td>
                  {{-- <td>{{ $item['ruang']['nama_ruang'] }}</td> --}}
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
