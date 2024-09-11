@extends('layouts.main')
@section('content')
<div class="container-fluid">
	 <div class="col-12">
		  <div class="row">
				<div class="card shadow col-lg-12">
					 <div class="card-body">
						  <h5><strong>Buat Surat Keputusan Tentang Pengangkatan Guru </strong></h5>
						  <p>Tahun Pelajaran {{$skbm->tahun_ajaran}}</p>
						  @if (session()->has('success'))
								<div class="alert alert-success col-12" role="alert">
									 <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
								</div>
						  @endif
							@if (session()->has('error'))
								<div class="alert alert-danger col-12" role="alert">
										<span class="fe fe-info fe-16 mr-2"></span> {{ session('error') }}
								</div>
							@endif
						  <form class="needs-validation  @if ($errors->any()) was-validated @endif" action="{{route('skp.store', $skbm->id)}}" method="post" novalidate>
								@csrf
								<div class="form-group mb-2">
									<label for="kode_klasifikasi">Kode Klasifikasi</label>
									<input type="hidden" class="form-control" name="klasifikasi_id" value="{{$klasifikasi_id}}" readonly>
									<input type="text" class="form-control" name="kode_klasifikasi" value="{{$kodeKlasifikasi}}" readonly>
								</div>
								<div class="form-group mb-2">
									<label for="tahun_ajaran">Tahun Ajaran</label>
									<input class="form-control input-tahun-ajaran" id="tahun_ajaran" type="text" name="tahun_ajaran" value="{{$skbm->tahun_ajaran}}" placeholder="____/____" maxlength="9" readonly>
									@error('tahun_ajaran')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
								<div class="form-group mb-2">
									<label for="semester">Semester</label>
									<input type="text" class="form-control" id="semester" name="semester" value="{{$skbm->semester}}" readonly>
								</div>
								<div class="form-group mb-3">
									<div>Daftar guru yang akan dibuatkan SK :</div>
									<div class="card">
										<div class="card-body">
											<div class="row row-radio-guru">
												@foreach ($gurus as $guru)	
												<div class="col-sm-6 col-md-4">
													<div class="custom-control custom-checkbox">
														<input type="hidden" name="guru_id[]" value="{{$guru->id}}">
														<input type="checkbox" class="custom-control-input" id="guru{{$guru->id}}" name="guru_id[]" value="{{$guru->id}}" disabled checked>
														<label class="custom-control-label" for="guru{{$guru->id}}">{{$guru->nama}}</label>
													</div>
												</div>
												@endforeach
											</div>
										</div>
									</div>
								</div>

								<div class="form-group mb-3">
									 <button class="btn btn-primary" type="submit"><span class="fe fe-save"></span> Simpan</button>
								</div>
						  </form>
					 </div>
				</div>
		  </div>
	 </div>
</div>
@endsection
