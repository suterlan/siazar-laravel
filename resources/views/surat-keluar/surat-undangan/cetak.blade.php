<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>{{ $title; }}</title>
            <!-- App CSS -->
        <link rel="stylesheet"  href="{{public_path('css/surat.css')}}">
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
            <div align="right" style="padding-bottom: 2mm;">
                <div>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y') }}</div>
            </div>
            <table>
                <tr>
                    <td width="60">Nomor</td>
                    <td width="10">:</td>
                    <td>{{ $surat->no_surat }}</td>
                </tr>
                <tr>
                    <td width="60">Lampiran</td>
                    <td width="10">:</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td width="60">Perihal</td>
                    <td width="10">:</td>
                    <td>{{ $surat->suratkeluar->klasifikasi->nama }}</td>
                </tr>
                <tr>
                    <td height="15"></td>
                </tr>
            </table>
            <div>Yth.</div>
            <div>Bapak/Ibu <b>{{ strtoupper($surat->penerima) }}</b></div>
            <div style="padding-bottom: 5mm">Di Tempat</div>
            <div style="padding-bottom: 2mm"><i>Assalamu'alaikum Wr. Wb.</i></div>
            <div>Dengan hormat,</div>
            <div align="justify" style="margin-bottom: 3mm">Sehubungan dengan akan diadakannya kegiatan {{ $surat->kegiatan }}, maka kami selaku Kepala Panitia bermaksud mengundang Bapak/Ibu {{ $surat->penerima }} untuk dapat menghadiri kegiatan tersebut yang akan di selenggarakan pada :</div>
            <table cellspacing="5">
                <tr>
                    <td width="80" class="pl-5">Hari, Tanggal</td>
                    <td width="10">:</td>
                    <td>{{ \Carbon\Carbon::parse($surat->tanggal_acara)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <td width="80" class="pl-5">Waktu</td>
                    <td width="10">:</td>
                    <td>{{ \Carbon\Carbon::parse($surat->waktu)->translatedFormat('H:i') }} s/d selesai</td>
                </tr>
                <tr>
                    <td width="80" class="pl-5">Tempat</td>
                    <td width="10">:</td>
                    <td>{{ $surat->tempat }}</td>
                </tr>
            </table>
            <div align="justify" style="margin-top: 3mm">Demikian surat undangan ini kami sampaikan. Atas kehadiran dan perhatiannya kami ucapkan terima kasih.</div>
            <table class="table-ttd-2">
                <tr>
                    <td width="50%">Mengetahui</td>
                    <td width="50%">Hormat Kami,</td>
                </tr>
                <tr>
                    <td>Kepala Sekolah</td>
                    <td>Ketua Panitia</td>
                </tr>
                <tr>
                    <td height="150px"><u><b>SITI ROHIMAH, S.Sos</b></u></td>
                    <td height="150px"><u><b>{{ $surat->ketua_panitia }}</b></u></td>
                </tr>
            </table>
        </div>
        <div class="footer-page">
            <div id="foot-note"> Dicetak dari <b>SIAZAR (Sistem Informasi Akademik SMK AZ-ZARKASYIH)</b></div>
            <div id="versi">{{config('app.version')}}</div>
        </div>
	</body>
</html>
