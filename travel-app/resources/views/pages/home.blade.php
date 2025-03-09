@extends('layouts.app')

@section('content')
<div class="p-20 h-3/5 bg-[url('https://cdn.pixabay.com/photo/2018/08/25/18/57/city-3630634_1280.jpg')] shadow-md rounded-lg text-center items-center justify-center">
    <h1 class="text-lg font-bold text-white">Selamat Datang di <span class="font-mono text-2xl">Traveler99</span> </h1>
    <h2 class="text-5xl mt-3 font-bold text-white py-10">Let's Explore The World</h2>
    <p class="text-white text-sm">Dapatkan pengalaman liburan yang istimewa dengan harga menarik dan layanan terbaik untuk memuaskan setiap perjalanan!</p>
    <div class="grid grid-cols-1 md:grid-cols-2 font-medium mt-3 md:mt-10  gap-1 bg-slate-400 mx-2 md:mx-20 my-3 rounded-lg border border-white bg-white/75 shadow-lg shadow-black/5 saturate-200 backdrop-blur-sm">
        <div class="p-3 border border-slate-200 rounded-lg">
            <div class="flex items-center justify-center space-x-2"><svg class="w-6 h-6 text-gray-100 dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path fill-rule="evenodd" d="M11.906 1.994a8.002 8.002 0 0 1 8.09 8.421 7.996 7.996 0 0 1-1.297 3.957.996.996 0 0 1-.133.204l-.108.129c-.178.243-.37.477-.573.699l-5.112 6.224a1 1 0 0 1-1.545 0L5.982 15.26l-.002-.002a18.146 18.146 0 0 1-.309-.38l-.133-.163a.999.999 0 0 1-.13-.202 7.995 7.995 0 0 1 6.498-12.518ZM15 9.997a3 3 0 1 1-5.999 0 3 3 0 0 1 5.999 0Z" clip-rule="evenodd"/>
              </svg>
              <span class="text-gray-100 dark:text-black">Destination</span></div>
            <p class="font-light">Beritahu kami kemana anda ingin pergi</p></div>
        <div class="p-3 border border-slate-200 rounded-lg">
            <div class="flex items-center justify-center space-x-2"><svg class="w-6 h-6 text-gray-100 dark:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z"/>
              </svg>
              <span class="text-gray-100 dark:text-black">Travel Date </span></div>
            <p class="font-light">Kapan rencana perjalanan anda</p></div>
    </div>
</div>
<div class="mt-10 md:mt-5 bg-[url('https://cdn.pixabay.com/photo/2024/01/22/22/09/map-8526430_1280.jpg')] py-20 md:py-10 px-10 items-center justify-center rounded-lg">
    <h1 class="font-semibold text-xl text-white">Belum mempunyai tujuan atau bingung memilih tanggal? Mari lihat jadwal kami untuk memberikan inspirasi buat anda.</h1>
    <a href="{{ route('travel') }}" class="mt-4 px-5 py-3 font-mono font-semibold rounded-md inline-block border border-white bg-white/75 shadow-lg shadow-black/5 saturate-800 backdrop-blur-sm">
        Lihat Daftar Travel >
    </a>
</div>

@endsection
