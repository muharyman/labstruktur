<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> Laporan Bulanan </title>
</head>
<body>
    <div>
        <h1>Kuitansi</h1>
    </div>
    <div>
        <table>
            <div>No: {{$pembayaran->pengujian->nomor_laporan}} </div>
            <div>Pemberi Tugas: {{$pembayaran->pengujian->pemberi_tugas}}</div>
            <div>{{$terbilang}}</div>
            <div>{{$itemPengujian}}</div>
            <div>Tanggal Pembayaran: {{$pembayaran->tanggal_pembayaran}}</div>
            <div>Jumlah Pembayaran: {{$pembayaran->jumlah_pembayaran}}</div>
            <div>Mengetahui: {{$pembayaran->pengujian->engineer->nama_user}}</div>
        </table>
    </div>
</body>
</html>
