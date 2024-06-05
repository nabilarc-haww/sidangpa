@extends('main')

<body>
@include('header')
@include('sidebar')
  <main id="main" class="main">


    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Announcement Page</title>
      <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
      <style>
          .announcement-header {
              margin-top: 20px;
              text-align: center;
          }
          .content {
              margin: 20px;
          }
          .content img {
              width: 100%;
              max-width: 600px;
          }
          .files {
              margin-top: 20px;
          }
          .file-link {
              display: block;
              margin-top: 10px;
          }
          .file-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            display: flex;
            align-items: center;
        }
        .file-icon {
            background-color: #e9ffe9;
            border-radius: 5px;
            padding: 10px;
            margin-right: 10px;
        }
        .file-info {
            color: green;
        }
        .file-info .file-name {
            font-size: 1.1rem;
        }
        .file-info .file-size {
            font-size: 0.9rem;
        }
      </style>
  </head>
  <body>
      <div class="container">
          <div class="announcement-header">
              <a href="#">&#60; Kembali</a>
              <div class="pagetitle">
                <h1>Ayo lihat pengumuman terbaru terkait masa depanmu!</h1>
              </div>
              <p style="font-size: 14px">2 November 2023</p>
          </div>
          <div class="content text-center">
              <img src="{{ asset('style/assets/img/news-1.jpg') }}">
          </div>
          <div class="content">
              <p><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></p>
              <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
              <p><strong>Section 1.10.32 of "de Finibus Bonorum et Malorum", written by Cicero in 45 BC</strong></p>
              <p>"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem."</p>
          </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="file-card">
                        <div class="file-icon">
                            <img src="https://via.placeholder.com/50/32cd32/ffffff?text=PDF" alt="File Icon">
                        </div>
                        <div class="file-info">
                            <div class="file-name">jadwalsidang.pdf</div>
                            <div class="file-size">235 Kb</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="file-card">
                        <div class="file-icon">
                            <img src="https://via.placeholder.com/50/32cd32/ffffff?text=PDF" alt="File Icon">
                        </div>
                        <div class="file-info">
                            <div class="file-name">jadwalsidang.pdf</div>
                            <div class="file-size">235 Kb</div>
                        </div>
                    </div>
                </div>
            </div>

      </div>
  </body>

  </main><!-- End #main -->

  @include('footer')

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>

</html>