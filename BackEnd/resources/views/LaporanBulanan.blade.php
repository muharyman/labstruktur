<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title> Laporan Bulanan </title>
</head>
<body>
    <div>
        {{$data}} 
    </div>
    <div>
        {{$sum}}
    </div>
</body>
</html>
