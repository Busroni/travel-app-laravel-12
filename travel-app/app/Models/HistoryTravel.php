<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HistoryTravel extends Model
{
    use HasFactory;

    protected $table = 'history_travel';
    protected $primaryKey = 'id_history';
    public $timestamps = true;

    protected $fillable = [
        'id_user',
        'id_travel',
        'id_invoice',
        'tanggal_pesan',
        'status_bayar',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }


}
