<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Transaksi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //buat awal bulan di tahun ini
        $start = Carbon::now()->startOfMonth()->format('Y-m-d');
        $end = Carbon::now()->endOfMonth()->format('Y-m-d');
        // return $start;
        $monthly = Transaksi::whereBetween('tanggal_pinjam', [$start, $end])->whereIn('status', [1,2])->get()->sum(function($item){
            return $item->harga + $item->denda;
        });
        $disewakan = Transaksi::where('status', 1)->count();
        $booking = Transaksi::where('status', 0)->count();
        $cancel = Transaksi::where('status', 3)->count();


        return view('welcome', compact(['monthly', 'disewakan', 'booking', 'cancel']));
    }


    public function getChartData()
    {
        $month = [
            [
                'month' => "Jan",
                'data' => 0
            ],
            [
                'month' => "Feb",
                'data' => 0
            ],
            [
                'month' => "Mar",
                'data' => 0
            ],
            [
                'month' => "Apr",
                'data' => 0
            ],
            [
                'month' => "May",
                'data' => 0
            ],
            [
                'month' => "Jun",
                'data' => 0
            ],
            [
                'month' => "Jul",
                'data' => 0
            ],
            [
                'month' => "Aug",
                'data' => 0
            ],
            [
                'month' => "Sep",
                'data' => 0
            ],
            [
                'month' => "Oct",
                'data' => 0
            ],
            [
                'month' => "Nov",
                'data' => 0
            ],
            [
                'month' => "Dec",
                'data' => 0
            ]
        ];

        $start = Carbon::now()->format('Y') . '-01-01';
        $end = Carbon::now()->format('Y') . '-12-31';
        $result = Transaksi::whereBetween('tanggal_pinjam', [$start, $end])->whereIn('status', [1,2])->get();
        //mapping dari hasil query ke dalam array of object yg berisi key month dan data sejumlah 12
        foreach ($result as $row) {
            $index = (int) $row->tanggal_pinjam->format('m') - 1;
            $month[$index]['data'] += $row->harga + $row->denda;
        }
        return response()->json([
            'bulan' => collect($month)->pluck('month')->all(),
            'data' => collect($month)->pluck('data')->all()
        ]);
    }


    public function profile()
    {
        return view('profile');
    }

    public function updateProfile(Request $request)
    {
       $this->validate($request, [
           'name' => 'required|string',
           'email' => 'required|email',
           'password' => 'nullable|string|min:6'
       ]);
       $user = auth()->user();
       $data = $request->only('name', 'email');
       if($request->password != '') {
           $data['password'] = bcrypt($request->password);
       }
       $user->update($data);

       return redirect()->back()->with('success', 'Profil berhasil diperbarui');
    }

    public function setting()
    {
        $setting = Setting::first();
        return view('setting', compact('setting'));
    }

    public function updateSetting(Request $request)
    {
        $this->validate($request, [
            'nama_toko' => 'required|string',
            'alamat' => 'required|string',
            'telepon' => 'required|string|min:9'
        ]);
        $user = auth()->user();
        $data = $request->only('nama_toko', 'alamat');
        if ($request->password != '') {
            $data['password'] = bcrypt($request->password);
        }
        $setting = Setting::first();
        $setting->update([
            'nama_toko' => $request->nama_toko,
            'alamat' => $request->alamat,
            'telepon' => $request->telepon,
        ]);
        return redirect()->back()->with('success', 'Setting berhasil diperbarui');
    }
}
