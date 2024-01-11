@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow border-dark mb-4">
                    <div class="card-header border-dark">
                        <h4 class="text-center">Input Nilai</h4>
                    </div>
                    <form class="needs-validation @if ($errors->any()) was-validated @endif" action="#" method="POST" novalidate>
                    <div class="card-body px-5">
                        <div class="form-group mb-3">
                            <select class="form-control {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="tahun_ajaran" name="tahun_ajaran" required>
                                <option value="">-- Tahun Ajaran --</option>
                                @foreach ($tahuns as $tahun => $value)
                                    @if (old('tahun_ajaran') == $tahun)
                                        <option value="{{ $tahun }}" selected>{{ $tahun }}</option>
                                    @else
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <select id="select_mapel_id" name="select_mapel_id" class="form-control {{$errors->first('select_mapel_id') ? "is-invalid" : "" }}" required>
                                {{-- render from js --}}
                            </select>
                            @error('select_mapel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                                {{-- render from js --}}
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <select class="form-control {{$errors->first('jurusan_id') ? "is-invalid" : "" }}" id="jurusan_id" name="jurusan_id" required disabled>
                                {{-- render from js --}}
                            </select>
                            @error('jurusan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger col-12" role="alert">
                        <span class="fe fe-info fe-16 mr-2"></span> {{ session('error') }}
                    </div>
                @endif
                <div class="card shadow">
                    <div class="card-header">
                        <div class="row justify-content-center">
                            <div class="col-lg-8 justify-content-center">
                                <strong>Nama Siswa</strong>
                                <strong class="float-right">Nilai</strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="/dashboard/nilai-input" method="POST">
                        @csrf
                            <div id="card-siswa">
                            {{-- render from js --}}
                            </div>
                            <button id="simpanNilai" class="btn btn-primary" type="submit" hidden>Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    const selectKelas = document.querySelector('#kelas_id');
    const selectTahun = document.querySelector('#tahun_ajaran');
    const selectMapel = document.querySelector('#select_mapel_id');
    const selectJurusan = document.querySelector('#jurusan_id');

    selectTahun.addEventListener('change', async () => {
        const tahun = selectTahun.value;
        // console.log(tahun);

        const mapel = await getFetch("/dashboard/get-mapel-mengajar?tahun=", tahun);
        // console.log(mapel);

        setOptionMapel(mapel, selectMapel);
    });

    function setOptionMapel(mapel, selectMapel) {
        let options = "";
        options += `<option value="">-- Pilih Mata Pelajaran --</option>`;
        mapel.forEach(
            (i) => (options += `<option value="${i.id}">${i.nama}</option>`)
        );
        selectMapel.innerHTML = options;
    }


    selectMapel.addEventListener('change', async () => {
        const mapelId = selectMapel.value;
        // console.log(mapelId);

        const kelas = await getFetch("/dashboard/get-kelas-mengajar?mapel_id=", mapelId);
        // console.log(kelas);
        setOptionKelas(kelas, selectKelas);
    });

    function setOptionKelas(kelas, selectKelas) {
        let options = "";
        options += `<option value="">-- Pilih Kelas --</option>`;
        kelas.forEach(
            (i) => (options += `<option value="${i.id}" data-idjurusan="${i.jurusan.id}" data-namajurusan="${i.jurusan.nama}">${i.nama} - ${i.jurusan.kode}</option>`)
        );
        selectKelas.innerHTML = options;
    }

    selectKelas.addEventListener('change', async (e) => {
        let idKelas = selectKelas.value;
        let idJurusan = e.target.options[e.target.selectedIndex].dataset.idjurusan;
        let namaJurusan = e.target.options[e.target.selectedIndex].dataset.namajurusan;

        let jurusanOption = '';
        jurusanOption += `<option value="${idJurusan}" selected>${namaJurusan}</option>`;

        selectJurusan.innerHTML = jurusanOption;

        // get siswa sesuai kelas_id dan jurusan_id
        getSiswa(idKelas, idJurusan);
    });

    // fungsi get siswa
    async function getSiswa(idKelas, idJurusan) {
        const tahun_ajaran  = selectTahun.value;
        const mapel_id  = selectMapel.value;

        const response = await fetch("/dashboard/get-siswa?kelas_id=" + idKelas + "&&jurusan_id=" + idJurusan + "&&tahun_ajaran=" + tahun_ajaran + "&&mapel_id=" + mapel_id);
        const siswa = await response.json();
        console.log(siswa);

        const cardSiswa = document.querySelector('#card-siswa');
        const btnSimpanNilai = document.querySelector('#simpanNilai');
        // form input nilai siswa
        let formInputNilaiSiswa = '';
        let inputNilai = '';
        siswa.forEach( (e) => {
            // if(e.mapels.length > 0){
                e.mapels.forEach( (n) => {
                    // console.log(n.pivot.nilai);
                    inputNilai = `${[n.pivot.nilai]}`;
                });
            // }
            // else{
            //     inputNilai = 0;
            // }

                formInputNilaiSiswa += `
                    <div class="form-row">
                        <div class="form-group col-lg-8">
                            <input type="text" id="siswa_id${e.id}" name="siswa_id[]" class="form-control" value="${e.id}" hidden>
                            <input type="text" id="siswa_nama${e.id}" name="siswa_nama[${e.id}]" class="form-control" value="${e.nama_siswa}">
                        </div>
                        <div class="form-group">
                            <input type="text" id="mapel_id${e.id}" name="mapel_id" class="form-control" value="${mapel_id}" hidden>
                        </div>
                        <div class="form-group">
                            <input type="text" id="tahun_ajaran${e.id}" name="tahun_ajaran" class="form-control" value="${tahun_ajaran}" hidden>
                        </div>
                        <div class="form-group col-lg-4">
                            <input type="number" id="nilai${e.id}" name="nilai[]" class="form-control" min="0" value="${inputNilai}" max="100">
                        </div>
                    </div>
                `;
        });

        cardSiswa.innerHTML = formInputNilaiSiswa;
        btnSimpanNilai.removeAttribute('hidden');
    }

    function getFetch(link, id) {
        return fetch(link + id)
            .then((response) => response.json())
            .then((response) => response);
    }

</script>
@endsection
