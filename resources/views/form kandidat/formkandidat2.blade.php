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
  <form method="POST" action="{{ route('fk.SubmitForm2') }}" enctype="multipart/form-data">
    @csrf
    <div id='frm' class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-3">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">INFORMASI KANDIDAT</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="namalengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="{{ $info_kandidat->namalengkap }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="namalengkap">No. KTP / Passport</label>
                    <input type="text" class="form-control" id="noidentitas" name="noidentitas" value="{{ $info_kandidat->noidentitas }}" readonly>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">Tempat lahir</label>
                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="{{ trim($info_kandidat->StateName) }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tgllahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="tgllahir" name="tgllahir" value="{{ str_replace(" 00:00:00.000","",$info_kandidat->tglLahir) }}" readonly>
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Pelatihan & Kursus </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="list_pelatihan">
                
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-pelatihan">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Pelatihan</span>
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Informasi Pendidikan </h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="prestasi">Prestasi karya luar biasa yang pernah Saudara peroleh selama pendidikan</label>
                    <textarea class="form-control" id="prestasi" rows="3" resize="none" name="prestasi" maxlength="2000"></textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="karyailmiah">Tulisan / karya ilmiah yang pernah Saudara tulis ( Skripsi, artikel, buku, dsb) / tahun:</label>
                    <textarea class="form-control" id="karyailmiah" rows="3" resize="none" name="karyailmiah" maxlength="220"></textarea>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <label class="form-control-label" for="bahasa">Bahasa asing atau bahasa daerah yang dikuasai :</label>
                {{-- <div class="table-responsive">
                  <table class="table" id="Tblbahasa">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 23.75%;">Bahasa</th>
                        <th style="width: 23.75%;">Berbicara</th>
                        <th style="width: 23.75%;">Menulis</th>
                        <th style="width: 23.75%;">Membaca</th>
                        <th style="width: 5%;"> 
                          <button type="button" class="btn btn-success d-flex" id="btnAddRow-bahasa">
                            <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                  </table>
                </div> --}}
                <div id="list_bahasa">
                  
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-success d-flex" id="btnAdd-bahasa">
                    <span class="material-symbols-outlined">add</span>
                    <span class="gap-logo">Bahasa</span>
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
                <div class="col-6">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">AKTIVITAS SOSIAL DAN KEGIATAN LAIN</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <label class="form-control-label" for="organisasi">Keanggotaan dalam organisasi / lembaga :</label>
                <div id="list_organisasi">
                  
                </div>
                <div class="form-group">
                  <button type="button" class="btn btn-success d-flex" id="btnAdd-organisasi">
                    <span class="material-symbols-outlined">add</span>
                    <span class="gap-logo">Organisasi</span>
                  </button>
                </div>
                <hr class="my-4">
                <div class="row" >
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="waktuluang">Kegiatan pada waktu luang</label>
                      <input type="text" class="form-control" id="waktuluang" name="waktuluang" maxlength='2000'>
                    </div>
                  </div>
                </div>
                <div class="row" >
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="suratkabar">Surat kabar / majalah yang sering dibaca</label>
                      <input type="text" class="form-control" id="suratkabar" name="suratkabar" maxlength='2000'>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="topik">Topik yang diminati untuk dibaca</label>
                      <input type="text" class="form-control" id="topik" name="topik" maxlength='2000'>
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
                <div class="col-5">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">SUSUNAN KELUARGA</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div id="list_keluarga">
                
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-keluarga">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Keluarga</span>
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
                <div class="col-6">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">HAL-HAL YANG BERHUBUNGAN DENGAN LAMARAN KERJA</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="alasan">Alasan / tujuan Saudara melamar di perusahaan ini :</label>
                    <input type="text" class="form-control" id="alasan" name="alasan" maxlength='2000'>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label " for="lingkungankerja">Lingkungan pekerjaan yang Saudara sukai :</label>
                    <select id="lingkungankerja" class="form-control" name="lingkungankerja[]" multiple="multiple" required>
                      <option value="Kantor"> Kantor</option>
                      <option value="Pabrik"> Pabrik</option>
                      <option value="Laboratorium"> Laboratorium</option>
                      <option value="Lapangan"> Lapangan</option>
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
                <div class="col-6">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">LAIN - LAIN</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="sakit">Pernahkah Saudara menderita sakit keras atau kecelakaan kerja ?*</label>
                    <select class="form-control" id="sakit" name="sakit" required>
                      <option value="" disabled selected>Ya/Tidak</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6" id="rowsakitkapan" hidden>
                  <div class="form-group">
                    <label class="form-control-label" for="sakitkapan">kapan</label>
                    <input class="form-control" type="month" id="sakitkapan" name="sakitkapan">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="psikologis">Pernahkah Saudara mengikuti pemeriksaan psikologis ?*</label>
                    <select class="form-control" id="psikologis" name="psikologis" required>
                      <option value="" disabled selected>Ya/Tidak</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6 rowpsikologis" hidden>
                  <div class="form-group">
                    <label class="form-control-label" for="psikologiskapan">kapan</label>
                    <input class="form-control" type="month" id="psikologiskapan" name="psikologiskapan">
                  </div>
                </div>
              </div>
              <div class="row rowpsikologis" hidden>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="psikologislembaga">Tempat / Lembaga</label>
                    <input class="form-control" type="text" id="psikologislembaga" name="psikologislembaga" maxlength='220'>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="psikologistujuan">tujuan</label>
                    <input class="form-control" type="text" id="psikologistujuan" name="psikologistujuan" maxlength='220'>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kendaraan">Jenis kendaraan yang digunakan</label>
                    <input class="form-control" type="text" id="kendaraan" name="kendaraan" maxlength='220'>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kendaraanmilik">Milik</label>
                    <select id="kendaraanmilik" class="form-control" name="kendaraanmilik">
                      <option value="Pribadi"> Pribadi</option>
                      <option value="Orangtua"> Orangtua</option>
                      <option value="Dinas"> Dinas</option>
                      <option value="Umum"> Umum</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <label class="form-control-label" for="karyawankenal">Karyawan / Karyawati yang Saudara kenal di perusahaan ini :</label>
              <div id="list_karyawan">
                
              </div>
              <div class="form-group">
                <button type="button" class="btn btn-success d-flex" id="btnAdd-karyawan">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Karyawan</span>
                </button>
              </div>
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kendaraan"> Adakah kerabat atau anggota keluarga Saudara yang bekerja di perusahaan farmasi ?*</label>
                    <select class="form-control" id="kerabat" name="kerabat" required>
                      <option value="" disabled selected>Ya/Tidak</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
              {{-- <div class="table-responsive" >
                <table class="table" id="Tblsaudarafarmasi" hidden>
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 19%;">Hubungan*</th>
                      <th style="width: 19%;">Nama*</th>
                      <th style="width: 19%;">L/P*</th>
                      <th style="width: 19%;">Nama Perushaan*</th>
                      <th style="width: 19%;">Jabatan*</th>
                      <th style="width: 5%;"> 
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-saudarafarmasi">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                </table>
              </div> --}}
              <div class="saudarafarmasi" id='datasaudarafarmasi' hidden>
                <div class="row sdr1">
                  <div class="col-md-2">
                    <div class="form-group">
                      <label class="form-control-label" for="kerabat">Hubungan</label>
                      <input class="form-control" type="text" id="hubungan_saudarafarmasi" name="hubungan_saudarafarmasi[]" maxlength='220'required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="kerabat">Nama</label>
                      <input class="form-control" type="text" id="nama_saudarafarmasi" name="nama_saudarafarmasi[]" maxlength='220'required>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="form-group">
                      <label class="form-control-label" for="kerabat">Gender</label>
                      <select class='form-control' id='LPsaudara' name='LP_saudarafarmasi[]' required>
                        <option value='' disabled selected>L/P</option>
                        <option value='L'>L</option>
                        <option value='P'>P</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="kerabat">Nama Perushaan*</label>
                      <input class="form-control" type="text" id="perushaan_saudarafarmasi" name="perushaan_saudarafarmasi[]" maxlength='220' required>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="form-control-label" for="kerabat">Jabatan*</label>
                      <input class="form-control" type="text" id="jabatan_saudarafarmasi" name="jabatan_saudarafarmasi[]" maxlength='220' required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group saudarafarmasi" hidden>
                <button type="button" class="btn btn-success d-flex" id="btnAdd-saudarafarmasi">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Saudara</span>
                </button>
              </div>
              <hr class="my-4">
              <label class="form-control-label" for="referensi"> Tuliskan 2 nama yang berkenan memberikan referensi bagi lamaran Saudara ke perusahaan ini :</label>
              {{-- <div class="table-responsive"> --}}
                <div id="list_refrensi">
                  <div class="row brdr">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">Nama</label>
                        <input class="form-control" type="text" id="nama_referensi" name="nama_referensi[]">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">Alamat</label>
                        <input class="form-control" type="text" id="alamat_referensi" name="alamat_referensi[]">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">Pekerjaan</label>
                        <input class="form-control" type="text" id="pekerjaan_referensi" name="pekerjaan_referensi[]">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">No.Tlp</label>
                        <input class="form-control" type="text" id="tlp_referensi" name="tlp_referensi[]">
                      </div>
                    </div>
                  </div>
                  <div class="row brdr">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">Nama</label>
                        <input class="form-control" type="text" id="nama_referensi" name="nama_referensi[]">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">Alamat</label>
                        <input class="form-control" type="text" id="alamat_referensi" name="alamat_referensi[]">
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">Pekerjaan</label>
                        <input class="form-control" type="text" id="pekerjaan_referensi" name="pekerjaan_referensi[]">
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label" for="referensi">No.Tlp</label>
                        <input class="form-control" type="text" id="tlp_referensi" name="tlp_referensi[]">
                      </div>
                    </div>
                  </div>
                </div>
              {{-- </div> --}}
              <hr class="my-4">
              <label class="form-control-label" for="kendaraan"> Tuliskan 2 alamat kenalan Saudara yang dapat dihubungi dalam keadaan darurat</label>
                <div id="list_refrensi">
                  <div class="row brdr">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="darurat">Nama*</label>
                        <input class="form-control" type="text" id="nama_darurat" name="nama_darurat[]" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label" for="darurat">Alamat*</label>
                        <input class="form-control" type="text" id="alamat_darurat" name="alamat_darurat[]" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label" for="darurat">No.Tlp*</label>
                        <input class="form-control" type="text" id="tlp_darurat" name="tlp_darurat[]" required>
                      </div>
                    </div>
                  </div>
                  <div class="row brdr">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label class="form-control-label" for="darurat">Nama*</label>
                        <input class="form-control" type="text" id="nama_darurat" name="nama_darurat[]" required>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="form-control-label" for="darurat">Alamat*</label>
                        <input class="form-control" type="text" id="alamat_darurat" name="alamat_darurat[]" required>
                      </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="form-control-label" for="darurat">No.Tlp*</label>
                        <input class="form-control" type="text" id="tlp_darurat" name="tlp_darurat[]" required>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <input name='kandidat' value='{{ $info_kandidat->id }}'hidden>
        <button type="submit" class="btn btn-primary btnsbmt">Submit</button>
      </div>

    </div>
  </form>

  
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Kandidat/form2.js') }}"></script>
  <script src="{{ asset('js/select2.min.js') }}"></script>
</body>
