@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-6 col-xl-3 mb-4">
                <a href="/dashboard/arsip/ppdb" style="text-decoration: none;">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="p-0 m-auto">PPDB</h4>
                            </div>
                            <div class="col-5 mr-2 py-2 bg-primary-darker rounded">
                                <span class="h4 mb-0 text-white">{{ $jml_ppdb }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <a href="#" style="text-decoration: none;">
                <div id="alumni" class="card shadow-lg">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="p-0 m-auto">Alumni</h4>
                            </div>
                            <div class="col-5 mr-2 py-2 bg-primary-dark rounded">
                                <span class="h4 mb-0 text-white">1,869</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
