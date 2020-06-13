@extends('layouts.TemplatePage')


@section('title')
    <title> Laporan Transaksi</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Laporan </h1>
        </div>

          <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <form action="{{url('admin/laporan')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Tanggal Awal</label>
                            <input type="date" name="start" class="form-control  {{ $errors->has('start') ? 'is-invalid':''}}" >
                             <p class="text-danger">{{$errors->first('start')}}</p>
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Akhir</label>
                            <input type="date" name="end" class="form-control  {{ $errors->has('end') ? 'is-invalid':''}}">
                             <p class="text-danger">{{$errors->first('end')}}</p>
                        </div>
                        <button class="btn btn-primary btn-sm"> Get PDF</button>
                    </form>
                    
                </div>
              </div>
            </div>
        </div>
                
    </div>
@endsection

