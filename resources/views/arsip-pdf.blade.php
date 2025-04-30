<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        h3 {
            text-align: center;
            margin-bottom: 10px;
        }
        p {
            margin: 0 0 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #333;
            padding: 6px;
            vertical-align: top;
        }
        th {
            background-color: #f0f0f0;
            text-align: center;
        }
    </style>
</head>
<body>

    <h3>Rekapitulasi Arsip ELANG</h3>
    <p>Bulan: <strong>{{ $bulan ?? 'Semua' }}</strong> &nbsp;&nbsp;|&nbsp;&nbsp; Tahun: <strong>{{ $tahun ?? 'Semua' }}</strong></p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Pelaku Usaha</th>
                <th>Jenis Usaha</th>
                <th>Tanggal</th>
                <th>Dokumen Lingkungan</th>
                <th>PPA</th>
                <th>PPU</th>
                <th>PLB3</th>
                <th>Rekomendasi</th>
                <th>Tindak Lanjut</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($arsip as $index => $item)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $item['pelaku'] }}</td>
                <td>{{ $item['jenis'] }}</td>
                <td>{{ $item['tanggal'] }}</td>
                <td>{!! nl2br(e($item['dokling'])) !!}</td>
                <td>{!! nl2br(e($item['ppa'])) !!}</td>
                <td>{!! nl2br(e($item['ppu'])) !!}</td>
                <td>{!! nl2br(e($item['plb3'])) !!}</td>
                <td>{!! nl2br(e($item['rekomendasi'])) !!}</td>
                <td>{!! nl2br(e($item['tindak'])) !!}</td>
            </tr>
            @empty
            <tr>
                <td colspan="10" style="text-align:center;">Tidak ada data tersedia untuk periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>
