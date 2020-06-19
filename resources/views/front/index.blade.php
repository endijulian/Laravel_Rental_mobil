@extends('layouts.frontend')

@section('title')
    <title>Katalog - {{$site_setting->nama_toko}}</title>
@endsection


@section('content')
    <main role="main">
            
            <section class="jumbotron text-center">
                <div class="container">
                    <h1 class="jumbotron-heading">Katalog Kendaraan Rental</h1>
                    <p class="lead text-muted">Nikmati kemudahan layanan sewa kendaraan </p>
                </div>
            </section>

            
                <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row">
                        @foreach ($produk as $p)
                        <div class="col-md-4">
                            <div class="card mb-4 box-shadow">
                                <img class="card-img-top" src="{{  asset('storage/produk/' .$p->gambar) }}" width="200px" height="200px" alt="Card image cap">
                                <div class="card-body">
                                    <p class="card-text">
                                        <strong>Varian : </strong>      {{$p->varian }} <br>
                                        <strong>Merk : </strong>        {{$p->merk }} <br>
                                        <strong>No. Polisi : </strong>  {{$p->plat }}
                                    </p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <a href="{{url('/katalog/'. $p->plat)}}" class="btn btn-sm btn-outline-secondary">Detail </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </main>
@endsection
