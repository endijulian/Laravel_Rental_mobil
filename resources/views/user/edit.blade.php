@extends('layouts.TemplatePage')

@section('title')
    <title>Edit User - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
    <a href="{{ url('admin/user')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <form action="{{route('user.update', $user->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name </label>
                        <input type="text" name="name" value="{{ $user->name}}" class="form-control {{ $errors->has('name') ? 'is-invalid':''}}" required>
                        <p class="text-danger">{{$errors->first('varian')}}</p>
                    </div> 
                    <div class="form-group"> 
                        <label for="">Email </label> 
                        <input type="text" name="email" value="{{ $user->email}}" class="form-control {{ $errors->has('email') ? 'is-invalid':''}}" required> 
                        <p class="text-danger">{{$errors->first('plat')}}</p>
                    </div>
                    <div class="form-group"> 
                        <label for=""> Password</label> 
                        <input type="password" name="password"  class="form-control {{ $errors->has('password') ? 'is-invalid':''}}" > 
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    </div>
                    <div class="form-group"> 
                        <label for=""> Konfirmasi Password</label> 
                        <input type="password" name="password_confirmation"  class="form-control {{ $errors->has('password') ? 'is-invalid':''}}" > 
                        <p class="text-danger">{{$errors->first('password')}}</p>
                    </div>
                    <div class="form-group"> 
                        <label for=""> Role</label> 
                        <select name="role"  class="form-control">
                            <option value="">List</option>
                            @foreach ($roles as $row)
                            <option value="{{$row->name}}" {{$user->roles->count() > 0 && $user->roles[0]->name == $row->name ? 'selected' : ''}} > {{$row->name}} </option>
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