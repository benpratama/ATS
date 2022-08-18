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
                <li class="breadcrumb-item"><a href="#">Vendor</a></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Page content -->
  <div class="container-fluid mt--6">
    {{-- !! MCU !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">vendor</h6>
                <h5 class="h3 mb-0">Medical Check Up</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-mcu">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-mcu" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblMcu" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-mcu"></th>
                    <th>Active</th>
                    <th>Vendor</th>
                    <th>Nama Lab</th>
                    <th>Alamat</th>
                    <th>No Tlp</th>
                    <th>No Fax</th>
                    <th>Email</th>
                    <th>Nama PIC</th>
                    <th>No Tlp PIC</th>
                    <th>Edit</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
      {{--!!START MODAL TAMBAH!!--}}
      <div class="modal fade bd-example-modal-xl modal-tambah-mcu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Vendor MCU</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-mcu" class="col-md-2 col-form-label form-control-label">Nama Vendor</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-namavendor">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-namalab" class="col-md-2 col-form-label form-control-label">Nama Lab</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-namalab">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-alamat" class="col-md-2 col-form-label form-control-label">Alamat</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="new-alamat">
                </div>
              </div>
              <div class="form-group row">
                <div class="table-responsive">
                  <table class="table" id="TblAddMcu" style="width: 100%">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 19%;">No Tlp</th>
                        <th style="width: 19%;">No Fax</th>
                        <th style="width: 19%;">Email</th>
                        <th style="width: 19%;">Nama PIC</th>
                        <th style="width: 19%;">No Tlp PIC</th>
                        <th style="width: 5%;">
                          <button type="button" class="btn btn-success d-flex" id="btnAddRow-mcu">
                            <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnAdd-mcu" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL TAMBAH!!--}}

      {{--!!START MODAL EDIT!!--}}
      <div class="modal fade bd-example-modal-xl modal-edit-mcu" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Vendor MCU</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="edit-mcu" class="col-md-2 col-form-label form-control-label">Nama Vendor</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-namavendor">
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-namalab" class="col-md-2 col-form-label form-control-label">Nama Lab</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-namalab">
                </div>
              </div>
              <div class="form-group row">
                <label for="edit-alamat" class="col-md-2 col-form-label form-control-label">Alamat</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-alamat">
                </div>
              </div>
              <div class="form-group row">
                <div class="table-responsive">
                  <table class="table" id="TblEditMcu" style="width: 100%">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 19%;">No Tlp</th>
                        <th style="width: 19%;">No Fax</th>
                        <th style="width: 19%;">Email</th>
                        <th style="width: 19%;">Nama PIC</th>
                        <th style="width: 19%;">No Tlp PIC</th>
                        <th style="width: 5%;">
                          <button type="button" class="btn btn-success d-flex" id="btnEditRow-mcu">
                            <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btnEdit-mcu" type="button" class="btn btn-primary" value="">Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL EDIT!!--}}
    </div>

    {{-- !! PSIKOTEST !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">vendor</h6>
                <h5 class="h3 mb-0">Psikotest</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-psikotest">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button id="btnDel-psikotest" type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblPsikotest"  style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th><input type="checkbox" id="cekAll-psikotest"></th>
                    <th>Active</th>
                    <th>Vendor</th>
                    <th>Alamat</th>
                    <th>No Tlp</th>
                    <th>No Fax</th>
                    <th>Email</th>
                    <th>Nama PIC</th>
                    <th>No Tlp PIC</th>
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
    <div class="modal fade bd-example-modal-xl modal-tambah-psikotest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Vendor Psikotest</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="new-psikotest" class="col-md-2 col-form-label form-control-label">Nama Vendor</label>
              <div class="col-md-10">
                <input class="form-control" type="text" id="new-namavendor-psikotest">
              </div>
            </div>
            <div class="form-group row">
              <label for="new-alamat" class="col-md-2 col-form-label form-control-label">Alamat</label>
              <div class="col-md-10">
                <input class="form-control" type="text" id="new-alamat-psikotest">
              </div>
            </div>
            <div class="form-group row">
              <div class="table-responsive">
                <table class="table" id="TblAddPsikotest" style="width: 100%">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 19%;">No Tlp</th>
                      <th style="width: 19%;">No Fax</th>
                      <th style="width: 19%;">Email</th>
                      <th style="width: 19%;">Nama PIC</th>
                      <th style="width: 19%;">No Tlp PIC</th>
                      <th style="width: 5%;">
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-psikotest">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button id="btnAdd-psikotest" type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{--!!END MODAL TAMBAH!!--}}

    {{--!!START MODAL EDIT!!--}}
    <div class="modal fade bd-example-modal-xl modal-edit-psikotest" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Vendor Psikotest</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group row">
              <label for="edit-psikotest" class="col-md-2 col-form-label form-control-label">Nama Vendor</label>
              <div class="col-md-10">
                <input class="form-control" type="text" id="edit-namavendor-psikotest">
              </div>
            </div>
            <div class="form-group row">
              <label for="edit-alamat" class="col-md-2 col-form-label form-control-label">Alamat</label>
              <div class="col-md-10">
                <input class="form-control" type="text" id="edit-alamat-psikotest">
              </div>
            </div>
            <div class="form-group row">
              <div class="table-responsive">
                <table class="table" id="TblEditPsikotest" style="width: 100%">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 19%;">No Tlp</th>
                      <th style="width: 19%;">No Fax</th>
                      <th style="width: 19%;">Email</th>
                      <th style="width: 19%;">Nama PIC</th>
                      <th style="width: 19%;">No Tlp PIC</th>
                      <th style="width: 5%;">
                        <button type="button" class="btn btn-success d-flex" id="btnEditRow-psikotest">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button id="btnEdit-psikotest" type="button" class="btn btn-primary" value="">Save changes</button>
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
  {{-- <script>
      $(document).ready(function(){
        var baris=0
        $('#btnAddRow-mcu').on('click',function(){
          baris+=1;
          
          var html  = "<tr id='baris"+baris+"'>"
              html +=   "<td style='width: 19%;'>"
              html +=     "<input class='form-control'  type='text' name='new-notlp[]'>"
              html +=   "</td>" 
              html +=   "<td style='width: 19%;'>"
              html +=     "<input class='form-control'  type='text' name='new-nofax[]'>"
              html +=   "</td>" 
              html +=   "<td style='width: 19%;'>"
              html +=     "<input class='form-control' type='text' name='new-email[]'>"
              html +=   "</td>"
              html +=   "<td style='width: 19%;'>"
              html +=     "<input class='form-control' type='text' name='new-namapic[]'>"
              html +=   "</td>"
              html +=   "<td style='width: 19%;'>"
              html +=     "<input class='form-control' type='text' name='new-tlppic[]'>"
              html +=   "</td>"   
              html +=   "<td style='width: 5%;'>"
              html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris+"' id='btnDelRow-mcu'>"
              html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
              html +=     "</button>"
              html +=   "</td>"   
              html +="</tr>"

          $('#TblAddMcu').append(html);
        })
      })

      $(document).on('click','#btnDelRow-mcu',function(){
        var hapus = $(this).data('row')
        // console.log(hapus);
        $('#'+hapus).remove();
      })

  </script> --}}
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Master Table/mt_v.js') }}"></script>
@endsection