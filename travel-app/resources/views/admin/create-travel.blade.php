@extends('layouts.admin')

@section('title', 'Tambah Travel')

@section('content')
<div class="p-20 shadow-lg rounded-lg">
    <h1 class="text-2xl font-bold mb-4">Tambah Jadwal Travel</h1>

    <form action="{{ route('admin.travel.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold">Tujuan</label>
            <input type="text" name="tujuan" class="w-full p-2 border rounded" required>
        </div>
        
        <div class="mb-4">
            <label class="block font-semibold">Waktu Berangkat</label>
            <input type="datetime-local" name="tanggal_berangkat" class="w-full p-2 border rounded" required>
        </div>

        <div class="mb-4">
            <label class="block font-semibold">Harga</label>
            <input type="number" name="harga_tiket" class="w-full p-2 border rounded" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold">Kuota</label>
            <input type="number" name="kuota" class="w-full p-2 border rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Jadwal</button>
    </form>
</div>
@endsection
