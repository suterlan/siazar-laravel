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
                                <h5 class="p-0 m-auto">PPDB</h5>
                            </div>
                            <div class="col-5 mr-2 py-1 bg-primary-darker rounded">
                                <span class="h5 mb-0 text-white">{{ $jml_ppdb }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <a href="{{route('arsip-alumni')}}" style="text-decoration: none;">
                <div id="alumni" class="card shadow-lg">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="p-0 m-auto">Alumni</h5>
                            </div>
                            <div class="col-5 mr-2 py-1 bg-primary-dark rounded">
                                <span class="h5 mb-0 text-white">{{ $jml_alumni }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                </a>
            </div>
            <div class="col-md-6 col-xl-3 mb-4">
                <a href="{{ route('arsip-tracing-alumni') }}" style="text-decoration: none;">
                <div id="tracing_alumni" class="card shadow-lg">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="p-0 m-auto">Tracing</h5>
                            </div>
                            <div class="col-5 mr-2 py-1 bg-danger-dark rounded">
                                <span class="h5 mb-0 text-white">{{ $jml_tracing }}</span>
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
