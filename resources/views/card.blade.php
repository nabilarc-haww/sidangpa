@extends('main')
<body>
@include('header')
@include('sidebar')

<main id="main" class="main">

  <div class="row">
    <div class="col">
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
    </div>
    <div class="col" style="padding-left: 500px; padding-top: 10px;">
      <div class="row">
        <div class="col-12 dropdown">
          <form action="{{ url('/hasil-proyek-akhir') }}" method="GET">
            <select name="tahun_ajaran" class="form-select btn btn-warning" aria-expanded="false" onchange="this.form.submit()">
              <option value="">Pilih Tahun Ajaran</option>
              @foreach($tahunAjaranList as $tahunAjaran)
                <option value="{{ $tahunAjaran }}">{{ $tahunAjaran }}</option>
              @endforeach
            </select>
          </form>
        </div>
      </div>
    </div>
  </div>

  <section class="section">
    <div class="container">
      <div class="row g-2">
        @foreach($headers as $header)
        <div class="col-6">
          <div class="card card-body">
            <small class="text-muted mt-3" style="font-size: 12px">
            <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($header['created_at'])->locale('id')->isoFormat('DD MMMM YYYY') }}
            </small>
            <h4 class="card-title m-0 py-3">{{ $header['judul'] }}</h4>
            <div class="row mb-2">
              <div class="col-4">
                <strong>Tahun Ajaran</strong>
              </div>
              <div class="col-8">
                : {{ $header['tahun_ajaran'] ?? "-" }}
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-4">
                <strong>Jurusan</strong>
              </div>
              <div class="col-8">
                : {{ $header['prodi'] }}
              </div>
            </div>
            <div class="row mb-2">
              <div class="col-4">
                <strong>Tahapan</strong>
              </div>
              <div class="col-8">
                : {{ $header['tahapan_sidang'] }}
              </div>
            </div>

            <div class="row mb-2">
              <div class="col-4">
                <strong>Waktu</strong>
              </div>
              <div class="col-8">
                : {{ \Carbon\Carbon::parse($header['tanggal'])->locale('id')->isoFormat('DD MMMM YYYY') }} | {{ $header['waktu']}} WIB
              </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
            <button class="btn btn-success me-2" style="background-color: #04BC00; border: none; font-size: 14px;" data-bs-toggle="modal" data-bs-target="#downloadModal" data-id="{{ $header['id_header'] }}">Download</button>
              <a href="{{ url('/proyek-akhir/generate-hasil/'.$header['id_header'])  }}" class="btn btn-primary" style="font-size: 14px;">Lihat Hasil</a>
            </div>
          </div>     
        </div>
        @endforeach
      </div>                
    </div>
  </section>
  <!-- Modal -->
  <div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="downloadModalLabel">Download File</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p>Pilih format file yang ingin diunduh:</p>
          <div class="d-grid gap-2">
            <a href="#" id="downloadPDF" class="btn btn-success">Download sebagai PDF</a>
            <a href="#" id="downloadExcel" class="btn btn-primary">Download sebagai Excel</a>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</main>

@include('footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>

</html>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var downloadModal = document.getElementById('downloadModal');
    downloadModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var idHeader = button.getAttribute('data-id');
      
      var downloadPDF = document.getElementById('downloadPDF');
      var downloadExcel = document.getElementById('downloadExcel');
      
      downloadPDF.href = '/proyek-akhir/download-pdf/' + idHeader;
      downloadExcel.href = '/proyek-akhir/download-excel/' + idHeader;
    });
  });
</script>