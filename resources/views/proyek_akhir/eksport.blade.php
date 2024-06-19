<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export Data Proyek Akhir</title>
</head>
<body>
    @foreach($data_pa as $master)
        <table>
            <thead>
                <tr>
                    <th>nrp_mahasiswa</th>
                    <th>nama_mahasiswa</th>
                    <th>judul_pa</th>
                    <th>dosen_pembimbing1</th>
                    <th>dosen_pembimbing2</th>
                    <th>dosen_pembimbing3</th>
                </tr>
            </thead>
            <tbody>
                @foreach($master['proyek_akhir'] as $data)
                    <tr>
                        <td>{{ $data['nrp_mahasiswa'] }}</td>
                        <td>{{ $data['nama_mahasiswa'] }}</td>
                        <td>{{ $data['judul_pa'] }}</td>
                        <td>{{ $data['dosen_pembimbing1']['id_dosen'] ?? '-' }}</td>
                        <td>{{ $data['dosen_pembimbing2']['id_dosen'] ?? '-' }}</td>
                        <td>{{ $data['dosen_pembimbing3']['id_dosen'] ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
