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
      .brdr{
        border-style: solid;
        border-color: #D8D9CF;
        padding: 1em;
        margin: 0.5em
      }
    </style>
</head>
<body class="stly">
  <form method="POST" action="{{ route('fk.SubmitForm1') }}" enctype="multipart/form-data">
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
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="status_perkawinan">Status Perkawinan*</label>
                    <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                      <option value="" disabled selected>Status Perkawinan</option>
                      @foreach ($Pernikahan as $pernikahan )
                      <option value="{{ $pernikahan->MaritalStId }}">{{ $pernikahan->MaritalSt }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">Tempat lahir*</label>
                    <select class="js-example-basic-single form-control" name="tempatlahir" id="tempatlahir" required>
                      <option value="" disabled selected>Tempat lahir</option>
                      @foreach ($TempatLahir as $tempatlahir )
                      <option value="{{ $tempatlahir->StateId }}">{{ $tempatlahir->StateName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tgllahir">Tanggal Lahir*</label>
                    <input class="form-control" type="date" id="tgllahir" name="tgllahir" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="goldarah">Golongan Darah*</label>
                    <select class="form-control" id="goldarah" name="goldarah" required>
                      <option value="" disabled selected>Golongan Darah</option>
                      <option value="O">O</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tinggibadan">tinggi badan (cm)*</label>
                    <input type="number" class="form-control" id="tinggibadan" name="tinggibadan" min="1" max="10000" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="beratbadan">berat badan (kg)*</label>
                    <input type="number" class="form-control" id="beratbadan" name="beratbadan" min="1" max="1000" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="noidentitas">No. KTP*</label>
                    <input type="text" class="form-control" id="noidentitas" name="noidentitas" maxlength="45" required>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <label class="form-control-label" for="noidentitas">Kota Penerbit KTP</label>
                    <input type="text" class="form-control" id="kotapenerbitKTP" name="kotapenerbitKTP" maxlength="45" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" maxlength="45">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="form-control-label" for="KTP">Alamat Lengkap* (KTP)</label>
                    <input type="text" class="form-control" id="alamat_KTP" name="alamat_KTP" maxlength="220" required>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label class="form-control-label" for="KTP">RT (KTP)</label>
                    <input type="text" class="form-control" id="RT_KTP" name="RT_KTP" maxlength="10">
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label class="form-control-label" for="KTP">RW (KTP)</label>
                    <input type="text" class="form-control" id="RW_KTP" name="RW_KTP" maxlength="10">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik">Status*</label>
                    <select class="form-control" id="rumahmilik" name="rumahmilik" required>
                      <option value="" disabled selected>Status</option>
                      @foreach ($Status as $s )
                      <option value="{{ $s->HouseStatusId }}">{{ $s->HouseStatus }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kota">Kota*</label>
                    <select class="js-example-basic-single form-control" name="kota1" id="kota1" required>
                      <option value="" disabled selected>Domisili</option>
                      @foreach ($Domisili as $domisili )
                      <option value="{{ $domisili->CityId }}">{{ $domisili->CityName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kodepos">kode pos*</label>
                    {{-- <select class="js-example-basic-single form-control" name="kodepos" id="kodepos" required>
                      <option value="" disabled selected>kode pos</option>
                    </select> --}}
                    <input type="number" class="form-control" id="kodepos" name="kodepos" min="1" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="form-control-label" for="alamat_koresponden">Alamat Korespondensi*</label>
                    <input type="text" class="form-control" id="alamat_koresponden" name="alamat_koresponden" maxlength="220" required>
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label class="form-control-label" for="koresponden">RT</label>
                    <input type="text" class="form-control" id="RT_koresponden" name="RT_koresponden" maxlength="10">
                  </div>
                </div>
                <div class="col-md-1">
                  <div class="form-group">
                    <label class="form-control-label" for="koresponden">RW</label>
                    <input type="text" class="form-control" id="RW_koresponden" name="RW_koresponden" maxlength="10">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik_koresponden">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik_koresponden" name="rumahmilik_koresponden" required>
                      <option value="" disabled selected>Status</option>
                      @foreach ($Status as $s )
                      <option value="{{ $s->HouseStatusId }}">{{ $s->HouseStatus }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kota_koresponden">Kota*</label>
                    <select class="js-example-basic-single form-control" name="kota_koresponden" id="kota_koresponden" required>
                      <option value="" disabled selected>Domisili</option>
                      @foreach ($Domisili as $domisili )
                      <option value="{{ $domisili->CityId }}">{{ $domisili->CityName }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kodepos_koresponden">kodepos*</label>
                    <input type="number" class="form-control" id="kodepos_koresponden" name="kodepos_koresponden" min="1" required>
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Kontak</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                    <label class="form-control-label" for="notlp">NO TLP</label>
                </div>
              </div>
              <div id="list_tlp">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="notlp">Tipe</label>
                      <select class="form-control" id="tipe_Tlp" name="tipe_Tlp[]" data-rowattr='attr_tlp1' required>
                        <option value="" disabled selected>Tipe Tlp</option>
                        <option value="H">Rumah</option>
                        <option value="M">Seluler</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-1 attr_tlp1">
                    <div class="form-group">
                      <label class="form-control-label" for="notlp">Area</label>
                      <input type="text" class="form-control" id="Area_Tlp" name="Area_Tlp[]" maxlength="45" required>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="notlp">Nomer Tlp</label>
                      <input type="text" class="form-control" id="no_Tlp" name="no_Tlp[]" maxlength="45" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-notlp">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah No Tlp</span>
                </button>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                    <label class="form-control-label" for="email">Email</label>
                </div>
              </div>
              <div id="list_email">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="email">Tipe</label>
                      <select class="form-control" id="tipe_Tlp" name="tipe_Email[]" required>
                        <option value="" disabled selected>Tipe Email</option>
                        <option value="B">Bisnis</option>
                        <option value="H">Pribadi</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email[]" maxlength="45" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-email">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Email</span>
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
                <div class="col-3">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">SIM</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="list_sim">
                <div class="row">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">Jenis*</label>
                      <select class="form-control" id="jenis_SIM" name="jenis_SIM[]" data-rowattr='attr_sim1' required>
                        <option value="" disabled selected>Jenis SIM</option>
                        <option value="0">Tidak punya</option>
                        <option value="63">SIM A</option>
                        <option value="64">SIM B1</option>
                        <option value="65">SIM C</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3 attr_sim1">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">NO SIM*</label>
                      <input type="text" class="form-control" id="no_SIM" name="no_SIM[]" required>
                    </div>
                  </div>
                  <div class="col-md-3 attr_sim1">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">Masa Berlaku*</label>
                      <input class="form-control" type="date" id="exp_sim" name="exp_sim[]" required>
                    </div>
                  </div>
                  <div class="col-md-3 attr_sim1">
                    <div class="form-group">
                      <label class="form-control-label" for="SIM">Kota Penerbit*</label>
                      <input class="form-control" type="text" id="kota_sim" name="kota_sim[]" required> 
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Riwayat pendidikan</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="list_pendidikan">
                
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
                <div class="col-3">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Riwayat Pekerjaan</h3>
                </div>
              </div>
            </div>
            <div class="card-body">

              <div id="list_riwayat">

              </div>
            
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-riwayat">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Tambah Riwayat</span>
                </button>
              </div>

              <div class="row" style="margin-top: 1.7em">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">gaji yang diterima terakhir</label>
                    <input type="text" class="form-control" id="gaji" name="gaji">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">tujangan yang diterima terakhir</label>
                    <input type="text" class="form-control" id="tunjangan" name="tunjangan">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gambarkedudukan">Gambarkan kedudukan Saudara dalam struktur organisasi perusahaan (max 5MB)</label>
                    <input type="file" class="form-control" name="gambarkedudukan" id="gambarkedudukan" accept="image/png, image/jpeg, image/jpg ">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tanggungjawab">jelaskan tugas dan tanggung jawab saudara</label>
                    <textarea class="form-control" id="tanggungjawab" rows="3" resize="none" name="tanggungjawab"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="prestasi">prestasi yang pernah saudara lakukan </label>
                    <textarea class="form-control" id="prestasi" rows="3" resize="none" name="prestasi"></textarea>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="jabatanharapan">Jabatan yang Saudara inginkan*</label>
                    <input type="text" class="form-control" id="jabatanharapan" name="jabatanharapan" maxlength="200" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="gajiharapan">gaji yang yang diharapkan*</label>
                    <input type="text" class="form-control" id="gajiharapan" name="gajiharapan" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tujanganharapan">tujangan yang diharapkan*</label>
                    <input type="text" class="form-control" id="tujanganharapan" name="tujanganharapan" maxlength="200" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="bertugasluarkota">bersedia Bertugas ke luar kota*</label>
                    <select class="form-control" id="bertugasluarkota" name="bertugasluarkota" required>
                      <option value="" disabled selected>Bertugas ke luar kota</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="ditempatkanluarkota">bersedia Ditempatkan di luar kota*</label>
                    <select class="form-control" id="ditempatkanluarkota" name="ditempatkanluarkota" required>
                      <option value="" disabled selected>Ditempatkan di luar kota</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Dokumen Penunjang</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="porto">URL Portofolio</label>
                    <input type="text" class="form-control" id="porto" name="porto">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="porto">CV (max 5MB)</label>
                    <input type="file" class="form-control" name="cv" id="cv" accept="application/pdf">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="porto">Foto (max 5MB)</label>
                    <input type="file" class="form-control" name="foto" id="foto" accept="image/png, image/jpeg, image/jpg ">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <input name='urlid' value='{{ $URL->id }}' hidden>
        {{-- <input name='organisasiid' value='{{ $URL->id_Organisasi }}' hidden> --}}
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
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Kandidat/form.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
</body>
