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
                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Form</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    
    {{-- !! SIM !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">SIM</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-sim">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-sim" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblSim">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-sim"></th>
                    <th>Active</th>
                    <th>SIM</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-sim" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah SIM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-sim" class="col-md-2 col-form-label form-control-label">Jenis SIM</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-sim">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-sim" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-sim" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit SIM</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-sim" class="col-md-2 col-form-label form-control-label">Jenis SIM</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-sim">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-sim" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}

    </div>

    {{-- !! DOMISILI !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Domisili</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-domisili">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-domisili" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblDomisili">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-domisili"></th>
                    <th>Active</th>
                    <th>Provinsi</th>
                    <th>Kabupaten</th>
                    <th>kodepos</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-domisili" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Domisili</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-provinsi" class="col-md-2 col-form-label form-control-label">Provinsi</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-provinsi">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-kabupaten" class="col-md-2 col-form-label form-control-label">Kabupaten</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-kabupaten">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-kodepos" class="col-md-2 col-form-label form-control-label">kodepos</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-kodepos">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-domisili" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-domisili" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Domisili</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-provinsi" class="col-md-2 col-form-label form-control-label">Provinsi</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-provinsi">
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-kabupaten" class="col-md-2 col-form-label form-control-label">Kabupaten</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-kabupaten">
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-kodepos" class="col-md-2 col-form-label form-control-label">kodepos</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-kodepos">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-domisili" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
      
    </div>

    {{-- !! JURUSAN !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Jurusan</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-jurusan">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-jurusan" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblJurusan">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-jurusan"></th>
                    <th>Active</th>
                    <th>Jurusan</th>
                    <th>SMA/Sederajat</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>

      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-jurusan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Jurusan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-jurusan" class="col-md-2 col-form-label form-control-label">Jurusan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-jurusan">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 col-form-label form-control-label" for="new-jenis">Jenis</label>
                <div class="col-md-10">
                    <select class="form-control" id="new-jenis" required>
                      <option value="" disabled selected>Jenis</option>
                      <option value="SMA">SMA</option>
                      <option value="Sederajat">Sederajat</option>
                    </select>
                  </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-jurusan" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-jurusan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Jurusan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-jurusan" class="col-md-2 col-form-label form-control-label">Jurusan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-jurusan">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-2 col-form-label form-control-label" for="edit-jenis">Jenis</label>
                <div class="col-md-10">
                    <select class="form-control" id="edit-jenis" required>
                      <option value="SMA">SMA</option>
                      <option value="Sederajat">Sederajat</option>
                    </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-jurusan" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! PERKAWINAN !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Perkawinan</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-perkawinan">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-perkawinan" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblPerkawinan">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-perkawinan"></th>
                    <th>Active</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-perkawinan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Perkawinan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-perkawinan" class="col-md-2 col-form-label form-control-label">Perkawinan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-perkawinan">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-keterangan" class="col-md-2 col-form-label form-control-label">Keterangan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-keterangan">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-perkawinan" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-perkawinan" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Perkawinan</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-perkawinan" class="col-md-2 col-form-label form-control-label">Perkawinan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-perkawinan">
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-keterangan" class="col-md-2 col-form-label form-control-label">Keterangan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-keterangan">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-perkawinan" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! STATUS FPTK !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status FPTK</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-sfptk">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-sfptk" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblSfptk">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-sfptk"></th>
                    <th>Active</th>
                    <th>Status</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-sfptk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Status FPTK</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-sfptk" class="col-md-2 col-form-label form-control-label">Status FPTK</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-sfptk">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-sfptk" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-sfptk" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Status FPTK</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-sfptk" class="col-md-2 col-form-label form-control-label">Status FPTK</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-sfptk">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-sfptk" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! STATUS MCU !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status MCU</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-smcu">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-smcu" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblSmcu">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-smcu"></th>
                    <th>Active</th>
                    <th>Keterangan</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-smcu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Status MCU</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-smcu" class="col-md-2 col-form-label form-control-label">Status MCU</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-smcu">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-smcu" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-smcu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Status MCU</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-smcu" class="col-md-2 col-form-label form-control-label">Status MCU</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-smcu">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-smcu" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! STATUS Test !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status Test</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-stest">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-stest" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblStest">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-stest"></th>
                    <th>Active</th>
                    <th>Keterangan</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-lg modal-tambah-stest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Status Test</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-stest" class="col-md-2 col-form-label form-control-label">Status Test</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-stest">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-stest" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-lg modal-edit-stest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Status Test</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-stest" class="col-md-2 col-form-label form-control-label">Status Test</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-stest">
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-stest" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! STATUS Kandidat !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status Rekrutmen</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-srek">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-srek" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblSrek">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-srek"></th>
                    <th>Active</th>
                    <th>Proses</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--!!START MODAL TAMBAH!!--}}
    <div class="modal fade bd-example-modal-lg modal-tambah-srek" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Status Rekrutmen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="new-srek" class="col-md-2 col-form-label form-control-label">Status Rekrutmen</label>
              <div class="col-md-10">
                <input class="form-control" type="text" id="new-srek">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button id="btnAdd-srek" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--!!END MODAL TAMBAH!!--}}

    {{--!!START MODAL EDIT!!--}}
    <div class="modal fade bd-example-modal-lg modal-edit-srek" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Status Rekrutmen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="edit-srek" class="col-md-2 col-form-label form-control-label">Status Rekrutmen</label>
              <div class="col-md-10">
                <input class="form-control" type="text" id="edit-srek">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button id="btnEdit-srek" type="button" class="btn btn-primary" value="">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--!!END MODAL EDIT!!--}}
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Master Table/mt_f.js') }}"></script>
@endsection