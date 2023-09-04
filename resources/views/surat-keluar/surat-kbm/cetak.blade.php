<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title; }}</title>
<style>
            /** Define the margins of your page **/
            @page {
                margin: 1cm 2cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                width: 210mm;
                height: 330mm;
                margin-top: 3cm;
                margin-bottom: 0.5cm;
            }

            /** Define the header rules **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
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
                text-align: center;
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
                margin-left: auto;
            }
            .table-border {
                border: 1px solid black;
                border-collapse: collapse;
                width: 100%;
            }

            .table-border th {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 5px;
            }
            .table-border td {
                border: 1px solid black;
                border-collapse: collapse;
                padding: 2px;
                padding-left: 2px;
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
        <!-- Define header and footer blocks before your content -->
        <header>
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
        </header>

        <footer>
            <div class="foot-note">
                <div> Dicetak dari <b>SIAZAR (Sistem Informasi Akademik SMK AZ-ZARKASYIH)</b></div>
                <div id="versi">{{config('app.version')}}</div>
            </div>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
            <div class="content-surat">
                <div style="page-break-after: always;">
                    <h4 style="text-align: center">
                        SURAT KEPUTUSAN <br>
                        KEPALA SEKOLAH MENENGAH KEJURUAN (SMK) AZ-ZARKASYIH <br>
                        Nomor  : {{ $surat->no_surat }} </h4>
                    <h4 style="text-align: center">
                        TENTANG
                        PEMBAGIAN TUGAS GURU DAN PEGAWAI  SERTA TUGAS TAMBAHAN LAINNYA
                        DALAM KEGIATAN PROSES BELAJAR MENGAJAR ATAU BIMBINGAN</h4>
                    <h4 style="text-align: center">
                        PADA SEMESTER GANJIL <br>
                        TAHUN PELAJARAN {{ $surat->tahun_ajaran }}</h4>
                    <table>
                        <tr>
                            <td valign="top">Menimbang</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ol style="margin-top: 0; margin-bottom: 0">
                                    <li>
                                        Bahwa dalam rangka memperlancar pelaksanaan kegiatan belajar mengajar di SMK AZ-Zarkasyih Kabupaten Cianjur, perlu  menetapkan pembagian tugas guru.
                                    </li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Mengingat</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ol style="margin-top: 0; margin-bottom: 0; text-align: justify">
                                    <li>Undang-Undang Nomor 20 Tahun 2003 Tentang Sistem Pendidikan Nasional;</li>
                                    <li>Undang-Undang Nomor 14 Tahun 2005 Tentang Guru dan dosen</li>
                                    <li>Peraturan Pemerintah Nomor 19 Tahun 2005 tentang Standar Nasional Pendidikan;</li>
                                    <li>Peraturan Menteri Pendidikan Republik Indonesia  Nomor 18 Tahun 2007 tentang Sertifikasi Guru;</li>
                                    <li>Peraturan Menteri Pendidikan Republik Indonesia  Nomor 41 Tahun 2007 tentang Standar Proses Untuk Satuan Pendidikan Dasar dan Menengah;</li>
                                    <li>Peraturan Menteri Pendidikan Republik Indonesia  Nomor 74 Tahun 2008 tentang Beban Kerja Guru;</li>
                                    <li>Surat Edaran Bersama Menteri Pendidikan dan Kebudayaan dan Kepala Badan Kepegawaian Administrasi Negara Nomor 38/SE/1998;</li>
                                    <li>Hasil Keputusan Rapat Dewan Guru SMK AZ-Zarkasyih pada Tanggal 24 Juni 2022.</li>
                                </ol>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" style="text-align: center"><b>MEMUTUSKAN</b></td>
                        </tr>
                        <tr>
                            <td>Menetapkan</td>
                            <td colspan="2">:</td>
                        </tr>
                        <tr>
                            <td valign="top">Pertama</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ul style="margin-top: 0; margin-bottom: 0; text-align: justify; list-style: none">
                                    <li>
                                        Pembagian Tugas Guru dalam kegiatan belajar mengajar dan membimbing pada Semester 1 (Ganjil) tahun pelajaran 2022/2023 seperti terlampir dalam lampiran 1.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Kedua</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ul style="margin-top: 0; margin-bottom: 0; text-align: justify; list-style: none">
                                    <li>
                                        Menugaskan guru untuk melaksanakan tugas tertentu/khusus seperti pada lampiran 2
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Ketiga</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ul style="margin-top: 0; margin-bottom: 0; text-align: justify; list-style: none">
                                    <li>
                                        Masing-masing guru melaporkan pelaksanaan tugasnya secara tertulis dan berkala kepada kepala sekolah.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Keempat</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ul style="margin-top: 0; margin-bottom: 0; text-align: justify; list-style: none">
                                    <li>
                                        Segala biaya yang timbul akibat pelaksanaan keputusan ini dibebankan pada anggaran yang sesuai.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Kelima</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ul style="margin-top: 0; margin-bottom: 0; text-align: justify; list-style: none">
                                    <li>
                                        Apabila terdapat kekeliruan dalam keputusan ini, akan diperbaiki sebagaimana mestinya.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Keenam</td>
                            <td valign="top">:</td>
                            <td valign="top">
                                <ul style="margin-top: 0; margin-bottom: 0; text-align: justify; list-style: none">
                                    <li>
                                        Keputusan ini berlaku sejak tanggal ditetapkan.
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                    <table class="table-ttd">
                        <tr>
                            <td>Ditetapkan di : Cianjur</td>
                        </tr>
                        <tr>
                            <td>Pada tanggal :{{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                        </tr>
                        <tr>
                            <td>Kepala Sekolah,</td>
                        </tr>
                        <tr>
                            <td rowspan="30"><u><b>SITI ROHIMAH, S.Sos</b></u> <br> NIP.</td>
                        </tr>
                    </table>

                    <p style="padding-top: 200px">Tembusan :
                        <ol>
                            <li>Yth. Kepala Dinas Pendidikan Provinsi Jawa Barat</li>
                            <li>Yth. Ketua Yayasan</li>
                            <li>Arsip</li>
                        </ol>
                    </p>
                </div>

                <p style="page-break-after: never;">
                    Lampiran I :
                    <h4 style="text-align: center">
                        PEMBAGIAN TUGAS MENGAJAR GURU<br>
                        SEMESTER {{ strtoupper($surat->semester) }} TAHUN PELAJARAN {{ $surat->tahun_ajaran }} </h4>

                    <table class="table-border" style="font-size: 9px">
                        <thead>
                            <tr>
                                <th rowspan="3">NO</th>
                                <th rowspan="3">NAMA GURU</th>
                                <th rowspan="3">TUGAS MENGAJAR</th>
                                <th colspan="9">JUMLAH JAM PER ROMBEL</th>
                                <th rowspan="3">JML JAM</th>
                                <th rowspan="3">TOTAL</th>
                            </tr>
                            <tr>
                                <th colspan="3">X</th>
                                <th colspan="3">XI</th>
                                <th colspan="3">XII</th>
                            </tr>
                            <tr>
                                <th>MP</th>
                                <th>DKV</th>
                                <th>TSM</th>

                                <th>MP</th>
                                <th>DKV</th>
                                <th>TSM</th>

                                <th>MP</th>
                                <th>DKV</th>
                                <th>TSM</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mengajars as $guru => $mapels)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $guru }}</td>
                                <td>
                                    @foreach ($mapels as $mapel => $jam )
                                        <div>{{ $mapel }}</div>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </p>

                <p style="page-break-after: always;">
                    <p>Lampiran II :</p>
                    <h4 style="text-align: center">
                        PEMBAGIAN TUGAS TAMBAHAN, TUGAS KEPEGAWAIAN DAN TUGAS BIMBINGAN<br>
                        SEMESTER {{ strtoupper($surat->semester) }} TAHUN PELAJARAN {{ $surat->tahun_ajaran }} </h4>

                    <table class="table-border">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>TUGAS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($strukturs as $tugas => $gurus)
                            <tr>
                                <td colspan="3" style="padding: 4px"><b>{{ strtoupper( $loop->iteration . '. ' . $tugas) }}</b></td>
                                @foreach ($gurus as $guru)
                                    <tr>
                                        <td style="text-align: center">{{ $loop->iteration }}</td>
                                        <td>{{ $guru->guru->nama }}</td>
                                        <td style="text-align: center">{{ $guru->jabatan }}</td>
                                    </tr>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table-ttd">
                        <tr>
                            <td>Ditetapkan di : Cianjur</td>
                        </tr>
                        <tr>
                            <td>Pada tanggal :{{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
                        </tr>
                        <tr>
                            <td>Kepala Sekolah,</td>
                        </tr>
                        <tr>
                            <td rowspan="30"><u><b>SITI ROHIMAH, S.Sos</b></u> <br> NIP.</td>
                        </tr>
                    </table>
                </p>
            </div>
        </main>
    </body>
</html>
