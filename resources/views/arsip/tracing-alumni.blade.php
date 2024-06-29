@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                {{-- <div class="col-md-12"> --}}
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Arsip Tracing Alumni</strong>
                            <p class="text-mutted">Data ini hanya arsip pelacakan alumni, untuk melihat arip lengkap alumni ada di menu arsip alumni</p>
                            <small class="text-info">Silahkan copy dan bagikan link dibawah ini kepada alumni untuk mengisi formulir pendataan alumni</small>

                            <div class="input-group mb-2">
                                <input id="linkTracingAlumni" type="text" class="form-control col-md-4" aria-label="clipboard tracing alumni" aria-describedby="button-copy" value="{{ route('tracing-alumni') }}" readonly>
                                <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-copy"  data-toggle="tooltip" data-placement="top" title="copy link" onclick="copyToClipboard()">
                                    <i class="fe fe-copy"></i>
                                </button>
                                </div>
                            </div>
                            <small id="text-copied" class="text-muted"></small>

                        </div>
                        <div class="card-body">
                            <form action="/dashboard/arsip/tracing-alumni">
                                <div class="d-flex mb-3 col-md-6">
                                    <div class="input-group">
                                        <select id="filter_tahun" name="filter_tahun" class="form-control" required>
                                            <option value="">-- Tahun --</option>
                                            @for($i=date('Y'); $i>=date('Y')-10; $i-=1)
                                                @if (request('filter_tahun') == $i)
                                                    <option value="{{ $i }}" selected> {{ $i }} </option>
                                                @else
                                                    <option value="{{ $i }}"> {{ $i }} </option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="input-group">
                                        <select id="filter_status" name="filter_status" class="form-control" required>
                                            <option value="">-- Status --</option>
                                            <option value="all" @selected(request('filter_status') == 'all')>Semua</option>
                                            <option value="Kerja" @if(request('filter_status') == 'Kerja') selected @endif>Kerja</option>
                                            <option value="Kuliah" @if(request('filter_status') == 'Kuliah') selected @endif>Kuliah</option>
                                            <option value="Menikah" @if(request('filter_status') == 'Menikah') selected @endif>Menikah</option>
                                            <option value="Usaha Mandiri" @if(request('filter_status') == 'Usaha Mandiri') selected @endif>Usaha Mandiri</option>
                                        </select>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="submit">Filter</button>
                                        <a href="{{ route('arsip-tracing-alumni') }}" class="btn btn-outline-primary ml-1">Reset</a>
                                    </div>
                                </div>
                            </form>

                            <table id="tbArsipTracingAlumni" class="table table-bordered table-hover table-responsive" style="font-size: 11px;">
                                <thead class="text-center">
                                    <th class="text-dark">NO</th>
                                    <th class="text-dark">NAMA SISWA</th>
                                    <th class="text-dark">NISN</th>
                                    <th class="text-dark">STATUS</th>
                                    <th class="bg-primary-darker">NAMA PERUSAHAAN</th>
                                    <th class="bg-primary-darker">ALAMAT PERUSAHAAN</th>
                                    <th class="bg-info-dark">NAMA UNIVERSITAS</th>
                                    <th class="bg-info-dark">ALAMAT UNIVERSITAS</th>
                                    <th class="bg-info-dark">JURUSAN</th>
                                    <th class="bg-secondary">KATEGORI USAHA</th>
                                    <th class="text-dark">GAJI / PENDAPATAN</th>
                                </thead>
                                <tbody>
                                    @foreach ($alumnis as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->siswa->nama_siswa }}</td>
                                        <td>{{ $siswa->siswa->nisn }}</td>
                                        <td>{{ $siswa->status }}</td>
                                        <td class="@if ($siswa->nama_perusahaan == NULL) bg-dark @endif">{{ $siswa->nama_perusahaan }}</td>
                                        <td class="@if ($siswa->alamat_perusahaan == NULL) bg-dark @endif">{{ $siswa->alamat_perusahaan }}</td>
                                        <td class="@if ($siswa->nama_universitas == NULL) bg-dark @endif">{{ $siswa->nama_universitas }}</td>
                                        <td class="@if ($siswa->alamat_universitas == NULL) bg-dark @endif">{{ $siswa->alamat_universitas }}</td>
                                        <td class="@if ($siswa->jurusan == NULL) bg-dark @endif">{{ $siswa->jurusan }}</td>
                                        <td class="@if ($siswa->kategori_usaha == NULL) bg-dark @endif">{{ $siswa->kategori_usaha }}</td>
                                        <td>{{ $siswa->gaji }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                {{-- </div> --}}
            </div>
        </div>
    </div>
    <script>
        function copyToClipboard(){
            document.getElementById('linkTracingAlumni').select();
            document.execCommand('copy');

            const textCopied = document.getElementById('text-copied');
            textCopied.innerHTML = 'link copied!';

            setTimeout(() => {
                textCopied.innerHTML = '';
            }, 3000);
        }
    </script>
@endsection
