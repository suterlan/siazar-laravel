@extends('layouts.main')
    @section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
            @if (session()->has('success'))
                <div class="alert alert-success col-12" role="alert">
                    <span class="fe fe-check-circle fe-16 mr-2"></span> {{ session('success') }}
                </div>
            @endif
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Selamat Datang! <span class="text-primary-dark">{{ auth()->user()->name }}</span></h2>
                </div>
              </div>
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    @endsection

