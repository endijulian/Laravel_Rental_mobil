<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $guarded = [];
    protected $appends = ['poin_terpakai'];

    public function mutasi(){
        return $this->hasMany(MutasiPoin::class);
    }

    public function GetPoinTerpakaiAttribute()
    {
        return $this->mutasi->sum(function($item){
            if ($item->type == 0) {
                return $item->poin;
            }
            return 0;
        });
    }

}
