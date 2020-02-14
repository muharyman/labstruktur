<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> Laporan Bulanan </title>
</head>
<body>
    <div>
        <h1>Laporan Bulanan</h1>
        <h2>Tanggal: {{$start}} - {{$end}}</h2>
        <h2>Total Pendapatan: {{$sum}}</h2>
    </div>
    <div>
        <table>
            <tr>
                <td>No.</td>
                <td>Tanggal Masuk</td>
                <td>Tanggal Pembayaran</td>
                <td>Pemberi Tugas</td>
                @if($rutin) 
                    <td>Pekerjaan</td> 
                @endif
                <td>Nilai Pekerjaan Laboratorium</td>
                <td>Jumlah Pembayaran</td>
                @if(!$rutin) 
                    <td>Sisa Pembayaran</td>
                    <td>Keterangan Pembayaran</td> 
                @endif
                <td>status</td>
                <td>Mengetahui</td>
                <td>Dikerjakan oleh</td>
                <td>NPWP</td>
                <td>Status Pengambilan</td>
            </tr>
            @foreach($data as $d)
                @foreach($d->pembayaran as $pembayaran)
                    @if($pembayaran->tanggal_pembayaran < $end && $pembayaran->tanggal_pembayaran > $start)
                        <tr>
                            <td>{{$d->idpengujian}}</td>
                            <td>{{$d->tanggal_terima}}</td>
                            <td>{{$pembayaran->tanggal_pembayaran}}</td>
                            <td>{{$d->pemberi_tugas}}</td>
                            @if($rutin)
                                <td>{{$d->proyek}}</td>
                            @endif
                            <td>{{$d->total_biaya}}</td>
                            <td>{{$pembayaran->jumlah_pembayaran}}</td>
                            @if(!$rutin) 
                                <td>{{$d->total_biaya - $d->total_pembayaran}}Sisa Pembayaran</td>
                                <td>{{$pembayaran->metode_pembayaran}}</td> 
                            @endif
                            <td>{{$d->status_pembayaran}}</td>
                            <td>{{$d->engineer->nama_user}}</td>
                            <td>{{$d->teknisi->nama_user}}</td>
                            <td>{{$d->npwp}}</td>
                            <td>{{$d->status_pengambilan}}</td>
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </table>
    </div>
</body>
</html>
