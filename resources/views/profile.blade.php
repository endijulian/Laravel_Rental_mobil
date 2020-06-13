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
                    <form action="{{ url('admin/profile')}}" method="POST">
                        @csrf
                         <div class="form-group">
                            <label for="">Nama </label>
                            <input type="text" name="name" value="{{auth()->user()->name}}" class="form-control {{ $errors->has('name') ? 'is-invalid':''}}" required>
                            <p class="text-danger">{{ $errors->first('name')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Email </label>
                            <input type="text" name="email" value="{{auth()->user()->email}}" class="form-control {{ $errors->has('email') ? 'is-invalid':''}}" required>
                            <p class="text-danger">{{ $errors->first('email')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Password </label>
                            <input type="text" name="password"  class="form-control" >
                        </div>
                        <p class="text-warning">{Biarkan kosong jika tidak ingin mengganti password}</p>
                        <button class="btn btn-primary sm">Ubah </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

