<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>{{ $title; }}</title>
            <!-- App CSS -->
        <link rel="stylesheet" href="{{public_path('css/surat.css')}}">
	</head>
	<body>
        <div class="page">
            <table class="kop">
                <tr>
                    <td>
                        <img src="{{ public_path('logo_smk.jpg') }}" width="80px" />
                    </td>
                    <td class="text-kop">
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
                    </td>
                </tr>
            </table>
            <!-- /end kop surat -->
            <div class="text-center">
                <u><b>SURAT KETERANGAN PINDAH SEKOLAH</b></u>
                <div><b>Nomor : {{ $surat->no_surat }}</b></div>
            </div>

            <div style="margin-top: 8mm">Yang bertanda tangan dibawah ini Kepala Sekolah SMK AZ-ZARKASYIH menerangkan bahwa : </div>
            <table cellspacing="5">
                <tr>
                    <td width="150" class="pl-5">Nama</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nama_siswa }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Tempat, Tgl lahir</td>
                    <td width="10">:</td>
                    <td>{{ $surat->ttl }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">NISN</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nisn }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Jenis Kelamin</td>
                    <td width="10">:</td>
                    <td>{{ $surat->jk }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Kelas</td>
                    <td width="10">:</td>
                    <td>{{ $surat->kelas }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Tahun Pelajaran</td>
                    <td width="10">:</td>
                    <td>{{ $surat->tahun_pelajaran }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Pekerjaan Orang Tua / Wali</td>
                    <td width="10">:</td>
                    <td>{{ $surat->pekerjaan }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Nama Orang Tua</td>
                    <td width="10">:</td>
                    <td>a. Ayah / Wali</td>
                    <td>: {{ $surat->nama_ayah }}</td>
                </tr>
                <tr>
                    <td width="150"></td>
                    <td width="10"></td>
                    <td>b. Ibu</td>
                    <td>: {{ $surat->nama_ibu }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Alamat</td>
                    <td width="10">:</td>
                    <td colspan="2">{{ $surat->alamat }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Alasan Pindah</td>
                    <td width="10">:</td>
                    <td colspan="2">{{ $surat->alasan_pindah }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5" valign="top">Catatan</td>
                    <td width="10" valign="top">:</td>
                    <td colspan="2">Surat keterangan ini merupakan surat yang sah dan menyatakan dengan benar bahwa siswa yang namanya tersebut diatas selama berada di SMK AZ-ZARKASYIH memiliki kelakuan baik dan pindah dengan alasan {{ $surat->alasan_pindah }}</td>
                </tr>
                <tr>
                    <td height="10"></td>
                </tr>
            </table>
            <div>Demikian surat keterangan ini dibuat, untuk diketahui dan dipergunakan sebagaimana mestinya.</div>
            <table class="table-ttd">
                <tr>
                    <td>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                </tr>
                <tr>
                    <td>Kepala Sekolah,</td>
                </tr>
                <tr>
                    @empty($sekolah->nip)
                        <td rowspan="30"><u><b>{{ $sekolah->kepala_sekolah }}</b></u> <br> NUPTK.{{ $sekolah->nuptk }}</td>
                    @else
                        <td rowspan="30"><u><b>{{ $sekolah->kepala_sekolah }}</b></u> <br> NIP.{{ $sekolah->nip }}</td>
                    @endempty
                </tr>
            </table>
        </div>
        <div class="footer-page">
            <div id="foot-note"> Dicetak dari <b>SIAZAR (Sistem Informasi Akademik SMK AZ-ZARKASYIH)</b></div>
            <div id="versi">{{config('app.version')}}</div>
        </div>

        {{-- Lampiran surat --}}
        <div class="page">
            <!-- /end kop surat -->
            <div class="text-center" style="margin-top: 10mm">
                <u><b>SURAT PERTANGGUNG JAWABAN ORANG TUA / WALI SISWA</b></u>
            </div>

            <div style="margin-top: 8mm">Yang bertanda tangan dibawah ini :</div>
            <table cellspacing="5">
                <tr>
                    <td width="150" class="pl-5">Nama</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nama_ayah }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Tempat, Tgl lahir</td>
                    <td width="10">:</td>
                    <td>{{ $surat->ttl_ayah }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Pekerjaan</td>
                    <td width="10">:</td>
                    <td>{{ $surat->pekerjaan }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Alamat</td>
                    <td width="10">:</td>
                    <td colspan="2">{{ $surat->alamat }}</td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div>Dengan ini kami sebagai orang tua / wali siswa :</div>
                    </td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Nama</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nama_siswa }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Tempat, Tgl lahir</td>
                    <td width="10">:</td>
                    <td>{{ $surat->ttl }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">NISN</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nisn }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Kelas</td>
                    <td width="10">:</td>
                    <td>{{ $surat->kelas }}</td>
                </tr>
                <tr>
                    <td width="150" class="pl-5">Alamat</td>
                    <td width="10">:</td>
                    <td colspan="2">{{ $surat->alamat }}</td>
                </tr>
                <tr>
                    <td height="5"></td>
                </tr>
            </table>
            <div>Dengan ini saya bertanggung jawab atas pindahnya anak saya dari SMK AZ-ZARKASYIH ke sekolah yang dituju serta siap menjaga nama baik sekolah sebelumnya dan bertanggung jawab atas kelangsungan pendidikan anak saya, apabila dikemudian hari tidak menepati janji surat pertanggung jawaban ini, maka saya siap menerima tuntutan.</div>
            <div style="margin-top: 5mm;">Demikian surat ini saya buat dalam keadaan sehat jasmani dan rohani serta atas kesadaran diri sendiri tanpa ada paksaan dari pihak manapun.</div>
            <table class="table-ttd">
                <tr>
                    <td>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                </tr>
                <tr>
                    <td>Penanggung jawab,</td>
                </tr>
                <tr>
                    <td rowspan="30"><u><b>{{ strtoupper($surat->nama_ayah) }}</b></u></td>
                </tr>
            </table>
        </div>
        <div class="footer-page">
            <div id="foot-note"> Dicetak dari <b>SIAZAR (Sistem Informasi Akademik SMK AZ-ZARKASYIH)</b></div>
            <div id="versi">{{config('app.version')}}</div>
        </div>
        <script>
            setTimeout(() => {
                window.print();
            }, 1000);
        </script>
	</body>
</html>
