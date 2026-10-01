<!DOCTYPE html>
<html>
<head>
    <title>Laporan Perjalanan Dinas</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 11px;
            color: #000;
        }

        .kop { text-align: center; }
        .kop h1 { font-size: 14px; margin: 0; font-weight: bold; }
        .kop h2 { font-size: 13px; margin: 2px 0; font-weight: bold; }
        .kop p  { font-size: 10px; margin: 2px 0; }

        .line { border-top: 2px solid #000; margin: 8px 0 2px; }
        .line-thin { border-top: 1px solid #000; margin-bottom: 10px; }

        .judul {
            text-align: center;
            font-weight: bold;
            margin: 15px 0;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        th {
            text-align: center;
            font-weight: bold;
            background-color: #f0f0f0;
        }

        td { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }

        .pegawai-list {
            padding-left: 14px;
            margin: 0;
        }

        .pegawai-list li {
            margin-bottom: 2px;
        }

        .total {
            margin-top: 10px;
            width: 45%;
            border: 1px solid #000;
            padding: 8px;
            font-weight: bold;
        }

        .ttd {
            margin-top: 40px;
            width: 100%;
        }

        .ttd .kanan {
            width: 40%;
            float: right;
            text-align: center;
        }

        .nama {
            margin-top: 60px;
            font-weight: bold;
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            font-size: 10px;
            font-style: italic;
        }

        .clear { clear: both; }
    </style>
</head>
<body>

{{-- KOP --}}
<div class="kop">
    <h1>DEWAN PERWAKILAN RAKYAT DAERAH</h1>
    <h2>KOTA CIREBON</h2>
    <p>
        Jl. Siliwangi No.109, Kebonbaru, Kec. Kejaksan, Kota Cirebon, Jawa Barat 45121
        | Telp. (0231) 202278
    </p>
</div>

<div class="line"></div>
<div class="line-thin"></div>

{{-- JUDUL --}}
<div class="judul">
    LAPORAN PERJALANAN DINAS
</div>

{{-- TABEL --}}
<table>
    <thead>
        <tr>
            <th width="4%">No</th>
            <th width="22%">Nama Pegawai</th>
            <th width="18%">Jabatan</th>
            <th width="18%">Tujuan</th>
            <th width="22%">Tanggal</th>
            <th width="16%">Anggaran (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>

                {{-- NAMA PEGAWAI --}}
                <td class="text-left">
                    <ul class="pegawai-list">
                        @foreach($item->pegawai as $p)
                            <li>{{ $p->name }}</li>
                        @endforeach
                    </ul>
                </td>

                {{-- JABATAN --}}
                <td class="text-left">
                    <ul class="pegawai-list">
                        @foreach($item->pegawai as $p)
                            <li>{{ $p->jabatan ?? '-' }}</li>
                        @endforeach
                    </ul>
                </td>

                {{-- TUJUAN --}}
                <td class="text-left">{{ $item->tujuan }}</td>

                {{-- TANGGAL --}}
                <td>
                    {{ \Carbon\Carbon::parse($item->tanggal_berangkat)->format('d M Y') }}
                    <br>
                    s/d
                    {{ \Carbon\Carbon::parse($item->tanggal_pulang)->format('d M Y') }}
                </td>

                {{-- ANGGARAN --}}
                <td class="text-right">
                    {{ number_format($item->anggaran, 0, ',', '.') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{-- TOTAL --}}
<div class="total">
    Total Anggaran : Rp {{ number_format($totalAnggaran, 0, ',', '.') }}
</div>

{{-- TTD --}}
<div class="ttd">
    <div class="kanan">
        Cirebon, {{ date('d F Y') }}<br>
        Kepala Bagian Umum
        <div class="nama">________________________</div>
    </div>
</div>

<div class="clear"></div>

{{-- FOOTER --}}
<div class="footer">
    Dokumen ini dicetak secara otomatis melalui
    Sistem Informasi Perjalanan Dinas DPRD Kota Cirebon.
</div>

</body>
</html>
