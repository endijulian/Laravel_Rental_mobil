@extends('layouts.TemplatePage')

@section('title')
    <title>Detail Pelanggan - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">
          <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Detail Pelanggan</h1>
            <a href="{{ url('admin/pelanggan')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
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

                @if (session('error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ session('error') }}</strong>
                    </div>
                @endif
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body row">

                        <div class="col-md-6">
                            <table class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <td width="5%">NIK</td>
                                        <td> : </td>
                                        <td>{{$pelanggan->nik}}</td> 
                                    </tr>
                                    <tr>
                                        <td>Nama </td>
                                        <td> : </td>
                                        <td>{{$pelanggan->nama}}</td> 
                                    </tr>
                                    <tr>
                                        <td>Alamat </td>
                                        <td> : </td>
                                        <td>{{$pelanggan->alamat}}</td> 
                                    </tr>
                                    <tr>
                                        <td>Telepon </td>
                                        <td> : </td>
                                        <td>{{$pelanggan->notlp}}</td> 
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <div class="text-center">
                                <h4> <span> Total Poin </span> </h4>
                                <h4>{{$pelanggan->poin}}</h4>
                                <hr>
                                <h5>Poin digunakan </h5>
                                <h4>{{$pelanggan->poin_terpakai}}</h4>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <hr>
                        </div>

                        <div class="col-md-6">
                            <h4>Mutasi Poin</h4>
                            <table class="table table-bordered">
                                <thead>
                                        <tr>
                                            <td width="5%">No</td>
                                            <td width="25%">Status </td>
                                            <td width="35%">Jumlah Poin</td>
                                            <td width="35%">Keterangan / No. Faktur</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($pelanggan->mutasi as $key => $item)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{!! $item->type_label !!}</td>
                                                <td>{{$item->poin}}</td>
                                                <td>{{$item->keterangan}}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="4"><p class="text-danger text-center"> Tidak ada history</p></td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                            </table>
                        </div>

                        <div class="col-md-6">
                            <h4 class="text-center">Tukar Poin</h4>
                            <form action="{{url('admin/pelanggan/' .$pelanggan->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Klaim</label>
                                    <select name="rewards" id="" class="form-control" required>
                                        <option value="">Pilih Reward</option>
                                        @foreach ($rewards as $item)
                                        <option value="{{$item->id}}"> {{$item->title}} - {{$item->poin}}poin</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger">{{$errors->first('rewards')}}</p>
                                </div>
                                <button class="btn btn-primary btn-sm">Tukarkan </button>
                            </form>
                        </div>

                    </div>
                    <div class="float-right"></div> 
                </div>
            </div>
        
        </div>

        <div class="row"></div>

        <div class="row">
            <!-- Content Column -->
            <div class="col-lg-6 mb-4">
            </div>

            <div class="col-lg-6 mb-4">
            </div>
        </div>
    </div>
@endsection
