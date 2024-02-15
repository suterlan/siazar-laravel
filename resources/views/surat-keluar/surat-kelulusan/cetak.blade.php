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
                float: right;
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
                <div style="page-break-after: never;">
                    <h4 style="text-align: center">
                        SURAT KETERANGAN LULUS <br>
                        Nomor  : {{ $surat->no_surat }} </h4>
                    <div>Kepala SMK AZ-Zarkasyih selaku Penanggungjawab Penyelenggara Ujian Sekolah (US) Tahun Pelajaran
                        {{ \Carbon\Carbon::parse($surat->created_at)->subYears(1)->format('Y') . '/' . \Carbon\Carbon::parse($surat->created_at)->format('Y') }}
                        berdasarkan :</div>
                    <table>
                        <tr>
                            <td valign="top">
                                <ol style="margin-top: 0; margin-bottom: 0">
                                    <li>
                                        Ketuntasan dari seluruh program pembelajaran pada Kurikulum di SMK AZ-Zarkasyih;
                                    </li>
                                    <li>
                                        Kriteria kelulusan sesuai dengan peraturan perundang-undangan;
                                    </li>
                                    <li>
                                        Rapat Pleno Dewan Guru tentang kelulusan siswa.
                                    </li>
                                </ol>
                            </td>
                        </tr>
                    </table>
                    <div>Menerangkan bahwa : </div>
                    <table style="margin-top: 2mm; margin-bottom: 2mm">
                        <tr>
                            <td width="150" style="padding-left: 6mm">Nama</td>
                            <td width="10">:</td>
                            <td><b>{{ Str::upper($surat->nama) }}</b></td>
                        </tr>
                        <tr>
                            <td width="150" style="padding-left: 6mm">Tempat, Tanggal Lahir</td>
                            <td width="10">:</td>
                            <td>{{ $surat->ttl }}</td>
                        </tr>
                        <tr>
                            <td width="150" style="padding-left: 6mm">Nomor Induk</td>
                            <td width="10">:</td>
                            <td>{{ $surat->nis }}</td>
                        </tr>
                        <tr>
                            <td width="150" style="padding-left: 6mm">Nomor Induk Siswa Nasional</td>
                            <td width="10">:</td>
                            <td>{{ $surat->nisn }}</td>
                        </tr>
                        <tr>
                            <td width="150" style="padding-left: 6mm">Kompetensi Keahlian</td>
                            <td width="10">:</td>
                            <td>{{ $surat->jurusan }}</td>
                        </tr>
                        <tr>
                            <td width="150" style="padding-left: 6mm">Dinyatakan</td>
                            <td width="10">:</td>
                            <td><b>LULUS</b></td>
                        </tr>
                    </table>

                    <table class="table-border">
                        <thead>
                            <tr style="background-color: lightgray">
                                <th>No</th>
                                <th>Mata Pelajaran</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa->mapels as $mapel)
                                <tr>
                                    <td style="text-align: center">{{ $loop->iteration }}</td>
                                    <td>{{ $mapel->nama }}</td>
                                    <td style="text-align: center">{{ $mapel->pivot->nilai }}</td>
                                </tr>
                            @endforeach
                                <tr style="background-color: lightgray">
                                    <td colspan="2" style="text-align: center"><b>Rata-rata</b></td>
                                    <td style="text-align: center"><b>{{ number_format($rataRata, 2) }}</b></td>
                                </tr>
                        </tbody>
                    </table>

                    <div style="margin-top: 3mm">
                        Surat keterangan ini bersipat sementara dan berlaku sampai diterbitkannya ijazah untuk siswa yang bersangkutan. Demikian surat keterangan diberikan agar dipergunakan sebagaimana mestinya.
                    </div>

                    <table class="table-ttd">
                        <tr>
                            <td>Ditetapkan di : Cianjur</td>
                        </tr>
                        <tr>
                            <td>Pada tanggal : {{ \Carbon\Carbon::parse($surat->suratkeluar->tanggal_surat)->translatedFormat('d F Y')  }}</td>
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
            </div>
        </main>
    </body>
</html>
