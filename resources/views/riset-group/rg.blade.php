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
                  <th>Dosen psdku</th>
                  <th>Available</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody class="row">
                @foreach($riset_group as $item)
                <tr>
                  <td class="col-1">{{ $item['riset_group'] }}</td>
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
                <td>
                  @foreach ($item['dosen'] as $dosen)
                      @if ($dosen['psdku'])
                        Ya
                      @else
                        Tidak
                      @endif
                      <br>
                  @endforeach
                </td>
                <td>
                  @foreach ($item['dosen'] as $dosen)
                    @if ($dosen['available'])
                      Ya
                    @else
                      Tidak
                    @endif
                    <br>
                  @endforeach
                </td>
                <td>
                  @foreach ($item['dosen'] as $dosen)
                  <div class="d-flex">
                    <form action="{{ route('riset-group.editDosen', $dosen['id_dosen']) }}" method="GET" class="me-2">
                      <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                    </form>
                    <form action="{{ route('riset-group.deleteDosen', $dosen['id_dosen']) }}" method="POST" style="display: inline-block;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </div>
                  @endforeach
                </td>
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
