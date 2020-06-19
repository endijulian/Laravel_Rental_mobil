<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $guarded = [];
    protected static function boot(){
        parent::boot();

        static::creating(function($transaksi){
            $existing = Transaksi::orderBy('created_at', 'DESC')->first(); //AMBIL FAKTUR TERAKHIR YG ADA
            $faktur = 'JD-1'; //nilai awal faktur kalo belum ada transaksi

            if ($existing) {
                $explode = explode('-', $existing->faktur); //pisah berdasar - jadinya array ['JD','1']
                $faktur = 'JD-' . ($explode[1] + 1);  //dengan menambahkan kurng buka dan tutup bisa mengatasi masalah penjumlahan integer dan string ::amazing:)
            }
            $transaksi->faktur = $faktur;
        });
        
    }

    protected $appends = 'status_label';
    protected $dates = ['tanggal_pinjam', 'tanggal_kembali', 'tanggal_dikembalikan'];

    public function GetStatusLabelAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge badge-secondary"> Booking </span>';
        } elseif ($this->status == 1) {
            return '<span class="badge badge-warning"> Dipinjam </span>';
        } elseif ($this->status == 2) {
            return '<span class="badge badge-info"> Dikembalikan </span>';
        } elseif ($this->status == 3) {
            return '<span class="badge badge-danger"> Dibatalkan </span>';
        }
    }

    //buat method untuk eager loading dari tabel relasi pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    //buat method untuk eager loading dari tabel relasi produk
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
