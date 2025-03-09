<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoice';
    protected $primaryKey = 'id_invoice';
    public $timestamps = true;

    protected $fillable = [
        'jumlah_bayar',
        'metode',
        'tanggal_bayar'
    ];
}
