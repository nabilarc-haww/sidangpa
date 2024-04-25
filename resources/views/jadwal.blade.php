@extends('main')

<body>
    @include('header')
    @include('sidebar')

<main id="main" class="main">
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

              <!-- <form action="{{ route('header.store') }}" method="POST">
                  @csrf
                  <div class="col-md-12">
                      <label for="" class="form-label">Judul Jadwal</label>
                      <textarea name="judul" style="height: 100px;" type="text" class="form-control" placeholder="Masukkan judulmu"></textarea>
                  </div>
                  <div class="col-md-12">
                      <label for="inputState" class="form-label">Program Studi</label>
                      <select name="prodi" id="inputState" class="form-select" placeholder="Pilihlah program studi">
                          <option selected disabled>Program Studi</option>
                          <option>D3 Teknik Informatika</option>
                      </select>
                  </div>
                  <div class="col-md-6">
                      <label for="inputZip" class="form-label">Tanggal</label>
                      <input name="tanggal_waktu" type="date" class="form-control" id="inputZip" placeholder="Pilih tanggal">
                  </div>
                  <div class="col-md-6">
                      <label for="inputZip" class="form-label">Waktu</label>
                      <input type="time" class="form-control" id="inputZip" placeholder="Masukkan waktu">
                  </div>
                  <div class="col-md-12">
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
              </form> -->

              <form class="row g-3" action="{{ route('proyek-akhir.import') }}" method="post" enctype="multipart/form-data">
                @csrf
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
</main>

</body>