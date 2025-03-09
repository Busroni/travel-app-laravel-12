@extends('layouts.admin')

@section('content')
    <div class="flex px-20 justify-center items-center mb-4 mt-10">
        <h1 class="text-2xl font-bold">Dashboard Admin</h1>
    </div>

    @if(session('success'))
        <div class="bg-blue-500 text-white p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <h2 class="text-xl text-center font-semibold mb-2">Jadwal Travel</h2>
    <table class="w-full bg-white shadow-md text-center rounded border-collapse">
        <thead>
            <tr class="bg-gray-200">
                <th class="p-2">No Travel</th>
                <th class="p-2">Rute</th>
                <th class="p-2">Waktu Berangkat</th>
                <th class="p-2">Harga</th>
                <th class="p-2">Kuota</th>
                <th class="p-2">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ongoingTravels as $travel)
                <tr class="border-b">
                    <td class="p-2">{{ $travel->id_travel }}</td>
                    <td class="p-2">{{ $travel->tujuan }}</td>
                    <td class="p-2">{{ date('d M Y, H:i', strtotime($travel->tanggal_berangkat)) }}</td>
                    <td class="p-2">Rp{{ number_format($travel->harga_tiket, 0, ',', '.') }}</td>
                    <td class="p-2">{{ $travel->kuota }}</td>
                    <td class="p-1 text-white grid grid-cols-1 md:grid-cols-2 gap-1">
                        <a href="{{ route('admin.travel.edit', $travel->id_travel) }}" class="p-1 rounded-md hover:bg-yellow-600 bg-yellow-500">Edit</a>
                        <form action="{{ route('admin.travel.delete', $travel->id_travel) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus travel No {{$travel->id_travel }} ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-1 text-xs w-full md:text-lg rounded-md bg-red-500 text-white hover:bg-red-700">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection