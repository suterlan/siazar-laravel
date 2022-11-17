@extends('layouts.main')
    @section('content')
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row align-items-center mb-2">
                <div class="col">
                  <h2 class="h5 page-title">Welcome!</h2>
                </div>
                <div class="col-auto">
                  <form class="form-inline">
                    <div class="form-group d-none d-lg-inline">
                      <label for="reportrange" class="sr-only">Date Ranges</label>
                      <div id="reportrange" class="px-2 py-2 text-muted">
                        <span class="small"></span>
                      </div>
                    </div>
                    <div class="form-group">
                      <button type="button" class="btn btn-sm"><span class="fe fe-refresh-ccw fe-16 text-muted"></span></button>
                      <button type="button" class="btn btn-sm mr-2"><span class="fe fe-filter fe-16 text-muted"></span></button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row my-4">
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Surat Keluar</small>
                          <h3 class="card-title mb-0">1168</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-down fe-12 text-danger"></span><span>-18.9% Last week</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="fe fe-mail fe-32"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Surat Masuk</small>
                          <h3 class="card-title mb-0">1168</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-down fe-12 text-danger"></span><span>-18.9% Last week</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="fe fe-mail fe-32"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div>
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    @endsection

