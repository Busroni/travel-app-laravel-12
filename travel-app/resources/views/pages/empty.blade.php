@extends('layouts.customer')

@section('content')
    <div class="container text-center mt-20">
        <h2 class="text-2xl font-black">History Travel Tidak Ditemukan</h2>
        <p class="mt-5">Anda belum memiliki riwayat travel bersama kami.</p>
        <a href="{{ route('customer.add-travel') }}">
            <button class="bg-slate-500 text-white px-10 py-5 mt-10 rounded-lg hover:bg-blue-950">
            Pesan Tiket Sekarang
            </button>
        </a>
    </div>
@endsection
