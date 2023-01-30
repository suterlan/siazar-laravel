<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<title>{{ $title; }}</title>
            <!-- App CSS -->
		<style type="text/css">
			.page {
				margin: 0;
				padding: 20mm;
                padding-top: 10mm;
				font: 12pt "arial";
			}
			* {
				box-sizing: border-box;
				-moz-box-sizing: border-box;
			}

			@page {
				size: A4;
				margin: 0;
			}
			@media print {
				html,
				body {
					width: 210mm;
					height: 297mm;
				}
				.page {
					margin: 0;
					border: initial;
					border-radius: initial;
					width: initial;
					min-height: initial;
					box-shadow: initial;
					background: initial;
					page-break-after: always;
				}
			}
			.kop {
				width: 100%;
				border-bottom: 5px solid black;
				margin-bottom: 0.2cm;
			}
			.text-kop {
				text-align: center;
				/* line-height: 0.1cm; */
				padding: 0;
			}
            .text-center{
               text-align: center;
            }
            .pl-5{
                padding-left: 8mm;
            }
            .table-ttd{
                float: right;
                margin-top: 10mm;
                text-align: left;
                margin-right: 10mm;
            }
            .footer-page {
                position: fixed;
                bottom: 0cm;
                left: 0.5cm;
                right: 0cm;
                height: 0.7cm;
                font-size: 11px;
            }
		</style>
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
                    <td>Surat {{ $surat->suratkeluar->klasifikasi->nama }}</td>
                </tr>
                <tr>
                    <td height="15"></td>
                </tr>
            </table>
            <div>Yth.</div>
            <div>Bapak/Ibu Wali murid dari <b>{{ strtoupper($surat->nama_siswa) }}</b></div>
            <div>Kelas {{ $surat->kelas }}</div>
            <div style="padding-bottom: 5mm">Di Tempat</div>
            <div style="padding-bottom: 2mm"><i>Assalamu'alaikum Wr. Wb.</i></div>
            <div>Dengan hormat,</div>
            <div>Sehubungan dengan adanya <b>Permasalah {{ $surat->masalah }}</b> yang harus diselesaikan bersama, maka dengan ini kami mengharapkan kehadiran Bapak/Ibu Wali murid pada :</div>
            <table cellspacing="5">
                <tr>
                    <td width="80" class="pl-5">Hari, Tanggal</td>
                    <td width="10">:</td>
                    <td>{{ $surat->hari_tgl }}</td>
                </tr>
                <tr>
                    <td width="80" class="pl-5">Waktu</td>
                    <td width="10">:</td>
                    <td>{{ $surat->waktu }}</td>
                </tr>
                <tr>
                    <td width="80" class="pl-5">Tempat</td>
                    <td width="10">:</td>
                    <td>Kantor SMK AZ-ZARKASYIH</td>
                </tr>
            </table>
            <div style="padding-bottom: 5mm">Mengingat pentingnya hal tersebut maka kami mengharapkan Bapak/Ibu Wali murid untuk datang tepat pada waktu yang telah di tentukan.</div>
            <div>Demikian Surat panggilan ini kami sampaikan, atas perhatiannya kami ucapkan terima kasih.</div>
            <table class="table-ttd">
                <tr>
                    <td>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y') }}</td>
                </tr>
                <tr>
                    <td>Kepala Sekolah,</td>
                </tr>
                <tr>
                    <td rowspan="30"><u><b>SITI ROHIMAH, S.Sos</b></u></td>
                </tr>
            </table>
        </div>
        <div class="footer-page">Dicetak dari <b>SIAZAR (Sistem Informasi Akademik SMK AZ-ZARKASYIH)</b></div>
	</body>
</html>
