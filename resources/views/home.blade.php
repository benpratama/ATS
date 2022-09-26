@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
<style>
  .btnhide{
    padding: 0.3em !important;
    margin-left: 2.7em;
  }
</style>
@endsection

@section('content')
<div class="header bg-primary pb-6">
    {{-- !!! ROUTE DIHEADER !!! --}}
    <div class="container-fluid">
      <div class="header-body">
        <div class="row align-items-center py-4">
          <div class="col-lg-6 col-7">
            <h6 class="h2 text-white d-inline-block mb-0">Dashboards</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboards</a></li>
                <li class="breadcrumb-item active" aria-current="page">HRD</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    <div class="row">
        <div class="col-xl-12">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">PROSES</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_summary" type="button" class="btn btn-danger d-flex btnhide" data-value="0">
                    <span id="span_summary" class="material-symbols-outlined">
                      close_fullscreen
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div id="body_summary" class="card-body">
              <div class="row" id="summary">
                {{-- disni --}}

              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- TABLE KANDIDAT --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                <h5 class="h3 mb-0">Kandidat</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblKandidat" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 123.778px;" class="thseacrh"><input type="checkbox" id="cekAll-kandidat"></th>
                    <th style="width: 123.778px;" id="2">Usia</th>
                    <th style="width: 123.778px;" id="3">Domisili</th>
                    <th style="width: 123.778px;" id="4">Gender</th>
                    <th style="width: 123.778px;" id="5">Pendidikan</th>
                    <th style="width: 123.778px;" id="6">Jurusan</th>
                    <th style="width: 123.778px;" id="7">Pengalaman</th>
                    <th style="width: 123.778px;" id="8">Bidang lini</th>
                    <th style="width: 123.778px;" id="9">Lama Kerja</th>
                    <th style="width: 123.778px;" id="10">Penempatan luar indo</th>
                    <th style="width: 123.778px;" id="11">ditempatkan luar indo</th>
                    <th style="width: 123.778px;" id="12">SIM</th>
                    <th style="width: 123.778px;" id="13">Apply</th>
                    <th style="width: 123.778px;" id="14">Status</th>
                    <th style="width: 123.778px;" id="15">Detail</th>
                  </tr>
                </thead>
                {{-- <thead id="DTsearch">
                  <tr>
                    <th></th>
                    <th class="thseacrh">Usia</th>
                    <th class="thseacrh">Domisili</th>
                    <th class="thseacrh">Gender</th>
                    <th class="thseacrh">Pendidikan</th>
                    <th class="thseacrh">Jurusan</th>
                    <th class="thseacrh">Fresh or not</th>
                    <th class="thseacrh">Bidang lini</th>
                    <th class="thseacrh">Penempatan luar indo</th>
                    <th class="thseacrh">ditempatkan luar indo</th>
                    <th class="thseacrh">SIM</th>
                    <th class="thseacrh">Apply</th>
                    <th class="thseacrh">Status</th>
                    <th></th>
                </tr>
                </thead> --}}
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection