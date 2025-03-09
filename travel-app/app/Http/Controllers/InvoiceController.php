<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Invoice::all());
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
            'jumlah_bayar' => 'required|integer',
            'metode' => 'required|string',
            'tanggal_bayar' => 'required|date',
        ]);

        $invoice = Invoice::create($request->all());

        return response()->json($invoice, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return view('pages.user-invoice', compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'jumlah_bayar' => 'integer',
            'metode' => 'string',
            'tanggal_bayar' => 'date',
        ]);

        $invoice->update($request->all());

        return response()->json($invoice);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $id)
    {
        $invoice = Invoice::find($id);

        if (!$invoice) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $invoice->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
