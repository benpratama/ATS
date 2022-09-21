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

    {{-- START URL PAHSE 2 --}}
      {{-- <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-control-label" for="urlphase2">URL Pahse 2</label>
            <input type="text" class="form-control" id="urlphase2" name="urlphase2" value="{{ $url_phase2 }}" readonly>
          </div>
        </div>
        <div class="col-md-3">
          <button id="btnGen-url" type="button" class="btn btn-primary btnsbmt" value={{ $info_kandidat->id }} data-noidentitas={{ $info_kandidat->noidentitas }}>Genarate</button>
        </div>
      </div> --}}
    {{-- END URL PAHSE 2 --}}
    <div class="row">
      <div class="col-xl-4 order-xl-1">
        <div class="card card-profile">
          <img src="{{ asset('assets/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="#">
                  <img src="{{ asset('storage/app/public/kandidatFotos/1.png')}}" class="rounded-circle">
                </a>
              </div>
            </div>
          </div>
          <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
          </div>
          <div class="card-body pt-0">
            <div class="row">
              <div class="col">
                <div class="card-profile-stats d-flex justify-content-center">
                  {{-- <div>
                    <span class="description">Umur</span>
                    <span class="heading">22</span>
                  </div>
                  <div>
                    <span class="description">Apply</span>
                    <span class="heading">10</span>
                    
                  </div>
                  <div>
                    <span class="description">Last Satus</span>
                    <span class="heading">89</span>
                  </div> --}}
                </div>
              </div>
            </div>
            <div class="text-center">
              <h5 class="h3">
                {{ $info_kandidat->namalengkap }}<span class="font-weight-light">, {{ $umur }}</span>
              </h5>
              <div class="h5 font-weight-500">
                <i class="ni location_pin mr-2"></i>{{ $info_kandidat->email }}<br>
                <i class="ni location_pin mr-2"></i>{{ $info_kandidat->nohp }}
              </div>
              <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>{{ $FreshorNot }}<br>
                <i class="ni business_briefcase-24 mr-2"></i>{{ $pekerjaan->namaPerusahaan }} - {{ $pekerjaan->jabatanPerusahaan }}
              </div>
              <div>
                <i class="ni education_hat mr-2"></i>{{ $pendidikan->pendidikan }} {{ $pendidikan->namaSekolah }} {{ $pendidikan->jurusan }}
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-8 order-xl-2">
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <h3 class="mb-0">Kandidat id: {{ $info_kandidat->id }} </h3>
              </div>
              <div class="col-4 text-right">
                <a href="#!" class="btn btn-sm btn-primary">Settings</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <form>
              <h6 class="heading-small text-muted mb-4">Info Kandidat</h6>
              <div class="pl-lg-4">
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="namalengkap">Nama lengkap</label>
                      <input type="text" id="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap Kandidat" value="{{ $info_kandidat->namalengkap }}">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="gender">Gender</label>
                      <select class="form-control" id="gender" name="gender">
                        <option value="Pria" {{ $info_kandidat->gender == "Pria" ? 'selected' : ''}}>Pria</option>
                        <option value="Wanita"  {{ $info_kandidat->gender == "Wanita" ? 'selected' : ''}}>Wanita</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="status_perkawinan">Status Perkawinan</label>
                      <select class="form-control" id="status_perkawinan" name="status_perkawinan">
                        @foreach ($StatusPerkawinan  as $status )
                          <option value="{{ $status->keterangan }}" {{ $status->keterangan == $info_kandidat->status_perkawinan ? 'selected' : ''}}>{{ $status->nama }} - {{ $status->keterangan }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="noidentitas">No. KTP / Passport</label>
                    <input type="text" class="form-control" id="noidentitas" name="noidentitas"placeholder="NO Identitas"  value="{{ $info_kandidat->noidentitas }}"  maxlength="45" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $info_kandidat->npwp }}" placeholder="NPWP" maxlength="45">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="nohp">NO HP</label>
                      <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $info_kandidat->nohp }}" maxlength="45" placeholder="08123456789" required>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="form-group">
                      <label class="form-control-label" for="npwp">Email</label>
                      <input type="email" class="form-control" id="email" value="{{ $info_kandidat->email }}" name="email" maxlength="45" required>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <!-- Address -->
              {{--<h6 class="heading-small text-muted mb-4">Contact information</h6>
               <div class="pl-lg-4">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="input-address">Address</label>
                      <input id="input-address" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09" type="text">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-city">City</label>
                      <input type="text" id="input-city" class="form-control" placeholder="City" value="New York">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-country">Country</label>
                      <input type="text" id="input-country" class="form-control" placeholder="Country" value="United States">
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="form-group">
                      <label class="form-control-label" for="input-country">Postal code</label>
                      <input type="number" id="input-postal-code" class="form-control" placeholder="Postal code">
                    </div>
                  </div>
                </div>
              </div> --}}
            </form>
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
    </div>
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Kandidat/detail_kandidat.js') }}"></script>
@endsection