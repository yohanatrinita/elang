<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            margin: 30px;
        }

        .header {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td.center {
            text-align: center;
        }

        .judul {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            text-transform: uppercase;
            line-height: 1.6;
        }

    </style>
</head>
<body>

    <div class="judul">
        REKAPITULASI PENGAWASAN {{ \Carbon\Carbon::parse(request('from'))->format('d F Y') }} - {{ \Carbon\Carbon::parse(request('to'))->format('d F Y') }}<br>
        SUBKO PENEGAKAN HUKUM LINGKUNGAN<br>
        BIDANG PENEGAKAN HUKUM LINGKUNGAN DAN PENGELOLAAN LIMBAH B3<br>
        DINAS LINGKUNGAN HIDUP KABUPATEN BOGOR
    </div>

    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Pelaku Usaha</th>
                <th rowspan="2">Jenis Usaha/Kegiatan</th>
                <th rowspan="2">Tanggal Pengawasan</th>
                <th colspan="4">Hasil Pemeriksaan Lapangan</th>
                <th rowspan="2">Rekomendasi</th>
                <th rowspan="2">Tindak Lanjut</th>
            </tr>
            <tr>
                <th>Dokumen Lingkungan</th>
                <th>PPA</th>
                <th>PPU</th>
                <th>PLB3</th>
            </tr>
        </thead>
        <tbody>
            @foreach($arsips as $index => $arsip)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $arsip->pelaku_usaha }}</td>
                    <td>{{ $arsip->jenis_usaha }}</td>
                    <td class="center">{{ \Carbon\Carbon::parse($arsip->tanggal_pengawasan)->format('d-m-Y') }}</td>
                    <td>{!! nl2br(e($arsip->dokumen_lingkungan)) !!}</td>
                    <td>{!! nl2br(e($arsip->ppa)) !!}</td>
                    <td>{!! nl2br(e($arsip->ppu)) !!}</td>
                    <td>{!! nl2br(e($arsip->plb3)) !!}</td>
                    <td>{!! nl2br(e($arsip->rekomendasi)) !!}</td>
                    <td>{!! nl2br(e($arsip->tindak_lanjut)) !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
