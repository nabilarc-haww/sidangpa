<!DOCTYPE html>
@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Pengumuman</h1>
        <nav>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active">Daftar Pengumuman</li>
          </ol>
        </nav>
      </div><!-- End Page Title -->

      <section class="section">
        <div class="row">
          <div class="col-lg-12">
    
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <h5 class="card-title">Ayo lihat pengumuman terbaru terkait masa depanmu !</h5>
                    <p>Kamu bisa melihat pengumuman terbaru tentang jadwal sidang, persiapannya, ketentuan dan informasi lain yang serupa.</p>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6 pb-3" style="padding-left: 300px">
                    <a type="button" href="/pengumuman/tambah" class="btn btn-success" style="background-color: #04BC00;" >
                      + Tambah Pengumuman
                    </a>
                  </div>
                </div>
                
                <div class="col-lg-12">

                    <div class="card">
                      <div class="card-body">
          
                        <!-- Table with stripped rows -->
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>Judul Pengumuman</th>
                                  <th>Deskripsi</th>
                                  <th>Status</th>
                                  <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pengumuman as $item)
                                <tr>
                                  <td>{{ $item['judul_pengumuman'] }}</td>
                                  <td>{{ $item['deskripsi'] }}</td>
                                  <td>{{ $item['status'] }}</td>
                                  <td>
                                    <div class="d-flex">
                                      <a href="{{ route('pengumuman.editPengumuman', $item['id_pengumuman']) }}" class="btn btn-primary btn-sm me-2">
                                          Edit
                                      </a>
                                      <form action="{{ route('pengumuman.deletePengumuman', $item['id_pengumuman']) }}" method="post">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')">Hapus</button>
                                      </form>
                                    </div>
                                  </td>
                                </tr>
                                @endforeach
                              </tbody>
                        </table>
                        <!-- End Table with stripped rows -->
          
                      </div>
                    </div>
          
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