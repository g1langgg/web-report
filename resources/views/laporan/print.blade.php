<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara - {{ $laporan->ticket_number }}</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 20px;
            line-height: 1.5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            border-bottom: 3px double #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0;
            font-size: 14px;
        }
        .doc-title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            text-decoration: underline;
            margin: 20px 0 10px;
            text-transform: uppercase;
        }
        .doc-number {
            text-align: center;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .content-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .content-table th, .content-table td {
            border: 1px solid #000;
            padding: 8px 12px;
            vertical-align: top;
            font-size: 14px;
        }
        .content-table th {
            width: 30%;
            text-align: left;
            background-color: #f5f5f5;
        }
        .section-title {
            font-weight: bold;
            margin: 20px 0 10px;
            font-size: 16px;
            text-decoration: underline;
        }
        .notes-box {
            border: 1px solid #000;
            padding: 10px;
            min-height: 80px;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .signatures {
            display: table;
            width: 100%;
            margin-top: 50px;
        }
        .sig-col {
            display: table-cell;
            width: 33.33%;
            text-align: center;
        }
        .sig-box {
            height: 80px;
        }
        .sig-name {
            font-weight: bold;
            text-decoration: underline;
        }
        .print-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #000;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 14px;
        }
        @media print {
            .print-btn {
                display: none;
            }
            body {
                padding: 0;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <button class="print-btn" onclick="window.print()">Cetak Dokumen</button>

    <div class="container">
        <div class="header">
            <h1>HOTEL GRAND LUXURY</h1>
            <p>Jl. Jenderal Sudirman No. 123, Jakarta Selatan</p>
            <p>Telp: (021) 555-0123 | Email: info@grandluxury.com</p>
        </div>

        <div class="doc-title">BERITA ACARA PENYELESAIAN PEKERJAAN</div>
        <div class="doc-number">No. Tiket: {{ $laporan->ticket_number }}</div>

        <p style="font-size: 14px;">Pada hari ini, tanggal <strong>{{ \Carbon\Carbon::parse($laporan->completed_at ?? now())->isoFormat('D MMMM Y') }}</strong>, telah diselesaikan pekerjaan maintenance/perbaikan dengan rincian sebagai berikut:</p>

        <table class="content-table">
            <tr>
                <th>Tanggal Dilaporkan</th>
                <td>{{ $laporan->report_date->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <th>Pelapor</th>
                <td>{{ $laporan->pelapor->name }} ({{ $laporan->department->name }})</td>
            </tr>
            <tr>
                <th>Lokasi Pengerjaan</th>
                <td>{{ $laporan->location }}</td>
            </tr>
            <tr>
                <th>Prioritas</th>
                <td style="text-transform: capitalize;">{{ $laporan->priority }}</td>
            </tr>
            <tr>
                <th>Deskripsi Masalah</th>
                <td>{{ $laporan->description }}</td>
            </tr>
            <tr>
                <th>Teknisi Bertugas</th>
                <td>{{ $laporan->assignment?->teknisi?->name ?? '-' }}</td>
            </tr>
        </table>

        <div class="section-title">Tindakan / Solusi yang Dilakukan:</div>
        <div class="notes-box">
            @if($laporan->assignment && $laporan->assignment->completion_notes)
                {!! nl2br(e($laporan->assignment->completion_notes)) !!}
            @else
                <i>Pekerjaan belum selesai atau tidak ada catatan penyelesaian.</i>
            @endif
        </div>

        <p style="font-size: 14px;">Demikian Berita Acara ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana mestinya.</p>

        <div class="signatures">
            <div class="sig-col">
                <p>Dilaporkan Oleh,</p>
                <div class="sig-box"></div>
                <p class="sig-name">{{ $laporan->pelapor->name }}</p>
                <p style="font-size: 12px; margin: 0;">{{ $laporan->department->name }}</p>
            </div>
            <div class="sig-col">
                <p>Dikerjakan Oleh,</p>
                <div class="sig-box"></div>
                <p class="sig-name">{{ $laporan->assignment?->teknisi?->name ?? '__________________' }}</p>
                <p style="font-size: 12px; margin: 0;">Teknisi</p>
            </div>
            <div class="sig-col">
                <p>Mengetahui,</p>
                <div class="sig-box"></div>
                <p class="sig-name">__________________</p>
                <p style="font-size: 12px; margin: 0;">Manager / Supervisor</p>
            </div>
        </div>
    </div>

</body>
</html>
