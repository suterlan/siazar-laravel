@extends('layouts.main')
@section('content')
<div class="container-fluid">
		<div class="col-12">
				<div class="row">
						<div class="card shadow col-lg-12">
								<div class="card-body">
										<h4><strong>Edit Surat KBM</strong></h3>
										<form class="needs-validation @if ($errors->any()) was-validated @endif" action="/dashboard/suratkeluar/skbm/{{ $surat->id }}" method="post" novalidate>
												@method('put')
												@csrf
												<div class="form-row">
														<div class="form-group col-lg-6">
																{{-- <input type="hidden" name="jenis" id="jenis" value="{{ $jenis }}"> --}}
																<Label for="klasifikasi">Pilih Klasifikasi</Label>
																<select id="klasifikasi" name="klasifikasi_id" class="form-control select2" onchange="changeKlasifikasi()" required>
																		<option value="">&nbsp;</option>
																		@foreach ($klasifikasi as $klasifikasi )
																				@if (old('klasifikasi_id', $surat->suratkeluar->klasifikasi_id) == $klasifikasi->id)
																						<option value="{{ $klasifikasi->id }}" data-kode="{{ $klasifikasi->kode }}" selected>{{ $klasifikasi->nama }}</option>
																				@else
																						<option value="{{ $klasifikasi->id }}" data-kode="{{ $klasifikasi->kode }}">{{ $klasifikasi->nama }}</option>
																				@endif
																		@endforeach
																</select>
																@error('klasifikasi_id')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
														<div class="form-group col-lg-6">
																<label for="tanggal_surat">Tanggal Surat</label>
																<div class="input-group">
																		<input name="tanggal_surat" type="text" class="form-control drgpicker" id="tanggal_surat" value="{{ $surat->suratkeluar->tanggal_surat }}" aria-describedby="button-addon-date" required>
																		<div class="input-group-append">
																		<div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
																		</div>
																</div>
														</div>
												</div>
												<div class="form-row">
														<div class="form-group col-lg-6">
																<label for="no_surat">Nomor Surat</label>
																<p class="text-info" style="font-size: 80%"><span class="fe fe-info"></span> Nomor surat akan diisi otomatis saat memilih klasifikasi</p>
																<input name="no_surat" id="no_surat" type="text" class="form-control" aria-describedby="addonSurat" value="{{ old('no_surat', $surat->no_surat) }}" readonly required>
																@error('no_surat')
																		<div class="invalid-feedback">{{ $message }}</div>
																@enderror
														</div>
												</div>
												<div class="form-group mb-2">
														<label for="tahun_ajaran">Tahun Ajaran</label>
														<input class="form-control input-tahun-ajaran col-lg-6" id="tahun_ajaran" type="text" name="tahun_ajaran" value="{{$surat->tahun_ajaran}}" placeholder="____/____" maxlength="9" required readonly>
														@error('tahun_ajaran')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div>
												{{-- <div class="form-group mb-2">
														<label for="tahun_ajaran">Tahun Ajaran</label>
														<select class="form-control col-lg-6 {{$errors->first('tahun_ajaran') ? "is-invalid" : "" }}" id="tahun_ajaran" name="tahun_ajaran" required>
																@foreach ($tahuns as $tahun => $value)
																		<option value="{{ $tahun }}" @selected($surat->tahun_ajaran == $tahun)>
																				{{ $tahun }}
																		</option>
																@endforeach
														</select>
														@error('tahun_ajaran')
																<div class="invalid-feedback">{{ $message }}</div>
														@enderror
												</div> --}}
												<label class="form-label mt-2">Semster</label>
												<div class="form-group mb-2">
														<div class="form-check form-check-inline select-semester" for="semester1">
																<input type="radio" name="semester" id="semester1" value="Ganjil" @if(isset($surat->semester) && $surat->semester == 'Ganjil') checked  @endif readonly onclick="return false;" required>
																<label class="form-check-label pl-1" for="semester1">Ganjil</label>
														</div>
														<div class="form-check form-check-inline select-semester" for="semester2">
																<input type="radio" name="semester" id="semester2" value="Genap" @if(isset($surat->semester) && $surat->semester == 'Genap') checked  @endif readonly onclick="return false;" required>
																<label class="form-check-label pl-1" for="semester2">Genap</label>
														</div>
														@error('semester')
																<div class="error text-danger"><small>{{ $message }}</small> </div>
														@enderror
												</div>

												<div class="form-group mb-3">
														<div>Daftar guru yang dibuatkan SK :</div>
														{{-- <div class="card">
																<div class="card-body">
																		<div class="row row-radio-guru"> --}}
																				
																				<div class="table-responsive">
																				<table class="table">
																				@foreach ($skGurus as $skGuru)
																						<tr>
																								<td class="text-nowrap" style="padding-top: 0.5%; padding-bottom: 0.5%">
																										<div class="custom-control custom-checkbox">
																												<input type="checkbox" class="custom-control-input" id="guru{{$skGuru->guru_id}}" name="guru_id[]" value="{{$skGuru->guru_id}}" disabled checked>
																												<label class="custom-control-label" for="guru{{$skGuru->guru_id}}">{{$skGuru->guru->nama}}</label>
																										</div>
																								</td>
																								<td class="text-nowrap" style="padding-top: 0.5%; padding-bottom: 0.5%">
																										<div>Nomor : </div>
																								</td>
																								<td class="text-nowrap" style="padding-top: 0.5%; padding-bottom: 0.5%">
																										<input type="hidden" id="sk_guru{{$skGuru->id}}" name="sk_guru[{{$skGuru->id}}]" class="form-control no-sk" value="{{$skGuru->no_surat}}" readonly />
																										<div id="sk_guru{{$skGuru->id}}" class="show-sk">{{$skGuru->no_surat}}</div>
																								</td>
																						</tr>
																				{{-- <div class="col-sm-6 col-md-4">
																						<div class="custom-control custom-checkbox">
																								<input type="hidden" name="guru_id[]" value="{{$skGuru->guru_id}}">
																								<input type="checkbox" class="custom-control-input" id="guru{{$skGuru->guru_id}}" name="guru_id[]" value="{{$skGuru->guru_id}}" disabled checked>
																								<label class="custom-control-label" for="guru{{$skGuru->guru_id}}">{{$skGuru->guru->nama}}</label>
																						</div>
																				</div> --}}
																				@endforeach
																				</table>
																				</div>
																				{{-- javascript here --}}
																		{{-- </div>
																</div>
														</div> --}}
												</div>

												<label class="form-label mt-2 mb-0">Aktifkan E-Sign 
														<span class="text-info"><i class="fe fe-info" title="Tanda tangan elektronik menggunakan qrcode"></i></span>
												</label>
												<div class="form-group mb-2">
														<div class="custom-control custom-switch">
																<input type="checkbox" class="custom-control-input" id="qr_active" name="qr_active"
																@isset($esign)
																		@checked($esign->active == true)
																@endisset 
																>
																<label class="custom-control-label" for="qr_active">Aktif</label>
														</div>
												</div>
												<div class="form-group mb-3 mt-4">
														<a href="/dashboard/suratkeluar/skbm" class="btn btn-danger"><span class="fe fe-arrow-left"></span> Kembali</a>
														<button class="btn btn-success float-right" type="submit"><span class="fe fe-save"></span> Update</button>
												</div>
										</form>
								</div>
						</div>
				</div>
		</div>
</div>
<script>
	function changeKlasifikasi(){
			const klasifikasi = document.querySelector('#klasifikasi');
			const noSurat = document.querySelector('#no_surat');
			// split no surat untuk menghilangkan simbol '/' dan mengubahnya jadi array
			const arrSurat = noSurat.value.split('/');
			// ganti array no surat index ke-1 yang merupakan id dari klasifikasi
			arrSurat[1] = klasifikasi.options[klasifikasi.selectedIndex].dataset.kode;
			// simpan perubahan pada variabel newNoSurat
			const newNoSurat = arrSurat.join('/');
			// ganti isi nomor surat dengan no surat baru
			noSurat.value = newNoSurat;

			changeNoSk(klasifikasi);
	}

	function changeNoSk(klasifikasi){
			const noSk = document.querySelectorAll('.no-sk');

			noSk.forEach( (e) => {
					const arrSk = e.value.split('/');
					arrSk[1] = klasifikasi.options[klasifikasi.selectedIndex].dataset.kode;
					const newSk = arrSk.join('/');

					e.nextElementSibling.textContent = newSk;
					e.value = newSk;
			})
	}

</script>
@endsection
