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
            <div class="text-center">
                <u><b>SURAT PENERIMAAN PERSERTA DIDIK PINDAHAN</b></u>
                <div><b>Nomor Surat : {{ $surat->no_surat }}</b></div>
            </div>

            <div style="margin-top: 8mm">Yang bertanda tangan dibawah ini : </div>
            <table cellspacing="5">
                <tr>
                    <td width="100" class="pl-5">Nama</td>
                    <td width="10">:</td>
                    <td>{{ $sekolah->kepala_sekolah }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">NIP/NUPTK</td>
                    <td width="10">:</td>
                    <td>{{ $sekolah->nip . ' / ' . $sekolah->nuptk }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">Jabatan</td>
                    <td width="10">:</td>
                    <td>Kepala Sekolah</td>
                </tr>
                <tr>
                    <td height="15"></td>
                </tr>
            </table>
            <div>Berdasarkan permintaan secara lisan dari orangtua/wali calon peserta didik:</div>
            <table cellspacing="5">
                <tr>
                    <td width="100" class="pl-5">Nama</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nama_siswa }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">NISN</td>
                    <td width="10">:</td>
                    <td>{{ $surat->nisn }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">Tempat, Tgl lahir</td>
                    <td width="10">:</td>
                    <td>{{ $surat->ttl }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">Bin</td>
                    <td width="10">:</td>
                    <td>{{ $surat->bin }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">Kelas</td>
                    <td width="10">:</td>
                    <td>{{ $surat->kelas }}</td>
                </tr>
                <tr>
                    <td width="100" class="pl-5">Sekolah Asal</td>
                    <td width="10">:</td>
                    <td>{{ $surat->asal_sekolah }}</td>
                </tr>
                <tr>
                    <td height="14"></td>
                </tr>
            </table>
            <div>Bahwa selaku lembaga pendidikan penerima, kami bersedia menerima calon peserta didik pindahan tersebut di atas untuk menjadi peserta didik di lembaga kami, dengan catatan membawa: </div>
            <ol>
                <li>Surat Mutasi <b>DAPODIK (Wajib)</b>; </li>
                <li>Surat Pindah dari sekolah asal; </li>
                <li>Bukti hasil belajar semester Ganjil;  </li>
                <li>SKKB dari sekolah asal;   </li>
                <li>Photo copy Ijazah dan SKHUN Pendidikan sebelumnya;   </li>
                <li>Photo copy Akta Kelahiran dan Kartu Keluarga (KK);   </li>
                <li>Photo copy KTP orangtua (ayah & ibu)   </li>
                <li>Photo copy KIP/sejenisnya jika ada.   </li>
            </ol>
            <div>Demikian Surat ini kami buat dengan sebenarnya dan penuh rasa tanggung jawab.</div>
            <table class="table-ttd">
                <tr>
                    <td>Cianjur, {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                </tr>
                <tr>
                    <td>Kepala Sekolah,</td>
                </tr>
                <tr>
                    <td rowspan="30"><u><b>{{ $sekolah->kepala_sekolah }}</b></u></td>
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
            }, 10000);
        </script>
	</body>
</html>
