@extends('layouts.TemplatePage')

@section('title')
    <title>Manajemen User - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Produk</h1>
          <a href="{{ route('user.create')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file fa-sm text-white-50"></i> Tambah User</a>
          </div>

          <!-- Content Row -->
          <div class="row">
           
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-12">
                 @if (session('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('success') }}</strong>
                    </div>
                @endif
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="offset-md-9 col-md-3 mb-2">
                        <div class="form-group">
                            <form action="{{route('user.index')}}" method="get" >
                            <input type="text" name="q" class="form-control"  placeholder="Cari ...">
                    </form>
                        </div>
                </div>
                  <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Nama User</td>
                                <td>Email </td>
                                <td>Role</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($user as $p)
                            <tr>
                                <td>{{$p->name}}</td>
                                <td>{{$p->email}}</td>
                                <td><span class="badge badge-success">{{$p->roles->count() > 0 ? $p->roles[0]->name : ''}}</span></td>
                                <td>
                                <form action="{{route('user.destroy', $p->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <a href='{{route('user.edit', $p->id)}}' class="btn btn-info btn-sm">Edit</a>
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center"><p class="text-danger">Maaf tidak ada data</p></td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                      </table>
                  </div>
                  <div class="float-right">
                    {!!$user->links()!!}
                  </div> 
                </div>
            </div>
           
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
           

            <!-- Pie Chart -->
            
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              

              <!-- Color System -->
             

            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              

              <!-- Approach -->
              

            </div>
          </div>

        </div>
@endsection
