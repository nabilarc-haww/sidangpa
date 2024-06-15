@extends('main')

<body>
    @include('header')
    @include('sidebar')

<main id="main" class="main">
  
<!-- Alerts -->
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif


<div class="row">
    <div class="col-lg-6">
        <div class="card p-5">
          <div class="card-title">
            <a style="color: 4154F1; font-size: 26px;">Bagaimana</a> 
            <a style="font-size: 26px;">cara membuat jadwal dengan</a> 
            <u style="color: 4154F1; font-size: 26px;">SCHEDU</u>
            <a style="font-size: 30px;">?</a> 
          </div>
          <ul class="list-unstyled">
              <ul>
                <li class="lh-base">Anda dapat membuat jadwal  dengan mengisi formulir di samping dan menekan tombol generate jadwal.</li>
                <li class="lh-base">Tunggulah beberapa saat dan jadwalmu akan selesai.</li>
                <li class="lh-base">Apabila hasil generate sudah terlihat semua, anda dapat melakukan regenerate jadwal apabila kurang sesuai.</li>
              </ul>
          </ul>
          <div class="row">
            <div class="col-1">
              {{-- <i class="bi bi-caret-right-fill" style="color: 4154F1; width: 30; height: 30;"></i> --}}
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgba(66,84,241,1)" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
              </svg>
            </div>
            <div class="col-10">
              <div class="card ps-3 pe-3 pt-2 pb-2" style="background-color: EDEEFD; box-shadow: none; margin-bottom: 15px;">
                <label>Melakukan <b>Generate Jadwal</b> dengan mudah dan otomatis.</label>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6 ps-5 pe-0">
              <img src="{{ asset('style/assets/img/ilustrasi.svg') }}" style="width: 200px; height: 200px;" alt="">
            </div>
            <div class="col-6 p-5">
              <i>SCHEDU, teman terpercaya Anda dalam menyusun jadwal sidang proyek akhir !</i>
            </div>
          </div>
        </div>
    </div>
    <div class="col-lg-6">
      <div class="card p-3">
          <div class="card-body">
              <h5 class="card-title">Mulai Pembuatan Jadwalmu !</h5>

              <form action="{{ route('header.store') }}" method="POST">
                  @csrf
                  <div class="col-md-12">
                      <label for="" class="form-label">Judul Jadwal</label>
                      <textarea name="judul" style="height: 100px;" type="text" class="form-control" placeholder="Masukkan judulmu"></textarea>
                  </div>
                  <div class="col-md-12 mt-2">
                      <label for="inputState" class="form-label">Tahun Ajaran</label>
                      <div class="row">
                        <div class="col-4">
                            <select name="start_year" class="form-control" id="startYear">
                                <!-- Years will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="col-1 text-center">
                            <h3>/</h3>
                        </div>
                        <div class="col-4">
                            <select name="end_year" class="form-control" id="endYear">
                                <!-- Years will be populated by JavaScript -->
                            </select>
                        </div>
                      </div>
                  </div>
                  <div class="col-md-12 mt-2">
                    <label for="inputState" class="form-label">Program Studi</label>
                    <select name="prodi" id="inputState" class="form-select" placeholder="Pilihlah program studi">
                        <option selected disabled>Program Studi</option>
                        <option>D3 Teknik Informatika</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-2">
                        <label for="inputZip" class="form-label">Tanggal</label>
                        <input name="tanggal" type="date" class="form-control" id="inputZip" placeholder="Pilih tanggal">
                    </div>
                    <div class="col-md-6 mt-2">
                        <label for="inputZip" class="form-label">Waktu</label>
                        <input type="time" name="waktu" class="form-control" id="inputZip" placeholder="Masukkan waktu">
                    </div>
                 </div>
                  <div class="col-md-12 mt-2">
                      <label for="inputState" class="form-label">Tahapan Sidang</label>
                      <select name="tahapan_sidang" id="inputState" class="form-select" placeholder="Pilihlah tahapan sidang">
                          <option selected disabled>Tahapan Sidang</option>
                          <option>Sidang Proposal Proyek Akhir (SPPA)</option>
                      </select>
                  </div>
                  <div class="col-12 mt-3 mb-3">
                      <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="gridCheck">
                          <label class="form-check-label" for="gridCheck">
                              Apakah data yang anda masukkan sudah benar?
                          </label>
                      </div>
                  </div>
                  <div class="text-center">
                      <button type="submit" class="btn btn-primary">Submit</button>
                      <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<!-- @if (session('id_header')) -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">import data proyek akhir</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="row g-3" action="{{ route('proyek-akhir.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <!-- <input type="hidden" name="id_header" value="{{ session('id_header') }}"> -->

                        <div class="col-md-12">
                            <label for="fileUpload" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="fileUpload" name="fileUpload">
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- @else -->
        <!-- <div class="alert alert-danger">
            Missing required parameter: id_header.
        </div>
    @endif -->


<!-- Include Bootstrap JS and jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        @if(session('success'))
            var myModal = new bootstrap.Modal(document.getElementById('uploadModal'), {
                keyboard: false
            });
            myModal.show();
        @elseif(session('error'))
            // Display error alert
            alert("{{ session('error') }}");
        @endif
    });

    // Function to populate year dropdowns
    function populateYearDropdowns(startYearId, endYearId, startYear, endYear) {
            const startYearSelect = document.getElementById(startYearId);
            const endYearSelect = document.getElementById(endYearId);

            for (let year = startYear; year <= endYear; year++) {
                let option = document.createElement("option");
                option.value = year;
                option.text = year;
                startYearSelect.appendChild(option.cloneNode(true));
                endYearSelect.appendChild(option);
            }
        }

        // Populate the year dropdowns from 2000 to the current year + 10
        document.addEventListener("DOMContentLoaded", function() {
            const currentYear = new Date().getFullYear();
            populateYearDropdowns('startYear', 'endYear', 2010, currentYear + 10);
        });
</script>
</main>

</body>