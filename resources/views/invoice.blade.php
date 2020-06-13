<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - {{ $site_setting->nama_toko}}</title>
</head>
<body>
    <h1>{{ $site_setting->nama_toko}} </h1>
    <p>{{ $site_setting->alamat}} </p>
    <p>{{ $site_setting->telepon}} </p>
    ================================
    <br>
    <table width="50%"> 
        <tr>
            <td width="50%">No Faktur</td>
            <td>{{ $transaksi->faktur}} </td>   
        </tr>
         <tr>
             <td>No KTP</td>
            <td>{{ $transaksi->jaminan}} </td>
        </tr>
        <tr>
             <td>Barang Pinjaman</td>
            <td>{{ $transaksi->produk->varian  .'-'.  $transaksi->produk->merk  .'-'. $transaksi->produk->plat }} </td>
        </tr>
         <tr>
             <td>Harga Sewa</td>
            <td>{{ $transaksi->harga}} </td>
        </tr>
         <tr>
             <td>Denda</td>
            <td>{{ $transaksi->denda}} </td>
        </tr>
         <tr>
             <td>Tanggal Pinjam</td>
            <td>{{ $transaksi->tanggal_pinjam }}  </td>
        </tr>
         <tr>
             <td>Tanggal Kembali</td>
            <td>{{ $transaksi->tanggal_kembali }}</td>
        </tr>
    </table>
</body>
</html>