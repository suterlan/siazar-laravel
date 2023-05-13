@extends('layouts.main')

@section('content')
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-md-8">
                    @if (session()->has('success'))
                    <div class="alert alert-success col-12" role="alert">
                        <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                    </div>
                    @endif
                    <div class="card shadow px-3">
                        <div class="card-header">
                            <a href="/dashboard/pesan/{{ $pesan->id }}" type="button" class="btn mb-2 btn-outline-secondary"><span class="fe fe-arrow-left fe-16 mr-2"></span> Kembali</a>
                        </div>
                        <div class="card-body">
                            <form action="/dashboard/pesan/kirim-email" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate>
                                @csrf
                                <div class="form-inline mb-3">
                                    <div class="form-group">
                                        <label for="email">Balas Ke : </label>
                                        <input type="text" readonly class="form-control-sm ml-2" name="email" id="email" value="{{ $pesan->email }}">
                                    </div>
                                </div>
                                <div class="form-inline mb-3">
                                    <div class="form-group">
                                        <label for="subject">Subject : </label>
                                        <input type="text" readonly class="form-control-sm ml-3" name="subject" id="subject" value="{{ $pesan->subject }}">
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    @error('content')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                    <input type="hidden" name="content" value="{{ old('content') }}" required>
                                    <div id="content" style="min-height: 200px">{!! old('content') !!}</div>
                                </div>
                                <div class="form-group mt-2">
                                    <button class="btn btn-primary float-right" type="submit"><span class="fe fe-send"></span> Kirim</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
