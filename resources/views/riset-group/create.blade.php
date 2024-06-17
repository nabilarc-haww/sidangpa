@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Tambah Dosen</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/riset-group">Riset Group</a></li>
        <li class="breadcrumb-item active">Tambah Dosen</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Tambah Dosen</h5>

            <form method="POST" action="{{ route('riset-group.store') }}">
              @csrf

              <div class="row mb-3">
                <label for="nama_dosen" class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama_dosen" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nip" required>
                </div>
              </div>

              <div class="row mb-3">
                <label for="id_rg" class="col-sm-2 col-form-label">Riset Group</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_rg" required>
                    @foreach ($rg as $group)
                      <option value="{{ $group['id_rg'] }}">{{ $group['riset_group'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="available" class="col-sm-2 col-form-label">Available</label>
                <div class="col-sm-10">
                  <select class="form-control" name="available" required>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="psdku" class="col-sm-2 col-form-label">PSDKU</label>
                <div class="col-sm-10">
                  <select class="form-control" name="psdku" required>
                    <option value="true">Yes</option>
                    <option value="false">No</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-2 offset-sm-2 d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary me-2">Save</button>
                  <a href="/riset-group" class="btn btn-secondary">Cancel</a>
                </div>
              </div>
            </form>

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
