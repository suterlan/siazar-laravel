@extends('layouts.main')

    @section('content')
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            @foreach ($mapels as $tahun => $mapel)
                            <div class="card shadow">
                                <div class="card-header">
                                    <div>Tahun Ajaran : <strong>{{ $tahun }}</strong></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($mapel as $semester => $nilai)
                                            <div class="col-md-6">
                                                <div class="mb-2">Semester : {{ $semester }}</div>
                                                <table class="table table-stripped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Mata Pelajaran</th>
                                                            <th class="text-right">Nilai Akhir</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($nilai as $value)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $value->mapel->nama }}</td>
                                                            <td class="text-right">{{ $value->nilai }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div> <!-- .col-12 -->
            </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    @endsection
