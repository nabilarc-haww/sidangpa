@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Edit Dosen</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item"><a href="/riset-group">Riset Group</a></li>
        <li class="breadcrumb-item active">Edit Dosen</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Edit Dosen</h5>

            <form method="POST" action="/riset-group/update/{{ $dosen[0]['id_dosen'] }}">
              @csrf
              @method('PATCH')

              <div class="row mb-3">
                <label for="nama_dosen" class="col-sm-2 col-form-label">Nama Dosen</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama_dosen" value="{{ $dosen[0]['nama_dosen'] }}">
                </div>
              </div>

              <div class="row mb-3">
                <label for="nip" class="col-sm-2 col-form-label">NIP</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="nip" value="{{ $dosen[0]['nip'] }}">
                </div>
              </div>

              <div class="row mb-3">
                <label for="id_rg" class="col-sm-2 col-form-label">Riset Group</label>
                <div class="col-sm-10">
                  <select class="form-control" name="id_rg">
                    @foreach ($rg as $group)
                      <option value="{{ $group['id_rg'] }}" {{ $dosen[0]['id_rg'] == $group['id_rg'] ? 'selected' : '' }}>{{ $group['riset_group'] }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="available" class="col-sm-2 col-form-label">Available</label>
                <div class="col-sm-10">
                  <select class="form-control" name="available">
                    <option value="true" {{ $dosen[0]['available'] ? 'selected' : '' }}>Yes</option>
                    <option value="false" {{ !$dosen[0]['available'] ? 'selected' : '' }}>No</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <label for="psdku" class="col-sm-2 col-form-label">PSDKU</label>
                <div class="col-sm-10">
                  <select class="form-control" name="psdku">
                    <option value="true" {{ $dosen[0]['psdku'] ? 'selected' : '' }}>Yes</option>
                    <option value="false" {{ !$dosen[0]['psdku'] ? 'selected' : '' }}>No</option>
                  </select>
                </div>
              </div>

              <div class="row mb-3">
                <div class="col-sm-2 offset-sm-2 d-flex justify-content-between">
                  <button type="submit" class="btn btn-primary me-2">Update</button>
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
