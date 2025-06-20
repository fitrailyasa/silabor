<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Formulir Peminjaman Alat Laboratorium</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            line-height: 1.5;
        }

        h2,
        h3 {
            text-align: center;
            margin: 0;
        }

        .header,
        .footer {
            text-align: center;
        }

        .section {
            margin-top: 20px;
            margin: 0mm 20mm 0mm 20mm;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        td,
        th {
            border: 1px solid black;
            padding: 5px;
            vertical-align: top;
        }

        .no-border td {
            border: none;
        }

        .signature-1 {
            text-align: left;
            margin: 80mm 20mm 0mm 20mm;
        }

        .signature-2 {
            text-align: center;
            margin: 0mm 20mm 0mm 20mm;
        }

        .center {
            text-align: center;
        }

        .alat-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .alat-table th,
        .alat-table td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
        }

        .alat-table th {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>

    <div class="header">
        <img src="{{ public_path('assets/kop-surat.png') }}" alt="" width="95%">
        <h3>FORMULIR PEMINJAMAN ALAT LABORATORIUM</h3>
    </div>

    <div class="section">
        <p>Dengan ini menyatakan bahwa:</p>
        <table class="no-border">
            <tr>
                <td>Nama</td>
                <td>: {{ $user->name ?? '-' }}</td>
            </tr>
            <tr>
                <td>NIM</td>
                <td>: {{ $user->nim ?? '-' }}</td>
            </tr>
            <tr>
                <td>No. HP</td>
                <td>: {{ $user->no_hp ?? '-' }}</td>
            </tr>
            <tr>
                <td>Program Studi</td>
                <td>: {{ $user->prodi ?? '-' }}</td>
            </tr>
        </table>

        <p>Mengajukan permohonan peminjaman alat laboratorium dengan rincian terlampir.</p>
        <p>Peminjam bersedia memenuhi persyaratan yang ada di laboratorium dan jika terjadi kerusakan atau kehilangan
            barang yang dipinjam, maka peminjam bersedia untuk bertanggung jawab.</p>
    </div>

    <div class="signature-1">
        <p>Lampung Selatan, .................... 20..</p>
        <p>Peminjam,</p>
        <br><br><br>
        <p>{{ $user->name ?? '-' }}</p>
        <p>{{ $user->nim ?? '-' }}</p>
    </div>

    <div style="page-break-before: always;"></div>

    <div class="section">
        <h4 align="center">RINCIAN KEGIATAN</h4>
        <table class="no-border">
            <tr>
                <td>Keperluan</td>
                <td>: ................................................</td>
            </tr>
            <tr>
                <td>Tempat Kegiatan</td>
                <td>: ................................................</td>
            </tr>
            <tr>
                <td>Lama Waktu Peminjaman</td>
                <td>: ….. sampai dengan tanggal ……..</td>
            </tr>
            <tr>
                <td>Judul Penelitian</td>
                <td>: ................................................</td>
            </tr>
            <tr>
                <td>Dosen Pembimbing</td>
                <td>: ................................................</td>
            </tr>
        </table>
    </div>

    <div class="section">
        <h4>DAFTAR ALAT YANG DIPINJAM</h4>
        <table class="alat-table">
            <thead>
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Nama Alat</th>
                    <th rowspan="2">Jumlah</th>
                    <th rowspan="2">Kondisi Alat</th>
                    <th rowspan="2">Tanggal Pengembalian</th>
                    <th colspan="2">Paraf Laboran</th>
                </tr>
                <tr>
                    <th>Awal</th>
                    <th>Akhir</th>
                </tr>
            </thead>
            <tbody>
                @for ($i = 1; $i <= 20; $i++)
                    <tr>
                        <td>{{ $i }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                @endfor
            </tbody>
        </table>

    </div>

    <div class="signature-2">
        <p>Lampung Selatan, .................... 20..</p>
        <table class="no-border" style="width: 100%; margin-top: 20px;">
            <tr>
                <td class="center">Laboran …<br><br><br><br>Nama<br>NRK/NIP</td>
                <td class="center">Koordinator Laboratorium<br>Program Studi …<br><br><br>Nama<br>NRK/NIP</td>
            </tr>
        </table>
        <br><br>
        <p>Menyetujui,</p>
        <p>Koordinator Laboratorium Fakultas Teknologi Industri</p>
        <br><br><br>
        <p><strong>Dr. Kardo Rajagukguk, S.Pd., M.Eng.</strong></p>
        <p>NIP 198909272019031014</p>
    </div>

</body>

</html>
