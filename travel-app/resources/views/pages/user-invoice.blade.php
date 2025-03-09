@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow-md rounded-lg mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Invoice Pembayaran</h2>

    <div class="border-t border-gray-200 pt-4">
        <p class="text-gray-700"><strong>ID Invoice:</strong> {{ $invoice->id_invoice }}</p>
        <p class="text-gray-700"><strong>Metode Pembayaran:</strong> {{ $invoice->metode }}</p>
        <p class="text-gray-700"><strong>Jumlah Bayar:</strong> Rp{{ number_format($invoice->jumlah_bayar, 0, ',', '.') }}</p>
        <p class="text-gray-700"><strong>Tanggal Bayar:</strong> {{ date('d M Y', strtotime($invoice->tanggal_bayar)) }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('customer.dashboard') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition">Kembali ke Riwayat</a>
    </div>
</div>
@endsection