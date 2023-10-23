
<table>
    <thead>
        <tr>
            <th></th>
            <th colspan="2">
                <h3>DATA SISWA </h3>
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
        <th>KELAS</th>
        <th>JURUSAN</th>
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
        <th>STATUS SISWA</th>
    </tr>
    </thead>
    <tbody>
    @foreach($siswas as $siswa)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $siswa->nama_siswa }}</td>
            <td>{{ $siswa->nisn }}</td>
            <td>{{ $siswa->nik }}</td>
            <td>{{ $siswa->jk }}</td>
            <td class="text-nowrap">{{ $siswa->tempat_lahir . ', ' . \Carbon\Carbon::parse($siswa->tgl_lahir)->format('d-m-Y') }}</td>
            <td>{{ $siswa->asal_sekolah }}</td>
            <td>{{ $siswa->kelas->nama ?? '' }}</td>
            <td>{{ $siswa->jurusan->kode ?? '' }}</td>
            <td class="text-nowrap">{{ \Carbon\Carbon::parse($siswa->created_at)->format('d-m-Y') }}</td>
            <td>{{ $siswa->no_hp ?? ''}}</td>
            <td>{{ $siswa->alamat ?? ''}}</td>
            <td>{{ $siswa->provinsi ?? ''}}</td>
            <td>{{ $siswa->kabupaten ?? ''}}</td>
            <td>{{ $siswa->kecamatan ?? ''}}</td>
            <td>{{ $siswa->desa ?? ''}}</td>
            <td>{{ $siswa->no_ijazah ?? ''}}</td>
            <td>{{ $siswa->no_skhun ?? ''}}</td>
            <td>{{ $siswa->nama_ayah ?? ''}}</td>
            <td>{{ $siswa->nik_ayah ?? ''}}</td>
            <td>{{ $siswa->pendidikan_ayah ?? ''}}</td>
            <td>{{ $siswa->pekerjaan_ayah ?? ''}}</td>
            <td>{{ $siswa->penghasilan_ayah ?? ''}}</td>
            <td>{{ $siswa->nama_ibu }}</td>
            <td>{{ $siswa->nik_ibu ?? ''}}</td>
            <td>{{ $siswa->pendidikan_ibu ?? ''}}</td>
            <td>{{ $siswa->pekerjaan_ibu ?? ''}}</td>
            <td>{{ $siswa->penghasilan_ibu ?? ''}}</td>
            <td>{{ $siswa->jml_saudara_kandung ?? ''}}</td>
            <td>{{ $siswa->no_kip ?? ''}}</td>
            <td>{{ $siswa->nama_kip ?? ''}}</td>
            <td>
                @if ($siswa->status_siswa == true)
                    Aktif
                @else
                    Tidak Aktif
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
