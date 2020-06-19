<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Produk;
use App\ProdukHarga;
use App\Transaksi;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FrontController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->get();
        return view('front.index', compact('produk'));
    }

    public function show($id)
    {
        $produk = Produk::where('plat', $id)->first();
        $pelanggan = Pelanggan::where('nik', request()->nik)->first();
        $produk_harga = ProdukHarga::where('produk_id', $produk->id)->get();
        // return $produk_harga;
        return view('front.show', compact('produk', 'pelanggan', 'produk_harga'));
    }

    public function pesan(Request $request)
    {
        DB::beginTransaction();
        try {
        //Ini untuk validasi form input no nik dan layanan, karena kedua form ini tidak terkena kondisi [data pelanggan yang didapat dari nik] 
            $valid = Pelanggan::where('nik', $request->nik)->first() ? true : false;
            $this->validate($request, [
                'nik' => 'required|string',
                'ktp' => [Rule::requiredIf(!$valid), 'image', 'mimes:jpg,jpeg,png'],
                'nama' => [Rule::requiredIf(!$valid), 'string', 'max:40'],
                'telepon' => [Rule::requiredIf(!$valid), 'string', 'max:12'],
                'alamat' => [Rule::requiredIf(!$valid), 'string', 'max:150'],
                'layanan' => 'required|exists:produk_harga,id', //harus ada id nya di dalam table produk_harga
                'jaminan' => 'required',
                'foto_jaminan' => 'required|image|mimes:jpg,jpeg,png',
                'tanggal_pinjam' => 'required|date|after:' . Carbon::now()->format('Y-m-d'),
                'lama_pinjam' => 'required',
            ]);

            $filename = '';
            if ($request->hasFile('ktp')) {
                $ktp_file = $request->file('ktp');
                $filename = $request->nik . '.' . $ktp_file->getClientOriginalExtension();
                $ktp_file->storeAs('public/pelanggan', $filename);
            }

            //tampung insert data pelanggan ke variabel $pelanggan , karena akan dipakai dalam proses transaksi
            //perhatikan firstOrCreate ini , ini adalah method untuk handle kalo sudah ada record ga insert(cari dulu record berdasar nik) , tapi kalo ada recordnya insert
            $pelanggan = Pelanggan::firstOrCreate(['nik' => $request->nik], [
                'foto_ktp' => $filename,
                'nama' => $request->nama,
                'notlp' => $request->telepon,
                'alamat' => $request->alamat,
            ]);

            $produk_harga = ProdukHarga::with(['produk'])->find($request->layanan);

            $user = User::first();

            if ($request->hasFile('foto_jaminan')) {
                $jaminanFile = $request->file('foto_jaminan');
                $jaminanFileName = time() . '-front-' . '.' . $jaminanFile->getClientOriginalExtension();
                $jaminanFile->storeAs('public/transaksi', $jaminanFileName);
            };

            $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
            $converterDate = $tanggalPinjam->format('Y-m-d');

            Transaksi::create([
                // 'faktur' => $faktur,
                'pelanggan_id' => $pelanggan->id,
                'jaminan' => $request->jaminan,
                'foto_jaminan' => $jaminanFileName,
                // 'tanggal_pinjam' => $tanggalPinjam->format('Y-m-d'),
                'tanggal_pinjam' => $converterDate,
                'tanggal_kembali' => $tanggalPinjam->addDays($request->lama_pinjam)->format('Y-m-d'),
                'harga' => $produk_harga->harga,
                'denda' => 0, //denda set 0 karena untuk transaksi baru belum ada denda
                'tanggal_dikembalikan' => NULL,
                'produk_id' => $produk_harga->produk->id,
                // 'user_id' => auth()->user()->id, //ambil dari session siapa yang login
                'user_id' => $user->id, //ambil dari session siapa yang login
                // 'status' =>  $status //jika tanggal pinjam sama dengan hari ini maka status = 1 jika tidak 0
                'status' =>  0 //jika tanggal pinjam sama dengan hari ini maka status = 1 jika tidak 0
            ]);
            //sampai disini kita ada masalah di bagian generate faktur dan status , yg sebelumnya di modul transaksi kita buat dengan function
            //solusinya kita buat seperti trigger di model yaitu ketika function create dari Eloquent dijalankan maka otomoatis fungsi generate faktur di jalankan dan diinsert langsung ke dalam DB
            // untuk problem di bagian user dan status kita hard code dahulu
            DB::commit();
            return redirect()->back()->with(['success' => 'Permintaan sewa layanan berhasil dikirim...']);
        } catch (\Exception $e) {
            DB::rollback();
            // return 'masuk sini';
            // return $e->getMessage();
            return redirect()->back()->with(['error' => 'Permintaan sewa gagal, silahkan hubungi CS kami']);
        }
    }
}
