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

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

  <div class="pagetitle">
    <h1>Penjadwalan Sidang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
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

            <a href="{{ route('riset-group.create') }}" class="btn btn-success mb-3">Tambah Dosen</a>

          <!-- Table untuk menampilkan data -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>Nama Riset Group</th>
                  <th>NIP</th>
                  <th>Nama Dosen</th>
                  <th>Dosen PSDku</th>
                  <th>Available</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($riset_group as $item)
                  @foreach ($item['dosen'] as $index => $dosen)
                  <tr>
                    @if ($index == 0)
                    <td rowspan="{{ count($item['dosen']) }}">{{ $item['riset_group'] }}</td>
                    @endif
                    <td>{{ $dosen['nip'] }}</td>
                    <td>{{ $dosen['nama_dosen'] }}</td>
                    <td>{{ $dosen['psdku'] ? 'Ya' : 'Tidak' }}</td>
                    <td>{{ $dosen['available'] ? 'Ya' : 'Tidak' }}</td>
                    <td>
                      <div class="d-flex">
                        <form action="{{ route('riset-group.editDosen', $dosen['id_dosen']) }}" method="GET" class="me-2">
                          <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                        </form>
                        <form action="{{ route('riset-group.deleteDosen', $dosen['id_dosen']) }}" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
