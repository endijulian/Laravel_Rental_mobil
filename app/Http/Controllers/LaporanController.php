<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Transaksi;
use PDF;

class LaporanController extends Controller
{
   public function index()
   {
       return view('laporan.index');
   }

    public function generatePDF(Request $request)
    {
        $this->validate($request, [
            'start' => 'required|date',
            'end' => 'required|date|after_or_equal:start',
        ]);
        
        
        $start = Carbon::parse($request->start)->format('Y-m-d');
        $end = Carbon::parse($request->end)->format('Y-m-d');
        $transaksi = Transaksi::selectRaw
            ('MONTH(tanggal_pinjam) AS bulan, SUM(harga + denda) as total , SUM(harga) as sewa, SUM(denda) as denda')
        ->groupBy('bulan')
        ->whereBetween('tanggal_pinjam', [$start, $end])
        ->whereIn('status', [1,2])
        ->get();
        $pdf = PDF::loadView('pdf.laporan', compact('transaksi','start', 'end'));
        // setPaper('a4', 'landscape')
        return $pdf->stream();
    }
}
