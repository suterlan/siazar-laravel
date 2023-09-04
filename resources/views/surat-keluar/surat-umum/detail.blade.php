@include('partials.header')
<body class="vertical light">
    <div class="wrapper">
        <main role="main" class="main-content">
            <div class="container-fluid">
                <div class="col-12">
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
                    </table>
                    <div class="form-group mb-3">
                        <input type="hidden" name="detail_surat" value="{{ old('detail_surat', $surat->isi_surat) }}" readonly>
                        <div id="detail_surat" style="min-height: 300px">{!! old('detail_surat', $surat->isi_surat) !!}</div>
                    </div>
                </div>
            </div>
        </main>
        <script>
            setTimeout(() => {
                window.print();
            }, 10000);
        </script>
@include('partials.footer')
</body>
</html>
