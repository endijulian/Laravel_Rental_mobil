@extends('layouts.TemplatePage')

@section('title')
    <title>List Pelanggan - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">List Pelanggan</h1>
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
                            <form action="{{url('admin/pelanggan')}}" method="get">
                                <input type="text" name="q" class="form-control" placeholder="Cari..." value="{{ request()->q}}">
                            </form>
                        </div>
                </div>
                  <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>NIK</td>
                                <td>Nama </td>
                                <td>No Telepon</td>
                                <td>Alamat </td>
                                <td>Poin </td>
                                <td>Poin digunakan</td>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @forelse ($pelanggan as $key => $p)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td><a href="{{url('admin/pelanggan/' .$p->id)}}">{{$p->nik}}</a></td>
                                <td>{{$p->nama}}</td>
                                <td>{{$p->notlp}}</td>
                                <td>{{$p->alamat}}</td>
                                <td>{{$p->poin}}</td>
                                <td>{{$p->poin_terpakai}}</td>
                                {{--  <td>
                                <form action="{{url('admin/produk/'. $p->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    @can('produk_edit')
                                        <a href='{{url("admin/produkharga/". $p->id)}}' class="btn btn-info btn-sm">Atur Harga</a>
                                    @endcan
                                    @can('produk_edit')
                                        <a href="{{url('admin/produk/'. $p->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                </form>
                                </td>  --}}
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center"><p class="text-danger">Maaf data pelanggan tidak ditemukan!</p></td>
                            </tr>
                            @endforelse
                            
                        </tbody>
                      </table>
                  </div>
                  <div class="float-right">
                    {!!$pelanggan->links()!!}
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
