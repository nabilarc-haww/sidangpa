<!DOCTYPE html>
<html>
<head>
    <title>Jadwal Sidang</title>
    <style>
        body {
            font-family: 'Arial, sans-serif';
            font-size: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    @foreach($finalResult as $header)
        <h2 style="text-align: center;">{{ $header['judul'] }}</h2>
        <p style="text-align: center;">Prodi: {{ $header['prodi'] }}</p>
        <p style="text-align: center;">Tanggal: {{ \Carbon\Carbon::parse($header['tanggal'])->locale('id')->isoFormat('DD MMMM YYYY') }}</p>
        <p style="text-align: center;">Jam: {{ $header['waktu'] }} - Selesai</p>
        <p style="text-align: center;">Tahapan Sidang: {{ $header['tahapan_sidang'] }}</p>

        @foreach($header['data_generate'] as $ruang)
            <h5>{{ $ruang['nama_ruang'] }} ({{ $ruang['kode_ruang'] }} - {{ $ruang['letak'] }})</h5>
            <table>
                <thead>
                    <tr>
                        <th>Nama Mahasiswa</th>
                        <th>Judul</th>
                        <th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        <th>Pembimbing 3</th>
                        <th>Penguji 1</th>
                        <th>Penguji 2</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ruang['data_generate'] as $data)
                        <tr>
                            <td>{{ $data['id_mhs']['nama_mahasiswa'] }}</td>
                            <td>{{ $data['id_mhs']['judul_pa'] }}</td>
                            <td>{{ $data['id_mhs']['dosen_pembimbing1']['nama_dosen'] }}</td>
                            <td>{{ $data['id_mhs']['dosen_pembimbing2']['nama_dosen'] }}</td>
                            <td>{{ $data['id_mhs']['dosen_pembimbing3']['nama_dosen'] }}</td>
                            <td>{{ $data['penguji_1']['nama_dosen'] ?? "kosong" }}</td>
                            <td>{{ $data['penguji_2']['nama_dosen'] ?? "kosong" }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    @endforeach
</body>
</html>
