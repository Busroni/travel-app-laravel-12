<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory;

    protected $table = 'data_travel';
    protected $primaryKey = 'id_travel';
    public $timestamps = true;

    protected $fillable = [
        'tujuan',
        'tanggal_berangkat',
        'kuota',
        'harga_tiket',
    ];

    public function history()
    {
        return $this->hasMany(HistoryTravel::class, 'id_travel');
    }

}


