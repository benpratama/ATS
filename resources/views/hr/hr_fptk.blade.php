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
              <button id="btnDel-jurusan" type="button" class="btn btn-danger d-flex">
                <span class="material-symbols-outlined">delete</span>
                <span class="gap-logo">Hapus</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

     {{-- !! FPTK btn !! --}}
     <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">Detail</h5>
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
    </div>
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Master Table/mt_f.js') }}"></script>
@endsection