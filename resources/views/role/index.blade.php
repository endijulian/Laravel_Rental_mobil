@extends('layouts.TemplatePage')

@section('title')
    <title>Manajemen Role - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Role</h1>
          </div>

          <!-- Content Row -->
          <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                       <form action="{{url('admin/role')}}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Role</label>
                                <input type="text" name="role" class="form-control">
                            </div>
                            <button class="btn btn-primary btn-sm">Submit</button>
                       </form>
                    </div>
                </div>
            </div>
           
            <!-- Earnings (Monthly) Card Example -->
            <div class="col-md-8">
                <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                     @if (session('success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('success') }}</strong>
                    </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button> 
                            <strong>{{ session('error') }}</strong>
                        </div>
                    @endif
                    <div class="offset-md-9 col-md-3 mb-2">
                        <div class="form-group">
                            <form action="{{ url('admin/role')}}" method="get">
                                <input type="text" name="q" class="form-control" value="{{request()->q}}"  placeholder="Cari ...">
                            </form>
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>Nama Role</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($role as $row)
                            <tr>
                                <td>{{$row->name}}</td>
                                <td>
                                    <form action="{{url('admin/role/'. $row->id)}}" method="post">
                                        <input type="hidden" name="_method" value="DELETE">
                                         @csrf
                                        <a href="{{url('admin/role/permission/'. $row->id)}}" class="btn btn-info btn-sm">Permission</a>
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
                    {{-- {!!$role->links()!!} --}}
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
