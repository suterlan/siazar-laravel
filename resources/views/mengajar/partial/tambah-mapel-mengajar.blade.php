 <div class="modal fade" id="tambahMapelMengajar" tabindex="-1" role="dialog" aria-labelledby="tambahMapelMengajarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title" id="tambahMapelMengajarLabel">ID : <strong id="idGuru" class="card-title"> {{ $guru->id }}</strong></div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/dashboard/mengajar" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                @csrf
            <div class="modal-body m-3 pt-0">
                <div class="form-row">
                    <input type="hidden" name="guru_id" value="{{ $guru->id }}">
                    <div class="form-group col-lg-6">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <select id="tahun_ajaran" name="tahun_ajaran" class="form-control {{$errors->first('tahun_ajaran') ? "is-invalid" : "" }}" required>
                            <option value="">-- Tahun Ajaran --</option>
                            @for($i=date('Y'); $i>=date('Y')-3; $i-=1)
                                <option value="{{ $i . '/' . $i+1 }}"> {{ $i . '/' . $i+1 }} </option>
                            @endfor
                        </select>
                        @error('tahun_ajaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-lg-6">
                        <label for="semester">Semester</label>
                        <select name="semester" id="semester" class="form-control {{$errors->first('semester') ? "is-invalid" : "" }}" required>

                        </select>
                        @error('semester')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group mb-3">
                    <select id="mapel_id" name="mapel_id" class="form-control {{$errors->first('mapel_id') ? "is-invalid" : "" }}" required>
                        {{-- generate from js --}}
                    </select>
                    @error('mapel_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <select class="form-control {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id" name="kelas_id" required>
                        {{-- generate from js --}}
                    </select>
                    @error('kelas_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-group mb-3">
                    <input class="form-control {{$errors->first('jam') ? "is-invalid" : "" }}" id="jam" type="number" name="jam" value="{{ old('jam') }}" min="0" required>
                    <div class="input-group-append">
                        <span class="input-group-text" id="jam">Jam</span>
                    </div>
                    @error('jam')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            <div class="modal-footer m-3">
                <button type="submit" class="btn mb-1 btn-primary btn-block"> <span class="fe fe-save"></span> Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    const selectTahun = document.querySelector('#tahun_ajaran');
    const selectSemester = document.querySelector('#semester');
    const selectMapel = document.querySelector('#mapel_id');
    const selectKelas = document.querySelector('#kelas_id');

    selectTahun.addEventListener('change', () => {
        let semesterOption = `
            <option value="">-- Semester --</option>
            <option value="Ganjil">Ganjil</option>
            <option value="Genap">Genap</option>
        `;
        selectSemester.innerHTML = semesterOption;
    });

    selectSemester.addEventListener('change', async (e) => {
        const idGuru = document.querySelector('#idGuru').innerHTML;
        const tahun = selectTahun.value;
        const semester = e.target.options[e.target.selectedIndex].value;

        const mapel = await getMapel();

        let options = "";
        options += `<option value="">-- Pilih Mapel --</option>`;
        mapel.forEach(
            (i) => (options += `<option value="${i.id}">${i.nama} - ${i.kode}</option>`)
        );

        selectMapel.innerHTML = options;

    });

    selectMapel.addEventListener('change', async (e) => {
        const mapelId = e.target.options[e.target.selectedIndex].value;
        const idGuru = document.querySelector('#idGuru').innerHTML;
        const tahun = selectTahun.value;
        const semester = selectSemester.value;

        const kelas = await getKelas(idGuru, tahun, semester, mapelId);

        let options = "";
        options += `<option value="">-- Pilih Kelas --</option>`;
        kelas.forEach(
            (i) => (options += `<option value="${i.id}">${i.nama} - ${i.jurusan.kode}</option>`)
        );
        selectKelas.innerHTML = options;
    });

    function getMapel() {
        return fetch("/dashboard/mengajar/get-mapel")
        .then((response) => response.json())
        .then((response) => response);
    };

    function getKelas(idGuru, tahun, semester, mapelId) {
        return fetch("/dashboard/mengajar/get-kelas?guru_id=" + idGuru + "&&tahun=" + tahun + "&&semester=" + semester + "&&mapel_id=" + mapelId)
        .then((response) => response.json())
        .then((response) => response);
    };
</script>
