@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Edit Surat KBM</strong></h3>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/skbm/{{ $surat->id }}" method="post" novalidate>
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                {{-- <input type="hidden" name="jenis" id="jenis" value="{{ $jenis }}"> --}}
                                <Label for="klasifikasi">Pilih Klasifikasi</Label>
                                <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" onchange="changeKlasifikasi()" required>
                                    <option value="">&nbsp;</option>
                                    @foreach ($klasifikasi as $klasifikasi )
                                        @if (old('klasifikasi_id', $surat->suratkeluar->klasifikasi_id) == $klasifikasi->id)
                                            <option value="{{ $klasifikasi->id }}" data-kode="{{ $klasifikasi->kode }}" selected>{{ $klasifikasi->nama }}</option>
                                        @else
                                            <option value="{{ $klasifikasi->id }}" data-kode="{{ $klasifikasi->kode }}">{{ $klasifikasi->nama }}</option>
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
                                    <input name="tanggal_surat" type="text" class="form-control drgpicker" id="tanggal_surat" value="{{ $surat->suratkeluar->tanggal_surat }}" aria-describedby="button-addon-date" required>
                                    <div class="input-group-append">
                                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="no_surat">Nomor Surat</label>
                                <p class="text-info" style="font-size: 80%"><span class="fe fe-info"></span> Nomor surat akan diisi otomatis saat memilih klasifikasi</p>
                                <input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat', $surat->no_surat) }}" readonly required>
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-2">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input class="form-control input-tahun-ajaran col-lg-6" id="tahun_ajaran" type="text" name="tahun_ajaran" placeholder="____/____" value="{{ $surat->tahun_ajaran }}" maxlength="9" required>
                        </div>
                        <label class="form-label mt-2">Semster</label>
                        <div class="form-group mb-2">
                            <div class="form-check form-check-inline" for="semester1">
                                <input type="radio" name="semester" id="semester1" value="Ganjil" @if(isset($surat->semester) && $surat->semester == 'Ganjil') checked  @endif required>
                                <label class="form-check-label pl-1" for="semester1">Ganjil</label>
                            </div>
                            <div class="form-check form-check-inline" for="semester2">
                                <input type="radio" name="semester" id="semester2" value="Genap" @if(isset($surat->semester) && $surat->semester == 'Genap') checked  @endif required>
                                <label class="form-check-label pl-1" for="semester2">Genap</label>
                            </div>
                            @error('semester')
                                <div class="error text-danger"><small>{{ $message }}</small> </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <a href="/dashboard/suratkeluar/skbm" class="btn btn-danger"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <button class="btn btn-success float-right" type="submit"><span class="fe fe-save"></span> Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function changeKlasifikasi(){
        const klasifikasi = document.querySelector('#klasifikasi');
        const noSurat = document.querySelector('#no_surat');
        // split no surat untuk menghilangkan simbol '/' dan mengubahnya jadi array
        arrSurat = noSurat.value.split('/');
        // ganti array no surat index ke-1 yang merupakan id dari klasifikasi
        arrSurat[1] = klasifikasi.options[klasifikasi.selectedIndex].dataset.kode;
        // simpan perubahan pada variabel newNoSurat
        const newNoSurat = arrSurat.join('/');
        // ganti isi nomor surat dengan no surat baru
        noSurat.value = newNoSurat;
    }

</script>
@endsection
