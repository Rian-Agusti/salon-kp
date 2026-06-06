<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reservasi - {{ $reservation->reservation_code }}</title>
    <style>
        body { font-family: Helvetica, Arial, sans-serif; font-size: 14px; color: #333; line-height: 1.5; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #C8A97E; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 24px; font-weight: bold; color: #C8A97E; margin: 0; }
        .title { font-size: 18px; margin: 5px 0 0; color: #666; }
        .row { width: 100%; margin-bottom: 20px; clear: both; overflow: hidden; }
        .col-half { width: 48%; float: left; }
        .col-half.right { float: right; text-align: right; }
        h3 { font-size: 16px; margin: 0 0 10px; color: #1f2937; border-bottom: 1px solid #eee; padding-bottom: 5px; text-transform: uppercase; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f9fafb; font-weight: bold; color: #4b5563; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .total-row { font-weight: bold; background-color: #f9fafb; }
        .total-price { color: #C8A97E; font-size: 16px; }
        .footer { margin-top: 50px; text-align: center; font-size: 12px; color: #9ca3af; border-top: 1px solid #eee; padding-top: 20px; }
        .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 12px; font-weight: bold; text-transform: uppercase; }
        .badge.confirmed { background-color: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .badge.completed { background-color: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
        .badge.pending { background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .badge.cancelled { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .notes-box { background-color: #f9fafb; border: 1px solid #eee; padding: 15px; margin-top: 20px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 class="logo">{{ \App\Models\Setting::first()->salon_name ?? 'Eeva Hair & Beauty Salon' }}</h1>
        <p class="title">Detail Reservasi</p>
    </div>

    <div class="row">
        <div class="col-half">
            <h3>Info Pelanggan</h3>
            <strong>Nama:</strong> {{ $reservation->customer_name }}<br>
            <strong>Email:</strong> {{ $reservation->customer_email }}<br>
            <strong>Telepon:</strong> {{ $reservation->customer_phone ?? 'Tidak ada' }}
        </div>
        <div class="col-half right">
            <h3>Info Jadwal</h3>
            <strong>Kode Booking:</strong> {{ $reservation->reservation_code }}<br>
            <strong>Tanggal:</strong> {{ $reservation->booking_date->translatedFormat('l, d F Y') }}<br>
            <strong>Waktu:</strong> {{ \Carbon\Carbon::parse($reservation->booking_time)->format('H:i') }} WIB<br>
            <strong>Status:</strong> <span class="badge {{ $reservation->status->value ?? $reservation->status }}">
                {{ ($reservation->status->value ?? $reservation->status) === 'pending' ? 'Menunggu' : (($reservation->status->value ?? $reservation->status) === 'confirmed' ? 'Dikonfirmasi' : (($reservation->status->value ?? $reservation->status) === 'completed' ? 'Selesai' : 'Dibatalkan')) }}
            </span>
        </div>
    </div>

    <h3>Layanan yang Dipesan</h3>
    <table>
        <thead>
            <tr>
                <th>Nama Layanan</th>
                <th class="text-center">Durasi</th>
                <th class="text-right">Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalPrice = 0;
                $totalDuration = 0;
            @endphp
            @foreach($reservation->reservationItems as $item)
                @php
                    $totalPrice += $item->service_price;
                    $totalDuration += $item->service_duration;
                @endphp
                <tr>
                    <td>{{ $item->service_name }}</td>
                    <td class="text-center">{{ $item->service_duration }} menit</td>
                    <td class="text-right">Rp {{ number_format($item->service_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td class="text-right"><strong>Total</strong></td>
                <td class="text-center">{{ $totalDuration }} menit</td>
                <td class="text-right total-price">Rp {{ number_format($totalPrice, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @if($reservation->notes)
        <div class="notes-box">
            <strong>Catatan:</strong><br>
            {{ $reservation->notes }}
        </div>
    @endif

    <div class="footer">
        <p>Dokumen ini dihasilkan oleh sistem dan berfungsi sebagai bukti reservasi yang sah.</p>
        <p>Dibuat pada {{ now()->translatedFormat('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
