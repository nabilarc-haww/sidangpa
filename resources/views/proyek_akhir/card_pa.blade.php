<html>
@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">
@if(session('success'))
    <script>
        $(document).ready(function(){
            // Show success modal here
            $('#successModal').modal('show');
        });
    </script>
@endif

<!-- Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Data berhasil ditambahkan.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


  <div class="pagetitle">
    <h1>Penjadwalan Sidang</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Proyek Akhir</li>
        <li class="breadcrumb-item active">Program Studi</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">

        <div class="container">
            <div class="row g-2">
              <div class="col-6">
                <div class="card card-body">
                    <small class="text-muted mt-3" style="font-size: 12px">
                        <i class="bi bi-clock"></i> Senin, 23 Juni 2024
                    </small>
                    <h4 class="card-title m-0 py-3">D3 Teknik Informatika</h5>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Tahun Ajaran</strong>
                      </div>
                      <div class="col-8">
                        : 2023 / 2024
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Mahasiswa</strong>
                      </div>
                      <div class="col-8">
                        : 51 orang
                      </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                      <button class="btn btn-success me-2"  style="background-color: #04BC00;border: none; font-size: 14px;">Download</button>
                      <button class="btn btn-primary" style="font-size: 14px;">Lihat Data</button>
                    </div>
                  </div>     
              </div>
              <div class="col-6">
                <div class="card card-body">
                    <small class="text-muted mt-3" style="font-size: 12px">
                        <i class="bi bi-clock"></i> Senin, 23 Juni 2024
                    </small>
                    <h4 class="card-title m-0 py-3">D3 Teknik Informatika</h5>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Tahun Ajaran</strong>
                      </div>
                      <div class="col-8">
                        : 2023 / 2024
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Mahasiswa</strong>
                      </div>
                      <div class="col-8">
                        : 51 orang
                      </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                      <button class="btn btn-success me-2"  style="background-color: #04BC00;border: none; font-size: 14px;">Download</button>
                      <button class="btn btn-primary" style="font-size: 14px;">Lihat Data</button>
                    </div>
                  </div>     
              </div>
              <div class="col-6">
                <div class="card card-body">
                    <small class="text-muted mt-3" style="font-size: 12px">
                        <i class="bi bi-clock"></i> Senin, 23 Juni 2024
                    </small>
                    <h4 class="card-title m-0 py-3">D3 Teknik Informatika</h5>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Tahun Ajaran</strong>
                      </div>
                      <div class="col-8">
                        : 2023 / 2024
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Mahasiswa</strong>
                      </div>
                      <div class="col-8">
                        : 51 orang
                      </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                      <button class="btn btn-success me-2"  style="background-color: #04BC00;border: none; font-size: 14px;">Download</button>
                      <button class="btn btn-primary" style="font-size: 14px;">Lihat Data</button>
                    </div>
                  </div>     
              </div>
              <div class="col-6">
                <div class="card card-body">
                    <small class="text-muted mt-3" style="font-size: 12px">
                        <i class="bi bi-clock"></i> Senin, 23 Juni 2024
                    </small>
                    <h4 class="card-title m-0 py-3">D3 Teknik Informatika</h5>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Tahun Ajaran</strong>
                      </div>
                      <div class="col-8">
                        : 2023 / 2024
                      </div>
                    </div>
                    <div class="row mb-2">
                      <div class="col-4">
                        <strong>Mahasiswa</strong>
                      </div>
                      <div class="col-8">
                        : 51 orang
                      </div>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                      <button class="btn btn-success me-2"  style="background-color: #04BC00;border: none; font-size: 14px;">Download</button>
                      <button class="btn btn-primary" style="font-size: 14px;">Lihat Data</button>
                    </div>
                  </div>     
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
