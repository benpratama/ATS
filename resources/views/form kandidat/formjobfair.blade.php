<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
    <link rel="stylesheet" href="{{ asset('assets/sweetalert2/sweetalert2.css') }}" type="text/css">
    
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}" type="text/css">
    <style>
      .material-symbols-outlined {
        font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 40
      }
      .stly{
        background: #F5F5F5;
        margin-top: 7em;
        margin-left: 2em;
        margin-right: 2em;
      }
      .btnsbmt{
        margin-top: 0.5em;
        margin-bottom: 2em;
        width: 100%;
      }
    </style>
</head>
<body class="stly">
  <form method="POST" action="{{ route('fk.SubmitFormjf') }}">
    @csrf
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-12">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">DATA PRIBADI</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="namalengkap">Nama Lengkap*</label>
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" maxlength="200" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gender">Gender*</label>
                    <select class="form-control" id="gender" name="gender" required>
                      <option value="" disabled selected>Gender</option>
                      <option value="1">Pria</option>
                      <option value="2">Wanita</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">Tempat Lahir*</label>
                    <select class="form-control" id="tempatlahir" name="tempatlahir" required>
                      <option value="" disabled selected>Tempat lahir</option>
                      <option value="1">Jakarta</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tgllahir">Tanggal Lahir*</label>
                    <input class="form-control" type="date" id="tgllahir" name="tgllahir" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="noidentitas">No. KTP / Passport*</label>
                    <input type="text" class="form-control" id="noidentitas" name="noidentitas" maxlength="45" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="domisili">Domisili saat ini*</label>
                    <select class="form-control" id="domisili" name="domisili" required>
                      <option value="" disabled selected>Domisili</option>
                      <option value="1">Jakarta</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="nohp">NO HP (Whastapp)*</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" maxlength="45" placeholder="08123456789" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="email">Email*</label>
                    <input type="email" class="form-control" id="email" name="email" maxlength="45" required>
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
                <div class="col-12">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Pendidikan</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id=list_pendidikan>
                <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="pendidikan">Jenis*</label>
                      <select class="form-control" id="jenis_pendidikan" name="jenis_pendidikan[]" required>
                        <option value="100" selected>SLTA (Sekolah Lanjut Tingkat Atas)</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="pendidikan">Nama Institusi*</label>
                      <select class="form-control" id="nama_pendidikan" name="nama_pendidikan[]" required>
                        <option value="" selected disabled>Nama Institusi</option>
                        <option value="SMA 123">SMA 123</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="pendidikan">Jurusan*</label>
                      <select class="form-control" id="jurusan_pendidikan" name="jurusan_pendidikan[]" required>
                        <option value="" selected disabled>Jurusan</option>
                        <option value="IPA">IPA</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="pendidikan">Nilai*</label>
                      <input type="number" step="0.01" class="form-control" id="nilai_pendidikan" name="nilai_pendidikan[]" min=0 max=100 required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-pendidikan">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah Pendidikan</span>
                </button>
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
                <div class="col-12">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Kelengkapan</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="luarkota">Bersedia penempatan seluruh Indonesia*</label>
                    <select class="form-control" id="luarkota" name="luarkota" required>
                      <option value="" disabled selected>Bersedia penempatan seluruh Indonesia</option>
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label class="form-control-label" for="SIM">Kepemilikan SIM</label>
                </div>
              </div>
              <div id="list_sim">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">Jenis*</label>
                      <select class="form-control" id="jenis_SIM" name="jenis_SIM[]" data-rowattr='attr_sim1' required>
                        <option value="" disabled selected>Jenis SIM</option>
                        <option value="0">Tidak punya</option>
                        <option value="1">A</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 attr_sim1">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">NO SIM</label>
                      <input type="text" class="form-control" id="no_SIM" name="no_SIM[]">
                    </div>
                  </div>
                  <div class="col-md-3 attr_sim1">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">Masa Berlaku</label>
                      <input class="form-control" type="date" id="exp_sim" name="exp_sim[]">
                    </div>
                  </div>
                  <div class="col-md-3 attr_sim1">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">Kota Penerbit</label>
                      <input class="form-control" type="text" id="kota_sim" name="kota_sim[]">
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-sim">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah SIM</span>
                </button>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label class="form-control-label" for="motor">Memiliki motor*</label>
                  <select class="form-control" id="motor" name="motor"required>
                    <option value="" disabled selected>Memiliki motor</option>
                    <option value="0">Tidak punya</option>
                    <option value="1">Punya</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label class="form-control-label" for="PMR">pengalaman MR*</label>
                  <select class="form-control" id="PMR" name="PMR"required>
                    <option value="" disabled selected>Pengalaman MR</option>
                    <option value="0">Tidak ada</option>
                    <option value="<1">< 1 Tahun</option>
                    <option value=">1">> 1 Tahun</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        {{-- <input name='urlid' value='{{ $URL->id }}' hidden>
        <input name='organisasiid' value='{{ $URL->id_Organisasi }}' hidden> --}}
        <button type="submit" class="btn btn-primary btnsbmt">Submit</button>
      </div>
    </div>
  </form> 
  <script src="{{ asset('assets/sweetalert2/sweetalert2.all.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Kandidat/formjf.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
</body>
