<!DOCTYPE html>
@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Edit Pengumuman</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Pengumuman</li>
            <li class="breadcrumb-item">Daftar</li>
            <li class="breadcrumb-item active">Edit</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section">
        <div class="row">
            <div class="col-lg-12">                
              <div class="card">
                  <div class="card-body p-5">
      
                    <!-- Vertical Form -->
                    <form method="POST" action="{{ route('pengumuman.updatePengumuman', $pengumuman[0]['id_pengumuman']) }}">
                      @csrf
                      @method('POST')
                      <div class="row">
                        <div class="col-md-6">
                          <label for="judul_pengumuman" class="form-label">Judul Pengumuman</label>
                          <input type="text" class="form-control" id="judul_pengumuman" name="judul_pengumuman" value="{{ $pengumuman[0]['judul_pengumuman'] }}">
                        </div>
                        <div class="col-md-6">
                          <label for="fileUpload" class="form-label">Cover</label>
                          <input type="file" class="form-control" id="fileUpload" name="fileUpload">
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="fileUpload" class="form-label">Lampiran</label>
                          <input type="file" class="form-control" id="fileUpload" name="fileUpload">
                        </div>
                        <div class="col-md-6">
                          <label for="fileUpload" class="form-label">Deskripsi</label>
                          <textarea class="form-control" id="deskripsi" name="deskripsi">{{ $pengumuman[0]['deskripsi'] }}</textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label class="col-form-label pt-0">Status</label>
                          <div class="row ms-4">
                            <div class="form-check col-2">
                              <input class="form-check-input" type="radio" name="status" id="gridRadios1" value="unpublish" {{ $pengumuman[0]['status'] == 'unpublish' ? 'checked' : '' }}>
                              <label class="form-check-label" for="gridRadios1">
                                Unpublish
                              </label>
                            </div>
                            <div class="form-check col-2">
                              <input class="form-check-input" type="radio" name="status" id="gridRadios2" value="publish" {{ $pengumuman[0]['status'] == 'publish' ? 'checked' : '' }}>
                              <label class="form-check-label" for="gridRadios2">
                                Publish
                              </label>
                            </div>
                            <div class="form-check col-2">
                              <input class="form-check-input" type="radio" name="status" id="gridRadios3" value="draft" {{ $pengumuman[0]['status'] == 'draft' ? 'checked' : '' }}>
                              <label class="form-check-label" for="gridRadios3">
                                Draft
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 d-flex justify-content-end align-items-end pt-5">
                        <button type="reset" class="btn btn-secondary" style="margin-right: 20px;">Reset</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                    </form><!-- Vertical Form -->
      
                  </div>
                </div>
          </div>
        </div>
      </section>

      @include('footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>

</main>
