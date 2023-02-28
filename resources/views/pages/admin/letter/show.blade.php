@extends('layouts.admin')

@section('title')
   Detail Surat
@endsection

@section('container')
    <main>
    <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="file-text"></i></div>
                                Detail Surat
                            </h1>
                        </div>
                        <div class="col-12 col-xl-auto mb-3">
                            <button class="btn btn-sm btn-light text-primary" onclick="javascript:window.history.back();">
                                <i class="me-1" data-feather="arrow-left"></i>
                                Kembali Ke Semua Surat
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-header-actions mb-4">
                        <div class="card-header">Detail Surat</div>
                        <div class="card-body">
                            <div class="mb-3 row">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th>Jenis Surat</th>
                                            <td>{{ $item->letter_type }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Surat</th>
                                            <td>{{ $item->letter_no }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Surat</th>
                                            <td>{{ $item->letter_date }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Kembali</th>
                                            <td>{{ $item->tanggal_kembali }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Nasabah</th>
                                            <td>{{ $item->date_received }}</td>
                                        </tr>
                                        <tr>
                                            <th>CIF</th>
                                            <td>{{ $item->regarding }}</td>
                                        </tr>
                                        <tr>
                                            <th>LD</th>
                                            <td>{{ $item->ld}}</td>
                                        </tr>
                                        <tr>
                                            <th>Dokumen</th>
                                            <td>{{ $item->perihal}}</td>
                                        </tr>
                                        <tr>
                                            <th>Unit Kerja</th>
                                            <td>{{ $item->department->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header">
                            File Surat - 
                            <a href="{{ route('download-surat', $item->id) }}" class="btn btn-sm btn-primary">  
                                <i class="fa fa-download" aria-hidden="true"></i> &nbsp; Download Surat
                            </a>
                            <button class="btn btn-sm btn-primary" onclick="window.print();">
                            <i class="me-1" data-feather="printer"></i>
                            Cetak Data
                            </button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

<script>
    function printPage() {
        window.print();
    }
</script>
