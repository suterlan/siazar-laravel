@include('partials.header')

<body class="vertical light">
    <div class="wrapper">
        <div class="container-fluid">
            <div class="col-12">
                <div class="row justify-content-center mt-4">
                    @if (auth()->user()->siswa->lulus != true)
                        <div class="alert alert-danger col-8" role="alert">
                            <span class="fe fe-info fe-16 mr-2"></span>
                            Anda belum menjadi alumni!
                        </div>
                    @else
                        <div class="col-md-8">
                            <div class="card shadow">
                                <div class="card-header">
                                    <h3>Tracing Alumni</h3>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('tracing-store') }}" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                                        @csrf
                                    <div class="form-group mb-3">
                                        <label for="angkatan" class="form-label">Pilih tahun kelulusan</label>
                                        <select id="angkatan" name="angkatan" class="form-control select2{{$errors->first('angkatan') ? "is-invalid" : "" }}" required>
                                            <option value="">-- Tahun Lulus --</option>
                                            @for($i=date('Y'); $i>=date('Y')-10; $i-=1)
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                        </select>
                                        @error('angkatan')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="status" class="form-label">Pilih status saat ini</label>
                                        <select id="status" name="status" class="form-control {{$errors->first('status') ? "is-invalid" : "" }}" required>
                                            <option value="">-- Pilih Status --</option>
                                            <option value="Belum Kerja">Belum Kerja</option>
                                            <option value="Kerja">Kerja</option>
                                            <option value="Kuliah">Kuliah</option>
                                            <option value="Menikah">Menikah</option>
                                            <option value="Usaha Mandiri">Usaha Mandiri</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div id="formKerja" style="display: none">
                                        <div class="form-group mb-3">
                                            <label for="nama_perusahaan" class="form-label">Nama Perusahaan tempat kerja</label>
                                            <input type="text" id="nama_perusahaan" name="nama_perusahaan" class="form-control {{$errors->first('nama_perusahaan') ? "is-invalid" : "" }}" placeholder="PT/CV..." required>
                                            @error('nama_perusahaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="alamat_perusahaan" class="form-label">Alamat Persahaan</label>
                                            <input type="text" id="alamat_perusahaan" name="alamat_perusahaan" class="form-control {{$errors->first('alamat_perusahaan') ? "is-invalid" : "" }}" placeholder="alamat..." required>
                                            @error('alamat_perusahaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="formKuliah" style="display: none">
                                        <div class="form-group mb-3">
                                            <label for="nama_universitas" class="form-label">Nama Universitas tempat kuliah</label>
                                            <input type="text" id="nama_universitas" name="nama_universitas" class="form-control {{$errors->first('nama_universitas') ? "is-invalid" : "" }}" required>
                                            @error('nama_universitas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="alamat_universitas" class="form-label">Alamat Universitas</label>
                                            <input type="text" id="alamat_universitas" name="alamat_universitas" class="form-control {{$errors->first('alamat_universitas') ? "is-invalid" : "" }}" placeholder="alamat..." required>
                                            @error('alamat_universitas')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="jurusan" class="form-label">Jurusan Kuliah</label>
                                            <input type="text" id="jurusan" name="jurusan" class="form-control {{$errors->first('jurusan') ? "is-invalid" : "" }}" required>
                                            @error('jurusan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div id="formNikahdanUsaha" style="display: none">
                                        <div class="form-group mb-3">
                                            <label for="kategori_usaha" class="form-label">Nama Usaha / Bisnis</label>
                                            <input type="text" id="kategori_usaha" name="kategori_usaha" class="form-control {{$errors->first('kategori_usaha') ? "is-invalid" : "" }}" placeholder="contoh : Jualan Roti Bakar" required>
                                            @error('kategori_usaha')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group mb-3 form-gaji" style="display: none">
                                        <label for="gaji" class="form-label">Gaji / Pendapatan</label>
                                        <select id="gaji" name="gaji" class="form-control {{$errors->first('gaji') ? "is-invalid" : "" }}" aria-describedby="select-gaji" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="< 1.000.000"> < 1.000.000</option>
                                            <option value="1.000.000 - 3.000.000">1.000.000 - 3.000.000</option>
                                            <option value="> 3.000.000"> > 3.000.000</option>
                                        </select>
                                        @error('gaji')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@include('partials.footer')
<script>
    const selectStatus = document.querySelector('#status');
    const formKerja = document.querySelector('#formKerja')
    const formKuliah = document.querySelector('#formKuliah')
    const formNikahdanUsaha = document.querySelector('#formNikahdanUsaha')
    const formGaji = document.querySelector('.form-gaji')

    selectStatus.addEventListener('change', function(){
        let selected = selectStatus.value;
        // console.log(selected);
        switch (selected) {
            case 'Belum Kerja':
                formKerja.style.display = 'none';
                formKuliah.style.display = 'none';
                formNikahdanUsaha.style.display = 'none';
                formGaji.style.display = 'none';
                break;
            case 'Kerja':
                formKerja.style.display = 'block';
                formKuliah.style.display = 'none';
                formNikahdanUsaha.style.display = 'none';
                formGaji.style.display = 'block';
                break;
            case 'Kuliah':
                formKuliah.style.display = 'block';
                formKerja.style.display = 'none';
                formNikahdanUsaha.style.display = 'none';
                formGaji.style.display = 'none';
                break;
            case 'Menikah':
                formNikahdanUsaha.style.display = 'block';
                formKerja.style.display = 'none';
                formKuliah.style.display = 'none';
                formGaji.style.display = 'block';
                break;
            case 'Usaha Mandiri':
                formNikahdanUsaha.style.display = 'block';
                formKerja.style.display = 'none';
                formKuliah.style.display = 'none';
                formGaji.style.display = 'block';
                break;
            default:
                formKerja.style.display = 'none';
                formKuliah.style.display = 'none';
                formNikahdanUsaha.style.display = 'none';
                formGaji.style.display = 'none';
                break;
        }
    });
</script>
</body>
</html>
