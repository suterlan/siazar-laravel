
@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <a href="/dashboard/suratkeluar/mutasi" class="btn btn-danger btn-sm"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <a href="/dashboard/suratkeluar/mutasi/cetak/{{ $surat->id }}" class="btn btn-primary btn-sm float-right"><span class="fe fe-printer"></span> Cetak</a>
                            <h5 class="mt-3">Preview surat mutasi siswa</h5>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center mx-5 ">
                                <table class="table datatables table-surat w-100">
                                    <tr class="border-kop">
                                        <td class="text-center text-nowrap pl-0" colspan="4">
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
                                        <td colspan="4">
                                            <div class="text-center mb-3">
                                                <u><b>SURAT KETERANGAN PINDAH SEKOLAH</b></u>
                                                <div><b>Nomor : {{ $surat->no_surat }}</b></div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Yang bertanda tangan dibawah ini Kepala Sekolah SMK AZ-ZARKASYIH menerangkan bahwa : </td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Nama</td>
                                        <td width="15" scope="col">:</td>
                                        <td width="200">{{ $surat->nama_siswa }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Tempat, Tgl lahir</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->ttl }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">NISN</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Jenis Kelamin</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->jk }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Kelas</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->kelas }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Tahun Pelajaran</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->tahun_pelajaran }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Pekerjaan Orang Tua / Wali </td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->pekerjaan }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Nama Orang Tua</td>
                                        <td width="15">:</td>
                                        <td>a. Ayah / Wali</td>
                                        <td>: {{ $surat->nama_ayah }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200"></td>
                                        <td width="15"></td>
                                        <td>b. Ibu</td>
                                        <td>: {{ $surat->nama_ibu }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Alamat </td>
                                        <td width="15">:</td>
                                        <td colspan="2">{{ $surat->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Alasan Pindah </td>
                                        <td width="15">:</td>
                                        <td colspan="2">{{ $surat->alasan_pindah }}</td>
                                    </tr>
                                    <tr>
                                        <td width="200" class="pl-5">Catatan </td>
                                        <td width="15">:</td>
                                        <td colspan="2">Surat keterangan ini merupakan surat yang sah dan menyatakan dengan benar bahwa siswa yang namanya tersebut diatas selama berada di SMK AZ-ZARKASYIH memiliki kelakuan baik dan pindah dengan alasan Malas</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">Demikian surat keterangan ini dibuat, untuk diketahui dan dipergunakan sebagaimana mestinya.</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">
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
