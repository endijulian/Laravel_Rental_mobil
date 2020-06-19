<?php

namespace App\Http\Controllers;

use App\Pelanggan;
use App\Produk;
use App\ProdukHarga;
use App\Transaksi;
use App\MutasiPoin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
// use Barryvdh\DomPDF\PDF;
// use Barryvdh\DomPDF\Facade as PDF;
use PDF;

class TransaksiController extends Controller
{
    public function formTransaksi()
    {
        $pelanggan = Pelanggan::orderBy('nama', 'ASC')->get();
        $produk = array_filter(Produk::orderBy('varian', 'DESC')->get()->map(function( $item){
            if($item->unit_available > 0){
                return $item;
            }
        })->all());  //intinya ini memfilter si unit_available
        return view('transaksi.form', compact('pelanggan', 'produk'));
    }


    public function getHargaProduk()
    {
        $harga = ProdukHarga::where('produk_id', request()->q)->get();
        return response()->json(['status' => 'success', 'data' => $harga]);
    }


    public function saveTransaksi(Request $request)
    {
        //return $request;

        $this->validate($request, [
            'tipe_pelanggan' => 'required',
            'produk' => 'required|exists:produk,id', //exists artinya datanya harus ada di table produk, berdasar id
            'harga_layanan' => 'required|exists:produk_harga,id',
            'jaminan' => 'required',
            'foto_jaminan' => 'required|image|mimes:jpg,png,jpeg',
            'tanggal_pinjam' => 'required|date|after_or_equal:' . Carbon::now()->format('Y-m-d'),
            'lama_pinjam' => 'required',
        ]);

        //19201137
        DB::beginTransaction(); //gunakan transakstion jika ada interaksi ke lebih dari 1 tabel di database

        //disini kita akan gunakan try and catch..dan transaction 
        try {
            //PELANGGAN BARU [terima input pelanggan]
            if ($request->tipe_pelanggan == 0) {
                echo $request->file('ktp');
                $ktp_file = $request->file('ktp');
                $filename = $request->nik . '.' . $ktp_file->getClientOriginalExtension();
                $ktp_file->storeAs('public/pelanggan', $filename);

                $pelanggan = Pelanggan::create([
                    'nik' => $request->nik,
                    'foto_ktp' => $filename,
                    'nama' => $request->nama,
                    'notlp' => $request->telepon,
                    'alamat' => $request->alamat,
                ]);
            } else {
                //PELANGGAN LAMA [pilih dari list pelanggan]
                $pelanggan = Pelanggan::find($request->pelanggan);
            }
            //setelah memilih dia pelanggan lama atau baru dan semua data pelanggan sudah didapat baru kita masuk ke input transaksi

            //generate no faktur
            // $existing = Transaksi::orderBy('created_at', 'DESC')->first(); //AMBIL FAKTUR TERAKHIR YG ADA
            // $faktur = 'JD-1'; //nilai awal faktur kalo belum ada transaksi

            // if ($existing) {
            //     $explode = explode('-', $existing->faktur); //pisah berdasar - jadinya array ['JD','1']
            //     $faktur = 'JD-' . ($explode[1] + 1);  //dengan menambahkan kurng buka dan tutup bisa mengatasi masalah penjumlahan integer dan string ::amazing:)
            // }


            $jaminanFile = $request->file('foto_jaminan');
            $jaminanFileName = time().'-backend-' . '.' . $jaminanFile->getClientOriginalExtension();
            $jaminanFile->storeAs('public/transaksi', $jaminanFileName);

            $hargaLayanan = ProdukHarga::find($request->harga_layanan);
            $tanggalPinjam = Carbon::parse($request->tanggal_pinjam);
            $status = $tanggalPinjam->format('Y-m-d') == Carbon::now()->format('Y-m-d') ? 1 : 0;

            Transaksi::create([
                // 'faktur' => $faktur,
                'pelanggan_id' => $pelanggan->id,
                'jaminan' => $request->jaminan,
                'foto_jaminan' => $jaminanFileName,
                'tanggal_pinjam' => $tanggalPinjam->format('Y-m-d'),
                'tanggal_kembali' => $tanggalPinjam->addDays($request->lama_pinjam)->format('Y-m-d'),
                'harga' => $hargaLayanan->harga,
                'denda' => 0, //denda set 0 karena untuk transaksi baru belum ada denda
                'tanggal_dikembalikan' => NULL,
                'produk_id' => $request->produk,
                'user_id' => auth()->user()->id, //ambil dari session siapa yang login
                'status' =>  $status//jika tanggal pinjam sama dengan hari ini maka status = 1 jika tidak 0
            ]);

            DB::commit();
            // return redirect()->back()->with(['success' => '#' . $faktur . 'berhasil dibuat']);
            return redirect()->back()->with(['success' => 'Faktur berhasil dibuat']);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function index()
    {
        /*
        menurut saya ini adalah chaining method kalo di JS, bacanya gini 
        setelah query select * from pelanggan order by created_at desc
        kemudian langsung di chaining, jika ada request dari form pencarian maka jalankan fungsi
        yg mana hasil dari query pertama [select * from transaksi join pelanggan on transaksi.pelanggan_id = pelanggan.id order by created_at desc]
        di query lagi dengan kondisi like jadi gini [select * from transaksi join pelanggan on transaksi.pelanggan_id = pelanggan.id where transaksi.faktur like %kata pencariannya% order by created_at desc]
        Lalu karena kita menggunakan 2 table yg berelasi , maka kita chaining dengan whereHas yg artinya jika ditabel relasinya data yg kita cari ada . Maka tampilkan!

        */
        $transaksi = Transaksi::with(['pelanggan'])->orderBy('created_at', 'DESC')
            ->when(request()->q, function ($transaksi) {
                $transaksi->where('faktur', 'LIKE', '%' . request()->q . '%');
            })
            ->orWhere(function ($apaAja) {
                $apaAja->whereHas('pelanggan', function ($opoManeh) {
                    $opoManeh->where('nama', 'LIKE', '%' . request()->q . '%');
                });
            })
            ->when(request()->status, function ($transaksi){
                $status = 0;
                if (request()->status == 'pinjam') {
                    $status = 1;
                }
                elseif (request()->status == 'kembali') {
                    $status = 2;
                }
                elseif (request()->status == 'batal') {
                    $status = 3;
                } else {
                    $status;
                }
                $transaksi->where('status', $status);
            })
            ->paginate(10);
        // return $transaksi;
        return view('transaksi.index', compact('transaksi'));
    }


    public function detailTransaksi($id)
    {
        /*
        menurut saya ini adalah chaining method kalo di JS, bacanya gini 
        setelah query select * from pelanggan order by created_at desc
        kemudian langsung di chaining, jika ada request dari form pencarian maka jalankan fungsi
        yg mana hasil dari query pertama [select * from transaksi join pelanggan on transaksi.pelanggan_id = pelanggan.id order by created_at desc]
        di query lagi dengan kondisi like jadi gini [select * from transaksi join pelanggan on transaksi.pelanggan_id = pelanggan.id where transaksi.faktur like %kata pencariannya% order by created_at desc]
        Lalu karena kita menggunakan 2 table yg berelasi , maka kita chaining dengan whereHas yg artinya jika ditabel relasinya data yg kita cari ada . Maka tampilkan!

        */
        $detail = Transaksi::with(['pelanggan', 'produk'])->find($id);
        return view('transaksi.detail', compact('detail'));
    }


    public function prosesTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update(['status' => 1]);
        return redirect()->back()->with(['success' => 'Transaksi berhasil diproses !']);
    }


    public function prosesPengembalian($id)
    {
        try {
            DB::beginTransaction();
            $transaksi = Transaksi::find($id);
            //Logic buat menghitung denda berdasarkan tanggal kembali - tanggal pengembalian
            $selisihHari = Carbon::now()->diffInDays($transaksi->tanggal_kembali, false);
            // return $selisihHari;
            if ($selisihHari < 0) {
                $jumlahDenda =  $transaksi->harga * abs($selisihHari);
            } else {
                $jumlahDenda = 0;
            }
            $transaksi->update([
                'status' => 2,
                'tanggal_dikembalikan' => Carbon::now(),
                'denda' => $jumlahDenda
            ]);
            //Mutasi poin
            $transaksi->pelanggan()->update(['poin' => $transaksi->pelanggan->poin + 1]);
            MutasiPoin::create([
                'pelanggan_id' => $transaksi->pelanggan->id,
                'poin' => 1,
                'type' => 1,
                'keterangan' => $transaksi->faktur
            ]);
            DB::commit();
            return redirect()->back()->with(['success' => 'Pegembalian pinjaman berhasil diproses !']);
        } catch (\Exception $e) {
            DB::rollback();
            // return $e->getMessage();
            return redirect()->back()->with(['error' => 'Pegembalian pinjaman gagal diproses !']);
        }
    }


    public function prosesPembatalan($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->update(['status' => 3]);
        return redirect()->back()->with(['success' => 'Transaksi dibatalkan !']);
    }


    public function hapusTransaksi($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect()->back()->with(['success' => 'Transaksi dihapus !']);
    }


    public function printTransaksi($id)
    {
        $transaksi = Transaksi::with(['produk'])->find($id);
        $pdf = PDF::loadView('invoice', compact('transaksi'));
        // setPaper('a4', 'landscape')
        return $pdf->stream();
    }
}
