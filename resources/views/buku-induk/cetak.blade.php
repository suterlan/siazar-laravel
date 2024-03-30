<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    {{-- style page & table --}}
    <style>
        /** Define the margins of your page **/
        @page {
            margin: 1cm 2cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            width: 210mm;
            height: 330mm;
            margin-top: 1.5cm;
            margin-bottom: 0.5cm;
        }

        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 1cm;
        }

        /** Define the footer rules **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 0cm;
            right: 0cm;
        }

        .kop {
            width: 100%;
            border-bottom: 5px solid black;

        }
        .text-kop {
            text-align: left;
            /* line-height: 0.1cm; */
            padding: 0;
        }
        .content-surat{
            text-align: justify;
            margin-right: 4cm;
            font-size: 13px;
        }
        .foot-note {
            font-size: 10px;
        }
        #versi {
            float: right;
        }
        .table-border {
            border: 1px solid black;
            border-collapse: collapse;
            width: 81%;
        }

        .table-border th {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 3px;
        }
        .table-border td {
            /* border: 1px solid black; */
            /* border-collapse: collapse; */
            padding: 2px;
            /* padding-left: 2px; */
        }
        .table-border tr {
            border: 1px solid black;
        }

        .table-ttd {
            float: right;
            margin-top: 10mm;
            text-align: left;
            margin-right: 10mm;
        }
    </style>

</head>
<body>
    <header>
        <table class="kop">
            <tr>
                <td width="10%">
                    <img src="{{ public_path('logo_smk.jpg') }}" width="30px" />
                </td>
                <td class="text-kop" width="90%">
                    <div style="font-size: 1.17em;">
                        <b>BUKU INDUK SISWA</b>
                    </div>
                    <div style="font-size: 1em;">
                        <b>SMK AZ-ZARKASYIH</b>
                    </div>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <div class="foot-note">
            <div> Dicetak dari <b>SIAZAR (Sistem Informasi Akademik SMK AZ-ZARKASYIH)</b></div>
            <div id="versi">{{config('app.version')}}</div>
        </div>
    </footer>

    <!-- Wrap the content of your PDF inside a main tag -->
    <main>
        <div class="content">
            <div style="page-break-after: always;">
                <div style="position: absolute; right: 0;">
                    <table style="border: 1px solid">
                        <tr>
                            <td width="27.9mm" height="38.1mm;" style="text-align: center">foto</td>
                        </tr>
                    </table>
                </div>

                <table style="margin-bottom: 20mm">
                    <tr>
                        <td><b>NIS</b></td>
                        <td><b>:</b></td>
                        <td>{{ $siswa->nis }}</td>
                    </tr>
                    <tr>
                        <td><b>NISN</b></td>
                        <td><b>:</b></td>
                        <td>{{ $siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <td><b>JURUSAN</b></td>
                        <td><b>:</b></td>
                        <td>{{ $siswa->jurusan->nama }}</td>
                    </tr>
                    <tr>
                        <td><b>KELAS</b></td>
                        <td><b>:</b></td>
                        <td>{{ $siswa->kelas->nama }}</td>
                    </tr>
                </table>

                <table class="table-border">
                    <tr>
                        <th>A.</th>
                        <td colspan="4"><b>KETERANGAN ANAK DIDIK</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. Nama Murid</td>
                        <td>a. Lengkap</td>
                        <td width="1mm">:</td>
                        <td width="5.5cm">{{ $siswa->nama_siswa }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Panggilan</td>
                        <td>:</td>
                        <td>
                            {{-- @php
                                $panggilan = explode(' ', $siswa->nama_siswa);
                            @endphp
                            {{ $panggilan[0] }} --}}
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. Jenis Kelamin</td>
                        <td></td>
                        <td>:</td>
                        <td>{{ $siswa->jk }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3. Kelahiran</td>
                        <td>a. Tempat</td>
                        <td>:</td>
                        <td>{{ $siswa->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Tanggal</td>
                        <td>:</td>
                        <td>{{ \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4. NIK</td>
                        <td></td>
                        <td>:</td>
                        <td>{{ $siswa->nik }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>5. Agama</td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>6. Kewarganegaraan</td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>7. Anak Ke</td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>8. Jumlah Saudara</td>
                        <td>a. Kandung</td>
                        <td>:</td>
                        <td>{{ $siswa->jml_saudara_kandung }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Tiri</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. Angkat</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>9. Bahasa Sehari-hari Keluarga</td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>10. Keadaan Jasmani</td>
                        <td>a. Berat Badan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Tinggi Badan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. Golongan Darah</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>d. Penyakit yang pernah di derita</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>11. Alamat Rumah</td>
                        <td></td>
                        <td>:</td>
                        <td>{{ $siswa->alamat }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>a. Desa / Kelurahan</td>
                        <td>:</td>
                        <td>{{ $siswa->kelurahan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Kecamatan</td>
                        <td>:</td>
                        <td>{{ $siswa->kecamatan }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. Kabupaten</td>
                        <td>:</td>
                        <td>{{ $siswa->kabupaten }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>d. Provinsi</td>
                        <td>:</td>
                        <td>{{ $siswa->provinsi }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>12. Bertempat Tinggal Pada</td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>13. Jarak Tempat Tinggal ke Sekolah</td>
                        <td></td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
                <br>

                <table class="table-border">
                    <tr>
                        <th>B.</th>
                        <td colspan="4"><b>KETERANGAN ORANG TUA / WALI MURID</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4"><b>a. Nama Orangtua Kandung</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. Nama</td>
                        <td>a. Ayah</td>
                        <td width="1mm">:</td>
                        <td width="5.5cm">{{ $siswa->nama_ayah }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>NIK</td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->nik_ayah }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Tempat / tanggal lahir</td>
                        <td width="1mm">:</td>
                        <td>{{ \Carbon\Carbon::parse($siswa->tgl_lahir_ayah)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Ibu</td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->nama_ibu }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>NIK</td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->nik_ibu }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>Tempat / tanggal lahir</td>
                        <td width="1mm">:</td>
                        <td>{{ \Carbon\Carbon::parse($siswa->tgl_lahir_ibu)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. Pendidikan Tertinggi</td>
                        <td>a. Ayah </td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->pendidikan_ayah }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b.Ibu</td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->pendidikan_ibu }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3. Pekerjaan / Jabatan</td>
                        <td>a. Ayah </td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->pekerjaan_ayah }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Ibu</td>
                        <td width="1mm">:</td>
                        <td>{{ $siswa->pekerjaan_ibu }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>4. Penghasilan</td>
                        <td>a. Ayah </td>
                        <td width="1mm">:</td>
                        <td>Rp. {{ number_format($siswa->penghasilan_ayah, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Ibu</td>
                        <td width="1mm">:</td>
                        <td>Rp. {{ number_format($siswa->penghasilan_ibu, '2', ',', '.') }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>5. Alamat</td>
                        <td>a. Rumah dan No. Telepon</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Kantor dan No. Telepon</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>6. Kewarganegaraan</td>
                        <td>a. Ayah </td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Ibu</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="4"><b>b. Wali Murid (Jika Mempunyai)</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>a. Nama</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Hubungan Keluarga</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. Pendidikan Tertinggi</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>d. Pekerjaan / Jabatan</td>
                        <td width="1mm">:</td>
                        <td></td>
                    </tr>
                </table>
                <br>

                <table class="table-border">
                    <tr>
                        <th>C.</th>
                        <td colspan="5"><b>PERKEMBANGAN MURID</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="5">1. Pendidikan Sebelumnya</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" style="padding-left: 5mm">1.1. Masuk Menjadi Murid Baru Kelas</td>
                        <td colspan="3">: </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>a. Asal Sekolah</td>
                        <td colspan="3">: {{ $siswa->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. No. Ijazah</td>
                        <td colspan="3">: {{ $siswa->no_ijazah }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. No. SKHUN</td>
                        <td colspan="3">: {{ $siswa->no_skhun }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2" style="padding-left: 5mm">1.2. Pindahan dari sekolah lain kelas</td>
                        <td colspan="3">:</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>a. Nama Sekolah Asal</td>
                        <td colspan="3">: </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Dari Kelas</td>
                        <td colspan="3">: </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. Diterima Tanggal</td>
                        <td colspan="3">: </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>d. Di Kelas</td>
                        <td colspan="3">: </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="5">2. Keadaan Jasmani</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-left: 5mm" colspan="2">a. TAHUN</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm">{{ \Carbon\Carbon::parse($siswa->created_at)->format('Y') }}</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm">{{ \Carbon\Carbon::parse($siswa->created_at)->addYears(1)->format('Y') }}</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm">{{ \Carbon\Carbon::parse($siswa->created_at)->addYears(2)->format('Y') }}</td>
                        {{-- <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                    </tr> --}}
                    <tr>
                        <td></td>
                        <td style="padding-left: 5mm" colspan="2">b. BERAT BADAN</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        {{-- <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td> --}}
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-left: 5mm" colspan="2">c. TINGGI BADAN</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        {{-- <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td> --}}
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-left: 5mm" colspan="2">d. PENYAKIT</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        {{-- <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td> --}}
                    </tr>
                    <tr>
                        <td></td>
                        <td style="padding-left: 5mm" colspan="2">e. KELAINAN JASMANI</td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        {{-- <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td>
                        <td style="border: 1px solid black; text-align: center" width="20mm"></td> --}}
                    </tr>
                </table>

            </div>
            <p style="page-break-after: never;">
                <table class="table-border">
                    <tr>
                        <th width="5mm">D.</th>
                        <td colspan="3"><b>BEASISWA</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="10cm">1. Jenis Beasiswa</td>
                        <td width="1mm">:</td>
                        <td width="5cm"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td width="10cm">2. Nomor Kartu</td>
                        <td width="1mm">:</td>
                        <td width="5cm">{{ $siswa->no_kip}}</td>
                    </tr>
                </table>
                <br>

                <table class="table-border">
                    <tr>
                        <th>E.</th>
                        <td colspan="4"><b>MENINGGALKAN SEKOLAH</b></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>1. Tamat Belajar</td>
                        <td>a. Tahun Tamat</td>
                        <td width="1mm">:</td>
                        <td width="5cm"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Melanjutkan ke Sekolah </td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>2. Pindah Ke Sekolah</td>
                        <td>a. Dari Kelas</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Ke Sekolah </td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>c. Ke Kelas</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>d. Tanggal</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>3. Keluar Sekolah</td>
                        <td>a. Tanggal</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>b. Alasan</td>
                        <td>:</td>
                        <td></td>
                    </tr>
                </table>
            </p>
        </div>
    </main>
</body>
</html>
