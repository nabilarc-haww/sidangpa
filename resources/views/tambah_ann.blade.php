<!DOCTYPE html>
@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Tambah Pengumuman</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item">Dashboard</li>
            <li class="breadcrumb-item">Pengumuman</li>
            <li class="breadcrumb-item">Daftar</li>
            <li class="breadcrumb-item active">Tambah</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12">
                <div class="card">
                  <div class="card-body p-5">

                    <!-- Vertical Form -->
                    <form method="POST" action="{{ route('pengumuman.tambahPengumuman') }}">
                      @csrf
                      <div class="row">
                        <div class="col-md-6">
                          <label for="judul_pengumuman" class="form-label">Judul Pengumuman</label>
                          <input type="text" class="form-control" id="judul_pengumuman" name="judul_pengumuman">
                        </div>
                        <!-- Tambah input untuk file cover -->
                        <div class="col-md-6">
                          <label for="cover" class="form-label">Cover</label>
                          <input type="file" class="form-control" id="cover" name="cover">
                        </div>
                      </div>
                      <div class="row">
                        <!-- Tambah input untuk file lampiran -->
                        <div class="col-md-6">
                          <label for="lampiran" class="form-label">Lampiran</label>
                          <input type="file" class="form-control" id="lampiran" name="lampiran">
                        </div>
                        <div class="col-md-6">
                          <label for="deskripsi" class="form-label">Deskripsi</label>
                          <textarea class="form-control" id="deskripsi" name="deskripsi"></textarea>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <label class="col-form-label pt-0">Status</label>
                          <div class="row ms-4">
                            <!-- Tambah input untuk status -->
                            <div class="form-check col-2">
                              <input class="form-check-input" type="radio" name="status" id="unpublish" value="unpublish" checked>
                              <label class="form-check-label" for="unpublish">
                                Unpublish
                              </label>
                            </div>
                            <div class="form-check col-2">
                              <input class="form-check-input" type="radio" name="status" id="publish" value="publish">
                              <label class="form-check-label" for="publish">
                                Publish
                              </label>
                            </div>
                            <div class="form-check col-2">
                              <input class="form-check-input" type="radio" name="status" id="draft" value="draft">
                              <label class="form-check-label" for="draft">
                                Draft
                              </label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12 d-flex justify-content-end align-items-end pt-5">
                        <button type="reset" class="btn btn-secondary" style="margin-right: 20px;">Reset</button>
                        <button type="submit" class=" btn btn-primary">Submit</button>
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
