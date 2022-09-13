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
            <h6 class="h2 text-white d-inline-block mb-0">Dashboard MPP</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">MPP</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    {{-- !! MPP btn !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">MPP</h6>
                <h5 class="h3 mb-0">Proses</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex col-8">
              <a href={{ route('hr_mpp.TemplateMpp') }} type="button" class="btn btn-success d-flex">
                <span class="material-symbols-outlined">add</span>
                <span class="gap-logo">Generate Template</span>
              </a>
              <button id="btnDel-jurusan" type="button" class="btn btn-danger d-flex" data-toggle="modal" data-target="#modal-upload-mpp">
                <span class="material-symbols-outlined">file_upload</span>
                <span class="gap-logo">Upload</span>
              </button>
            </div>
            <hr class="my-4">
            <div class="row d-flex col-12">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="filter_tahunBE">Tahun BE</label>
                  <input type="number" min="1900" max="9999" step="1" placeholder="2022" class="form-control" name="filter_tahunBE" id="filter_tahunBE" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="filter_lob">LOB</label>
                  <select class="js-example-basic-single form-control" name="filter_lob" id="filter_lob">
                    <option value="" disabled selected>LOB</option>
                    @foreach ($list_lobs as $list_lob )
                    <option value="{{ $list_lob->id }}">{{ $list_lob->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <div class="d-flex col-8">
              <button id="filtermpp" type="button" class="btn btn-primary btnsbmt">Filter</button>
            </div>  
          </div>
        </div>
      </div>
      {{-- !!  Start Modal MPP Upload !! --}}
      <div class="modal fade" id="modal-upload-mpp" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Upload File MPP</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form method="POST" action="{{ route('hr_mpp.ImportMpp') }}" enctype="multipart/form-data">
              @csrf
              <div class="modal-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="tahunBE">Tahun BE</label>
                      <input type="number" min="1900" max="9999" step="1" placeholder="2022" class="form-control" name="tahunBE" id="tahunBE" >
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="upload_MPP">File FPTK</label>
                      <input type="file" class="form-control" name="upload_MPP" id="upload_MPP" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
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
      {{-- !!  End Modal MPP Upload !! --}}
    </div>

    {{-- !! MPP table !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">MPP</h6>
                <h5 class="h3 mb-0">List</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive" style="width: 80%">
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
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')

  <script language="JavaScript" type="text/javascript" src="{{ asset('js/mpp.js') }}"></script>
@endsection