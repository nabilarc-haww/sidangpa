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
    
            <div class="col-lg-12">

                <div class="card">
                  <div class="card-body">

                    <!-- Vertical Form -->
                    <form class="row g-3">
                      <div class="col-12 pt-4">
                        <label for="inputNanme4" class="form-label">Judul Pengumuman</label>
                        <input type="text" class="form-control" id="inputNanme4">
                      </div>
                      <div class="col-md-12">
                        <label for="fileUpload" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="fileUpload" name="fileUpload">
                      </div>
                      <div class="col-md-12">
                        <label for="fileUpload" class="form-label">Lampiran</label>
                        <input type="file" class="form-control" id="fileUpload" name="fileUpload">
                      </div>
                      <div class="col-md-12">
                        <div class="card-body">
                          <h5 class="card-title">Quill Editor Default</h5>
            
                          <!-- Quill Editor Default -->
                          <div class="quill-editor-default" type="text" style="">
                          </div>
                          <!-- End Quill Editor Default -->
            
                        </div>
                      </div>
                      <div class="col-md-12">
                        <label class="col-form-label pt-0">Status</label>
                        <div class="row ms-4">
                          <div class="form-check col-2">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
                            <label class="form-check-label" for="gridRadios1">
                              Unpublish
                            </label>
                          </div>
                          <div class="form-check col-2">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                              Publish
                            </label>
                          </div>
                          <div class="form-check col-2">
                            <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
                            <label class="form-check-label" for="gridRadios2">
                              Draft
                            </label>
                          </div>
                        </div>
                    </div>
                      <div class="col-md-12 d-flex justify-content-end align-items-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                      </div>
                    </form><!-- Vertical Form -->
      
                  </div>
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