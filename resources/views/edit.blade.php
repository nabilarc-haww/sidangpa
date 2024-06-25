@extends('main')
<body>
@include('header')
@include('sidebar')

<main id="main" class="main">
    <div class="container">
        <div class="pagetitle">
            <h1>Edit Data Proyek Akhir</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">Home</li>
                    <li class="breadcrumb-item">Proyek Akhir</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <h2>Edit Data Generate</h2>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(isset($data_generate))
                <div class="mahasiswa-info mb-4">
                    <h4>Data Mahasiswa</h4>
                    <p><strong>Judul:</strong> {{ $data_generate['id_mhs']['judul_pa'] ?? 'Data tidak tersedia' }}</p>
                    <p><strong>Nama Mahasiswa:</strong> {{ $data_generate['id_mhs']['nama_mahasiswa'] ?? 'Data tidak tersedia' }}</p>
                    <p><strong>Pembimbing 1:</strong> {{ $data_generate['id_mhs']['dosen_pembimbing1']['nama_dosen'] ?? 'Data tidak tersedia' }}</p>
                    <p><strong>Pembimbing 2:</strong> {{ $data_generate['id_mhs']['dosen_pembimbing2']['nama_dosen'] ?? 'Data tidak tersedia' }}</p>
                    <p><strong>Pembimbing 3:</strong> {{ $data_generate['id_mhs']['dosen_pembimbing3']['nama_dosen'] ?? 'Data tidak tersedia' }}</p>
                </div>

                @if(isset($data_generate['id_jadwal_generate']))
                    <form action="{{ route('proyek-akhir.update', $data_generate['id_jadwal_generate']) }}" method="POST">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label for="id_ruang">Ruang</label>
                            <select name="id_ruang" class="form-control" required>
                                @foreach($ruang as $r)
                                    <option value="{{ $r['id_ruang'] }}" {{ $r['id_ruang'] == $data_generate['id_ruang'] ? 'selected' : '' }}>
                                        {{ $r['nama_ruang'] }} ({{ $r['kode_ruang'] }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_moderator">Moderator</label>
                            <select name="id_moderator" class="form-control" required>
                                @foreach($dosen as $d)
                                    <option value="{{ $d['id_dosen'] }}" {{ $d['id_dosen'] == $data_generate['id_moderator']['id_dosen'] ? 'selected' : '' }}>
                                        {{ $d['nama_dosen'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="penguji_1">Penguji 1</label>
                            <select name="penguji_1" class="form-control" required>
                                @foreach($dosen as $d)
                                    <option value="{{ $d['id_dosen'] }}" {{ $d['id_dosen'] == $data_generate['penguji_1']['id_dosen'] ? 'selected' : '' }}>
                                        {{ $d['nama_dosen'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="penguji_2">Penguji 2</label>
                            <select name="penguji_2" class="form-control" required>
                                @foreach($dosen as $d)
                                    <option value="{{ $d['id_dosen'] }}" {{ $d['id_dosen'] == $data_generate['penguji_2']['id_dosen'] ? 'selected' : '' }}>
                                        {{ $d['nama_dosen'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" name="id_header" value="{{ $data_generate['id_header'] }}">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                @else
                    <p>Error: Data tidak ditemukan atau tidak valid.</p>
                @endif
            @else
                <p>Error: Data tidak ditemukan atau tidak valid.</p>
            @endif
        </section>
    </div>

@include('footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</main>

</body>
</html>
