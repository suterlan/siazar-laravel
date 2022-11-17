
@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <a href="/dashboard/surat/penerimaan" class="btn btn-danger btn-sm"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <a href="/dashboard/surat/penerimaan/cetak/{{ $surat->id }}" class="btn btn-primary btn-sm float-right"><span class="fe fe-printer"></span> Cetak</a>
                            <h5 class="mt-3">Preview surat penerimaan siswa</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center mx-5 ">
                                <table class="table datatables table-surat w-100">
                                    <tr class="border-kop">
                                        <td class="text-center text-nowrap pl-0" colspan="3">
                                            <div class="row">
                                                <div class="col-2">
                                                    <img src="{{ asset('logo_smk.jpg') }}" width="90px" />
                                                </div>
                                                <div class="col-10">
                                                    <div style="font-size: 1.17em">
                                                        <b>YAYASAN AZ-ZARKASYIH LELES</b>
                                                    </div>
                                                    <div style="font-size: 1.5em">
                                                        <b>SMK AZ-ZARKASYIH</b>
                                                    </div>
                                                    <div style="font-size: 1em">
                                                        <b>
                                                            IJIN OPERASIONAL
                                                            No.421.5/1031a/Bid.SMA-SMK/Kab/2016
                                                        </b>
                                                    </div>
                                                    <small>
                                                        Jl. Rd. H. Mulya RT.01 RW.02 Desa Pusakasari
                                                        Kec. Leles Kab. Cianjur Kode Pos 43278
                                                    </small><br>
                                                    <small style="font-size: 12px">
                                                        Email: smk.azzarkasyih@gmail.com web:
                                                        www.smkazzarkasyih.sch.id Tlp.
                                                        0815-7234-3466
                                                    </small>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <!-- /end kop surat -->
                                    <tr>
                                        <td colspan="3">
                                            <div class="text-center mb-3">
                                                <u><b>SURAT PENERIMAAN PERSERTA DIDIK PINDAHAN</b></u>
                                                <div><b>Nomor Surat : {{ $surat->no_surat }}</b></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Yang bertanda tangan dibawah ini :</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Nama</td>
                                        <td width="15" scope="col">:</td>
                                        <td>SITI ROHIMAH, S.Sos</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">NIP</td>
                                        <td width="15">:</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Jabatan</td>
                                        <td width="15">:</td>
                                        <td>Kepala Sekolah</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div class="mt-3"></div> Berdasarkan permintaan secara lisan dari orangtua/wali calon peserta didik :</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Nama</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">NISN</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Tempat, Tgl lahir</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->ttl }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Bin</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->bin }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Kelas</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->kelas }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Sekolah Asal</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->asal_sekolah }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="mt-3"></div>
                                            Bahwa selaku lembaga pendidikan penerima, kami bersedia menerima calon peserta didik pindahan tersebut di atas untuk menjadi peserta didik di lembaga kami, dengan catatan membawa:
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <ol>
                                                <li>Surat Pindah dari sekolah asal; </li>
                                                <li>Bukti hasil belajar semester Ganjil;  </li>
                                                <li>SKKB dari sekolah asal;   </li>
                                                <li>Photo copy Ijazah dan SKHUN Pendidikan sebelumnya;   </li>
                                                <li>Photo copy Akta Kelahiran dan Kartu Keluarga (KK);   </li>
                                                <li>Photo copy KTP orangtua (ayah & ibu)   </li>
                                                <li>Photo copy KIP/sejenisnya jika ada.   </li>
                                            </ol>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Demikian Surat ini kami buat dengan sebenarnya dan penuh rasa tanggung jawab.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <div class="float-right mr-4 mt-5">
                                                <div>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y') }}</div>
                                                <div>Kepala Sekolah,</div>
                                                <div class="mt-5"><u><b>SITI ROHIMAH, S.Sos</b></u></div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
