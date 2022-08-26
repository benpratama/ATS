@extends('layouts.app')

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
                <div class="col">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">PROSES</h5>
                </div>
              </div>
            </div>
            <div class="card-body">
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
                    <th><input type="checkbox" id="cekAll-kandidat"></th>
                    <th>Usia</th>
                    <th>Domisili</th>
                    <th>Gender</th>
                    <th>Pendidikan</th>
                    <th>Jurusan</th>
                    <th>Fresh or not</th>
                    <th>Bidang lini</th>
                    <th>Penempatan luar indo</th>
                    <th>ditempatkan luar indo</th>
                    <th>SIM</th>
                    <th>Apply</th>
                    <th>Status</th>
                    <th>Detail</th>
                  </tr>
                </thead>
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