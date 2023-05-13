<div style="background-color: red">
    <img style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 1cm;" src="{{ asset('storage/' . $footer->logo) }}" width="100px">
</div>


<div>
    {!! $content !!}
</div>

<p style="margin-bottom: 1cm">Terima Kasih,</p>
<div style="margin: 0cm"><b>{{ $footer->nama_sekolah }}</b></div>
<p style="margin: 0cm">{{ $footer->alamat }}</p>
<p style="margin: 0cm">Telepon : {{ $footer->no_telepon }}</p>
<p style="margin: 0cm">Youtube : <a href="{{ $footer->link_youtube }}">{{ $footer->link_youtube }}</a></p>

