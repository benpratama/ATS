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
            <h6 class="h2 text-white d-inline-block mb-0">Master Table</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('mt.internal') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Internal<a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    {{-- !! USER !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">internal</h6>
                <h5 class="h3 mb-0">User</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-user">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblUser" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    {{-- <th><input type="checkbox" id="cekAll-job"></th> --}}
                    <th>nik</th>
                    <th>nama</th>
                    <th>job title</th>
                    <th>lokasi</th>
                    <th>reporting to</th>
                    <th>Kontak</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-xl modal-tambah-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-user" class="col-md-2 col-form-label form-control-label">NIK User</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-user">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-user" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-xl modal-edit-user" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Kontak User</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-email" class="col-md-2 col-form-label form-control-label">Email</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-email" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-wa" class="col-md-2 col-form-label form-control-label">no WA</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-wa">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-user" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! JOB !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">internal</h6>
                <h5 class="h3 mb-0">Job</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-job">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-job" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblJob" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-job"></th>
                    <th>Active</th>
                    <th>Job</th>
                    <th>Golongan</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-xl modal-tambah-job" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Job</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-job" class="col-md-2 col-form-label form-control-label">Nama Job</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-job">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-golongan" class="col-md-2 col-form-label form-control-label">Golongan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-golongan">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-job" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-xl modal-edit-job" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Job</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-job" class="col-md-2 col-form-label form-control-label">Nama Job</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-job">
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-golongan" class="col-md-2 col-form-label form-control-label">Golongan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-golongan">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-job" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! Organisasi !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">internal</h6>
                <h5 class="h3 mb-0">Organisasi</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblOrganisasi" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    {{-- <th><input type="checkbox" id="cekAll-job"></th> --}}
                    {{-- <th>Active</th> --}}
                    <th>Nama Organisasi</th>
                    {{-- <th>Golongan</th>
                    <th>Edit</th> --}}
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- !! DEPT !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">internal</h6>
                <h5 class="h3 mb-0">Departmen</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblDept" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    {{-- <th><input type="checkbox" id="cekAll-job"></th> --}}
                    {{-- <th>Active</th> --}}
                    <th>Nama Department</th>
                    {{-- <th>Golongan</th>
                    <th>Edit</th> --}}
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
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Master Table/mt_i.js') }}"></script>
@endsection