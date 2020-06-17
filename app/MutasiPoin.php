<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MutasiPoin extends Model
{
    protected $guarded = [];
    protected $table = 'mutasi_poin';
    protected $appends = ['type_label'];

    public function GetTypeLabelAttribute()
    {
        if ($this->type == 0) {
            return '<label class="badge badge-danger">Poin berkurang</label>';
        }
        return '<label class="badge badge-success">Poin bertambah</label>';
    }
}
