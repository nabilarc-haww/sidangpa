@extends('main')

<body>
@include('header')
@include('sidebar')
  <main id="main" class="main">


    <section class="section dashboard">

                  <!-- News & Updates Traffic -->
          <div class="col-lg-12 mb-4">
            <div class="card-body">
              <h4><a href="#">Nihil blanditiis at in nihil autem</a></h4>
              <img src="{{ asset('style/assets/img/news-1.jpg') }}" alt="">
              <p>Sit recusandae non aspernatur laboriosam. Quia enim eligendi sed ut harum...</p>
            </div>
        </div>

      {{-- </div> --}}
    </section>

  </main><!-- End #main -->

  @include('footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>