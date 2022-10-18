@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
<style>
  .btnhide{
    padding: 0.3em !important;
    margin-left: 2.7em;
  }
  .test{
    margin-top: 2em
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
                <li class="breadcrumb-item"><a href="{{ route('home') }}">MPP Dashboards</a></li>
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
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">MPP</h6>
                <h5 class="h3 mb-0">Data</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <label id="NIK">{{ session()->get('user')['NIK'] }}\</label>
              <label id="id_User">{{ session()->get('user')['id'] }}\</label>
              <label id="id_organisasi">{{ session()->get('user')['organisasi'] }}\</label>
              <label id="id_dept">{{ session()->get('user')['dept'] }}</label>
            </div>
            <div class="row d-flex col-12">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_tahunBE">Tahun BE</label>
                  <input type="number" min="1900" max="9999" step="1" placeholder="2022" class="form-control" name="filter_tahunBE" id="filter_tahunBE" >
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_lob">LOB</label>
                  <select class="js-example-basic-single form-control" name="filter_lob" id="filter_lob">
                    <option value="" disabled selected>LOB</option>
                    @foreach ($ListLob as $lob )
                    <option value="{{ $lob->id_MLobandSub }}">{{ $lob->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-2 test ">
                <div class="form-group">
                  <button id="filtermpp" type="button" class="btn btn-primary btnsbmt">Filter</button>
                </div>
              </div>
            </div>
            <hr class="my-4"> 
            <table class="table" id="TblMpp">
              <thead class="thead-light">
                <tr>
                  <th>Job Level / Function</th>
                  <th>Budget</th>
                  <th>Total Employee Request</th>
                  <th>Gap ER to Budget</th>
                </tr>
              </thead>
              <tbody id='detail'>
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div> 

<!-- Code begins here -->


{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/requestor.js') }}"></script>
@endsection