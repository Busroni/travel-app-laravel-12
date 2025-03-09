@extends('layouts.user')

@section('content')
<div class="p-10 bg-white shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Riwayat Pemesanan</h1>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2">#</th>
                <th class="border p-2">Rute</th>
                <th class="border p-2">Tanggal Berangkat</th>
                <th class="border p-2">Harga Tiket</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $index => $order)
                <tr class="border">
                    <td class="border p-2">{{ $index + 1 }}</td>
                    <td class="border p-2">{{ $order->travel->tujuan }}</td>
                    <td class="border p-2">{{ $order->travel->tanggal_berangkat }}</td>
                    <td class="border p-2">Rp {{ number_format($order->travel->harga_tiket, 0, ',', '.') }}</td>
                    <td class="border p-2">
                        <span class="px-2 py-1 rounded {{ $order->status_bayar == 'Lunas' ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                            {{ $order->status_bayar }}
                        </span>
                    </td>
                    <td class="border p-2">
                        <a href="{{ route('user.invoice', $order->id_invoice) }}" class="bg-blue-500 text-white px-4 py-2 rounded">Cetak Invoice</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
