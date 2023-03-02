<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letter;

class DashboardController extends Controller
{
    public function index()
    {
        $masuk = Letter::where('letter_type', 'Surat Peminjaman Recovery')->get()->count();
        $keluar = Letter::where('letter_type', 'Surat Penyerahan Recovery')->get()->count();
        $anu = Letter::where('letter_type', 'Surat Pelunasan')->get()->count();
        $apa = Letter::where('letter_type', 'Surat Penyerahan AFO')->get()->count();
        $appraisal = Letter::where('letter_type', 'Surat Permohonan Appraisal')->get()->count();
        

        return view('pages.admin.dashboard',[
            'masuk' => $masuk,
            'keluar' => $keluar,
            'anu' => $anu,
            'apa' => $apa,
            'appraisal' => $appraisal
        ]);
    }
}
