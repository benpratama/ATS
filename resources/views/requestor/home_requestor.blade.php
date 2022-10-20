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
    {{-- !! SUMMARY !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card bg-default">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-11">
                <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                <h5 class="h3 text-white mb-0">FPTK</h5>
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
            <div class="row d-flex col-12">
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
            <div class="row d-flex col-12">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_nofptk">NO FPTK</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_nofptk" name="filter_nofptk" required> --}}
                  <select id="filter_nofptk" class="form-control js-example-basic-multiple " name="filter_nofptk[]" multiple="multiple">
                    {{-- @foreach ($nofptks as $nofptk )
                      <option value="{{ $nofptk->nofptk }}">{{ $nofptk->nofptk }}</option>
                    @endforeach --}}
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_lokasi">Lokasi</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_npeminta" name="filter_npeminta" required> --}}
                  <select id="filter_lokasi" class="js-example-basic-multiple form-control" name="filter_lokasi[]" multiple="multiple">
                    {{-- @foreach ($namapemintas as $namapeminta )
                      <option value="{{ $namapeminta->namapeminta }}">{{ $namapeminta->namapeminta }}</option>
                    @endforeach --}}
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_status">Status</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_npeminta" name="filter_npeminta" required> --}}
                  <select id="filter_status" class="js-example-basic-multiple form-control" name="filter_status[]" multiple="multiple">
                    @foreach ($filterstatus as $status )
                      <option value="{{ $status->id }}">{{ $status->keterangan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            {{-- {{ dd($atasan) }} --}}
            @if (in_array(session()->get('user')['id'],$atasan))
              <div class="row d-flex col-12">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="filter_lob">LOB</label>
                    {{-- <input class="form-control" type="text" value="" id="filter_npeminta" name="filter_npeminta" required> --}}
                    <select id="filter_lob" class="js-example-basic-multiple form-control" name="filter_lob[]" multiple="multiple">
                      {{-- @foreach ($namapemintas as $namapeminta )
                        <option value="{{ $namapeminta->namapeminta }}">{{ $namapeminta->namapeminta }}</option>
                      @endforeach --}}
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="filter_npeminta">Nama Peminta</label>
                    {{-- <input class="form-control" type="text" value="" id="filter_npeminta" name="filter_npeminta" required> --}}
                    <select id="filter_namapeminta" class="js-example-basic-multiple form-control" name="filter_namapeminta[]" multiple="multiple">
                      {{-- @foreach ($namapemintas as $namapeminta )
                        <option value="{{ $namapeminta->namapeminta }}">{{ $namapeminta->namapeminta }}</option>
                      @endforeach --}}
                    </select>
                  </div>
                </div>
              </div>
            @endif
            <div class="row d-flex col-12">
              <div class="col-md-4">
                <button id="btnFilter_FPTK" type="button" class="btn btn-primary">Filter</button>
              </div>
            </div>
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
            @if (in_array(session()->get('user')['id'],$atasan))
            <label id="flag_atasan" hidden>1</label>
            @else
            <label id="flag_atasan" hidden>0</label>
            @endif
            @if (in_array(session()->get('user')['id'],$atasan))
            <div class="table-responsive">
              <table class="table" id="TblReqFPTKAtasan" width=100%>
                <thead class="thead-light">
                  <tr>
                    <th>No FPTK</th>
                    <th>Nama Peminta</th>
                    <th>LOB</th>
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
            @else
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
                      <th>LHW</th>
                      <th>Detail Kandidat</th>
                    </tr>
                  </thead>
                </table>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>

    {{-- !!  Start Modal LHW !! --}}
    <div class="modal fade" id="modalLHW" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Upload File FPTK</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="col-md-6">
            <a href="" type="button" class="btn btn-success d-flex" id='downloadLHW'>
              <span class="material-symbols-outlined">add</span>
              <span class="gap-logo">Generate Template</span>
            </a>
          </div>
          

          <form method="POST" action="{{ route('rq.ImportLHW') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="upload_LHW">File LHW</label>
                    <input type="file" class="form-control" name="upload_LHW" id="upload_LHW" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <input id="idfptk" name="idfptk" value="">
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- !!  End Modal LHW !! --}}
  </div> 

<!-- Code begins here -->


{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/requestor.js') }}"></script>
@endsection