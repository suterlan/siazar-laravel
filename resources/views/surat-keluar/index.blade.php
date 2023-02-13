@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="card shadow">
                    <div class="card-header">
                        <strong class="card-title">Surat Keluar</strong>
                            <button class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#newSuratModal" type="button"><span class="fe fe-file-plus"></span> Surat Baru </button>
                        <p class="card-text">Tabel Surat Keluar</p>
                    </div>
                    <div class="card-body">
                        @if (session()->has('success'))
                        <div class="alert alert-success col-12" role="alert">
                            <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                        </div>
                        @endif
                        <table id="tbSuratKeluar" class="table table-stripped table-hover table-responsive">
                            <thead class="thead-dark">
                                <th>#</th>
                                <th>Kode Klasifikasi</th>
                                <th>Klasifikasi</th>
                                <th>No Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Tanggal Dibuat</th>
                            </thead>
                            <tbody>
                                @foreach ($surats as $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $surat->klasifikasi->kode }}</td>
                                    <td>{{ $surat->klasifikasi->nama }}</td>
                                    <td class="text-nowrap">{{ $surat->no_surat }}</td>
                                    <td class="text-nowrap">{{ \Carbon\Carbon::parse($surat->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                                    <td>{{ $surat->created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="newSuratModal" tabindex="-1" role="dialog" aria-labelledby="newSuratModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newSuratModalLabel">Buat Surat Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                {{-- <form action="/dashboard/suratkeluar/suratbaru" method="post">
                    @csrf --}}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="jenis_surat">Pilih Jenis Surat</label>
                        <select name="jenis_surat" onchange="SelectJenis()" class="form-control select2" id="jenis_surat" required>
                            <option value="">&nbsp;</option>
                            <option value="Penerimaan">Surat Penerimaan Siswa</option>
                            <option value="panggilan">Surat Pemanggilan Siswa</option>
                            <option value="mutasi">Surat Mutasi Siswa</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btnJenisSurat" href="dashboard/suratkeluar/suratbaru/{{ $jenis = "" }}" type="submit" class="btn mb-2 btn-primary btn-block">Next</a>
                </div>
                {{-- </form> --}}
            </div>
        </div>
    </div>
    <script>
        function SelectJenis(){
            let jenis_surat = document.querySelector('#jenis_surat');
            const btnJenisSurat = document.querySelector('#btnJenisSurat');
            btnJenisSurat.setAttribute('href', '/dashboard/surat/' + jenis_surat.value);
        }
    </script>
@endsection
