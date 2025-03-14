@extends('layouts.app')

@section('content')
<div class="p-6 bg-white shadow-md rounded-lg">
    <div class="items-center text-center justify-center">
        <p class="text-4xl font-bold text-slate-600 ">Daftar Travel</p>
        <p class="text-lg font-light mb-10">Tentukan tujuan dan tanggal sesuai keinginanmu</p>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="card_travel"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem("auth_token");

    console.log("Token dari LocalStorage:", token); // ✅ Debug token

    if (!token) {
        alert("Token tidak ditemukan! Harap login terlebih dahulu.");
        window.location.href = "{{ route('login') }}";
        return;
    }

    fetch("{{ url('/api/travel') }}", {
        method: "GET",
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    })
    .then(response => {
        console.log("Status Response:", response.status);
        if (!response.ok) {
            throw new Error("Gagal mengambil data, status: " + response.status);
        }
        return response.json();
    })
    .then(data => {
        console.log("Data Travel:", data);
        if (!Array.isArray(data)) {
            throw new Error("Format data tidak valid");
        }

        let cardTravel = document.getElementById("card_travel");
        cardTravel.innerHTML = ""; // Hapus konten lama sebelum menampilkan data baru

        let now = new Date();
        let upcomingTravel = data.filter(travel => new Date(travel.tanggal_berangkat) >= now);
        upcomingTravel.sort((a, b) => new Date(a.tanggal_berangkat) - new Date(b.tanggal_berangkat));

        upcomingTravel.forEach(travel => {
            let formattedDate = new Date(travel.tanggal_berangkat).toLocaleString("id-ID", {
                weekday: "long",
                year: "numeric",
                month: "long",
                day: "numeric",
                hour: "2-digit",
                minute: "2-digit"
            });

            let card = `
                <x-travel-card
                    idTravel="${travel.id_travel}" 
                    hargaTiket="${travel.harga_tiket}" 
                    tujuan="${travel.tujuan}" 
                    tanggal="${formattedDate}"
                    kuota="${travel.kuota}"
                ></x-travel-card>
            `;

            cardTravel.innerHTML += card;
        });
    })
    .catch(error => {
        console.error("Error fetching data:", error);
        alert("Gagal mengambil data perjalanan. Silakan coba lagi.");
    });
});
</script>
@endsection
