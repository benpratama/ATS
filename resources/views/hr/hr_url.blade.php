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
            <h6 class="h2 text-white d-inline-block mb-0">Dashboard URL</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">URL</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
     {{-- !! Url btn !! --}}
     <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">URL</h6>
                <h5 class="h3 mb-0">List</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblUrl">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-url"></th>
                    <th>Job</th>
                    <th>Jumlah</th>
                    <th>Detail</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL 1!!--}}
      <div class="modal fade bd-example-modal-xl modal-url" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Detail URL</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="new_source" class="col-md-2 col-form-label form-control-label">Source</label>
                  <input class="form-control" type="text" id="new_Source">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="open_url">Open Url</label>
                    <input  type="datetime-local" class="form-control" name="open_url" id="open_url">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="close_url">Close Url</label>
                    <input  type="datetime-local" class="form-control" name="close_url" id="close_url">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <button id="btnAdd-url" type="button" class="btn btn-primary" value="">Generate</button>
                </div>
              </div>
              <hr class="my-4">
              <div class="form-group row">
                <div class="col-md-6">
                  <button id="btnAdd-url" type="button" class="btn btn-primary" value="">delete</button>
                </div>
              </div>
              <div class="table-responsive">
                <table class="table" id="TblDetailurl">
                  <thead class="thead-light">
                    <tr>
                      <th><input type="checkbox" id="cekAll-detailurl"></th>
                      <th>Active</th>
                      <th>Source</th>
                      <th>Open Url</th>
                      <th>Close Url</th>
                      <th>Url</th>
                      <th>Update</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL 1!!--}}

      {{--!!START MODAL 2!!--}}
      <div class="modal fade bd-example-modal-xl modal-detailurl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update URL</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="edit_source" class="col-md-2 col-form-label form-control-label">Source</label>
                  <input class="form-control" type="text" id="edit_Source" readonly>
                </div>
                <div class="col-md-6">
                  <label for="edit_Notes" class="col-md-2 col-form-label form-control-label">Notes</label>
                  <input class="form-control" type="text" id="edit_Notes">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="edit_open_url">Open Url</label>
                    <input  type="datetime-local" class="form-control" name="edit_open_url" id="edit_open_url">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="edit_close_url">Close Url</label>
                    <input  type="datetime-local" class="form-control" name="edit_close_url" id="edit_close_url">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <button id="btnAdd-url" type="button" class="btn btn-primary" value="">Update</button>
                </div>
              </div>
            </div>
            <div class="modal-footer">

            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL 2!!--}}
    </div>
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/url.js') }}"></script>
@endsection