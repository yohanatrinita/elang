<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; vertical-align: top; }
        th { background-color: #f0f0f0; text-align: center; }
    </style>
</head>
<body>
    <h3 style="text-align:center;">{{ $judul }}</h3>

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
            @foreach ($arsip as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item['pelaku'] }}</td>
                <td>{{ $item['jenis'] }}</td>
                <td>{{ \Carbon\Carbon::parse($item['tanggal'])->translatedFormat('d F Y') }}</td>
                <td>{!! nl2br(e($item['dokling'])) !!}</td>
                <td>{!! nl2br(e($item['ppa'])) !!}</td>
                <td>{!! nl2br(e($item['ppu'])) !!}</td>
                <td>{!! nl2br(e($item['plb3'])) !!}</td>
                <td>{!! nl2br(e($item['rekomendasi'])) !!}</td>
                <td>{!! nl2br(e($item['tindak'])) !!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
