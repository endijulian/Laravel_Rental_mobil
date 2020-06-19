@extends('layouts.TemplatePage')

@section('title')
    <title>List - Transaksi </title>
@endsection

@section('content')
    <div class="container-fluid">
<!-- Content Row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body row">
                        <div class="col-md-8">
                            <a href="{{url('admin/transaksi?status=')}}" class="btn {{ request()->status == '' ? 'btn-secondary' : 'btn-primary'}} btn-sm"> <i class="fas fa-filter"></i> Semua</a>
                            <a href="{{url('admin/transaksi?status=booking')}}" class="btn {{ request()->status == 'booking' ? 'btn-secondary' : 'btn-primary'}} btn-sm">   <i class="fas fa-filter"></i> Booking</a>
                            <a href="{{url('admin/transaksi?status=pinjam')}}" class="btn {{ request()->status == 'pinjam' ? 'btn-secondary' : 'btn-primary'}} btn-sm"> <i class="fas fa-filter"></i> Dipinjam</a>
                            <a href="{{url('admin/transaksi?status=kembali')}}" class="btn {{ request()->status == 'kembali' ? 'btn-secondary' : 'btn-primary'}} btn-sm">   <i class="fas fa-filter"></i> Dikembalikan</a>
                            <a href="{{url('admin/transaksi?status=batal')}}" class="btn {{ request()->status == 'batal' ? 'btn-secondary' : 'btn-primary'}} btn-sm">   <i class="fas fa-filter"></i> Dibatalkan</a>
                        </div>
                        <div class="col-md-4">
                            <form action="transaksi" method="GET">
                                <div class="form-group">
                                    <input type="text" name="q" class="form-control" value={{ request()->q }}>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td> Faktur</td>
                                            <td> Pelanggan</td>
                                            <td> Tanggal Pinjam dan Kembali</td>
                                            <td> Harga</td>
                                            <td> Status</td>
                                            <td> Aksi</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($transaksi as $row)
                                            <tr>
                                                <td >{{$row->faktur}} </td>
                                                <td> {{$row->pelanggan->nama}} ({{$row->pelanggan->nik}})</td>
                                                <td> {{$row->tanggal_pinjam->format('d-m-Y')}} / {{$row->tanggal_kembali->format('d-m-Y')}}</td>
                                                <td> Rp. {{number_format($row->harga)}}</td>
                                                <td> {!!$row->status_label!!}</td>
                                                <td> 
                                                    <form action={{ url("/admin/transaksi/hapus/" . $row->id)}} method='POST'> 
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href={{ url("/admin/transaksi/" . $row->id)}} class="btn btn-info btn-sm"> Detail</a>
                                                        <a href="{{ url("admin/transaksi/print/" . $row->id)}}" class="btn btn-warning btn-sm"> Print</a>
                                                        <button type="submit" class="btn btn-danger btn-sm" {{$row->status != 3 ? 'disabled' : '' }}> Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-danger">Data tidak ditemukan..</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

