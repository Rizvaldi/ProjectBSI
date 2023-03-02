<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\Letter;
use App\Models\Sender;

use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class LetterController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $departments = Department::all();
        

        return view('pages.admin.letter.create',[
            'departments' => $departments,
            
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'tanggal_kembali' => '',
            'date_received' => 'required',
            'regarding' => 'required',
            'ld' => 'required',
            'perihal' => 'required',
            'department_id' => 'required',
            'letter_file' => 'mimes:pdf, png, jpg|file',
            'letter_type' => 'required',
        ]);

        if($request->file('letter_file')){
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Peminjaman Recovery') {
            $redirect = 'surat-peminjaman-recovery';
        } elseif ($validatedData['letter_type'] == 'Surat Penyerahan Recovery') {
            $redirect = 'surat-penyerahan-recovery';
        } elseif ($validatedData['letter_type'] == 'Surat Pelunasan') {
            $redirect = 'surat-pelunasan';
        } elseif ($validatedData['letter_type'] == 'Surat Penyerahan AFO') {
            $redirect = 'surat-penyerahan-afo';
        } else {
            $redirect = 'surat-permohonan-appraisal';
        }



        Letter::create($validatedData);

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Disimpan');
    }

    public function incoming_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department'])->where('letter_type', 'Surat Peminjaman Recovery')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.incoming');
    }

    public function outgoing_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department'])->where('letter_type', 'Surat Penyerahan Recovery')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.outgoing');
    }

    public function anu_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department'])->where('letter_type', 'Surat Pelunasan')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.anu');
    }

    public function apa_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department'])->where('letter_type', 'Surat Penyerahan AFO')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.apa');
    }

    public function appraisal_mail()
    {
        if (request()->ajax()) {
            $query = Letter::with(['department'])->where('letter_type', 'Surat Permohonan Appraisal')->latest()->get();

            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <a class="btn btn-success btn-xs" href="' . route('detail-surat', $item->id) . '">
                            <i class="fa fa-search-plus"></i> &nbsp; Detail
                        </a>
                        <a class="btn btn-primary btn-xs" href="' . route('letter.edit', $item->id) . '">
                            <i class="fas fa-edit"></i> &nbsp; Ubah
                        </a>
                        <form action="' . route('letter.destroy', $item->id) . '" method="POST" onsubmit="return confirm('."'Anda akan menghapus item ini dari situs anda?'".')">
                            ' . method_field('delete') . csrf_field() . '
                            <button class="btn btn-danger btn-xs">
                                <i class="far fa-trash-alt"></i> &nbsp; Hapus
                            </button>
                        </form>
                    ';
                })
                ->editColumn('post_status', function ($item) {
                   return $item->post_status == 'Published' ? '<div class="badge bg-green-soft text-green">'.$item->post_status.'</div>':'<div class="badge bg-gray-200 text-dark">'.$item->post_status.'</div>';
                })
                ->addIndexColumn()
                ->removeColumn('id')
                ->rawColumns(['action','post_status'])
                ->make();
        }

        return view('pages.admin.letter.appraisal');
    }

    public function show($id)
    {
        $item = Letter::with(['department'])->findOrFail($id);

        return view('pages.admin.letter.show',[
            'item' => $item,
        ]);
    }

    public function edit($id)
    {
        $item = Letter::findOrFail($id);
        $departments = Department::all();
        

        return view('pages.admin.letter.edit',[
            'departments' => $departments,
            'item' => $item,
        ]);
    }

    public function download_letter($id)
    {
        $item = Letter::findOrFail($id);

        return Storage::download($item->letter_file);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'letter_no' => 'required',
            'letter_date' => 'required',
            'tanggal_kembali' => '',
            'date_received' => 'required',
            'regarding' => 'required',
            'ld' => 'required',
            'perihal' => 'required',
            'department_id' => 'required',
            'letter_file' => 'mimes:pdf|file',
            'letter_type' => 'required',
        ]);

        $item = Letter::findOrFail($id);

        if($request->file('letter_file')){
            $validatedData['letter_file'] = $request->file('letter_file')->store('assets/letter-file');
        }

        if ($validatedData['letter_type'] == 'Surat Peminjaman Recovery') {
            $redirect = 'surat-peminjaman-recovery';
        } elseif ($validatedData['letter_type'] == 'Surat Penyerahan Recovery') {
            $redirect = 'surat-penyerahan-recovery';
        } elseif ($validatedData['letter_type'] == 'Surat Pelunasan') {
            $redirect = 'surat-pelunasan';
        } elseif ($validatedData['letter_type'] == 'Surat Penyerahan AFO') {
            $redirect = 'surat-penyerahan-afo';
        } else {
            $redirect = 'surat-permohonan-appraisal';
        }

        $item->update($validatedData);

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $item = Letter::findorFail($id);

         if ($item->letter_type == 'Surat Peminjaman Recovery') {
            $redirect = 'surat-peminjaman-recovery';
        } elseif ($item->letter_type == 'Surat Penyerahan Recovery') {
            $redirect = 'surat-penyerahan-recovery';
        } elseif ($item->letter_type == 'Surat Pelunasan') {
            $redirect = 'surat-pelunasan';
        } elseif ($item-> letter_type == 'Surat Penyerahan AFO') {
            $redirect = 'surat-penyerahan-afo';
        } else {
            $redirect = 'surat-permohonan-appraisal';
        }


        

        Storage::delete($item->letter_file);

        $item->delete();

        return redirect()
                    ->route($redirect)
                    ->with('success', 'Sukses! 1 Data Berhasil Dihapus');
    }
}
