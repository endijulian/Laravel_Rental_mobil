@extends('layouts.TemplatePage')

@section('title')
    <title>Detail Transaksi - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success')}}
                        </div>
                    @endif
                    <form action="{{ url('admin/setting')}}" method="POST">
                        @csrf
                         <div class="form-group">
                            <label for="">Perusahaan </label>
                            <input type="text" name="nama_toko" value="{{$setting->nama_toko}}" class="form-control {{ $errors->has('nama_toko') ? 'is-invalid':''}}" required>
                            <p class="text-danger">{{ $errors->first('nama_toko')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat </label>
                            <input type="text" name="alamat" value="{{$setting->alamat}}" class="form-control {{ $errors->has('alamat') ? 'is-invalid':''}}" required>
                            <p class="text-danger">{{ $errors->first('alamat')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">No Telepon </label>
                            <input type="text" name="telepon"  class="form-control" value="{{$setting->telepon}}" >
                            <p class="text-danger">{{ $errors->first('telepon')}}</p>
                        </div>
                        <button class="btn btn-primary sm">Ubah </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

