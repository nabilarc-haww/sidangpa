@extends('main')

<body>
@include('header')
@include('sidebar')

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Penjadwalan Sidang</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
              <h5 class="card-title">Generate Jadwal</h5>
              <p>Kami membantumu melakukan penjadwalan sidang proyek akhir dengan lebih efektif dan efisien</a>.</p>

              <div class="row">
                <div class="col-md-4">
                  <label for="inputEmail5" class="form-label">Dosen Pembimbing Utama</label>
                  <input type="email" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-4" >
                  {{-- <div class="form-floating mb-3"> --}}
                    <label for="inputEmail5" class="form-label">Riset Group</label>
                    <select class="form-select">
                      <option selected>Data CentricArtificial Intelligence and e-Business System</option>
                      <option value="1">Health Informatics</option>
                      <option value="2">Agile Product Development</option>
                    </select>
                  {{-- </div> --}}
                </div>
                <div class="col-md-4" style="padding-top: 30px">
                  <button type="button" class="btn btn-primary">Submit</button>
                </div>
              
              </div>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Nama Mahasiswa </th>
                    <th>Judul</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>
                    <th>Pembimbing 3</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>
          
          <div class="row">
            <div >
              <button type="button" class="btn col-xl-12 btn-primary">Generate Jadwal</button>
            </div>
          </div>

          <div class="card" style="margin-top: 50px" >
            <div class="card-body">
              <h5 class="card-title">Generate Jadwal</h5>
              <p>Kami membantumu melakukan penjadwalan sidang proyek akhir dengan lebih efektif dan efisien</a>.</p>

              <div class="row">
                <div class="col-md-4">
                  <label for="inputEmail5" class="form-label">Dosen Pembimbing Utama</label>
                  <input type="email" class="form-control" id="inputEmail5">
                </div>
                <div class="col-md-4" >
                  {{-- <div class="form-floating mb-3"> --}}
                    <label for="inputEmail5" class="form-label">Riset Group</label>
                    <select class="form-select">
                      <option selected>Data CentricArtificial Intelligence and e-Business System</option>
                      <option value="1">Health Informatics</option>
                      <option value="2">Agile Product Development</option>
                    </select>
                  {{-- </div> --}}
                </div>
                <div class="col-md-4" style="padding-top: 30px">
                  <button type="button" class="btn btn-primary">Submit</button>
                </div>
              
              </div>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Nama Mahasiswa </th>
                    <th>Judul</th>
                    <th>Pembimbing 1</th>
                    <th>Pembimbing 2</th>
                    <th>Pembimbing 3</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Eva Dwi Lestari</td>
                    <td>Sistem Informasi E-Klinik Pada Klinik dr.H.M.Chalim, spa</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                    <td>Arif Basofi, S.Kom, M.T</td>
                  </tr>
                  <tr>
                    <td>Muhammad Hamdan Fairuz Zabadi</td>
                    <td>Chatbot Tumbuh Kembang Anak menggunakan Google DialogFlow (Studi Kasus: Posyandu Mawar Sukorame Kota Kediri)</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Rengga Asmara, S.Kom., M.T.</td>
                    <td>Rosiyah Faradisa, S.Si, M.Si</td>
                  </tr>
                  <tr>
                    <td>Rifqi Danny Pratama</td>
                    <td>Penerapan Tanda Tangan Elektronik pada Sistem Monitoring dan Evaluasi</td>
                    <td>Selvia Ferdiana Kusuma, M.Kom</td>
                    <td>Wiratmok Yuwono, ST, M.T</td>
                    <td>Dr. Idris Winarno, S.ST, M.Kom</td>
                  </tr>
                  <tr>
                    <td>Rafi Izah Ramadani Arief</td>
                    <td>Sistem Informasi Repository Wirausaha UMKM Jawa Timur</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                  <tr>
                    <td>Mohamad Faizal Norhavid</td>
                    <td>Sistem Informasi Pengajuan PKM untuk Kemahasiswaan PENS</td>
                    <td>Prasetyo Wibowo., S.ST, M.Kom</td>
                    <td>Mu'arifin, S.ST, M.T</td>
                    <td>Weny Mistarika Rahmawati, S.Kom., M.Kom., M.Sc.</td>
                  </tr>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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