@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Proyek Akhir</h1>
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

            @foreach($data_pa as $master)
            <h2 class="text-center">{{ $master['jurusan'] }}</h2>
            <p class="text-center">Tahun ajaran : {{ $master['tahun_ajaran'] }}</p>

            <div class="row">
              <div class="col-md-6"></div>
              <div class="col-md-6 pb-3" style="padding-left: 350px">
                <a type="button" href="{{ route('proyek-akhir.data.tambah_pa', ['id_master' => $id_master]) }}" class="btn btn-success" style="background-color: #04BC00;">
                  + Tambah Proyek Akhir
                </a>
              </div>
            </div>
           
            <!-- Table untuk menampilkan data -->
            <table class="table table-bordered">
                <thead  class="table-light">
                  <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Judul</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>
                    <th>Pembimbing 3</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
               
                    @foreach($master['proyek_akhir'] as $data)
                      <tr>
                        <td>{{ $data['nama_mahasiswa'] }}</td>
                        <td>{{ $data['judul_pa'] }}</td>
                        <td>{{ $data['dosen_pembimbing1']['nama_dosen'] ?? '-' }}</td>
                        <td>{{ $data['dosen_pembimbing2']['nama_dosen'] ?? '-' }}</td>
                        <td>{{ $data['dosen_pembimbing3']['nama_dosen'] ?? '-' }}</td>
                        <td>
                            <div class="d-flex">
                              <a href="{{ route('proyek-akhir.data.editDataProyek', $data['id_mhs']) }}" class="btn btn-primary btn-sm me-2">
                                Edit
                              </a>
                              <form action="{{ route('proyek-akhir.data.deleteDataProyek', $data['id_mhs']) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                              </form>
                            </div>
                        </td>
                      </tr>
                    @endforeach
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
