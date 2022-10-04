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

    {{-- TABLE Filter --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                <h5 class="h3 mb-0">Filter</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row d-flex">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Start Period</label>
                  <input class="form-control" type="date" value="" id="filter_Speriod" name="filter_Speriod">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Eperiod">End Period</label>
                  <input class="form-control" type="date" value="" id="filter_Eperiod" name="filter_Eperiod">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Umur</label>
                  <div class="d-flex">
                    <input class="form-control" type="number"  min="0" max="100" id="startAge" name="startAge">
                    <label style="margin:0.5em;">s/d</label>
                    <input class="form-control" type="number"  min="0" max="100" id="endAge" name="endAge">
                  </div>
                </div>
              </div>
              {{-- <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Gender</label>
                  <select id="f_gender" class="form-control js-example-basic-multiple " name="f_gender[]" multiple="multiple">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                  </select>
                </div>
              </div> --}}
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Pendidikan</label>
                  <select id="f_pendidikan" class="form-control js-example-basic-multiple " name="f_pendidikan[]" multiple="multiple">
                    @foreach ($ListPendidikan as $pendidikan )
                      <option value="{{ $pendidikan->pendidikan }}">{{ $pendidikan->pendidikan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_jurusan">Jurusan</label>
                  <select id="f_jurusans" class="form-control js-example-basic-multiple " name="f_jurusan[]" multiple="multiple">
                    @foreach ($ListJurusan as $jurusan )
                      <option value="{{ $jurusan->nama }}">{{ $jurusan->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              {{-- <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Lama kerja</label>
                  <select id="f_lamakerja" class="form-control js-example-basic-multiple " name="f_lamakerja[]" multiple="multiple">
                      <option value="0">0 Tahun</option>
                      <option value="1">1 - 2 Tahun</option>
                      <option value="2">2 - 3 Tahun</option>
                      <option value="3">3 - 4 Tahun</option>
                      <option value="4">4 - 5 Tahun</option>
                      <option value="5">5> Tahun</option>
                  </select>
                </div>
              </div> --}}
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_job">Apply</label>
                  <select id="f_job" class="form-control js-example-basic-multiple " name="f_job[]" multiple="multiple">
                    @foreach ($ListJob as $job )
                      <option value="{{ $job->nama }}">{{ $job->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Status</label>
                  <select id="f_status" class="form-control js-example-basic-multiple " name="f_status[]" multiple="multiple">
                    @foreach ($ListStatus as $status )
                      <option value="{{ $status->proses }}">{{ $status->proses }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Domisili</label>
                  <select id="f_domisili" class="form-control js-example-basic-multiple " name="f_domisili[]" multiple="multiple">
                    @foreach ($Domisili as $Domisili )
                      <option value="{{ $Domisili->kabupaten }}">{{ $Domisili->kabupaten }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <button id="filterdashboard" type="button" class="btn btn-primary btnsbmt">Filter</button>
          </div>
        </div>
      </div>
    </div>
    
    {{-- {{dd(session()->get('user')['organisasi']) }} --}}
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
                    <th  class="thseacrh"><input type="checkbox" id="cekAll-kandidat"></th>
                    <th  >Usia</th>
                    <th >Domisili</th>
                    <th >Gender</th>
                    <th >Pendidikan</th>
                    <th >Jurusan</th>
                    <th >Pengalaman</th>
                    <th >Bidang lini</th>
                    <th >Lama Kerja</th>
                    <th >Penempatan luar indo</th>
                    {{-- @if (session()->get('user')['organisasi']!='3') --}}
                    <th >ditempatkan luar indo</th>
                    {{-- @endif --}}
                    <th >SIM</th>
                    <th >Apply</th>
                    <th >Status</th>
                    <th >Detail</th>
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

<!-- Code begins here -->


{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection