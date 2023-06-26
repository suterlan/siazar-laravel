
<table>
    <thead>
        <tr>
            <th></th>
            <th colspan="2">
                <h3>DATA PPDB </h3>
            </th>
        </tr>
        <tr>
            <th></th>
            <th colspan="2">
               <h5>SMK AZ-ZARKASYIH</h5>
            </th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr></tr>
    <tr>
        <th>NO</th>
        <th>NAMA SISWA</th>
        <th>NISN</th>
        <th>NIK</th>
        <th>JK</th>
        <th>TTL</th>
        <th>ASAL SEKOLAH</th>
        <th>JURUSAN DIPILIH</th>
        <th>INPUT OLEH</th>
        <th>TGL INPUT</th>
        <th>NO HP</th>
        <th>ALAMAT</th>
        <th>PROVINSI</th>
        <th>KABUPATEN</th>
        <th>KECAMATAN</th>
        <th>DESA</th>
        <th>NO IJAZAH</th>
        <th>NO SKHUN</th>
        <th>NAMA AYAH</th>
        <th>NIK AYAH</th>
        <th>PENDIDIKAN AYAH</th>
        <th>PEKERJAAN AYAH</th>
        <th>PENGHASILAN AYAH</th>
        <th>NAMA IBU</th>
        <th>NIK IBU</th>
        <th>PENDIDIKAN IBU</th>
        <th>PEKERJAAN IBU</th>
        <th>PENGHASILAN IBU</th>
        <th>JML SAUDARA</th>
        <th>NO KIP</th>
        <th>NAMA KIP</th>
    </tr>
    </thead>
    <tbody>
    @foreach($ppdbs as $ppdb)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $ppdb->nama_siswa }}</td>
            <td>{{ $ppdb->nisn }}</td>
            <td>{{ $ppdb->nik }}</td>
            <td>{{ $ppdb->jk }}</td>
            <td class="text-nowrap">{{ $ppdb->tempat_lahir . ', ' . \Carbon\Carbon::parse($ppdb->tgl_lahir)->format('d-m-Y') }}</td>
            <td>{{ $ppdb->asal_sekolah }}</td>
            <td>{{ $ppdb->jurusan->kode ?? '' }}</td>
            <td>{{ $ppdb->user->name ?? ''}}</td>
            <td class="text-nowrap">{{ \Carbon\Carbon::parse($ppdb->created_at)->format('d-m-Y') }}</td>
            <td>{{ $ppdb->no_hp ?? ''}}</td>
            <td>{{ $ppdb->alamat ?? ''}}</td>
            <td>{{ $ppdb->provinsi ?? ''}}</td>
            <td>{{ $ppdb->kabupaten ?? ''}}</td>
            <td>{{ $ppdb->kecamatan ?? ''}}</td>
            <td>{{ $ppdb->desa ?? ''}}</td>
            <td>{{ $ppdb->no_ijazah ?? ''}}</td>
            <td>{{ $ppdb->no_skhun ?? ''}}</td>
            <td>{{ $ppdb->nama_ayah ?? ''}}</td>
            <td>{{ $ppdb->nik_ayah ?? ''}}</td>
            <td>{{ $ppdb->pendidikan_ayah ?? ''}}</td>
            <td>{{ $ppdb->pekerjaan_ayah ?? ''}}</td>
            <td>{{ $ppdb->penghasilan_ayah ?? ''}}</td>
            <td>{{ $ppdb->nama_ibu }}</td>
            <td>{{ $ppdb->nik_ibu ?? ''}}</td>
            <td>{{ $ppdb->pendidikan_ibu ?? ''}}</td>
            <td>{{ $ppdb->pekerjaan_ibu ?? ''}}</td>
            <td>{{ $ppdb->penghasilan_ibu ?? ''}}</td>
            <td>{{ $ppdb->jml_saudara_kandung ?? ''}}</td>
            <td>{{ $ppdb->no_kip ?? ''}}</td>
            <td>{{ $ppdb->nama_kip ?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
