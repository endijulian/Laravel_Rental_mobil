@extends('layouts.TemplatePage')

@section('title')
    <title>List Mobil - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Mobil</h1>
            @can('produk_add')
                <a href="{{ url('admin/produk/tambah')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-file fa-sm text-white-50"></i> Tambah Produk</a>
            @endcan
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
                            <form action="{{url('admin/produk')}}" method="get" >
                            <input type="text" name="q" class="form-control" placeholder="Cari...">
                    </form>
                        </div>
                </div>
                  <div class="table-responsive">
                      <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Varian</td>
                                <td>Merk</td>
                                <td>Plat</td>
                                <td>Unit</td>
                                <td>Unit Tersedia</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                        
                            @forelse ($produk as $p)
                            <tr>
                                <td><img src="{{  asset('storage/produk/' .$p->gambar) }}" class="img-responisve" width="259" height="194" alt=""/> </td>
                                <td>{{$p->varian}}</td>
                                <td>{{$p->merk}}</td>
                                <td>{{$p->plat}}</td>
                                <td>{{$p->unit}}</td>
                                <td>{{$p->unit_available}}</td>
                                <td>
                                <form action="{{url('admin/produk/'. $p->id)}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="_method" value="DELETE">
                                    @can('produk_edit')
                                        <a href='{{url("admin/produkharga/". $p->id)}}' class="btn btn-info btn-sm">Atur Harga</a>
                                    @endcan
                                    @can('produk_edit')
                                        <a href="{{url('admin/produk/'. $p->id)}}" class="btn btn-warning btn-sm">Edit</a>
                                    @endcan
                                    @can('produk_delete')
                                    <button class="btn btn-danger btn-sm">Hapus</button>
                                    @endcan
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
                    {!!$produk->links()!!}
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
