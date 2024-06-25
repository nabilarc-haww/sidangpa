@extends('main')

<body>
@include('header')
@include('sidebar')

<main id="main" class="main">
@if(session('success'))
    <script>
        $(document).ready(function(){
            $('#successModal').modal('show');
        });
    </script>
@endif

<!-- Success Modal -->
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

<!-- Tambah Data Master PA Modal -->
<div class="modal fade" id="tambahDataMasterPaModal" tabindex="-1" aria-labelledby="tambahDataMasterPaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahDataMasterPaModalLabel">Tambah Data Master PA</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('proyek-akhir.data.tambahDataMasterPa') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="inputState" class="form-label">Tahun Ajaran</label>
                        <div class="row">
                            <div class="col-5">
                                <select name="start_year" class="form-control" id="startYear" required>
                                    <!-- Years will be populated by JavaScript -->
                                </select>
                            </div>
                            <div class="col-2 text-center">
                                <h5>/</h5>
                            </div>
                            <div class="col-5">
                                <select name="end_year" class="form-control" id="endYear" required>
                                    <!-- Years will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="inputState" class="form-label">Program Studi</label>
                        <select name="jurusan" id="inputState" class="form-select" required>
                            <option selected disabled>Program Studi</option>
                            <option value="D3 Teknik Informatika">D3 Teknik Informatika</option>
                            <!-- Tambahkan opsi lainnya jika perlu -->
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tambah Data Master PA Button -->
<div class="row mb-4">
    <div class="col text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahDataMasterPaModal">
            Tambah Data Master PA
        </button>
    </div>
</div>

<!-- Download Modal -->
<div class="modal fade" id="downloadModal" tabindex="-1" aria-labelledby="downloadModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="downloadModalLabel">Download File</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Pilih format file untuk didownload:</p>
                <a href="#" id="downloadExcel" class="btn btn-success">Download Excel</a>
                <a href="#" id="downloadCsv" class="btn btn-primary">Download CSV</a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col">
        <div class="pagetitle">
            <h1>Proyek Akhir</h1>
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Proyek Akhir</li>
                <li class="breadcrumb-item active">Program Studi</li>
              </ol>
            </nav>
        </div><!-- End Page Title -->
    </div>
    <div class="col" style="padding-left: 500px; padding-top: 10px;">
        <form method="GET" action="{{ route('proyek-akhir.data.filter') }}">
            <div class="row">
                <div class="col dropdown">
                    <select class="form-select" name="program_studi">
                        <option value="">Program Studi</option>
                        @foreach($program_studi_list as $ps)
                            <option value="{{ $ps }}" {{ request('program_studi') == $ps ? 'selected' : '' }}>{{ $ps }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col dropdown">
                    <select class="form-select" name="tahun_ajaran">
                        <option value="">Tahun Ajaran</option>
                        @foreach($tahun_ajaran_list as $ta)
                            <option value="{{ $ta }}" {{ request('tahun_ajaran') == $ta ? 'selected' : '' }}>{{ $ta }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
        </form>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="row g-2">
            @foreach($master_pa as $data)
                <div class="col-6">
                    <div class="card card-body">
                        <small class="text-muted mt-3" style="font-size: 12px">
                            <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($data['created_at'])->locale('id')->isoFormat('DD MMMM YYYY') }}
                        </small>
                        <h4 class="card-title m-0 py-3">{{ $data['jurusan'] }}</h4>
                        <div class="row mb-2">
                            <div class="col-4">
                                <strong>Tahun Ajaran</strong>
                            </div>
                            <div class="col-8">
                                : {{ $data['tahun_ajaran'] }}
                            </div>
                        </div>
                        <div class="d-flex justify-content-end mt-2">
                            <button type="button" class="btn btn-success me-2" style="background-color: #04BC00; border: none; font-size: 14px;"  data-bs-toggle="modal" data-bs-target="#downloadModal" 
                                    data-id-master="{{ $data['id_master'] }}">
                                Download
                            </button>
                            <a href="{{ url('/proyek-akhir/data/'.$data['id_master'])  }}" class="btn btn-primary" style="font-size: 14px;">Lihat Hasil</a>
                        </div>
                    </div>     
                </div>
            @endforeach
        </div>
    </div>
</section>
</main><!-- End #main -->

@include('footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var downloadModal = document.getElementById('downloadModal');
    downloadModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var idMaster = button.getAttribute('data-id-master');

        var downloadExcel = document.getElementById('downloadExcel');
        var downloadCsv = document.getElementById('downloadCsv');

        downloadExcel.href = '/proyek-akhir/export/' + idMaster + '?format=excel';
        downloadCsv.href = '/proyek-akhir/export/' + idMaster + '?format=csv';
    });
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

document.addEventListener("DOMContentLoaded", function() {
    const currentYear = new Date().getFullYear();
    populateYearDropdowns('startYear', 'endYear', 2010, currentYear + 10);
});
</script>

</body>
</html>
