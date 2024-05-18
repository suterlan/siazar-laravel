<div class="modal fade" id="modalImportNilai" tabindex="-1" role="dialog" aria-labelledby="modalImportNilaiLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalImportNilaiLabel">Import Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('nilai-import') }}" method="post" class="needs-validation @foreach ($errors->all() as $error) was-validated @endforeach" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body m-3 pt-0">
                    <label for="import_nilai">File yang dipilih harus format excel <small><i class="text-warning">(xlsx atau xls)</i></small></label>
                    <div class="custom-file mb-2">
                        <input name="import_nilai" type="file" class="custom-file-input" id="import_nilai" required>
                        <label class="custom-file-label" for="file">PILIH FILE</label>
                    </div>
                    @error('import_nilai')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="modal-footer m-3">
                    <button type="submit" class="btn mb-1 btn-primary btn-block">Import</button>
                </div>
                </form>
            </div>
        </div>
    </div>
