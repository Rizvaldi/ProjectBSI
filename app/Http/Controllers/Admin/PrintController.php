<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Letter;

class PrintController extends Controller
{
    public function index()
    {
        $item = Letter::with(['department'])->where('letter_type', 'Surat Peminjaman Recovery')->latest()->get();

        return view('pages.admin.letter.print-incoming',[
            'item' => $item
        ]);
    }

    public function outgoing()
    {
        $item = Letter::with(['department'])->where('letter_type', 'Surat Penyerahan Recovery')->latest()->get();

        return view('pages.admin.letter.print-outgoing',[
            'item' => $item
        ]);
    }

    public function anu()
    {
        $item = Letter::with(['department'])->where('letter_type', 'Surat Pelunasan')->latest()->get();

        return view('pages.admin.letter.print-anu',[
            'item' => $item
        ]);
    }

    public function apa()
    {
        $item = Letter::with(['department'])->where('letter_type', 'Surat Penyerahan AFO')->latest()->get();

        return view('pages.admin.letter.print-apa',[
            'item' => $item
        ]);
    }
}
