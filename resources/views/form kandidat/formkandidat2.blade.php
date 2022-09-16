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
                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir" value="{{ $info_kandidat->tempatlahir }}" readonly>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tgllahir">Tanggal Lahir</label>
                    <input type="text" class="form-control" id="tgllahir" name="tgllahir" value="{{ $info_kandidat->tglLahir }}" readonly>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tlprumah">Telp. rumah*</label>
                    <input type="text" class="form-control" id="tlprumah" name="tlprumah" placeholder="(kode)12312123" maxlength="18" required>
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
              <div class="table-responsive">
                <table class="table" id="Tblpelatihan">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 30%;">jenis Kursus/Pelatihan</th>
                      <th style="width: 30%;">Penyelenggara</th>
                      <th style="width: 30%;">Tahun Pelaksanaan</th>
                      <th style="width: 10%;"> 
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-pelatihan">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                </table>
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
                <div class="table-responsive">
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
                <div class="table-responsive">
                  <table class="table" id="Tblorganisasi">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 23.75%;">Nama Organisasi</th>
                        <th style="width: 23.75%;">Kota</th>
                        <th style="width: 23.75%;">Jabatan</th>
                        <th style="width: 23.75%;">Dari/Sampai(Tahun)</th>
                        <th style="width: 5%;"> 
                          <button type="button" class="btn btn-success d-flex" id="btnAddRow-organisasi">
                            <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                  </table>
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">SUSUNAN KELUARGA (TERMASUK DIRI ANDA)</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="Tblorganisasi">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 14%;">Orang tua</th>
                        <th style="width: 21.6%;">Nama</th>
                        <th style="width: 10%;">usia</th>
                        <th style="width: 11%;">L/P</th>
                        <th style="width: 21.6%;">Pendidikan</th>
                        <th style="width: 21.6%;">Nama Perushaan</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Ayah</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>Ibu</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat Rumah</td>
                        <td colspan="3">
                          <input type="text" class="form-control" id="alamt" name="alamat[]" maxlength='1000'>
                        </td>
                        <td>
                          No Tlp:
                        </td>
                        <td>
                          <input type="text" class="form-control" id="notlp" name="notlp[]" maxlength='45'>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6" style="text-align: center; background:#CFD2CF" >Kakak/Adik</td>
                        
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>Istri/Suami</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6" style="text-align: center; background:#CFD2CF" >Anak</td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>Ayah Mertua</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>Ibu Mertua</td>
                        <td>
                          <input type="text" class="form-control" id="nama" name="nama[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">
                        </td>
                        <td>
                          <select class="form-control" id="LP" name="LP[]">
                            <option value="" selected>L/P</option>
                            <option value="L">L</option>
                            <option value="P">P</option>
                          </select>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength='90'>
                        </td>
                        <td>
                          <input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength='90'>
                        </td>
                      </tr>
                      <tr>
                        <td>Alamat Mertua</td>
                        <td colspan="5">
                          <input type="text" class="form-control" id="alamt" name="alamat[]" maxlength='1000'>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
              <div class="table-responsive">
                <table class="table" id="Tblkenal">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 47.5%;">Nama</th>
                      <th style="width: 47.5%;">hubungan</th>
                      <th style="width: 5%;"> 
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-kenal">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                </table>
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
              <div class="table-responsive" >
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
              </div>
              <hr class="my-4">
              <label class="form-control-label" for="referensi"> Tuliskan 2 nama yang berkenan memberikan referensi bagi lamaran Saudara ke perusahaan ini :</label>
              <div class="table-responsive">
                <table class="table" id="Tblsaudarafarmasi">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 25%;">Nama</th>
                      <th style="width: 25%;">Alamat</th>
                      <th style="width: 25%;">Pekerjaan</th>
                      <th style="width: 25%;">No.Tlp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <input class="form-control" type="text" id="nama_referensi" name="nama_referensi[]" maxlength='95'>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="alamat_referensi" name="alamat_referensi[]" maxlength='220'>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="pekerjaan_referensi" name="pekerjaan_referensi[]" maxlength='95'>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="tlp_referensi" name="tlp_referensi[]" maxlength='95'>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input class="form-control" type="text" id="nama_referensi" name="nama_referensi[]" maxlength='95'>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="alamat_referensi" name="alamat_referensi[]" maxlength='220'>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="pekerjaan_referensi" name="pekerjaan_referensi[]" maxlength='95'>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="tlp_referensi" name="tlp_referensi[]" maxlength='95'>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <hr class="my-4">
              <label class="form-control-label" for="kendaraan"> Tuliskan 2 alamat kenalan Saudara yang dapat dihubungi dalam keadaan darurat</label>
              <div class="table-responsive">
                <table class="table" id="kontakdarurat">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 33.3%;">Nama*</th>
                      <th style="width: 33.3%;">Alamat*</th>
                      <th style="width: 33.3%;">No.Tlp*</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <input class="form-control" type="text" id="nama_kontakdarurat" name="nama_kontakdarurat[]" maxlength='95' required>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="alamat_kontakdarurat" name="alamat_kontakdarurat[]" maxlength='220' required>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="tlp_kontakdarurat" name="tlp_kontakdarurat[]" maxlength='95' required>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <input class="form-control" type="text" id="nama_kontakdarurat" name="nama_kontakdarurat[]" maxlength='95'  required>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="alamat_kontakdarurat" name="alamat_kontakdarurat[]" maxlength='220'  required>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="tlp_kontakdarurat" name="tlp_kontakdarurat[]" maxlength='95' required>
                      </td>
                    </tr>
                  </tbody>
                </table>
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
