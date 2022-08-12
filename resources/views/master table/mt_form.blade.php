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
                <button type="button" class="btn btn-success d-flex">
                  {{-- <span class="material-symbols-outlined">add</span> --}}
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah</span>
                </button>
                <button type="button" class="btn btn-danger d-flex">
                  <span class="material-symbols-outlined">delete</span>
                  <span class="gap-logo">Hapus</span>
                </button>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive py-4">
              <table class="table table-flush" id="TblSim">
                <thead class="thead-light">
                  <tr>
                    <th><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked"></th>
                    <th>Active</th>
                    <th>SIM</th>
                    {{-- <th>Edit</th> --}}
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- !! DOMISILI !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Domisili</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! JURUSAN !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Jurusan</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! PERKAWINAN !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Perkawinan</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! STATUS FPTK !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status FPTK</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! STATUS MCU !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status MCU</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! STATUS Test !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status Test</h5>
              </div>
            </div>
          </div>
          <div class="card-body">

          </div>
        </div>
      </div>
    </div>

    {{-- !! STATUS Kandidat !! --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col">
                <h6 class="text-uppercase text-muted ls-1 mb-1">form</h6>
                <h5 class="h3 mb-0">Status Rekrutmen</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            
          </div>
        </div>
      </div>
    </div>

  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Master Table/mt_f.js') }}"></script>
@endsection