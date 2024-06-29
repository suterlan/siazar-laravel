
@extends('layouts.main')
@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow">
                        <div class="card-header">
                            <a href="/dashboard/suratkeluar/undangan" class="btn btn-danger btn-sm"><span class="fe fe-arrow-left"></span> Kembali</a>
                            <a href="/dashboard/suratkeluar/undangan/cetak/{{ $surat->id }}" class="btn btn-primary btn-sm float-right"><span class="fe fe-printer"></span> Cetak</a>
                            <h5 class="mt-3">Preview surat undangan</h5>
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
                                            <div class="float-right mb-3">
                                                <div>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y') }}</div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="180">Nomor</td>
                                        <td width="15" scope="col">:</td>
                                        <td>{{ $surat->no_surat }}</td>
                                    </tr>
                                    <tr>
                                        <td width="180">Lampiran</td>
                                        <td width="15">:</td>
                                        <td>-</td>
                                    </tr>
                                    <tr>
                                        <td width="180">Perihal</td>
                                        <td width="15">:</td>
                                        <td>Surat {{ $surat->suratkeluar->klasifikasi->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div class="mt-3">Yth.</div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div>Bapak/Ibu <b>{{ strtoupper($surat->penerima) }}</b></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div>Di Tempat</div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div class="mt-3"><b><i>Assalamu'alaikum Wr. Wb.</i></b></div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div class="mt-2">Dengan hormat,</div></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div align="justify">Sehubungan dengan diadakannya acara kegiatan {{ $surat->kegiatan }}, maka kami bermaksud mengundang Bapak/Ibu untuk dapat menghadiri kegiatan tersebut yang akan di selenggarakan pada :</div></td>
                                    </tr>
                                    <tr>
                                        <td width="180" class="pl-5">Hari, Tanggal</td>
                                        <td width="15">:</td>
                                        <td>{{ \Carbon\Carbon::parse($surat->tanggal_acara)->translatedFormat('l, d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td width="180" class="pl-5">Waktu</td>
                                        <td width="15">:</td>
                                        <td>{{ \Carbon\Carbon::parse($surat->waktu)->translatedFormat('H:i') }} s/d selesai</td>
                                    </tr>
                                    <tr>
                                        <td width="180" class="pl-5">Tempat</td>
                                        <td width="15">:</td>
                                        <td>{{ $surat->tempat }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div class="mt-3 mb-5" align="justify">Demikian surat undangan ini kami sampaikan. Atas kehadiran dan perhatian dari Bapak/Ibu kami ucapkan terima kasih.</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"><div class="mt-3"><b><i>Wassalamu'alaikum Wr. Wb.</i></b></div></td>
                                    </tr>
                                    @isset($surat->ketua_panitia)
                                    <tr>
                                        <td style="text-align: center">
                                            <div>Mengetahui</div>
                                            <div>Kepala Sekolah</div>
                                            <div class="mt-5"><u><b>SITI ROHIMAH, S.Sos</b></u></div>
                                        </td>
                                        <td></td>
                                        <td style="text-align: center">
                                            <div>Hormat Kami,</div>
                                            <div>Ketua Panitia</div>
                                            <div class="mt-5"><u><b>{{ $surat->ketua_panitia }}</b></u></div>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="3">
                                            <div class="float-right mr-4 mt-5">
                                                <div>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y') }}</div>
                                                <div>Kepala Sekolah,</div>
                                                <div class="mt-5"><u><b>SITI ROHIMAH, S.Sos</b></u></div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endisset
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
