<?php

namespace App\View\Components;

use Closure;
use App\Models\Travel;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TravelCard extends Component
{
    /**
     * Create a new component instance.
     */
    public $tujuan, $tanggal, $kuota, $hargaTiket ;

    public function __construct($tujuan, $tanggal, $kuota, $hargaTiket )
    {
        $this->tujuan = $tujuan;
        $this->tanggal = $tanggal;
        $this->kuota = $kuota;
        $this->hargaTiket = $hargaTiket;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.travel-card');
    }
}
