@extends('layouts.TemplatePage')

@section('title')
    <title>Input Form Rental - {{ $site_setting->nama_toko}}</title>
@endsection

@section('content')
    <div class="container-fluid">

          <!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Produk</h1>
    <a href="{{ url('admin/produk')}}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Kembali</a>
</div>

<!-- Content Row -->
<form action="{{url('/admin/transaksi')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-md-12">
            @if (session('success'))
            <div class="alert alert-success ">
            {{!! session('success') !!}}
            </div>
            @endif
        </div>
        <div class="col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    {{-- <input type="hidden" name="_method" value="PUT"> --}}
                    <div class="form-group">
                        <label for="">Pilih Jenis Pelanggan </label>
                        <select name="tipe_pelanggan" id="tipepelanggan" class="form-control {{ $errors->has('nik') ? 'is-invalid':''}}" required >
                            <option value="0">Pelanggan Baru </option>
                            <option value="1">Pelanggan Lama </option>
                        </select>
                        <p class="text-danger">{{$errors->first('alamat')}}</p>
                    </div> 

                    <!-- bagian customer lama -->
                    <div id="existing-customer" style="display: none">
                        <div class="form-froup">
                            <select name="pelanggan" id="pelanggan" class="form-control">
                                <option value="">List</option>
                                @foreach ($pelanggan ?? ''  as $p )
                                <option value="{{ $p->id }}"> {{ $p->nama}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- bagian customer baru -->
                    <div id="new-customer">
                        <div class="form-group">
                            <label for="">NIK </label>
                            <input type="text" name="nik" class="form-control {{ $errors->has('nik') ? 'is-invalid':''}}" >
                            <p class="text-danger">{{$errors->first('nik')}}</p>
                        </div> 

                        <div class="form-group">
                            <label for="">Foto KTP </label>
                            <input type="file" name="ktp" class="form-control {{ $errors->has('ktp') ? 'is-invalid':''}}" >
                            <p class="text-danger">{{$errors->first('ktp')}}</p>
                        </div> 

                        <div class="form-group">
                            <label for="">Nama </label>
                            <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid':''}}" >
                            <p class="text-danger">{{$errors->first('nama')}}</p>
                        </div>
                    
                        <div class="form-group">
                            <label for="">Telepon </label>
                            <input type="text" name="telepon" class="form-control {{ $errors->has('telepon') ? 'is-invalid':''}}" >
                            <p class="text-danger">{{$errors->first('telepon')}}</p>
                        </div>

                        <div class="form-group">
                            <label for="">Alamat </label>
                            <input type="text" name="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid':''}}" >
                            <p class="text-danger">{{$errors->first('alamat')}}</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Form Transaksi Section -->
        <div class="col-md-6">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    {{-- <input type="hidden" name="_method" value="PUT"> --}}
                    <div class="form-group">
                        <label for="">Pilih Produk  </label>
                        <select name="produk" class="form-control {{ $errors->has('nik') ? 'is-invalid':''}}"  id="produk" required >
                            @foreach($produk as $p)
                                <option value="">List</option>
                                <option value="{{ $p->id }}"> {{ $p->varian.' - [' .$p->plat .']' }}</option>
                            @endforeach
                        </select>
                        <p class="text-danger">{{$errors->first('alamat')}}</p>
                    </div> 

                    <div class="form-group">
                        <label for="">Pilih jenis layanan </label>
                        <select name="harga_layanan" class="form-control {{ $errors->has('nik') ? 'is-invalid':''}}"  id="layanan">
                            <!-- Kosongkan karena akan di append-->
                        </select>
                        <p class="text-danger">{{$errors->first('jaminan')}}</p>
                    </div>

                    <div class="form-group">
                        <label for="">Jaminan </label>
                        <input type="text" name="jaminan" class="form-control {{ $errors->has('jaminan') ? 'is-invalid':''}}" >
                        <p class="text-danger">{{$errors->first('jaminan')}}</p>
                    </div>

                    <div class="form-group">
                        <label for="">Foto Jaminan </label>
                        <input type="file" name="foto_jaminan" class="form-control {{ $errors->has('foto_jaminan') ? 'is-invalid':''}}" >
                        <p class="text-danger">{{$errors->first('foto_jaminan')}}</p>
                    </div>

                    <div class="form-group">
                        <label for="">Tanggal Pinjam </label>
                        <input type="date" name="tanggal_pinjam" class="form-control {{ $errors->has('tanggal_pinjam') ? 'is-invalid':''}}" >
                        <p class="text-danger">{{$errors->first('tanggal_pinjam')}}</p>
                    </div>

                    <div class="form-group">
                        <label for="">Lama Pinjam </label>
                        <select name="lama_pinjam" class="form-control {{ $errors->has('lama_pinjam') ? 'is-invalid':''}}" required >
                            <option value="1">1 Hari </option>
                            <option value="2">2 Hari </option>
                            <option value="3">3 Hari </option>
                            <option value="4">4 Hari </option>
                            <option value="5">5 Hari </option>
                            <option value="6">6 Hari </option>
                            <option value="7">7 Hari </option>
                        </select>
                    </div>
                    <div class="float-right">
                        <button class="btn-primary btn-sm">Input Transaksi </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form> 
@endsection

@section('js')
    <script>
        $('#tipepelanggan').on('change', function(){
            console.log('cek');
            if($(this).val() == 0){
                $('#existing-customer').hide()
                $('#new-customer').show()
            } else {
                $('#existing-customer').show()
                $('#new-customer').hide()
            }
        })
    </script>
    <script>
        $('#produk').on('change', function(){
            let produk_id = $(this).val()
            console.log(produk_id)
            $.ajax({
                url : "{{url('/api/produk-harga')}}",
                type : 'GET',
                data : {q : produk_id}, //si variabel id ini yang dipassing ke TransaksiController dalam method getHargaProduk, disana msuk sebagai request->q
                success : function(item){
                    console.log(item.data)
                    $('#layanan').empty()
                    $.each(item.data, function(key, row){
                        console.log(row)
                        $('#layanan').append("<option value=" + row.id +">" + row.deskripsi + " - " + "Rp." + row.harga_format + "</option>")
                    })
                },
            })
        })
    </script>
@endsection