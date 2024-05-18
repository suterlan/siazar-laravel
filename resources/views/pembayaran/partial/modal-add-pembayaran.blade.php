<div class="modal fade" id="addPembayaran" tabindex="-1" role="dialog" aria-labelledby="addPembayaranLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPembayaranLabel">Tambah Pembayaran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('dashboard.pembayaran.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <div class="form-group mb-1">
                        <label for="nama" class="col-form-label">Nama / Judul Pembayaran</label>
                        <input name="nama" type="text" class="form-control {{$errors->first('nama') ? "is-invalid" : "" }}" id="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <label for="nominal" class="col-form-label">Nominal</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp. </span>
                        </div>
                        <input type="number" name="nominal" class="form-control {{$errors->first('nominal') ? "is-invalid" : "" }}" value="0" min="0" aria-label="Nominal" required>
                        @error('nominal')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mb-1">
                        <label for="kelas_id">Pilih Kelas</label>
                        <select name="kelas_id[]" class="form-control select2-multi {{$errors->first('kelas_id') ? "is-invalid" : "" }}" id="kelas_id">
                        @foreach ($jurusans as $jurusan)
                            <optgroup label="{{ $jurusan->nama }}">
                                @foreach ($jurusan->kelas as $kelas)
                                    <option value="{{ $kelas->id }}">{{ $kelas->nama . ' - ' . $jurusan->kode }}</option>
                                @endforeach
                            </optgroup>
                        @endforeach
                        </select>
                        @error('kelas_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div> <!-- form-group -->
                    <div class="form-group mb-1">
                        <label for="keterangan" class="col-form-label">Keterangan</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn mb-1 btn-primary"> <i class="fe fe-save"></i> Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
