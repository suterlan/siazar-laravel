@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h4>Detail Calon Siswa</h4>
                    </div>
                    <div class="card-body pb-0">
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <h6><span class="fe fe-user text-primary"></span> PROFIL CALON SISWA</h6>
                                <div class="row ml-3">
                                    <div class="col-sm-3 md-4">Nama</div>
                                    <div class="col-sm-1 md-1">:</div>
                                    <div class="col-sm-8 md-7">{{ $ppdb->nama_siswa }}</div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <h6><span class="fe fe-file-text text-primary"></span> DATA PENDIDIKAN CALON SISWA</h6>
                                <div class="row ml-3">
                                    <div class="col-sm-3 md-4">Nama</div>
                                    <div class="col-sm-1 md-1">:</div>
                                    <div class="col-sm-8 md-7">Suterlan</div>
                                </div>
                            </div>
                        </div>
                        <h6><span class="fe fe-heart text-danger mb-3"></span> ORANG TUA CALON SISWA</h6>
                        <div class="row mb-3">
                            <div class="col-lg-6">

                            </div>
                            <div class="col-lg-6">

                            </div>
                        </div>
                        <div class="form-group">
                            <a href="/dashboard/ppdb" class="btn btn-danger" type="button"><span class="fe fe-arrow-left"></span> Back</a>
                        </div>
                    </div>
                </div> {{-- /card --}}
            </div>
        </div>
    </div>
@endsection
