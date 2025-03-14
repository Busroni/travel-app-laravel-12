@extends('layouts.customer')

@section('content')
<div class="container mx-auto mt-10">
    <h2 class="text-2xl font-bold text-slate-800">Riwayat Travel Yang Telah Dipesan </h2>

    <table class="mt-4 w-full border-collapse border border-slate-300">
        <thead>
            <tr class="bg-slate-100">
                <th class="border border-slate-300 px-4 py-2">ID Travel</th>
                <th class="border border-slate-300 px-4 py-2">Tujuan</th>
                <th class="border border-slate-300 px-4 py-2">Tanggal Berangkat</th>
                <th class="border border-slate-300 px-4 py-2">Harga Tiket</th>
                <th class="border border-slate-300 px-4 py-2">Tanggal Pesan</th>
                <th class="border border-slate-300 px-4 py-2">Status Bayar</th>
                <th class="border border-slate-300 px-4 py-2">ID Invoice</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($history as $item)
                <tr class="text-center">
                    <td class="border border-slate-300 px-4 py-2">{{ $item->id_travel }}</td>
                    <td class="border border-slate-300 px-4 py-2">{{ $item->tujuan }}</td>
                    <td class="border border-slate-300 px-4 py-2">{{ $item->tanggal_berangkat }}</td>
                    <td class="border border-slate-300 px-4 py-2">Rp {{ $item->harga_tiket }}</td>
                    <td class="border border-slate-300 px-4 py-2">{{ $item->tanggal_pesan }}</td>
                    <td class="border border-slate-300 px-4 py-2 {{ $item->status_bayar === 'succes' ? 'text-green-600' : 'text-red-600' }}">
                        {{ $item->status_bayar }} </td>
                    <td class="border border-slate-300 px-4 py-2"><a href="{{ route('customer.invoice',['id' => $item->id_invoice])}}" class="px-5 rounded-md bg-green-400">Lihat Invoice</a></td>
            @endforeach
        </tbody>
    </table>

    @if ($history->isEmpty())
        <p class="text-center text-slate-500 mt-4">Tidak ada history travel.</p>
    @endif
</div>
@endsection
