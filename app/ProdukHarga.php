<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdukHarga extends Model
{
    //
    protected $table = 'produk_harga';
    protected $guarded = [];
    protected $appends =['harga_format']; //maksudnya akan memberitahu model bahwa akan ada field tersebut pada response api nya 

    public function getHargaFormatAttribute()  //ini adalah accessor , ditulis sesuai dengan format baru yg didefinisikan pada model ini yaitu harga_format 
    {
        return number_format($this->harga);
    }
}


