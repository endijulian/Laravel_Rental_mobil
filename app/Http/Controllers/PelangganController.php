<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pelanggan;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('created_at','DESC')->when(request()->q, function($pelanggan){
            $pelanggan->where('nama', 'like', '%'. request()->q.'%')
            ->orWhere('nik', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('pelanggan.index', compact('pelanggan'));
    }
}
