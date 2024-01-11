@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header">
                        <h3 class="text-center">Data Nilai Siswa</h3>
                    </div>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="#" method="POST" novalidate>
                    <div class="card-body pb-0">
                        <div class="table-responsive">
                            <table class="table table-bordered datatables table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama Siswa</th>
                                        @foreach($kodemapels as $kode => $value)
                                        <th class="text-center bg-dark-lighter">{{ $kode }}</th>
                                        @endforeach
                                        {{-- <th class="bg-dark-lighter rounded text-center">Nilai</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswas as $siswa)
                                    <tr>
                                        <td>{{ $siswa->nama_siswa }}</td>
                                        @foreach ($siswa->mapels as $nilai)
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-primary me-2">{{ $nilai->pivot->nilai}}</a>
                                            @endforeach
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
