<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Travel;
use Illuminate\Http\Request;

class TravelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $now = Carbon::now();

        $ongoingTravels = Travel::where('tanggal_berangkat', '>=', $now)
            ->orderBy('tanggal_berangkat', 'asc')
            ->get();

        $finishedTravels = Travel::where('tanggal_berangkat', '<', $now)
            ->orderBy('tanggal_berangkat', 'desc')
            ->get();

        return view('admin.dashboard', compact('ongoingTravels', 'finishedTravels'));
    }

    public function apiIndex()
    {
        return response()->json(Travel::all());
        return view('pages.travel', compact('travels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create-travel');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tujuan' => 'required|string',
            'tanggal_berangkat' => 'required|date',
            'kuota' => 'required|integer',
            'harga_tiket' => 'required|integer',
        ]);

        Travel::create($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal travel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Travel $id)
    {
        $travel = Travel::find($id);

        if (!$travel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json($travel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $travel = Travel::findOrFail($id);
        return view('admin.edit-travel', compact('travel'));

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $travel = Travel::find($id);

        if (!$travel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'tujuan' => 'string',
            'tanggal_berangkat' => 'date',
            'kuota' => 'integer',
            'harga_tiket' => 'integer',
        ]);

        $travel = Travel::findOrFail($id);
        $travel->update($request->all());

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal travel berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $travel = Travel::where('id_travel', $id)->first();

        if (!$travel) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $travel->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Jadwal travel berhasil dihapus!');
    }
}
