@extends('layouts.main')
    @section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Selamat Datang! <span class="text-primary-dark">{{ auth()->user()->name }}</span></h2>
                </div>
              </div>
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    @endsection

