
@extends('layouts.TemplatePage')

@section('title')
    <title>Setting Harga - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Harga Layanan</h1>
    <a href="{{ url('admin/produk')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
</div>


<div class="row">
    <div class="col-md-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <form action="{{url('/admin/produkharga/' .$produk->id)}}" method="POST" >
                    @csrf
                     @if (session('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ session('success') }}</strong>
                        </div>
                    @endif
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="">Produk</label>
                    <input type="text" name="produk" class="form-control {{ $errors->has('varian') ? 'is-invalid':''}}" value="{{$produk->varian}}" readonly>
                        <p class="text-danger">{{$errors->first('name')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for="">Deskripi</label> 
                        <input type="text" name="deskripsi"class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':''}}"> 
                        <p class="text-danger">{{$errors->first('deskripsi')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for="">Harga</label> 
                        <input type="number" name="harga" class="form-control {{ $errors->has('harga') ? 'is-invalid':''}}"> 
                        <p class="text-danger">{{$errors->first('harga')}}</p>
                    </div> 
                    <button class="btn-primary btn-sm"> Tambah harga</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Deskripsi</td>
                                <td>Harga </td>
                                <td>Aksi </td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($produk->list_harga as $row)
                                <tr>
                                    <td>{{$row->deskripsi}}</td>
                                    <td>{{$row->harga}}</td>
                                    <td>
                                        <form action="{{url('admin/produkharga/'.$row->id) }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger btn-sm"> Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3"><p class="text-danger text-cente">Maaf data tidak ditemukan</p></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>    
        </div>
    </div>
</>
@endsection
