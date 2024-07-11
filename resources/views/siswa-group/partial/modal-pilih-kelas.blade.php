 <div class="modal fade" id="modalPilihKelas{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="modalPilihKelasLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">
                    <strong>Pilih Kelas</strong>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="{{ route('naik-kelas-all') }}" method="POST">
                @csrf
                @method('put')
            <div class="modal-body">
                <div class="form-group">
                    <select name="kelas_id" id="kelas_id" class="custom-select">
                        <option value="">--Pilih--</option>
                        @foreach ($kelas->where('nama', '!=', $row->nama) as $kel)
                            <option value="{{ $kel->id }}">{{ $kel->nama . ' - ' . $kel->jurusan->kode}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-sm text-white">Ubah</button>
            </div>
        </div>
    </div>
 </div>

