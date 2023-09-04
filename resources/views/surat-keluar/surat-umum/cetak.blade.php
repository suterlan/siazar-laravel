<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 1cm 2cm;
            }

            /** Define now the real margins of every page in the PDF **/
            body {
                width: 210mm;
                height: 297mm;
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
            }
            .foot-note {
                font-size: 10px;
            }
            #versi {
                margin-left: auto;
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
                <p style="page-break-after: always;">
                    {!! $surat->isi_surat !!}
                </p>
            </div>
            {{-- <p style="page-break-after: never;">
                Content Page 2
            </p> --}}
        </main>
    </body>
</html>
