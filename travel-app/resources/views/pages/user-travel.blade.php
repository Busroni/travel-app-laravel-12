@extends('layouts.customer')

@section('content')
<div class="mx-auto mt-10">
    <h2 class="text-2xl text-center font-extrabold text-slate-800">Pesanan Tiket Tavel</h2>
</div>

<div class="w-full mt-20 rounded-lg bg-white border  shadow-sm ml-2">
    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b   bg-gray-50  dark:text-gray-600 " id="defaultTab" data-tabs-toggle="#defaultTabContent" role="tablist">
        <li class="me-2">
            <button id="about-tab" data-tabs-target="#about" type="button" role="tab" aria-controls="about" aria-selected="true" class="inline-block p-4 text-blue-500  hover:bg-gray-100  dark:hover:bg-gray-700 dark:text-blue-500">Pesanan Berhasil</button>
        </li>
        <li class="me-2">
            <button id="services-tab" data-tabs-target="#services" type="button" role="tab" aria-controls="services" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Belum Bayar</button>
        </li>
        <li class="me-2">
            <button id="statistics-tab" data-tabs-target="#statistics" type="button" role="tab" aria-controls="statistics" aria-selected="false" class="inline-block p-4 hover:text-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-300">Pesanan Gagal</button>
        </li>
    </ul>
    <div id="defaultTabContent">
        <div class="hidden p-2 bg-white rounded-lg  " id="about" role="tabpanel" aria-labelledby="about-tab">

            <div class="grid grid-cols-1 xl:grid-cols-3 md:grid-cols-2 gap-3 p-5 ml-3 ">
            
                @if ($success->isNotEmpty())
                    @foreach ($success as $item)
                        
                    <div class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="absolute inset-0 pointer-events-none flex items-center justify-end opacity-5 z-0">
                            <svg class=" w-40 h-40 text-gray-800 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                          </svg>
                        </div>
                        <div class="absolute mx-2 inset-0 pointer-events-none flex items-top justify-center opacity-25 font-mono z-0 text-m text-amber-200">ID PEMESANAN : {{ $item->id_history }}</div>
                        <div>
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Travel {{ $item->tujuan }}</h5>
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Nomor travel :{{ $item->id_travel }}</p>
                            <hr class="opacity-20">
                            <p class="font-normal text-gray-500 dark:text-gray-400">Keberangkatan :<b class="text-blue-200"> {{ date('d M Y, H:i', strtotime($item->tanggal_berangkat)) }} WIB</b></p>
                            <p class="font-normal text-gray-500">Tanggal pemesanan : {{ date('d M Y, H:i', strtotime($item->tanggal_pesan)) }}</p>
                            <p class="font-mono text-gray-500">Harga Tiket : Rp {{ number_format($item->harga_tiket, 0, ',', '.') }},-</p>
                            <p class="{{ $item->status_bayar === 'success' ? 'text-green-600' : 
                                        ($item->status_bayar === 'Belum Bayar' ? 'text-yellow-300' : 'text-red-600') }}"> {{ $item->status_bayar }}</p>
                            
                            @php
                                $batas_waktu = \Carbon\Carbon::parse($item->tanggal_pesan)->addHours(3);
                                $sekarang = \Carbon\Carbon::now();
                                $expired = $sekarang->greaterThan($batas_waktu);    
                            @endphp
        
                            @if ($item->status_bayar === 'success')
                            <a href="{{ route('cetak.tiket', $item->id_history) }}" class="inline-flex font-medium items-center text-green-600 hover:underline">
                                Cetak Tiket
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                            @elseif ($item->status_bayar === 'failed')
                            <button class="inline-flex font-medium items-center text-gray-400 cursor-not-allowed" disabled>
                                Pembayaran Gagal
                            </button>
                            @else
                            <p class="text-sm text-orange-500">Batas bayar: {{ $batas_waktu->format('d M Y, H:i') }}</p>
                            <a href="{{ route('bayar', $item->id_history) }}" class="inline-flex pt-2 font-medium items-center text-blue-600 hover:underline">
                                Bayar Sekarang
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                            
                            @endif
        
                        </div>
                    </div>     
                    
                    @endforeach
                @else
                    <p class="text-gray-500">Tidak ada tiket yang berhasil.</p>
                @endif
                
    
                </div>
            </div>

        </div>
        <div class="hidden p-2 bg-white rounded-lg  " id="services" role="tabpanel" aria-labelledby="services-tab">
            
            <div class="grid grid-cols-1 xl:grid-cols-3 md:grid-cols-2 gap-3 p-5 ml-3">
            
                @if ($belumBayar->isNotEmpty())
                    @foreach ($belumBayar as $item)
                    
                    <div class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="absolute inset-0 pointer-events-none flex items-center justify-end opacity-5 z-0">
                            <svg class=" w-40 h-40 text-gray-800 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                          </svg>
                        </div>
                        <div class="absolute mx-2 inset-0 pointer-events-none flex items-top justify-center opacity-25 font-mono z-0 text-m text-amber-200">ID PEMESANAN : {{ $item->id_history }}</div>
                        <div>
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Travel {{ $item->tujuan }}</h5>
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Nomor travel :{{ $item->id_travel }}</p>
                            <hr class="opacity-20">
                            <p class="font-normal text-gray-500 dark:text-gray-400">Keberangkatan :<b class="text-blue-200"> {{ date('d M Y, H:i', strtotime($item->tanggal_berangkat)) }} WIB</b></p>
                            <p class="font-normal text-gray-500">Tanggal pemesanan : {{ date('d M Y, H:i', strtotime($item->tanggal_pesan)) }}</p>
                            <p class="font-mono text-gray-500">Harga Tiket : Rp {{ number_format($item->harga_tiket, 0, ',', '.') }},-</p>
                            <p class="{{ $item->status_bayar === 'success' ? 'text-green-600' : 
                                        ($item->status_bayar === 'Belum Bayar' ? 'text-yellow-300' : 'text-red-600') }}"> {{ $item->status_bayar }}</p>
                            
                            @php
                                $batas_waktu = \Carbon\Carbon::parse($item->tanggal_pesan)->addHours(3);
                                $sekarang = \Carbon\Carbon::now();
                                $expired = $sekarang->greaterThan($batas_waktu);    
                            @endphp
        
                            @if ($item->status_bayar === 'success')
                            <a href="{{ route('cetak.tiket', $item->id_history) }}" class="inline-flex font-medium items-center text-green-600 hover:underline">
                                Cetak Tiket
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                            @elseif ($item->status_bayar === 'failed')
                            <button class="inline-flex font-medium items-center text-gray-400 cursor-not-allowed" disabled>
                                Pembayaran Gagal
                            </button>
                            @else
                            <p class="text-sm text-orange-500">Batas bayar: {{ $batas_waktu->format('d M Y, H:i') }}</p>
                            <a href="{{ route('bayar', $item->id_history) }}" class="inline-flex pt-2 font-medium items-center text-blue-600 hover:underline">
                                Bayar Sekarang
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                            
                            @endif
        
                        </div>
                    </div>     
                    
                    @endforeach
                @else
                    <p class="text-gray-500">Tidak ada tiket yang belum dibayar.</p>
                @endif
    
                </div>
            
        </div>
        <div class="hidden p-2 bg-white rounded-lg  " id="statistics" role="tabpanel" aria-labelledby="statistics-tab">
             
            <div class="grid grid-cols-1 xl:grid-cols-3 md:grid-cols-2 gap-3 p-5 ml-3">
    
                @if ($failed->isNotEmpty())
                    @foreach ($failed as $item)
                        
                    <div class="relative max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">
                        <div class="absolute inset-0 pointer-events-none flex items-center justify-end opacity-5 z-0">
                            <svg class=" w-40 h-40 text-gray-800 dark:text-blue-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M5.617 2.076a1 1 0 0 1 1.09.217L8 3.586l1.293-1.293a1 1 0 0 1 1.414 0L12 3.586l1.293-1.293a1 1 0 0 1 1.414 0L16 3.586l1.293-1.293A1 1 0 0 1 19 3v18a1 1 0 0 1-1.707.707L16 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L12 20.414l-1.293 1.293a1 1 0 0 1-1.414 0L8 20.414l-1.293 1.293A1 1 0 0 1 5 21V3a1 1 0 0 1 .617-.924ZM9 7a1 1 0 0 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Zm0 4a1 1 0 1 0 0 2h6a1 1 0 1 0 0-2H9Z" clip-rule="evenodd"/>
                        </svg>
                        </div>
                        <div class="absolute mx-2 inset-0 pointer-events-none flex items-top justify-center opacity-25 font-mono z-0 text-m text-amber-200">ID PEMESANAN : {{ $item->id_history }}</div>
                        <div>
                            <h5 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Travel {{ $item->tujuan }}</h5>
                            <p class="mb-2 text-gray-500 dark:text-gray-400">Nomor travel :{{ $item->id_travel }}</p>
                            <hr class="opacity-20">
                            <p class="font-normal text-gray-500 dark:text-gray-400">Keberangkatan :<b class="text-blue-200"> {{ date('d M Y, H:i', strtotime($item->tanggal_berangkat)) }} WIB</b></p>
                            <p class="font-normal text-gray-500">Tanggal pemesanan : {{ date('d M Y, H:i', strtotime($item->tanggal_pesan)) }}</p>
                            <p class="font-mono text-gray-500">Harga Tiket : Rp {{ number_format($item->harga_tiket, 0, ',', '.') }},-</p>
                            <p class="{{ $item->status_bayar === 'success' ? 'text-green-600' : 
                                        ($item->status_bayar === 'Belum Bayar' ? 'text-yellow-300' : 'text-red-600') }}"> {{ $item->status_bayar }}</p>
                            
                            @php
                                $batas_waktu = \Carbon\Carbon::parse($item->tanggal_pesan)->addHours(3);
                                $sekarang = \Carbon\Carbon::now();
                                $expired = $sekarang->greaterThan($batas_waktu);    
                            @endphp
    
                            @if ($item->status_bayar === 'success')
                            <a href="{{ route('cetak.tiket', $item->id_history) }}" class="inline-flex font-medium items-center text-green-600 hover:underline">
                                Cetak Tiket
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                            @elseif ($item->status_bayar === 'failed')
                            <button class="inline-flex font-medium items-center text-gray-400 cursor-not-allowed" disabled>
                                Pembayaran Gagal
                            </button>
                            @else
                            <p class="text-sm text-orange-500">Batas bayar: {{ $batas_waktu->format('d M Y, H:i') }}</p>
                            <a href="{{ route('bayar', $item->id_history) }}" class="inline-flex pt-2 font-medium items-center text-blue-600 hover:underline">
                                Bayar Sekarang
                                <svg class="w-3 h-3 ms-2.5 rtl:rotate-[270deg]" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11v4.833A1.166 1.166 0 0 1 13.833 17H2.167A1.167 1.167 0 0 1 1 15.833V4.167A1.166 1.166 0 0 1 2.167 3h4.618m4.447-2H17v5.768M9.111 8.889l7.778-7.778"/>
                                </svg>
                            </a>
                            
                            @endif
    
                        </div>
                    </div>     
    
                    @endforeach
                @else
                    <p class="text-gray-500">Tidak ada tiket yang gagal.</p>
                @endif
    
              </div>

        </div>
    </div>
</div>


@endsection
