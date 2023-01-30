<div class="">
    @if(!empty($successMessage))
        <div class="alert alert-success">
            {{ $successMessage }}
        </div>
    @endif
    <ul class="nav nav-pills nav-fill">
        <li class="nav-item">
            <a class="btn btn-block  {{ $currentStep != 1 ? 'btn-secondary' : 'btn-primary' }}" href="#step1">Profil Siswa</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-block {{ $currentStep != 2 ? 'btn-secondary' : 'btn-primary' }}" href="#step2">Riwayat Pendidikan</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-block {{ $currentStep != 3 ? 'btn-secondary' : 'btn-primary' }}" href="#step3">Data Orang Tua</a>
        </li>
        <li class="nav-item">
            <a class="btn btn-block {{ $currentStep != 4 ? 'btn-secondary' : 'btn-success' }}" href="#step4">Finish</a>
        </li>
    </ul>
    <div class="row pt-3">,
        <div class="col-lg-12">
            {{-- Step 1 --}}
            <div id="step1" class="needs-validation" style="display: {{ $currentStep != 1 ? 'none' : '' }}">
                <div class="mb-3">
                    <label for="nama_siswa" class="form-label">Nama Lengkap <small class="text-danger">(*)</small></label>
                    <input type="text" wire:model="nama_siswa" class="form-control {{$errors->first('nama_siswa') ? "is-invalid" : "" }}" id="nama_siswa" aria-describedby="nama_siswa">
                    @error('nama_siswa')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="jk" class="form-label">Jenis Kelamin <small class="text-danger">(*)</small></label><br>
                    <label class="radio-inline me-2">
                        <input type="radio" wire:model="jk" class="me-2" value="Laki-laki" {{{ $jk == 'Laki-laki' ? "checked" : "" }}}> Laki-laki
                    </label>
                    <label class="radio-inline">
                        <input type="radio" wire:model="jk" class="me-2" value="Perempuan" {{{ $jk == 'Perempuan' ? "checked" : "" }}}> Perempuan
                        </label>
                    @error('jk')
                        <div class="error text-danger"><small>{{ $message }}</small> </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nik">NIK <small class="text-danger">(*)</small></label>
                    <input id="nik" type="tel" wire:model="nik" name="nik" class="form-control {{$errors->first('nik') ? "is-invalid" : "" }}" value="{{ old('nik') }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    @error('nik')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tempat_lahir" class="form-label">Tempat Lahir <small class="text-danger">(*)</small></label>
                    <input type="text" wire:model="tempat_lahir" class="form-control {{$errors->first('tempat_lahir') ? "is-invalid" : "" }}" id="tempat_lahir">
                    @error('tempat_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir" class="form-label">Tanggal Lahir <small class="text-danger">(*)</small></label>
                    <input type="date" wire:model="tgl_lahir" class="form-control {{$errors->first('tgl_lahir') ? "is-invalid" : "" }}" id="tgl_lahir">
                    @error('tgl_lahir')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control {{$errors->first('alamat') ? "is-invalid" : "" }}" wire:model="alamat" id="alamat" rows="2">{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="provinsi">Provinsi</label>
                    <select class="custom-select {{$errors->first('provinsi') ? "is-invalid" : "" }}" wire:model="provinsi" id="provinsi">
                        <option value="">==Pilih Provinsi==</option>
                        @foreach ($provinces as $code => $name)
                            <option value="{{ $name }}" data-code="{{ $code }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('provinsi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="kabupaten">Kabupaten / Kota</label>
                    <select class="custom-select {{$errors->first('kabupaten') ? "is-invalid" : "" }}" wire:model="kabupaten" id="kabupaten">
                       
                    </select>
                    @error('kabupaten')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{--<div class="form-group mb-3">
                    <label for="kecamatan">Kecamatan</label>
                    <select class="custom-select {{$errors->first('kecamatan') ? "is-invalid" : "" }}" wire:model="kecamatan" id="kecamatan">
                        <option value="">==Pilih==</option>
                        @foreach ($kecamatan as $id => $name )
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('kecamatan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="kelurahan">Desa / Kelurahan</label>
                    <select class="custom-select {{$errors->first('kelurahan') ? "is-invalid" : "" }}" wire:model="kelurahan" id="kelurahan">
                        <option value="">==Pilih==</option>
                        @foreach ($kelurahan as $id => $name )
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('kelurahan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div> --}}
                <div class="mb-3">
                    <label for="jml_saudara_kandung" class="form-label">Jumlah Saudara Kandung</label>
                    <input type="tel" wire:model="jml_saudara_kandung" class="form-control {{$errors->first('jml_saudara_kandung') ? "is-invalid" : "" }}" id="jml_saudara_kandung" onKeyDown="if(this.value.length==1 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    @error('jml_saudara_kandung')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <hr>
                <div class="mb-3">
                    <div>Ket : <span class="text-danger">(*)</span> = Wajib diisi</div>
                </div>

                <button class="btn btn-primary float-right" wire:click="firstStepSubmit" type="button">Next <span class="fe fe-arrow-right"></span></button>
            </div>

            {{-- Step 2 --}}
            <div id="step2" style="display: {{ $currentStep != 2 ? 'none' : '' }}">
                <div class="mb-3">
                    <label for="asal_sekolah" class="form-label">Asal Sekolah <small class="text-danger">(*)</small></label>
                    <input type="text" wire:model="asal_sekolah" class="form-control {{$errors->first('asal_sekolah') ? "is-invalid" : "" }}" id="asal_sekolah">
                    @error('asal_sekolah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nisn">NISN</label>
                    <input id="nisn" type="tel" wire:model="nisn" name="nisn" class="form-control" value="{{ old('nisn') }}" onKeyDown="if(this.value.length==10 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57' required>
                    @error('nisn')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_ijazah">Nomor Ijazah SMPN/MTs</label>
                    <input id="no_ijazah" type="text" wire:model="no_ijazah" name="no_ijazah" class="form-control" value="{{ old('no_ijazah') }}" maxlength="16">
                    @error('no_ijazah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_skhun">Nomor SKHUN</label>
                    <input id="no_skhun" type="text" wire:model="no_skhun" name="no_skhun" class="form-control" value="{{ old('no_skhun') }}" maxlength="7">
                    @error('no_skhun')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="no_kip">Nomor KIP</label>
                    <input id="no_kip" type="text" wire:model="no_kip" name="no_kip" class="form-control" value="{{ old('no_kip') }}" maxlength="7">
                    @error('no_kip')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nama_kip" class="form-label">Nama di KIP </label>
                    <input type="text" wire:model="nama_kip" class="form-control {{$errors->first('nama_kip') ? "is-invalid" : "" }}" id="nama_kip" >
                    @error('nama_kip')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <div>Ket : <span class="text-danger">(*)</span> = Wajib diisi</div>
                </div>

                <div class="float-right">
                    <button class="btn btn-danger" type="button" wire:click="back(1)"><span class="fe fe-arrow-left"></span> Back</button>
                    <button class="btn btn-primary" type="button" wire:click="secondStepSubmit"><span class="fe fe-arrow-right"></span>Next</button>
                </div>
            </div>

            {{-- Step 3 --}}
            <div id="step3" style="display: {{ $currentStep !=3 ? 'none' : '' }}">
                <h3>DATA AYAH</h3>
                <div class="mb-3">
                    <label for="nama_ayah" class="form-label">Nama Ayah</label>
                    <input type="text" wire:model="nama_ayah" class="form-control {{$errors->first('nama_ayah') ? "is-invalid" : "" }}" id="nama_ayah">
                    @error('nama_ayah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nik_ayah">NIK Ayah</label>
                    <input id="nik_ayah" type="tel" wire:model="nik_ayah" name="nik_ayah" class="form-control" value="{{ old('nik_ayah') }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    @error('nik_ayah')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir_ayah" class="form-label">Tanggal Lahir </label>
                    <input type="date" wire:model="tgl_lahir_ayah" class="form-control {{$errors->first('tgl_lahir_ayah') ? "is-invalid" : "" }}" id="tgl_lahir_ayah">
                    @error('tgl_lahir_ayah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pendidikan_ayah">Pendidikan Terakhir</label>
                    <select class="custom-select {{$errors->first('pendidikan_ayah') ? "is-invalid" : "" }}" wire:model="pendidikan_ayah" id="pendidikan_ayah">
                        <option value="">&nbsp;</option>
                        <option value="SD">SD</option>
                        <option value="SLTP">SLTP</option>
                        <option value="SLTA">SLTA</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                    @error('pendidikan_ayah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pekerjaan_ayah" class="form-label">Pekerjaan Ayah</label>
                    <input type="text" wire:model="pekerjaan_ayah" class="form-control {{$errors->first('pekerjaan_ayah') ? "is-invalid" : "" }}" id="pekerjaan_ayah">
                    @error('pekerjaan_ayah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="penghasilan_ayah" class="form-label">Penghasilan Ayah</label>
                    <input type="number" wire:model="penghasilan_ayah" class="form-control {{$errors->first('penghasilan_ayah') ? "is-invalid" : "" }}" id="penghasilan_ayah" max="11">
                    @error('penghasilan_ayah')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <h3 class="mt-3">DATA IBU</h3>
                <div class="mb-3">
                    <label for="nama_ibu" class="form-label">Nama Ibu</label>
                    <input type="text" wire:model="nama_ibu" class="form-control {{$errors->first('nama_ibu') ? "is-invalid" : "" }}" id="nama_ibu">
                    @error('nama_ibu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nik_ibu">NIK Ibu</label>
                    <input id="nik_ibu" type="tel" wire:model="nik_ibu" name="nik_ibu" class="form-control" value="{{ old('nik_ibu') }}" onKeyDown="if(this.value.length==16 && event.keyCode!=8) return false;" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                    @error('nik_ibu')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="tgl_lahir_ibu" class="form-label">Tanggal Lahir </label>
                    <input type="date" wire:model="tgl_lahir_ibu" class="form-control {{$errors->first('tgl_lahir_ibu') ? "is-invalid" : "" }}" id="tgl_lahir_ibu">
                    @error('tgl_lahir_ibu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pendidikan_ibu">Pendidikan Terakhir</label>
                    <select class="custom-select {{$errors->first('pendidikan_ibu') ? "is-invalid" : "" }}" wire:model="pendidikan_ibu" id="pendidikan_ibu">
                        <option value="">&nbsp;</option>
                        <option value="SD">SD</option>
                        <option value="SLTP">SLTP</option>
                        <option value="SLTA">SLTA</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                    </select>
                    @error('pendidikan_ibu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="pekerjaan_ibu" class="form-label">Pekerjaan Ibu</label>
                    <input type="text" wire:model="pekerjaan_ibu" class="form-control {{$errors->first('pekerjaan_ibu') ? "is-invalid" : "" }}" id="pekerjaan_ibu">
                    @error('pekerjaan_ibu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="penghasilan_ibu" class="form-label">Penghasilan Ibu</label>
                    <input type="number" wire:model="penghasilan_ibu" class="form-control {{$errors->first('penghasilan_ibu') ? "is-invalid" : "" }}" id="penghasilan_ibu" max="11">
                    @error('penghasilan_ibu')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="float-right">
                    <button class="btn btn-danger" type="button" wire:click="back(2)"><span class="fe fe-arrow-left"></span> Back</button>
                    <button class="btn btn-primary" type="button" wire:click="thirdStepSubmit"><span class="fe fe-arrow-right"></span>Next</button>
                </div>
            </div>

            {{-- Step 4 --}}
            <div id="step4" style="display: {{ $currentStep != 4 ? 'none' : '' }}">
                <h4>DATA SISWA</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Name: {{$nama_siswa}}</li>
                    <li class="list-group-item">Jenis Kelamin: {{ $jk }}</li>
                    <li class="list-group-item">Tempat Lahir: {{ $tempat_lahir }}</li>
                    <li class="list-group-item">Tanggal Lahir: {{ $tgl_lahir }}</li>
                    <li class="list-group-item">Alamat: {{$alamat}}</li>
                    <li class="list-group-item">Kelurahan: {{ $kelurahan }}</li>
                    <li class="list-group-item">Kecamatan: {{ $kecamatan }}</li>
                    <li class="list-group-item">Jumlah Saudara Kandung: {{ $jml_saudara_kandung }}</li>
                </ul>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Asal Sekolah: {{$asal_sekolah}}</li>
                    <li class="list-group-item">NISN: {{ $nisn }}</li>
                    <li class="list-group-item">Nomor Ijazah: {{ $no_ijazah }}</li>
                    <li class="list-group-item">Nomor SKHUN: {{ $no_skhun }}</li>
                    <li class="list-group-item">Nomor KIP: {{ $no_kip }}</li>
                    <li class="list-group-item">Nama di KIP: {{ $nama_kip }}</li>
                </ul>
                <h4>DATA ORANG TUA</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nama Ayah: {{$nama_ayah}}</li>
                    <li class="list-group-item">NIK Ayah: {{$nik_ayah}}</li>
                    <li class="list-group-item">Tanggal Lahir Ayah: {{$tgl_lahir_ayah}}</li>
                    <li class="list-group-item">Pendidikan Terakhir: {{$pendidikan_ayah}}</li>
                    <li class="list-group-item">Pekerjaan: {{$pekerjaan_ayah}}</li>
                    <li class="list-group-item">Penghasilan: {{$penghasilan_ayah}}</li>
                </ul>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Nama Ibu: {{$nama_ibu}}</li>
                    <li class="list-group-item">NIK Ibu: {{$nik_ibu}}</li>
                    <li class="list-group-item">Tanggal Lahir Ibu: {{$tgl_lahir_ibu}}</li>
                    <li class="list-group-item">Pendidikan Terakhir: {{$pendidikan_ibu}}</li>
                    <li class="list-group-item">Pekerjaan: {{$pekerjaan_ibu}}</li>
                    <li class="list-group-item">Penghasilan: {{$penghasilan_ibu}}</li>
                </ul>
                <button class="btn btn-danger" type="button" wire:click="back(3)">Back</button>
                <button class="btn btn-success" wire:click="submitForm" type="button">Finish</button>
            </div>
        </div>
    </div>
</div>

