<?php

namespace App\Http\Controllers;

use App\MutasiPoin;
use Illuminate\Http\Request;
use App\Pelanggan;
use App\Reward;
use Illuminate\Support\Facades\DB;

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

    public function show($id)
    {
        $pelanggan = Pelanggan::with(['mutasi'])->find($id);
        // return $pelanggan;
        $rewards = Reward::orderBy('created_at','DESC')->where('status', 1)->get();
        return view('pelanggan.detail', compact('pelanggan','rewards'));
    }

    public function update(Request $request, $id)
    {
        //biasakan jika ada interaksi lebih dari satu table gunakan try and catch serta transaction DB
        DB::beginTransaction();
        try {
            //dapatkan poin yg dimiliki pelanggan
            $pelanggan = Pelanggan::find($id);
            // return $pelanggan;
            //ambil record reward yg sesuai dari list select request yang dipilih
            $reward = Reward::find($request->rewards);
            // return $reward;
            //bandingkan , apakah poinnya cukup
            if ($pelanggan->poin >= $reward->poin) {
                //kita update poin pelanggan dengan hasil pengurangan poin sebelumnya dikurang rewards
                $pelanggan->update([
                    'poin' => ($pelanggan->poin - $reward->poin)
                ]);
                //catat di tabel mutasi poin
                MutasiPoin::create([
                    'pelanggan_id' => $pelanggan->id,
                    'poin' => $reward->poin,
                    'type' => 0,
                    'keterangan' => 'Menukarkan reward '.$reward->title
                ]);
                DB::commit();
                return redirect()->back()->with(['success' => 'Penukaran reward berhasil']);
            }
            return redirect()->back()->with(['error' => 'Poin anda tidak mencukupi']);
            
        } catch(\Exception $e) {
            return $e->getMessage();
            DB::rollBack();
            
        }
    }
}
