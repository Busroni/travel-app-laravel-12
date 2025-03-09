@extends('layouts.admin')

@section('content')
<div class="p-10 bg-white shadow-lg rounded-lg mt-10">
    <h1 class="text-2xl font-bold mb-4">History Travel</h1>
    <table class="w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border p-2 text-xs">NO Travel</th>
                <th class="border p-2">Rute</th>
                <th class="border p-2">Tanggal Berangkat</th>
                <th class="border p-2">Harga Tiket</th>
                <th class="border p-2">Dipesan Oleh</th>
                <th class="border p-2">Total Penumpang</th>
            </tr>
        </thead>
        <tbody>
            @forelse($travels as $index => $travel)
                <tr class="border">
                    <td class="border p-2">{{ $travel->id_travel }}</td>
                    <td class="border p-2">{{ $travel->tujuan }}</td>
                    <td class="border p-2">{{ $travel->tanggal_berangkat }}</td>
                    <<td class="border p-2">Rp {{ number_format($travel->harga_tiket, 0, ',', '.') }}</td>
                    <td class="border p-2">{{ $travel->pemesan }}</td>
                    <td class="border p-2">{{ $travel->total_penumpang }} Penumpang dari Kuota : {{ $travel->kuota }}</td> 
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4">Tidak ada history travel</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
