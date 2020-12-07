@extends('layouts.frontend')

@section('title')
    <title>Detail Armada - {{$site_setting->nama_toko}}</title>
@endsection


@section('content')
    <main role="main">
            
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Katalog Kendaraan Rental</h1>
                    <p class="lead text-muted">Nikmati kemudahan layanan sewa kendaraan </p>
                </div>
            </section>

            
            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{  asset('storage/produk/' .$produk->gambar) }}" width="200px" height="200px" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>Varian : </strong>      {{$produk->varian }} <br>
                                        <strong>Merk : </strong>        {{$produk->merk }} <br>
                                        <strong>No. produkolisi : </strong>  {{$produk->plat }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        {{--  <button type="button" class="btn btn-sm btn-outline-secondary">Detail </button>  --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            @if (session('success'))
                                <div class="alert alert-success">{{session('success')}}</div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{session('error')}}</div>
                            @endif
                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-info">
                                        Jika anda adalah member silahkan gunakan NIK untuk melakukan pemesanan
                                    </div>
                                    <div class="form-group">
                                        <form action="{{url('/katalog/' . $produk->plat)}}" method="GET">
                                            <div class="input-group mb-2">
                                                <input type="text" name="nik" class="form-control {{ $errors->has('nik') ? 'is-invalid':''}}" placeholder="Masukan NIK" value="{{request()->nik}}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary btn-sm">Input </button>
                                                </div>
                                            </div>
                                            <p class="text-danger">{{$errors->first('nik')}}</p>
                                        </form>  
                                    </div>
                                    
                                    <form action="{{url('katalog/pesan')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                            <input type="hidden" name="nik" value="{{request()->nik}}">
                                        @if ($pelanggan)
                                            <table class="table table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>NIK </th>
                                                        <th>Nama </th>
                                                        <th>No Telepon </th>
                                                        <th>Alamat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                        <td>{{$pelanggan->nik}} </td>
                                                        <td>{{$pelanggan->nama}} </td>
                                                        <td>{{$pelanggan->notlp}} </td>
                                                        <td>{{$pelanggan->alamat}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="form-group">
                                                <label for="">Foto KTP </label>
                                                <input type="file" name="ktp" class="form-control {{ $errors->has('ktp') ? 'is-invalid':''}}" required >
                                                <p class="text-danger">{{$errors->first('ktp')}}</p>
                                            </div> 

                                            <div class="form-group">
                                                <label for="">Nama </label>
                                                <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':''}}" required >
                                                <p class="text-danger">{{$errors->first('nama')}}</p>
                                            </div>
                            
                                            <div class="form-group">
                                                <label for="">Telepon </label>
                                                <input type="text" name="telepon" class="form-control {{ $errors->has('telepon') ? 'is-invalid':''}}" required >
                                                <p class="text-danger">{{$errors->first('telepon')}}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Alamat </label>
                                                <input type="text" name="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid':''}}" required >
                                                <p class="text-danger">{{$errors->first('alamat')}}</p>
                                            </div>
                                        @endif
                                            <div class="form-group">
                                                <label for="">Pilih Layanan </label>
                                                <select name="layanan" id="" class="form-control {{ $errors->has('layanan') ? 'is-invalid':''}}">
                                                    <option value="">List</option>
                                                        @foreach ($produk_harga as $item)
                                                            <option value="{{$item->id}}">{{$item->deskripsi}} - {{number_format($item->harga)}} </option>
                                                        @endforeach
                                                </select>
                                                <p class="text-danger">{{$errors->first('layanan')}}</p>
                                            </div>

                                            <hr>
                                            
                                            <div class="form-group">
                                                <label for="">Jaminan </label>
                                                <input type="text" name="jaminan" class="form-control {{ $errors->has('jaminan') ? 'is-invalid':''}}" >
                                                <p class="text-danger">{{$errors->first('jaminan')}}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Foto Jaminan </label>
                                                <input type="file" name="foto_jaminan" class="form-control {{ $errors->has('foto_jaminan') ? 'is-invalid':''}}" >
                                                <p class="text-danger">{{$errors->first('foto_jaminan')}}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Tanggal Pinjam </label>
                                                <input type="date" name="tanggal_pinjam" class="form-control {{ $errors->has('tanggal_pinjam') ? 'is-invalid':''}}" required>
                                                <p class="text-danger">{{$errors->first('tanggal_pinjam')}}</p>
                                            </div>

                                            <div class="form-group">
                                                <label for="">Lama Pinjam </label>
                                                <select name="lama_pinjam" class="form-control {{ $errors->has('lama_pinjam') ? 'is-invalid':''}}" required>
                                                    <option value="1">1 Hari </option>
                                                    <option value="2">2 Hari </option>
                                                    <option value="3">3 Hari </option>
                                                    <option value="4">4 Hari </option>
                                                    <option value="5">5 Hari </option>
                                                    <option value="6">6 Hari </option>
                                                    <option value="7">7 Hari </option>
                                                </select>
                                            </div>
                                            
                                            <button class="btn btn-primary btn-sm">Kirim permintaan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </main>
@endsection
