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
                <li class="breadcrumb-item active" aria-current="page">Requestor</li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
     {{-- !! FILTER !! --}}
     <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">FILTER</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            
          </div>
        </div>
      </div>
    </div>

     {{-- !! FPTK !! --}}
     <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">List</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <label id="NIK" hidden>{{ session()->get('user')['NIK'] }}</label>
            <label id="id_User" hidden>{{ session()->get('user')['id'] }}</label>
            <label id="id_organisasi" hidden>{{ session()->get('user')['organisasi'] }}</label>
            <label id="id_dept" hidden>{{ session()->get('user')['dept'] }}</label>
            <div class="table-responsive">
              <table class="table" id="TblReqFPTK" width=100%>
                <thead class="thead-light">
                  <tr>
                    <th>No FPTK</th>
                    <th>Lokasi</th>
                    <th>Nama yang diganti</th>
                    <th>Alasan</th>
                    <th>Progres</th>
                    <th>Kandidat</th>
                    <th>Status</th>
                    <th>Detail Kandidat</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> 

<!-- Code begins here -->


{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/rqFPTK.js') }}"></script>
@endsection