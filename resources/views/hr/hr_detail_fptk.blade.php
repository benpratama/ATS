@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" type="text/css">
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
            <h6 class="h2 text-white d-inline-block mb-0">Detail FPTK</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('hr_fptk.index') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('hr_fptk.index') }}">FPTK</a></li>
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
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">Info</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <label id='id_fptk' hidden>{{ $detailfptk[0]->id }}</label>
            <div class="row">
              <div class="col-md-8">
                <label for="nofptk" class="col-md-5 col-form-label form-control-label">No FPTK</label>
                <input class="form-control" type="text" id="nofptk" value="{{ $detailfptk[0]->nofptk }}">
              </div>
              <div class="col-md-4">
                <label for="status" class="col-md-5 col-form-label form-control-label">Status</label>
                <select id="status" class="form-control" name="status">
                  <option value="" disabled selected>Status FPTK</option>
                  @foreach ($statusfptk  as $status )
                  <option value="{{ $status->id }}" {{ $status->id == $detailfptk[0]->status ? 'selected' : ''}}>{{ $status->keterangan }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tgl_inputfptk" class="col-md-5 col-form-label form-control-label">Tanggal Input</label>
                    <input class="form-control" type="date" id="tgl_inputfptk" value="{{ $detailfptk[0]->tglinputfptk }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="tgl_disetujui" class="col-md-5 col-form-label form-control-label">Tanggal Disetujui</label>
                    <input class="form-control" type="date" id="tgl_disetujui" value="{{ $detailfptk[0]->tgldisetujui }}">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="nikpeminta" class="col-md-5 col-form-label form-control-label">NIK Peminta</label>
                    <input class="form-control" type="text" id="nikpeminta" value="{{ $detailfptk[0]->nikpeminta }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="namapeminta" class="col-md-5 col-form-label form-control-label">nama Peminta</label>
                    <input class="form-control" type="text" id="namapeminta" value="{{ $detailfptk[0]->namapeminta }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="atasanlangsung" class="col-md-8 col-form-label form-control-label">nama atasan langsung</label>
                    <input class="form-control" type="text" id="atasanlangsung" value="{{ $detailfptk[0]->namaatasanlangusng }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="namaspvdm" class="col-md-8 col-form-label form-control-label">nama SPV/DM</label>
                    <input class="form-control" type="text" id="namaspvdm" value="{{ $detailfptk[0]->namaatasanlangusng }}">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="posisi" class="col-md-5 col-form-label form-control-label">Posisi</label>
                    <input class="form-control" type="text" id="posisi" value="{{ $detailfptk[0]->posisi }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="organisasi" class="col-md-5 col-form-label form-control-label">Organisasi</label>
                    <input class="form-control" type="text" id="organisasi" value="{{ $detailfptk[0]->organisasi }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="penempatan" class="col-md-8 col-form-label form-control-label">Penempatan</label>
                    <input class="form-control" type="text" id="penempatan" value="{{ $detailfptk[0]->penempatan }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="alasan" class="col-md-5 col-form-label form-control-label">alasan digantikan</label>
                    <input class="form-control" type="text" id="alasan" value="{{ $detailfptk[0]->alasandigantikan }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="namadigantikan" class="col-md-5 col-form-label form-control-label">nama digantikan</label>
                    <input class="form-control" type="text" id="namadigantikan" value="{{ $detailfptk[0]->namaygdigantikan }}">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="form-group row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="pic" class="col-md-8 col-form-label form-control-label">PIC</label>
                    <input class="form-control" type="text" id="pic" value="{{ $detailfptk[0]->pic }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="namabergabung" class="col-md-10 col-form-label form-control-label">Nama karyawan bergabung</label>
                    <input class="form-control" type="text" id="namabergabung" value="{{ $detailfptk[0]->namakarybergabung }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="leadtime" class="col-md-8 col-form-label form-control-label">lead time</label>
                    <input class="form-control" type="text" id="leadtime" value="{{ $detailfptk[0]->leadtime }}">
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">Kandidat</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="Tblkandidat">
                <thead class="thead-light">
                  <tr>
                    <th style="width: 50%;">Data kandidat</th>
                    <th style="width: 10%;">Tgl konfirm</th>
                    <th style="width: 10%;">Tgl join</th>
                    <th style="width: 10%;">Tgl batal</th>
                    <th style="width: 5%;">Detail</th>
                    {{-- <th style="width: 45%;">Nama Kandidat</th> --}}
                    <th style="width: 5%;"> 
                      <button type="button" class="btn btn-success d-flex" id="btnAddRow-kandidat">
                        <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                      </button>
                    </th>
                  </tr>
                </thead>
              </table>
            </div>
            <div class="row">
              <button type="button" id="btnUpdateFPTK" class="btn btn-primary btnsbmt" data-value="{{ $detailfptk[0]->id }}">Primary</button>
            </div>
          </div>
        </div>
      </div>

      {{--!!START MODAL DETAIL KANDIDAT!!--}}
      <div class="modal fade bd-example-modal-lg modal-detail-kandidat" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Data Kandidat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group row">
                <label for="new-sim" class="col-md-2 col-form-label form-control-label">Keterangan</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-keterangan">
                </div>
              </div>
              <div class="form-group row">
                <label for="new-sim" class="col-md-2 col-form-label form-control-label">Sumber</label>
                <div class="col-md-10">
                  <input class="form-control" type="text" id="edit-sumber" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="new-sim" class="col-md-2 col-form-label form-control-label">Jenis</label>
                <div class="col-md-10">
                  <select class="form-control" id="edit-jenis" name="edit-jenis" required>
                    <option value="" disabled selected>Rekrutment/ Cabang</option>
                    <option value="Rekrutment">Rekrutment</option>
                    <option value="Cabang">Cabang</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <label id="kandidat" hidden></label>
              <label id="fptk" hidden></label>
              <div class="row">
                <button id="btnEdit-kandidat" type="button" class="btn btn-primary" >Save changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{--!!END MODAL DETAIL KANDIDAT!!--}}
    </div>
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script src="{{ asset('js/select2.min.js') }}"></script>
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/fptk.js') }}"></script>
@endsection