@extends('layouts.main')
@section('content')
<div class="container-fluid">
    <div class="col-12">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header m-3">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="/dashboard/pesan" type="button" class="btn mb-2 btn-outline-secondary"><span class="fe fe-arrow-left fe-16 mr-2"></span> Kembali</a>
                            <a id="printPesan" type="button" class="btn mb-2 btn-outline-secondary"><span class="fe fe-printer fe-16 mr-2"></span> Print</a>
                            <a href="/dashboard/pesan/tulis-email/{{ $pesan->id }}" type="button" class="btn mb-2 btn-outline-secondary"><span class="fe fe-corner-up-right fe-16 mr-2"></span> Balas</a>
                        </div>
                        <div class="float-right">{{ $pesan->created_at->diffForHumans() }}</div><hr>
                        <div>Pesan Pengunjung - {{ \Carbon\Carbon::parse($pesan->created_at)->format('d M Y H:i:s'); }}</div>
                        <div> Dari : {{ $pesan->nama }} <a href="/dashboard/pesan/tulis-email/{{ $pesan->id }}">{{ $pesan->email }}</a></div>
                    </div>
                    <div class="card-body">
                        <p>{{ $pesan->pesan }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const btnPrint = document.getElementById('printPesan');
    btnPrint.addEventListener('click', () => {
        window.print();
    });
</script>
@endsection
