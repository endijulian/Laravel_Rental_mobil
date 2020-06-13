<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
</head>
<body>
    <h4>Laporan Transaksi</h4>
    <p>
        Periode : <strong>{{$start}}</strong> s/d  <strong>{{$end}}</strong>
    </p>
    <table width="100%" class="table table-bordered table-hover">
        <thead>
            <tr>
                <td> No</td>
                <td> Bulan</td>
                <td> Penghasilan</td>
                <td> Sewa</td>
                <td> Denda</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $key => $row)
                <tr>
                    <td>{{ $key + 1}}</td>
                    <td>{{ $row->bulan}}</td>
                    <td>{{ number_format($row->total) }}</td>
                    <td>{{ number_format($row->sewa) }}</td>
                    <td>{{ number_format($row->denda) }}</td>
                </tr>    
            @endforeach
        </tbody>
    </table>
</body>
</html>