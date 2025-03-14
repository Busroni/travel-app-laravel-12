@extends('layouts.customer')

@section('content')
<div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold text-gray-700 mb-4">Tambah Pesanan Travel</h2>
    <form id="orderForm">
        @csrf
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600">ID Travel</label>
            <input disabled type="number" name="id_travel" id="id_travel" value="" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
        
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600">ID User</label>
            <input type="number" name="id_user" id="id_user" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-4">
            <input hidden type="number" value='0' name="id_invoice" id="id_invoice" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
            <input hidden name="status_bayar" value="Belum Bayar" id="status_bayar" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400"></input>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-600">Tanggal Pesan</label>
            <input type="date" name="tanggal_pesan" id="tanggal_pesan" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>


        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">Tambah Pesanan</button>
    </form>
</div>

<script>
document.getElementById("orderForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = {
        id_travel: document.getElementById("id_travel").value,
        id_user: document.getElementById("id_user").value,
        id_invoice: document.getElementById("id_invoice").value,
        tanggal_pesan: document.getElementById("tanggal_pesan").value,
        status_bayar: document.getElementById("status_bayar").value
    };

    fetch("{{ url('/api/history_travel') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Authorization": "Bearer " + localStorage.getItem("auth_token"),
            "Accept": "application/json"
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        console.log("Response:", data);
        alert("Pesanan berhasil ditambahkan!");
        location.reload();
    })
    .catch(error => console.error("Error:", error));
});
</script>

@endsection
