<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaksi;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = [];
    protected $appends = 'unit_available';

    //buat method untuk menampilkan list harga berdasarkan produk id . Konsep seperti ini biasa disebut eager loading
    public function list_harga()
    {
        return $this->hasMany(ProdukHarga::class);
    }


    public function GetUnitAvailableAttribute()
    {
        $checkUnitAvailable = Transaksi::where('produk_id', $this->id)->whereIn('status', [0,1])->count();
        return $this->unit - $checkUnitAvailable;
    }
}
