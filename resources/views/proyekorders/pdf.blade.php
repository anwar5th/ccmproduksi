<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Proyek Order - {{ $proyekorders->kodepo }}</title>
    <style>
        /* CSS Print Optimized - Enterprise Style */
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            color: #334155; /* text-slate-700 */
            line-height: 1.6;
            font-size: 14px;
            margin: 0;
            padding: 10px 20px;
        }
        
        /* Typography */
        h1, h2, h3, h4 { color: #0f172a; margin-top: 0; }
        
        /* Header Layout */
        .header-container {
            width: 100%;
            border-bottom: 2px solid #cbd5e1; /* border-slate-300 */
            padding-bottom: 15px;
            margin-bottom: 30px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-table td {
            vertical-align: middle;
        }
        .app-title {
            font-size: 26px;
            font-weight: bold;
            margin: 0;
            letter-spacing: 0.5px;
        }
        .print-date {
            text-align: right;
            font-size: 12px;
            color: #64748b; /* text-slate-500 */
            font-weight: normal;
        }

        /* Container / Card */
        .section-card {
            background-color: #f8fafc; /* bg-slate-50 */
            border: 1px solid #e2e8f0; /* border-slate-200 */
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 25px;
            page-break-inside: avoid; /* Mencegah kepotong saat pindah halaman */
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a;
            margin-bottom: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 8px;
        }

        /* Table Info */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        .info-table td {
            padding: 8px 0;
            vertical-align: top;
        }
        .info-label {
            font-size: 12px;
            font-weight: bold;
            color: #64748b; /* text-slate-500 */
            text-transform: uppercase;
            width: 35%;
        }
        .info-colon {
            width: 5%;
            font-weight: bold;
        }
        .info-value {
            font-size: 14px;
            font-weight: bold;
            color: #0f172a; /* text-slate-900 */
            width: 60%;
        }

        /* Long text / Keterangan */
        .text-wrap-box {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 16px;
            font-size: 13px;
            color: #334155;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>

    <!-- KOP Header -->
    <div class="header-container">
        <table class="header-table">
            <tr>
                <td>
                    <h1 class="app-title">FCM Produksi</h1>
                </td>
                <td class="print-date">
                    Printer: {{ $dateNow }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Informasi Detail PO -->
    <div class="section-card">
        <div class="section-title">Informasi Proyek Order</div>
        <table class="info-table">
            <tr>
                <td class="info-label">Kode Proyek Order</td>
                <td class="info-colon">:</td>
                <td class="info-value">{{ $proyekorders->kodepo ?? '-' }}</td>
            </tr>
            <tr>
                <td class="info-label">Nama Proyek Order</td>
                <td class="info-colon">:</td>
                <td class="info-value">{{ $proyekorders->namaproyek ?? '-' }}</td>
            </tr>
            <tr>
                <td class="info-label">Tanggal Proyek Order</td>
                <td class="info-colon">:</td>
                <td class="info-value">
                    {{ $proyekorders->tglpo ? \Carbon\Carbon::parse($proyekorders->tglpo)->translatedFormat('d F Y H:i') : '-' }}
                </td>
            </tr>
        </table>
    </div>

    <!-- Keterangan / List Item -->
    <div class="section-card">
        <div class="section-title">Keterangan List Item SPK</div>
        <div class="text-wrap-box">
            @if(!empty(strip_tags($proyekorders->keteranganpoitem)))
                {!! $proyekorders->keteranganpoitem !!}
            @else
                <span style="color: #94a3b8; font-style: italic;">Tidak ada keterangan spesifik untuk proyek order ini.</span>
            @endif
        </div>
    </div>

</body>
</html>
