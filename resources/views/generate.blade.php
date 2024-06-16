@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

  @if(session('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif

  <div class="pagetitle">
    <h1>Hasil Penjadwalan</h1>
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
            <h5 class="card-title"></h5>
            
            <!-- Filter Form -->
            <form method="GET" action="{{ route('proyek-akhir.getdata', $id_header) }}">
              <div class="row mb-3">
                <div class="col-md-3">
                  <label for="dosen_pembimbing1" class="form-label">Dosen Pembimbing 1</label>
                  <select class="form-select" id="dosen_pembimbing1" name="dosen_pembimbing1">
                    <option value="">Select Dosen Pembimbing 1</option>
                    @foreach($dosenList as $dosen)
                      <option value="{{ $dosen['nama_dosen'] }}" {{ request('dosen_pembimbing1') == $dosen['nama_dosen'] ? 'selected' : '' }}>{{ $dosen['nama_dosen'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="penguji_1" class="form-label">Penguji 1</label>
                  <select class="form-select" id="penguji_1" name="penguji_1">
                    <option value="">Select Penguji 1</option>
                    @foreach($dosenList as $dosen)
                      <option value="{{ $dosen['nama_dosen'] }}" {{ request('penguji_1') == $dosen['nama_dosen'] ? 'selected' : '' }}>{{ $dosen['nama_dosen'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                  <label for="penguji_2" class="form-label">Penguji 2</label>
                  <select class="form-select" id="penguji_2" name="penguji_2">
                    <option value="">Select Penguji 2</option>
                    @foreach($dosenList as $dosen)
                      <option value="{{ $dosen['nama_dosen'] }}" {{ request('penguji_2') == $dosen['nama_dosen'] ? 'selected' : '' }}>{{ $dosen['nama_dosen'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-3">
                <label class="form-label" style="visibility: hidden;">Hidden Label</label>
                  <div>
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>
                </div>
              </div>
            </form>
            <!-- End Filter Form -->
            
            @foreach($finalResult as $header)
            <p class="title-generate text-center">{{ $header['judul'] }}</p>
            <p class="desc-generate text-center">Prodi {{ $header['prodi'] }}</p>
            <p class="desc-generate text-center">{{ $header['tanggal'] }} | Pukul {{ $header['waktu'] }} - Selesai </p>
            <p class="desc-generate text-center">{{ $header['tahapan_sidang'] }}</p>
            <p class="desc-generate text-center">{{ $header['tahun_ajaran'] ?? "-" }}</p>

            
            @foreach($header['data_generate'] as $ruang)
            <div class="highlight mt-3 mb-1">{{ $ruang['riset_group'] }}</div>
            <p class="nama-ruang" style="font-size: 16px;"><b>{{ $ruang['nama_ruang'] }} ({{ $ruang['kode_ruang'] }} - {{ $ruang['letak'] }})</b></p>
            <!-- Table untuk menampilkan data -->
            <table class="table table-bordered">
              <thead class="table-light">
                <tr>
                  <th class="judul-tabel">Nama Mahasiswa</th>
                  <th class="judul-tabel">Judul</th>
                  <th class="judul-tabel">Pembimbing 1</th>
                  <th class="judul-tabel">Pembimbing 2</th>
                  <th class="judul-tabel">Pembimbing 3</th>
                  <th class="judul-tabel">Penguji 1</th>
                  <th class="judul-tabel">Penguji 2</th>
                  <th class="aksi">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ruang['data_generate'] as $data)
                <tr>
                  <td class="isi-tabel">{{ $data['id_mhs']['nama_mahasiswa'] }}</td>
                  <td class="isi-tabel">{{ $data['id_mhs']['judul_pa'] }}</td>
                  <td class="isi-tabel">{{ $data['id_mhs']['dosen_pembimbing1']['nama_dosen'] }}</td>
                  <td class="isi-tabel">{{ $data['id_mhs']['dosen_pembimbing2']['nama_dosen'] }}</td>
                  <td class="isi-tabel">{{ $data['id_mhs']['dosen_pembimbing3']['nama_dosen'] }}</td>
                  <td class="isi-tabel">{{ $data['penguji_1']['nama_dosen'] ?? "kosong"}} </td>
                  <td class="isi-tabel">{{ $data['penguji_2']['nama_dosen'] ?? "kosong" }} </td>
                  <td>
                    <div class="d-flex">
                    <form action="{{ route('proyek-akhir.update', $data['id_jadwal_generate']) }}" method="POST">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="id_header" value="{{ $data['id_header'] }}">
                        <a href="{{ route('proyek-akhir.edit', $data['id_jadwal_generate']) }}" class="btn aksi-edit btn-primary btn-sm me-2">Edit</a>
                    </form>

                      <form action="{{ route('proyek-akhir.delete', $data['id_jadwal_generate']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id_header" value="{{ $data['id_header'] }}">
                        <button type="submit" class="btn aksi-hapus btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</button>
                      </form>
                    </div>
                  </td>
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
