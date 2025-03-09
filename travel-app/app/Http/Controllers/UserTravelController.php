<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Travel;
use App\Models\HistoryTravel;

class UserTravelController extends Controller
{
    // Menampilkan daftar travel yang tersedia
    public function showTravels()
    {
        $travels = Travel::where('kuota', '>', 0)->orderBy('tanggal_berangkat', 'asc')->get();
        return view('user.travels', compact('travels'));
    }

    // Proses pemesanan tiket
    public function storeOrder(Request $request)
    {
        $request->validate([
            'id_travel' => 'required|integer'
        ]);

        $order = new HistoryTravel();
        $order->id_travel = $request->id_travel;
        $order->id_user = auth()->user()->id;
        $order->status_bayar = 'Belum Lunas';
        $order->save();

        return redirect()->route('user.history')->with('success', 'Pemesanan berhasil!');
    }

    // Menampilkan riwayat pemesanan user
    public function showHistory()
    {
        $orders = HistoryTravel::where('id_user', auth()->user()->id)->with('travel')->get();
        return view('user.history', compact('orders'));
    }

    // Menampilkan invoice berdasarkan id_invoice
    public function showInvoice($id_invoice)
    {
        $invoice = HistoryTravel::where('id_invoice', $id_invoice)->with(['travel', 'user'])->firstOrFail();
        return view('user.invoice', compact('invoice'));
    }
}
