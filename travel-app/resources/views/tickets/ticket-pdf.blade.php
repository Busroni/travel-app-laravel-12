<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Travel</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        .card { border: 2px dashed #333; padding: 20px 0 20px 0; width: 100%; max-width: 470px; margin: auto; }
        .tiket { border: 2px dashed #333; padding: 20px; width: 100%; max-width: 400px; margin: auto; }
        .judul { font-size: 30px; font-weight: bold; color: #2f4071; margin-bottom: 10px; }
        .detail { font-size: 16px; margin: 5px 0; }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
        }
        .barcode { margin-top: 15px; width: 100%; }
    </style>
</head>
<body>
    <div class="card">
        <div class="tiket">
           <div class="judul">Traveler99 Ticket</div>
            <div class="detail">Nomor Pesanan: <b>{{ $history->id_history }}</b></div> 
        </div>
        <div class="tiket">
            <div class="detail">Nomor Travel: <b>{{ $history->id_travel }}</b></div>
            <div class="detail">Tujuan: <b>{{ $history->travel->tujuan }}</b></div>
            <div class="detail">Tanggal Berangkat: <b>{{ date('d M Y, H:i', strtotime($history->travel->tanggal_berangkat)) }}</b></div>
            <div class="detail">Harga: <b>Rp {{ number_format($history->travel->harga_tiket, 0, ',', '.') }}</b></div>

        </div>
        
        
        <!-- Barcode -->
        <div class="barcode">
            @php
                use Picqer\Barcode\BarcodeGeneratorPNG;

                $generator = new BarcodeGeneratorPNG();
                $barcodeData = $history->id_travel . '-' . $history->id_history . '#' . $history->id_user;
                $barcode = base64_encode($generator->getBarcode($barcodeData, BarcodeGeneratorPNG::TYPE_CODE_128));
            @endphp

            <img src="data:image/png;base64,{{ $barcode }}" alt="Barcode">
        </div>
    </div>
</body>
</html>
