@extends('main')

<body>
@include('header')
@include('sidebar')
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      {{-- <div class="row"> --}}

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <!-- Sales Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Mahasiswa</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-vcard"></i>
                    </div>
                    <div class="ps-3">
                      <h6>67 <label class="small pt-2 fs-6 fw-light">Orang</label> </h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Sales Card -->

            <!-- Revenue Card -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Dosen</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-person-video3"></i>
                    </div>
                    <div class="ps-3">
                      <h6>89 <label class="small pt-2 fs-6 fw-light">Orang</label> </h6>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- End Revenue Card -->

            <!-- Customers Card -->
            <div class="col-xxl-4 col-xl-12">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Riset Group</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6>24 <label class="small pt-2 fs-6 fw-light">Group</label> </h6>

                    </div>
                  </div>

                </div>
              </div>

            </div><!-- End Customers Card -->

          </div>
        </div><!-- End Left side columns -->

        <div class="row">
          <div class="col-lg-6">
            <div class="card p-5">
              <div class="card-title">
                <i class="bi bi-quote"></i>
                <a style="color: 4154F1; font-size: 26px;">Temukan</a> 
                <a style="font-size: 26px;">Kenyamanan Penjadwalan dengan</a> 
                <u style="color: 4154F1; font-size: 26px;">SCHEDU</u>
                <i class="bi bi-quote"></i>
              </div>
              <p class="lh-lg">Platform penjadwalan sidang proyek akhir yang menghadirkan kemudahan dan efisiensi dalam membuat jadwal sidang Anda. </p>
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
                <div class="col-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgba(66,84,241,1)" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                  </svg>
                </div>
                <div class="col-10">
                  <div class="card ps-3 pe-3 pt-2 pb-2" style="background-color: EDEEFD;box-shadow: none; margin-bottom: 15px;">
                    <label>Menyediakan informasi <b>Sidang Proyek Akhir</b> dalam satu tempat yang mudah.</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="rgba(66,84,241,1)" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
                    <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
                  </svg>
                </div>
                <div class="col-10">
                  <div class="card ps-3 pe-3 pt-2 pb-2" style="background-color: EDEEFD;box-shadow: none;margin-bottom: 15px;">
                    <label>Membagikan <b>Pengumuman</b> dengan lebih efektif dan efisien.</label>
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

                  <!-- News & Updates Traffic -->
          <div class="col-lg-6">
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">News &amp; Updates <span>| Today</span></h5>

              <div class="news">
                <div class="post-item clearfix">
                  <img src="{{ asset('style/assets/img/news-1.jpg') }}" alt="">
                  <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
                  <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="{{ asset('style/assets/img/news-2.jpg') }}" alt="">
                  <h4><a href="#">Quidem autem et impedit</a></h4>
                  <p>Illo nemo neque maiores vitae officiis cum eum turos elan dries werona nande...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="{{ asset('style/assets/img/news-3.jpg') }}" alt="">
                  <h4><a href="#">Id quia et et ut maxime similique occaecati ut</a></h4>
                  <p>Fugiat voluptas vero eaque accusantium eos. Consequuntur sed ipsam et totam...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="{{ asset('style/assets/img/news-4.jpg') }}" alt="">
                  <h4><a href="#">Laborum corporis quo dara net para</a></h4>
                  <p>Qui enim quia optio. Eligendi aut asperiores enim repellendusvel rerum cuder...</p>
                </div>

                <div class="post-item clearfix">
                  <img src="{{ asset('style/assets/img/news-5.jpg') }}" alt="">
                  <h4><a href="#">Et dolores corrupti quae illo quod dolor</a></h4>
                  <p>Odit ut eveniet modi reiciendis. Atque cupiditate libero beatae dignissimos eius...</p>
                </div>

              </div><!-- End sidebar recent posts-->
            </div>
            </div>
          </div><!-- End News & Updates -->
        </div>

      {{-- </div> --}}
    </section>

  </main><!-- End #main -->

  @include('footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>