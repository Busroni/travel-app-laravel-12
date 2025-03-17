@extends('layouts.customer')

@section('content')

<div class="max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-md">
    <h2 class="text-xl font-bold mb-4">Pembayaran Travel</h2>
    <p class="mb-2">Nomor Pesanan: <b>{{ $history->id_history }}</b></p>
    <p class="mb-2">Harga Tiket: <b>Rp {{ number_format($history->travel->harga_tiket, 0, ',', '.') }}</b></p>

    <form action="{{ route('proses.bayar', $history->id_history) }}" method="POST">
        @csrf
        <label class="block mb-2">Metode Pembayaran:</label>
        <select name="metode" class="w-full p-2 border rounded-md mb-4" required>
            <option value="Transfer Bank">Transfer Bank</option>
            <option value="E-Wallet">E-Wallet</option>
            <option value="Kartu Kredit">Kartu Kredit</option>
        </select>

        <label class="block mb-2">Jumlah Bayar:</label>
        <input type="number" name="jumlah_bayar" class="w-full p-2 border rounded-md mb-4 bg-gray-100" value="{{ $history->travel->harga_tiket }}" readonly required>

        <label class="block mb-2">Tanggal Bayar:</label>
        <input type="datetime-local" id="tanggal_bayar" name="tanggal_bayar" class="w-full p-2 border rounded-md mb-4 bg-gray-100" readonly required>

        <div class="flex items-center pt-5 mb-4">
            <input id="confirmOrder" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-900 rounded-sm focus:ring-blue-500 dark:focus:ring-blue-600">
            <label for="confirmOrder" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-800">Konfirmasi Pesanan</label>
        </div>

        <button type="submit" id="submitButton" class="w-full bg-blue-600 text-white p-2 rounded-md" disabled>
            Bayar Sekarang
        </button>
    </form>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const tanggalBayarInput = document.getElementById("tanggal_bayar");
        const confirmCheckbox = document.getElementById("confirmOrder");
        const submitButton = document.getElementById("submitButton");

        // Nonaktifkan tombol sebelum konfirmasi
        confirmCheckbox.addEventListener("change", function () {
            submitButton.disabled = !this.checked;
            if (this.checked) {
                setDateTimeNow();
            }
        });

        function setDateTimeNow() {
            const now = new Date();
            const offset = now.getTimezoneOffset();  
            now.setMinutes(now.getMinutes() - offset);  
            const localDateTime = now.toISOString().slice(0, 16);
            tanggalBayarInput.value = localDateTime;
        }
    });
</script>

@endsection
