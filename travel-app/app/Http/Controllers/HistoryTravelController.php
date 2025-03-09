<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\HistoryTravel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryTravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $travels = DB::table('history_travel')
        ->join('data_travel', 'history_travel.id_travel', '=', 'data_travel.id_travel')
        ->join('users', 'history_travel.id_user', '=', 'users.id_user')
        ->select(
            'history_travel.id_travel',
            'data_travel.tujuan',
            'data_travel.tanggal_berangkat',
            'data_travel.kuota',
            'data_travel.harga_tiket',
            DB::raw('STRING_AGG(users.name, \', \') as pemesan'), // Gabungkan nama pemesan
            DB::raw('COUNT(history_travel.id_user) as total_penumpang') // Hitung jumlah penumpang
        )
        ->groupBy('history_travel.id_travel', 'data_travel.tujuan', 'data_travel.tanggal_berangkat', 'data_travel.kuota','data_travel.harga_tiket')
        ->orderBy('data_travel.tanggal_berangkat', 'asc')
        ->get();


        return view('admin.history', compact('travels'));
    }

    public function userTravel(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil history travel berdasarkan id_user
        // $history = HistoryTravel::where('id_user', $user->id_user)->get();
        $history = DB::table('history_travel') 
                    ->join('data_travel', 'history_travel.id_travel', '=', 'data_travel.id_travel')
                    ->join('users', 'history_travel.id_user', '=', 'users.id_user')
                    ->select(
                        'history_travel.id_travel',
                        'history_travel.id_invoice',
                        'history_travel.tanggal_pesan',
                        'history_travel.status_bayar',  
                        'data_travel.tujuan',
                        'data_travel.tanggal_berangkat',
                        'data_travel.harga_tiket'
                    )
                    ->where('history_travel.id_user', $user->id_user) 
                    ->orderBy('data_travel.tanggal_berangkat', 'asc')
                    ->get();



        // Cek jika tidak ada data
        if ($history->isEmpty()) {
            return response()->json(['message' => 'History travel tidak ditemukan'], 404);
        }
        return view('pages.user-dashboard', compact('history'));
    }

    public function userTravelList(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil history travel berdasarkan id_user
        // $history = HistoryTravel::where('id_user', $user->id_user)->get();
        $travelist = DB::table('history_travel') 
                    ->join('data_travel', 'history_travel.id_travel', '=', 'data_travel.id_travel')
                    ->join('users', 'history_travel.id_user', '=', 'users.id_user')
                    ->select(
                        'history_travel.id_travel',
                        'history_travel.id_invoice',
                        'history_travel.tanggal_pesan',
                        'history_travel.status_bayar',  
                        'data_travel.tujuan',
                        'data_travel.tanggal_berangkat',
                        'data_travel.harga_tiket'
                    )
                    ->where('history_travel.id_user', $user->id_user)
                    ->whereDate('data_travel.tanggal_berangkat', '>=', now()) 
                    ->orderBy('data_travel.tanggal_berangkat', 'asc')
                    ->get();



        // Cek jika tidak ada data
        if ($travelist->isEmpty()) {
            return response()->json(['message' => 'History travel tidak ditemukan'], 404);
        }
        return view('pages.user-travel', compact('travelist'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_travel' => 'required|integer',
            'id_user' => 'required|integer',
            'id_invoice' => 'required|integer',
            'tanggal_pesan' => 'required|date',
            'status_bayar' => 'required|string',
        ]);

        $history_travel = HistoryTravel::create($request->all());

        return response()->json($history_travel, 201);
    }

    public function storeOrder(Request $request)
    {
        $request->validate([
            'id_travel' => 'required|integer'
        ]);

        $order = new HistoryTravel();
        $order->id_travel = $request->id_travel;
        $order->id_user = $request->id_user;
        $order->status_bayar = 'Belum Lunas';
        $order->save();

        return redirect()->route('user.history')->with('success', 'Pemesanan berhasil!');
    }


    /**
     * Display the specified resource.
     */
    public function show(HistoryTravel $id)
    {
        $history_travel = HistoryTravel::find($id);

        if (!$history_travel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($history_travel);
    }

    // public function showHistory()
    // {
    //     $orders = HistoryTravel::where('id_user', user()->id)->with('travel')->get();
    //     return view('user.history', compact('orders'));
    // }

    public function showInvoice($id_invoice)
    {
        $invoice = HistoryTravel::where('id_invoice', $id_invoice)->with(['travel', 'user'])->firstOrFail();
        return view('user.invoice', compact('invoice'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HistoryTravel $historyTravel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
    $history_travel = HistoryTravel::find($id);

    if (!$history_travel) {
        return response()->json(['message' => 'Data tidak ditemukan'], 404);
    }

    $request->validate([
        'id_travel' => 'integer',
        'id_user' => 'integer',
        'id_invoice' => 'integer',
        'tanggal_pesan' => 'date',
        'status_bayar' => 'string',
    ]);

    $history_travel->update($request->all());

    return response()->json($history_travel);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HistoryTravel $id)
    {
        $history_travel = HistoryTravel::find($id);

        if (!$history_travel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $history_travel->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
