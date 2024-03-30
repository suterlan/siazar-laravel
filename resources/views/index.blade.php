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
              {{-- row widget ppdb & siswa --}}
              <div class="row">
                <div class="col-sm-6 col-md-4 mb-4">
                    <a href="/dashboard/ppdb" style="text-decoration: none">
                        <div class="card bg-primary-light text-white" style="border-radius: 1rem">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-light">
                                            <i class="fe fe-16 fe-users text-dark mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-white mb-0">PPDB Tahun ini</p>
                                        <span class="h3 mb-0 text-white">{{ $ppdb }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 mb-4">
                    <a href="/dashboard/siswa" style="text-decoration: none">
                        <div class="card bg-success-light" style="border-radius: 1rem">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-light">
                                            <i class="fe fe-16 fe-user-check text-dark mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-white mb-0">PPDB Diterima </p>
                                        <span class="h3 text-white mb-0">{{$ppdb_approve }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6 col-md-4 mb-4">
                    <a href="/dashboard/guru" style="text-decoration: none">
                        <div class="card bg-danger-light" style="border-radius: 1rem">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-light">
                                            <i class="fe fe-16 fe-user-minus text-dark mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-white mb-0">PPDB Belum Diterima </p>
                                        <span class="h3 text-white mb-0">{{$ppdb_notapprove }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
              </div>
              {{-- end .row widget ppdb & siswa --}}
              <div class="row">
                <div class="col-md-6 col-xl-6 mb-4">
                    <a href="/dashboard/siswa" style="text-decoration: none">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-primary text-white">
                                            <i class="fe fe-16 fe-users mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-dark mb-0">Siswa </p>
                                        <span class="h3 mb-0">{{$siswa }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 col-xl-6 mb-4">
                    <a href="/dashboard/guru" style="text-decoration: none">
                        <div class="card shadow">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-3 text-center">
                                        <span class="circle circle-sm bg-info-dark text-white">
                                            <i class="fe fe-16 fe-user-check mb-0"></i>
                                        </span>
                                    </div>
                                    <div class="col pr-0">
                                        <p class="small text-dark mb-0">Guru </p>
                                        <span class="h3 mb-0">{{$guru }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
              </div>
              {{-- row widget surat --}}
              <div class="row my-4">
                <div class="col-md-6">
                  <div class="card shadow mb-4">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col">
                          <small class="text-muted mb-1">Surat Keluar Tahun Ini</small>
                          <h3 class="card-title mb-0">{{ $jmlSuratkeluar }}</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-up fe-12 text-success"></span><span>Jumlah surat keluar</span></p>
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
                          <small class="text-muted mb-1">Surat Masuk Tahun Ini</small>
                          <h3 class="card-title mb-0">{{ $jmlSuratmasuk }}</h3>
                          <p class="small text-muted mb-0"><span class="fe fe-arrow-down fe-12 text-danger"></span><span>Jumlah surat masuk</span></p>
                        </div>
                        <div class="col-4 text-right">
                          <span class="fe fe-mail fe-32"></span>
                        </div>
                      </div> <!-- /. row -->
                    </div> <!-- /. card-body -->
                  </div> <!-- /. card -->
                </div> <!-- /. col -->
              </div> <!-- .row my-4 -->
              {{-- Chart --}}
              {!! $chart->container() !!}
                <script src="{{ $chart->cdn() }}"></script>
              {!! $chart->script() !!}
            </div> <!-- .col-12 -->
          </div> <!-- .row -->
        </div> <!-- .container-fluid -->
    @endsection

