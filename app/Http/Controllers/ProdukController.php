<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\ProdukHarga;
use File;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->when(request()->q, function($produk){
            $produk->where('varian' ,'LIKE', '%' . request()->q . '%')
            ->orWhere('merk' ,'LIKE', '%' . request()->q . '%')
            ->orWhere('plat' ,'LIKE', '%' . request()->q . '%');
        })->paginate(5);
        return view('produk.index', compact('produk'));
    }

    public function tambah()
    {
        return view('produk.tambah');
    }

    public function simpan(Request $request)
    {
        $this->validate($request, [
            'varian'=>'required|string|max:50',
            'merk'=>'required|string|max:50',
            'plat'=>'required|string|max:50',
            'unit'=>'required|integer',
            'gambar'=>'required|image|mimes:png,jpg,jpeg'
        ]);

        //handle file gambar
        $filename = '';
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = request('plat').'now'.'.'.$file->getClientOriginalExtension();
            $file->storeAs('public/produk', $filename);
        }

        //insert into produk
        Produk::create([
            'varian'=> $request->varian,
            'merk'=> $request->merk,
            'plat'=> $request->plat,
            'unit'=> $request->unit,
            'gambar'=> $filename
        ]);
        return redirect('admin/produk')->with(['success'=>'Produk berhasil ditambahkan']);
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('produk.edit', compact('produk'));
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::find($id);
        
        $this->validate($request, [
            'varian' => 'required|string|max:50',
            'merk' => 'required|string|max:20',
            'plat' => 'required|string|max:10|unique:produk,plat,' .$id ,
            'unit' => 'required|integer',
            'gambar' => 'nullable|image|mimes:png,jpg,jpeg'
        ]);

        $produk = Produk::find($id);
        $filename = $produk->gambar;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = request('plat') .now(). '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/produk', $filename);
            File::delete(storage_path('app/public/produk/' .$produk->gambar));
        }
        

        $produk->update([   
            'varian' => $request->varian,
            'merk' => $request->merk,
            'plat' => $request->plat,
            'unit' => $request->unit,
            'gambar' => $filename
        ]);
        return redirect('admin/produk')->with(['success' => 'Produk berhasil diubah']);

    }

    public function hapus($id)
    {
        $produk = Produk::find($id);
        $produk->delete();
        return redirect('admin/produk')->with(['success' => 'Produk berhasil dihapus']);
    }


    public function formharga($id)
    {
        $produk = Produk::with(['list_harga'])->find($id);
        // return $produk;
        return view('produk.harga', compact('produk'));
    }

    public function tambahharga(Request $request,  $id)
    {
        
        $this->validate($request, [
            'deskripsi' => 'required|string|max:100',
            'harga' => 'required|integer'
        ]);

        
        ProdukHarga::create([
            'produk_id' => $id,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga
        ]);
        
        return redirect()->back()->with(['success' => 'Data berhasil ditambah']);
    }

    public function hapusHarga($id){
        $harga = ProdukHarga::find($id);
        $harga->delete();
        return redirect()->back()->with(['success' => 'Data berhasil dihapus']);
    }
    
}
