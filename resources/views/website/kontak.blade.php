@extends('website.layout.main')
@section('content')
    <!-- Contact Start -->
    <div class="container-fluid pt-5">
      <div class="col-md-10 justify-content-center mx-auto">
        <div class="text-center pb-2">
          <p class="section-title px-5">
            <span class="px-2">Informasi</span>
          </p>
          <h1 class="mb-4">Hubungi Kami</h1>
        </div>
        <div class="row">
          <div class="col-lg-7 mb-5">
            @if (session()->has('success'))
            <div class="alert alert-success col-12" role="alert">
                <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
            </div>
            @endif
            <div class="contact-form">
              <div id="success"></div>
              <form action="/pesan" id="contactForm" method="post" class="needs-validation @if ($errors->any()) was-validated @endif" novalidate="novalidate">
                @csrf
                <div class="control-group">
                  <input
                    type="text"
                    class="form-control {{$errors->first('nama') ? "is-invalid" : "" }}"
                    id="nama"
                    name="nama"
                    placeholder="Masukan Nama"
                    required="required"
                    data-validation-required-message="Please enter your name"
                  />
                @error('nama')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <input
                    type="email"
                    class="form-control {{$errors->first('email') ? "is-invalid" : "" }}"
                    id="email"
                    name="email"
                    placeholder="Email"
                    required="required"
                    data-validation-required-message="Please enter your email"
                  />
                  @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                    @enderror
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <input
                    type="text"
                    class="form-control {{$errors->first('subject') ? "is-invalid" : "" }}"
                    id="subject"
                    name="subject"
                    placeholder="Subject"
                    required="required"
                    data-validation-required-message="Please enter a subject"
                  />
                  @error('subject')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                  <p class="help-block text-danger"></p>
                </div>
                <div class="control-group">
                  <textarea
                    class="form-control {{$errors->first('pesan') ? "is-invalid" : "" }}"
                    rows="6"
                    id="pesan"
                    name="pesan"
                    placeholder="Tulis pesan anda..."
                    required="required"
                    data-validation-required-message="Please enter your message"
                  ></textarea>
                  @error('pesan')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                  <p class="help-block text-danger"></p>
                </div>
                <div>
                  <button
                    class="btn btn-primary py-2 px-4"
                    type="submit"
                    id="sendMessageButton"
                  >
                    Send Message
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="col-lg-5 mb-5">
            <p>Mendidik dengan sepenuh hati untuk menciptakan lulusan yang berakhlakul karimah</p>
            <div class="d-flex mb-2">
              <i
                class="fa fa-map-marker-alt d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3">
                <h5>Alamat</h5>
              </div>
            </div>
            <p>{{$setting->alamat}}</p>

            <div class="d-flex mb-3">
              <i
                class="fa fa-envelope d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3">
                <h5>Email</h5>
                <small>{{$setting->email}}</small>
              </div>
            </div>
            <div class="d-flex mb-3">
              <i
                class="fa fa-phone-alt d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                style="width: 45px; height: 45px"
              ></i>
              <div class="pl-3">
                <h5>Telepon</h5>
                <small>{{$setting->no_telepon}}</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Contact End -->
@endsection
