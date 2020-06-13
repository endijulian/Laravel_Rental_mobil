@extends('layouts.TemplatePage')

@section('title')
    <title>Detail Transaksi {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="float-right">
                                <a href={{ url('admin/transaksi/proses/' .$detail->id)}} class="btn btn-primary btn-sm {{ $detail->status != 0 ? 'disabled':''}}" onclick="return confirm('Proses Transaksi?')" >Pinjamkan</a>
                                <a href={{ url('admin/transaksi/pengembalian/' .$detail->id)}} class="btn btn-success btn-sm {{ $detail->status != 1 ? 'disabled':''}}" onclick="return confirm('Proses Pengembalian?')">Kembalikan</a>
                                <a href={{ url('admin/transaksi/pembatalan/' .$detail->id)}} class="btn btn-danger btn-sm {{ in_array($detail->status, [1,2,3,]) ? 'disabled':'' }}" onclick="return confirm('Yakin untuk membatalkan pesanan ?')"> Batalkan</a>
                                <a href={{ url('admin/transaksi/print/' .$detail->id)}} class="btn btn-info btn-sm {{ $detail->status != 2 ? 'disabled':''}}" onclick="return confirm('Cetak halaman ini?')" target="_blank"> Print</a>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {!! session('success') !!}
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Rincian Biaya</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Harga Sewa </th>
                                    <th> : </th>
                                    <th>Rp {{ number_format($detail->harga) }}</th>
                                </tr>
                                <tr>
                                    <th>Denda </th>
                                    <th> : </th>
                                    <th>Rp {{ number_format($detail->denda) }}</th>
                                </tr>
                                <tr>
                                    <th> Total </th>
                                    <th> : </th>
                                    <th class="text-white {{ $detail->status == 3 ? 'bg-secondary' : 'bg-success'}} ">
                                        @if ($detail->status == 3)
                                            <del> Rp {{ number_format($detail->harga + $detail->denda) }}</del>
                                        @else
                                            Rp {{ number_format($detail->harga + $detail->denda) }}
                                        @endif
                                    </th>
                                </tr>
                            </thead>
                            </table>
                            <h4>Data Pelanggan </h4>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>NIK </th>
                                        <th> : </th>
                                    <th>{{ $detail->pelanggan->nik}}</th>
                                    </tr>
                                    <tr>
                                        <th> Nama </th>
                                        <th> : </th>
                                        <th>{{ $detail->pelanggan->nama}}</th>
                                    </tr>
                                    <tr>
                                        <th>Telepon</th>
                                        <th> : </th>
                                        <th>{{ $detail->pelanggan->tlp}}</th>
                                    </tr>
                                    <tr>
                                        <th> Alamat </th>
                                        <th>: </th>
                                        <th>{{ $detail->pelanggan->alamat}}</th>
                                    </tr>
                                    <tr>
                                        <th> Foto </th>
                                        <th>: </th>
                                    <th><img src="{{ asset('storage/pelanggan/' . $detail->pelanggan->foto_ktp)}}" alt="" width="100px" height="100px"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                         <div class="col-md-6">
                            <h4> Data Transaksi</h4>
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Faktur </th>
                                    <th> : </th>
                                    <th>{{ $detail->faktur}}</th>
                                </tr>
                                <tr>
                                    <th>Status </th>
                                    <th> : </th>
                                    <th>{!! $detail->status_label !!}</th>
                                </tr>
                                <tr>
                                    <th> Jaminan </th>
                                    <th> : </th>
                                    <th>{{ $detail->jaminan}}</th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th><img src="{{ asset('storage/transaksi/' . $detail->foto_jaminan)}}" alt="" width="100px" height="100px"></th>
                                </tr>
                                <tr>
                                    <th> Tanggal Pinjam dan Kembali </th>
                                    <th>: </th>
                                    <th>{{ $detail->tanggal_pinjam->format('d-m-Y')}} / {{ $detail->tanggal_kembali->format('d-m-Y')}} </th>
                                </tr>
                                <tr>
                                    <th> Tanggal Dikembalikan </th>
                                    <th>: </th>
                                    <th>{{ $detail->tanggal_dikembalikan}}</th>
                                </tr>
                                {{-- <tr>
                                    <th> Harga </th>
                                    <th>: </th>
                                    <th>Rp. {{ number_format($detail->harga) }}</th>
                                </tr>
                                <tr>
                                    <th> Denda </th>
                                    <th>: </th>
                                    <th>{{ $detail->denda}}</th>
                                </tr> --}}
                                <tr>
                                    <th> Kendaraan</th>
                                    <th>: </th>
                                    <th>{{ $detail->produk->varian}} - {{ $detail->produk->merk}} - {{ $detail->produk->plat}}</th>
                                </tr>
                                <tr>
                                    <th> Foto Kendaraan</th>
                                    <th> : </th>
                                    <th><img src="{{ asset('storage/produk/' . $detail->produk->gambar)}}" alt="" width="100px" height="100px"></th>
                                </tr>
                            </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

