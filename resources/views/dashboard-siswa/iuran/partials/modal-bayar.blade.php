 <div class="modal fade" id="bayar{{ $iuran->id }}" tabindex="-1" role="dialog" aria-labelledby="tambahMapelMengajarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Bayar {{ $iuran->nama }}</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('transaksi.store') }}" method="POST">
                @csrf
            <div class="modal-body pt-0">
                <input type="hidden" value="{{ $iuran->id }}" name="pembayaran_id">
                <label class="mt-2" for="nominal">Ketik jumlah nominal yang akan dibayarkan <small class="text-danger">(tanpa titik / koma)</small></label>
                <div class="input-group mb-2">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rp. </span>
                    </div>
                    <input type="number" name="nominal" class="form-control {{$errors->first('nominal') ? "is-invalid" : "" }}" min="0" aria-label="Nominal" required>
                    @error('nominal')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="modal-footer float-right">
                <button type="submit" class="btn mb-1 btn-outline-link text-primary"> Lanjut</button>
            </div>
            </form>
        </div>
    </div>
</div>
