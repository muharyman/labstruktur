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
            <tr>No: {{$pembayaran->pengujian->nomor_laporan}} </tr>
            <tr>Pemberi Tugas: {{$pembayaran->pengujian->pemberi_tugas}}</tr>
            <tr>{{$terbilang}}</tr>
            <tr>Tanggal Pembayaran: {{$pembayaran->tanggal}}</tr>
            <tr>Jumlah Pembayaran: {{$pembayaran->jumlah_pembayaran}}</tr>
            <tr>Mengetahui: {{$pembayaran->pengujian->engineer->nama_user}}</tr>
        </table>
    </div>
</body>
</html>
