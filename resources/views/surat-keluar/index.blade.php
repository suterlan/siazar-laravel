@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <strong class="card-title">Surat Keluar</strong>
                                <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#generateNoSurat" type="button"><span class="fe fe-cpu"></span> Generate Nomor Surat </button>
                            <p class="card-text">Tabel Surat Keluar</p>
                        </div>
                        <div class="card-body">
                            @if (session()->has('success'))
                            <div class="alert alert-success col-12" role="alert">
                                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                            </div>
                            @endif

                            <table id="tbSuratKeluar" class="table table-stripped table-hover">
                                <thead class="thead-dark">
                                    <th>#</th>
                                    <th>Kode Klasifikasi</th>
                                    <th>Klasifikasi</th>
                                    <th>No Surat</th>
                                    <th>Tanggal Surat</th>
                                    <th>Tanggal Dibuat</th>
                                </thead>
                                <tbody>
                                    @foreach ($surats as $surat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $surat->klasifikasi->kode }}</td>
                                        <td>{{ $surat->klasifikasi->nama }}</td>
                                        <td class="text-nowrap">{{ $surat->no_surat }}</td>
                                        <td class="text-nowrap">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                                        <td>{{ $surat->created_at }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="generateNoSurat" tabindex="-1" role="dialog" aria-labelledby="generateNoSuratLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="generateNoSuratLabel">Generate Nomor Surat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="/dashboard/suratkeluar/custom" method="POST">
                    @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-lg-6">
                            {{-- <input type="hidden" name="jenis" id="jenis" value="{{ $jenis }}"> --}}
                            <Label for="klasifikasi">Pilih Klasifikasi</Label>
                            <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" required>
                                <option value="">&nbsp;</option>
                                @foreach ($klasifikasi as $klasifikasi )
                                    @if (old('klasifikasi_id') == $klasifikasi->id)
                                        <option value="{{ $klasifikasi->id }}" selected>{{ $klasifikasi->nama }}</option>
                                    @else
                                        <option value="{{ $klasifikasi->id }}">{{ $klasifikasi->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('klasifikasi_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="tanggal_surat">Tanggal Surat</label>
                            <div class="input-group">
                                <input name="tanggal_surat" type="text" class="form-control drgpicker" id="tanggal_surat" value="{{ date('Y/m/d') }}" aria-describedby="button-addon-date" required>
                                <div class="input-group-append">
                                <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" onclick="nomorSurat()" class="btn mb-3 btn-primary btn-block"><span class="fe fe-cpu"></span> Generate Nomor</button>

                    <div class="form-group">
                        <label for="no_surat">Nomor Surat</label>
                        {{-- <p class="text-info" style="font-size: 80%"><span class="fe fe-info"></span> Nomor surat akan diisi otomatis saat memilih klasifikasi</p> --}}
                        <input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat') }}" readonly required>
                        @error('no_surat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input name="keterangan" id="keterangan" type="text" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn mb-2 btn-secondary btn-block"><span class="fe fe-save"></span> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
<script>
    function nomorSurat(){
        const kode = document.querySelector('#klasifikasi');
        const noSurat = document.querySelector('#no_surat');
        // console.log(kode.value);
        fetch('/getCodeKlasifikasi?kode=' + kode.value)
        .then(response => response.json())
        .then(data => noSurat.value = data.no_surat)
    };
</script>
@endsection
