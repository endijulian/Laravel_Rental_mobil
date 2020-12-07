@extends('layouts.TemplatePage')

@section('title')
    <title>Edit Produk Mobil - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Produk Mobil</h1>
    <a href="{{ url('admin/produk')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <form action="{{url('/admin/produk/' .$produk->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    <div class="form-group">
                        <label for="">Varian</label>
                        <input type="text" name="varian" class="form-control {{ $errors->has('varian') ? 'is-invalid':''}}" value="{{ $produk->varian}}">
                        <p class="text-danger">{{$errors->first('varian')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for="">Plat</label> 
                        <input type="text" name="plat"class="form-control {{ $errors->has('plat') ? 'is-invalid':''}}" value="{{ $produk->plat}}"> 
                        <p class="text-danger">{{$errors->first('plat')}}</p>
                    </div>
                    <div class="form-group"> 
                        <label for=""> Unit</label> 
                        <input type="number" name="unit" class="form-control {{ $errors->has('unit') ? 'is-invalid':''}}" value="{{ $produk->unit}}"> 
                        <p class="text-danger">{{$errors->first('plat')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for="">Merk</label> 
                        <input type="text" name="merk"class="form-control {{ $errors->has('merk') ? 'is-invalid':''}}" value="{{ $produk->merk}}"> 
                        <p class="text-danger">{{$errors->first('merk')}}</p>
                    </div> 
                    <img src="{{  asset('storage/produk/' . $produk->gambar)}}" class="img-responsive" width="259" height="194" alt=""/>
                    <div class="form-group"> 
                        <label for="">Gambar </label> 
                        <input type="file" name="gambar" class="form-control {{ $errors->has('gambar') ? 'is-invalid':''}}">
                        <p class="text-danger">{{$errors->first('gambar')}}</p>
                        <p class="text-warning">Upload gambar untuk mengganti</p>
                    </div>
                    <button class="btn-primary btn-sm">Ubah </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection