@extends('layouts.customer')

@section('content')

<div class="mt-5 p-10 items-center ">
    <div class="text-4xl font-black text-blue-950 text-center">Pesan Tiket Travel Sesuai Kebutuhan Anda</div>
</div>

<div class="grid grid-cols-2 xl:grid-cols-4 md:grid-cols-3 gap-3 p-5">
    @foreach ($ongoingTravels as $travel)
        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-lg">
            <img class="rounded-t-lg" src="/docs/images/blog/image-1.jpg" alt="" />
            <div class="p-5">
                <h1>Nomor Travel: {{ $travel->id_travel }}</h1>
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">{{ $travel->tujuan }}</h5>
                <h2 class="text-gray-500">{{ date('d M Y, H:i', strtotime($travel->tanggal_berangkat)) }}</h2>
                <div class="my-3 font-mono font-semibold text-gray-700 text-xl flex">
                    <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M8 7V6a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1M3 18v-7a1 1 0 0 1 1-1h11a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1Zm8-3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                    Rp{{ number_format($travel->harga_tiket, 0, ',', '.') }}
                </div>
                <h3>Kuota tersisa: {{ $travel->sisa_kuota }}</h3>

                @if($travel->sisa_kuota > 0)
                
                <button class="openModalBtn mt-3 inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800"
                data-id="{{ $travel->id_travel }}"
                data-tujuan="{{ $travel->tujuan }}"
                data-tanggal="{{ date('d M Y, H:i', strtotime($travel->tanggal_berangkat)) }}"
                data-harga="{{ number_format($travel->harga_tiket, 0, ',', '.') }}">
                    Pesan Tiket
                </button>

                @else
                    <button disabled class="bg-gray-400 text-white px-4 py-2 rounded-md">Kuota Habis</button>
                @endif

            </div>
        </div>
    @endforeach
</div>

<!-- Modal -->
<div id="modal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 data-[hidden=true]:hidden" data-hidden="true" >
    <div class="bg-white max-w-lg w-full p-6 rounded-lg shadow-lg relative">
        <button id="closeModal" class="absolute top-3 right-3 text-gray-500 hover:text-red-500">&times;</button>
        <h2 id="modalTitle" class="text-xl font-bold text-gray-700 mb-4">Pesan Tiket Travel</h2>
        <hr>
        <form id="orderForm" class="pt-5">
            @csrf
            <div class="mb-4">
                <div id="nomor_travel">Nomor Travel</div>
                <div id="tanggal_travel">Waktu Berangkat</div>
                <div id="harga">Waktu Berangkat</div>
                
            </div>

            <input hidden type="number" name="id_travel" id="id_travel" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            <input hidden type="number" value="{{ Auth::id() }}" name="id_user" id="id_user"  required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            <input hidden type="number" value='0' name="id_invoice" id="id_invoice">
            <input hidden name="status_bayar" value="Belum Bayar" id="status_bayar">
            <input hidden type="datetime-local" name="tanggal_pesan" id="tanggal_pesan" required class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-400">
            <button type="submit" class="w-full mt-10 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Buat Pesanan
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("modal");
    const closeModalBtn = document.getElementById("closeModal");
    const form = document.getElementById("orderForm");
    const idTravelInput = document.getElementById("id_travel");
    const modalContent = modal.querySelector(".bg-white");

    // Tangani event saat tombol "Pesan Tiket" diklik
    document.querySelectorAll(".openModalBtn").forEach(button => {
        button.addEventListener("click", function () {
            setDateTimeNow();
            const travelId = this.getAttribute("data-id"); // Ambil ID dari data-id
            const travelTujuan = this.getAttribute("data-tujuan");
            const travelTanggal = this.getAttribute("data-tanggal");
            const travelHarga = this.getAttribute("data-harga");
            

            idTravelInput.value = travelId; // Masukkan ID ke dalam input
            modalTitle.textContent = `Pesan tiket travel ${travelTujuan}`;
            nomor_travel.textContent = `Nomor travel : ${travelId}`;
            harga.textContent = `Harga tiket : Rp${travelHarga},-`;
            tanggal_travel.textContent = `Tanggal keberangkatan travel : ${travelTanggal}`;
            modal.setAttribute("data-hidden", "false");
        });
    });

    const tanggalPesanInput = document.getElementById("tanggal_pesan");

    function setDateTimeNow() {
        const now = new Date();
        const offset = now.getTimezoneOffset();  
        now.setMinutes(now.getMinutes() - offset);  
        const localDateTime = now.toISOString().slice(0, 16);
        tanggalPesanInput.value = localDateTime;
    }

    // Tutup modal
    closeModalBtn.addEventListener("click", function () {
        modal.setAttribute("data-hidden", "true");
    });
    modal.addEventListener("click", function (event) {
        if (!modalContent.contains(event.target)) {
            modal.setAttribute("data-hidden", "true");
        }
    });

    // Handle submit form
    form.addEventListener("submit", function (event) {
        event.preventDefault();
        let formData = new FormData(form);

        fetch("/customer/add-new-travel", {
            method: "POST",
            headers: { "Accept": "application/json" },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Pesanan berhasil ditambahkan!");
                modal.classList.add("hidden");
                form.reset();
                window.location.href = "/customer/dashboard";
            } else {
                alert(data.message || "Gagal menambahkan pesanan!");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Terjadi kesalahan!");
        });
    });
});
</script>


@endsection
