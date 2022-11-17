@extends('layouts.main')

@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header">
                        <h4>Detail Surat Masuk</h4>
                    </div>
                    <div class="card-body" >
                        <div class="col-lg-10 col-md-7">
                            <ul class="no-margin pl-0">
                                <li style="list-style: none">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class=""></i>
                                            <strong class="margin-10px-left">Tgl Surat :</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>{{ date('d F Y', strtotime($surat->tanggal_surat)) }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                </li>
                                <li style="list-style: none">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class=""></i>
                                            <strong class="margin-10px-left">No Surat :</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>{{ $surat->no_surat }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li style="list-style: none">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class=""></i>
                                            <strong class="margin-10px-left">Klasifikasi :</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>{{ $surat->klasifikasi->kode }} ({{ $surat->klasifikasi->nama }})</p>
                                        </div>
                                    </div>
                                </li>
                                <li style="list-style: none">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class=""></i>
                                            <strong class="margin-10px-left">Asal Surat :</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>{{ $surat->asal_surat }}</p>
                                        </div>
                                    </div>
                                </li>
                                <li style="list-style: none">
                                    <div class="row">
                                        <div class="col-md-5 col-5">
                                            <i class=""></i>
                                            <strong class="margin-10px-left">Tgl Diterima :</strong>
                                        </div>
                                        <div class="col-md-7 col-7">
                                            <p>{{ date('d F Y', strtotime($surat->tanggal_diterima)) }}</p>
                                        </div>
                                    </div>
                                </li>
                                <hr>
                            </ul>
                            <h4>Deskripsi / Isi Surat</h4>
                            <p class="no-margin-bottom">{{ $surat->deskripsi }}</p>
                            <hr>
                            <div class="text-danger">*Catatan</div>
                            <h5>Keterangan : <span class="text-warning">{{ $surat->keterangan }}</span></h5>
                            <hr>

                            <strong class="float-left">File Scan :</strong>
                            <a class="btn btn-primary btn-sm float-right" href="{{ asset('storage/' . $surat->file) }}"><i class="fe fe-download fe-12"></i></a>
                            <div class="embed-responsive embed-responsive-1by1">
                                <iframe src="{{ asset('storage/' . $surat->file) }}" ></iframe>
                            </div>
                        </div>
                    </div>
                </div> <!-- .card -->
            </div>
        </div> <!-- .row -->
    </div>
</div>
@endsection
