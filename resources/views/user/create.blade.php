@extends('layouts.TemplatePage')

@section('title')
    <title>Tambah User - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
    <a href="{{ url('admin/user')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <form action="{{route('user.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Name </label>
                        <input type="text" name="name" class="form-control {{ $errors->has('varian') ? 'is-invalid':''}}" required>
                        <p class="text-danger">{{$errors->first('varian')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for="">Email </label> 
                        <input type="text" name="email" class="form-control {{ $errors->has('plat') ? 'is-invalid':''}}" required> 
                        <p class="text-danger">{{$errors->first('plat')}}</p>
                    </div>
                    <div class="form-group"> 
                        <label for=""> Password</label> 
                        <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid':''}}" required> 
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for=""> Konfirmasi Password</label> 
                        <input type="password" name="password_confirmation" class="form-control"  required> 
                    </div>
                    <div class="form-group"> 
                        <label for=""> Role</label> 
                        <select name="role" id="" class="form-control">
                            <option value="">List</option>
                            @foreach ($roles as $row)
                            <option value="{{$row->id}}"> {{$row->name}} </option>
                            @endforeach
                        </select>
                    </div> 
                    <button class="btn-primary btn-sm">Submit </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection