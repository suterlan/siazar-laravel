@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="card shadow col-lg-12">
                <div class="card-body">
                    <h4><strong>Buat Surat KBM </strong></h3>
                    <p>Silahkan isi form dibawah untuk membuat Surat Keputusan Kegiatan Belajar Mengajar baru</p>
                    <div class="alert alert-warning" role="alert">
                        <span class="fe fe-info fe-16 mr-2"></span> Jika pembagian tugas mengajar guru atau tugas tambahan belum ada atau berubah silahkan klik tombol di bawah ini :
                        <div class="mt-2">Tugas Mengajar &emsp;&ensp;: <a href="/dashboard/mengajar" class="btn btn-info btn-sm">Lihat</a></div>
                        <div class="mt-2">Tugas Tambahan &emsp;: <a href="/dashboard/struktur-organisasi" class="btn btn-info btn-sm">Lihat</a></div>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                    @endif
                    <form class="needs-validation  @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/skbm" method="post" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                {{-- <input type="hidden" name="jenis" id="jenis" value="{{ $jenis }}"> --}}
                                <Label for="klasifikasi">Pilih Klasifikasi</Label>
                                <select id="klasifikasi" name="klasifikasi_id" class="form-control select2" onchange="nomorSurat()" required>
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
                        <div class="form-row">
                            <div class="form-group col-lg-6">
                                <label for="no_surat">Nomor Surat</label>
                                <p class="text-info" style="font-size: 80%"><span class="fe fe-info"></span> Nomor surat akan diisi otomatis saat memilih klasifikasi</p>
                                <input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat') }}" readonly required>
                                @error('no_surat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="form-group mb-2">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <input class="form-control input-tahun-ajaran col-lg-6" id="tahun_ajaran" type="text" name="tahun_ajaran" placeholder="____/____" maxlength="9" required>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div> --}}
                        <div class="form-group mb-2">
                            <label for="tahun_ajaran">Tahun Ajaran</label>
                            <select class="form-control col-lg-6 {{$errors->first('tahun_ajaran') ? "is-invalid" : "" }}" id="tahun_ajaran" name="tahun_ajaran" required>
                                {{-- <option value="">-- Pilih Tahun --</option> --}}
                                @foreach ($tahuns as $tahun => $value)
                                    @if (old('tahun_ajaran') == $tahun)
                                        <option value="{{ $tahun }}" selected>{{ $tahun }}</option>
                                    @else
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label mt-2">Semster</label>
                        <div class="form-group mb-2">
                            <div class="form-check form-check-inline select-semester" for="semester1">
                                <input type="radio" name="semester" id="semester1" value="Ganjil" required>
                                <label class="form-check-label pl-1" for="semester1">Ganjil</label>
                            </div>
                            <div class="form-check form-check-inline select-semester" for="semester2">
                                <input type="radio" name="semester" id="semester2" value="Genap" required>
                                <label class="form-check-label pl-1" for="semester2">Genap</label>
                            </div>
                            @error('semester')
                                <div class="error text-danger"><small>{{ $message }}</small> </div>
                            @enderror
                        </div>

                        <label class="form-label mt-2 mb-0">Aktifkan E-Sign 
                            <span class="text-info"><i class="fe fe-info" title="Tanda tangan elektronik menggunakan qrcode"></i></span>
                        </label>
                        <div class="form-group mb-2">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="qr_active" name="qr_active">
                                <label class="custom-control-label" for="qr_active">Aktif</label>
                            </div>
                        </div>
                        <div class="alert alert-warning" role="alert">
                            <span class="fe fe-info fe-16 mr-2"></span> Data surat KBM akan disimpan setelah dilanjutkan ke tahap berikutnya
                        </div>
                        <div class="form-group mb-3 mt-4">
                            <a href="/dashboard/suratkeluar/skbm" class="btn btn-danger"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <button class="btn btn-primary float-right" type="submit"><span class="fe fe-save"></span> Selanjutnya</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        function nomorSurat(){
            const kode = document.querySelector('#klasifikasi');
            const noSurat = document.querySelector('#no_surat');
            // console.log(kode.value);
            fetch('/getCodeKlasifikasi?kode=' + kode.value)
            .then(response => response.json())
            .then(data => noSurat.value = data.no_surat)
        };

        // const tahunAjaran = document.querySelector('#tahun_ajaran');
        // const radioButtons  = document.querySelectorAll('.select-semester');

        // radioButtons.forEach(radioSemester => {
        //     radioSemester.addEventListener('change', async (event) => {
        //         // console.log(event.target.value);
        //         const tahun = tahunAjaran.value;
        //         const semester = event.target.value;
                
        //         const guru = await getGuruMengajar(tahun, semester);
        //         showRowRadio(guru);
        //     });
        // });

        // function showRowRadio(guru){
        //     const rowRadioGuru = document.querySelector('.row-radio-guru');
        //     let radioGuru = '';
            
        //     guru.forEach((e) => {
        //         radioGuru += `
        //             <div class="col-sm-6 col-md-4">
        //                 <div class="custom-control custom-checkbox">
        //                     <input type="hidden" name="guru_id[]" value="${e.id}">
        //                     <input type="checkbox" class="custom-control-input" id="guru${e.id}" name="guru_id[]" value="${e.id}" disabled checked>
        //                     <label class="custom-control-label" for="guru${e.id}">${e.nama}</label>
        //                 </div>
        //             </div>
        //         `;
        //     });
            
        //     rowRadioGuru.innerHTML = radioGuru;
        // }

        // function getGuruMengajar(tahun, semester){
        //     return fetch('/dashboard/suratkeluar/skbm/get-guru-mengajar/?tahun_ajaran=' + tahun + '&&semester='+ semester)
        //     .then(response => response.json())
        //     .then(response => response);
        // }
        
    </script>
@endpush
@endsection
