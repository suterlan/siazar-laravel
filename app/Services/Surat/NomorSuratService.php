<?php

namespace App\Services\Surat;

use App\Models\SuratKeluar;

class NomorSuratService
{
	protected $kodeKlasifikasi;
	protected $surat;

	public function __construct($kode_klasifikasi)
	{
		$this->kodeKlasifikasi =  $kode_klasifikasi;
		// ambil data terakhir dari tabel surat keluar
		$this->surat = SuratKeluar::latest('id')->first();
	}

	public function createNomor()
	{

		if ($this->kodeKlasifikasi != '') {

			if (!blank($this->surat)) {
				// simpan nomor_surat yang didapat ke dalam variabel $lasNoSurat
				$lastNoSurat = $this->surat->no_surat;
				// pecah nomor_surat menjadi beberapa bagian berdasarkan separator "/"
				// dan simpan kedalam variabel temp
				$temp = explode('/', $lastNoSurat);
				// ambil array index pertama (0) dari hasil pemecahan nomor_surat
				// dan ubah menjadi tipe data integer
				$noCurrent = (int) $temp[0];
				// nomor surat saat ini kemudian ditambah 1 dan simpan ke variabel $noNext
				$noNext = $noCurrent + 1;
				// ubah kembali menjadi tipe data string dan simpan ke variabel $no_surat
				$no_surat = sprintf('%03s', $noNext);
			} else {
				$no_surat = '001';
			}

			// Buat bulan dalam angka romawi
			$currenMonth = date('n');
			$romawi = self::toRomawi($currenMonth);

			// gabungkan, sehingga menjadi no surat
			$no_surat = $no_surat . '/' . $this->kodeKlasifikasi . '/SMK-AZ/' . $romawi . '/' . date('Y');

			return $no_surat;
		} else {
			return $no_surat = '';
		}
	}

	public function toRomawi($currenMonth)
	{
		switch ($currenMonth) {
			case 1:
				return 'I';
				break;
			case 2:
				return 'II';
				break;
			case 3:
				return 'III';
				break;
			case 4:
				return 'IV';
				break;
			case 5:
				return 'V';
				break;
			case 6:
				return 'VI';
				break;
			case 7:
				return 'VII';
				break;
			case 8:
				return 'VIII';
				break;
			case 9:
				return 'IX';
				break;
			case 10:
				return 'X';
				break;
			case 11:
				return 'XI';
				break;
			case 12:
				return 'XII';
				break;
		}
	}
}
