@extends('layouts.app')

@section('styles')

<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
<style>
  .material-symbols-outlined {
    font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 40
  }
  .gap-logo{
      margin-left: .5em;
      margin-top: 0.3em
    }
  table th{
    text-align: center;
  }
  table td{
    text-align: center;
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
            <h6 class="h2 text-white d-inline-block mb-0">Dashboard FPTK</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">FPTK</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    {{-- !! FPTK btn !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">Proses</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex col-8">
              <a href={{ route('hr_fptk.TemplateFptk') }} type="button" class="btn btn-success d-flex">
                <span class="material-symbols-outlined">add</span>
                <span class="gap-logo">Generate Template</span>
              </a>
              <button id="btnUploadFPTK" type="button" class="btn btn-danger d-flex" data-toggle="modal" data-target="#ModalUploadFPTK">
                <span class="material-symbols-outlined">file_upload</span>
                <span class="gap-logo">Upload</span>
              </button>
            </div>
            <hr class="my-4">
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
                    @foreach ($nofptks as $nofptk )
                      <option value="{{ $nofptk->nofptk }}">{{ $nofptk->nofptk }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_npeminta">Nama Peminta</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_npeminta" name="filter_npeminta" required> --}}
                  <select id="filter_namapeminta" class="js-example-basic-multiple form-control" name="filter_namapeminta[]" multiple="multiple">
                    @foreach ($namapemintas as $namapeminta )
                      <option value="{{ $namapeminta->namapeminta }}">{{ $namapeminta->namapeminta }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_natasan">Nama Atasan</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_natasan" name="filter_natasan" required> --}}
                  <select id="filter_namaatasan" class="js-example-basic-multiple form-control" name="filter_namaatasan[]" multiple="multiple">
                    @foreach ($namaatasans as $namaatasan )
                      <option value="{{ $namaatasan->namaatasanlangusng }}">{{ $namaatasan->namaatasanlangusng }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="row d-flex col-12">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_posisi">Posisi</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_posisi" name="filter_posisi" required> --}}
                  <select id="filter_posisi" class="js-example-basic-multiple form-control" name="filter_posisi[]" multiple="multiple">
                    @foreach ($posisis as $posisi )
                      <option value="{{ $posisi->posisi }}">{{ $posisi->posisi }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_lokasi">Lokasi</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_lokasi" name="filter_lokasi" required> --}}
                  <select id="filter_lokasi" class="js-example-basic-multiple form-control" name="filter_lokasi[]" multiple="multiple">
                    @foreach ($lokasis as $lokasi )
                      <option value="{{ $lokasi->penempatan }}">{{ $lokasi->penempatan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="filter_status">Status</label>
                  {{-- <input class="form-control" type="text" value="" id="filter_status" name="filter_status" required> --}}
                  <select id="filter_status" class="js-example-basic-multiple form-control" name="filter_status[]" multiple="multiple">
                    @foreach ($statuss as $status )
                      <option value="{{ $status->id }}">{{ $status->keterangan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="d-flex col-8">
              <label id="F_startTgl" hidden></label>
              <label id="F_endTgl" hidden></label>
              <button id="filterfptk" type="button" class="btn btn-primary btnsbmt">Filter</button>
              <button id="Clearfilterfptk" type="button" class="btn btn-primary btnsbmt">Clear Filter</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- !!  Start Modal FPTK Upload !! --}}
    <div class="modal fade" id="ModalUploadFPTK" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Upload File FPTK</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form method="POST" action="{{ route('hr_fptk.ImportFptk') }}" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="upload_FPTK">File FPTK</label>
                    <input type="file" class="form-control" name="upload_FPTK" id="upload_FPTK" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Upload</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    {{-- !!  End Modal FPTK Upload !! --}}

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
              <div class="d-flex col-8">
                <button id="btnExportFPTK" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">file_download</span>
                  <span class="gap-logo">Export FPTK</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblFptk">
                <thead class="thead-light">
                  <tr>
                    <th>No FPTK</th>
                    <th>TGL Disetujui</th>
                    <th>Nama Peminta</th>
                    <th>Nama Atasan</th>
                    <th>Posisi</th>
                    <th>Lokasi</th>
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
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')

  <script language="JavaScript" type="text/javascript" src="{{ asset('js/fptk.js') }}"></script>
@endsection