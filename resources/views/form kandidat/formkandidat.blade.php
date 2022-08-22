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
  <form method="POST" action="{{ route('fk.SubmitForm1') }}">
    @csrf
    <div id='frm' class="container-fluid mt--6">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-3">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">DATA PRIBADI</h3>
                </div>
              </div>
            </div>
            <div class="card-body">

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="namalengkap">Nama Lengkap*</label>
                    <input type="text" class="form-control" id="namalengkap" name="namalengkap" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gender">Gender*</label>
                    <select class="form-control" id="gender" name="gender" required>
                      <option value="" disabled selected>Gender</option>
                      <option value="Pria">Pria</option>
                      <option value="Wanita">Wanita</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="alamatlengkap">Alamat Lengkap* (KTP)</label>
                    <input type="text" class="form-control" id="alamatlengkap" name="alamatlengkap" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik" name="rumahmilik" required>
                      <option value="" disabled selected>rumah milik</option>
                      <option value="Sendiri">Sendiri</option>
                      <option value="Orangtua">Orangtua</option>
                      <option value="Sewa">Sewa</option>
                      <option value="Indekost">Indekost</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kota">Kota*</label>
                    <input type="text" class="form-control" id="kota" name="kota" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kodepos">kode pos*</label>
                    <input type="text" class="form-control" id="kodepos" name="kodepos"required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="form-control-label" for="alamatkoresponden">Alamat Korespondensi*</label>
                    <input type="text" class="form-control" id="alamatkoresponden" name="alamatkoresponden"required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik_koresponden">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik_koresponden" name="rumahmilik_koresponden" required>
                      <option value="" disabled selected>rumah milik</option>
                      <option value="Sendiri">Sendiri</option>
                      <option value="Orangtua">Orangtua</option>
                      <option value="Sewa">Sewa</option>
                      <option value="Indekost">Indekost</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kota_koresponden">Kota*</label>
                    <input type="text" class="form-control" id="kota_koresponden" name="kota_koresponden" required>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kodepos_koresponden">kodepos*</label>
                    <input type="text" class="form-control" id="kodepos_koresponden" name="kodepos_koresponden" required>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="status_perkawinan">Status Perkawinan*</label>
                    {{-- <input type="text" class="form-control" id="status_perkawinan" name="status_perkawinan" required> --}}
                    <select class="form-control" id="status_perkawinan" name="status_perkawinan" required>
                      <option value="" disabled selected>Status Perkawinan</option>
                      @foreach ($Pernikahan as $pernikahan )
                      <option value="{{ $pernikahan->keterangan }}">{{ $pernikahan->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tgllahir">Tanggal Lahir*</label>
                    {{-- <input type="text" class="form-control" id="tgllahir" name="tgllahir"> --}}
                    <input class="form-control" type="date" value="" id="tgllahir" name="tgllahir" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="noidentitas">No. KTP / Passport*</label>
                    <input type="text" class="form-control" id="noidentitas" name="noidentitas" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp" name="npwp">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="col-md-2">
                <div class="form-group">
                  {{-- <label class="form-control-label" for="nosim">Tambah SIM</label> --}}
                  <button type="button" class="btn btn-success d-flex">
                    <span class="material-symbols-outlined">add</span>
                    <span class="gap-logo">Tambah SIM</span>
                  </button>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="jenissim">SIM yang dimiliki</label>
                    <select class="form-control" id="sim[]" name="sim[]" required>
                      <option value="" disabled selected>SIM</option>
                      @foreach ($SIM as $sim )
                      <option value="{{ $sim->id }}">{{ $sim->nama }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="nosim">No SIM</label>
                    <input type="text" class="form-control" id="nosim" name="nosim[]">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button id="btnDel-jurusan" type="button" class="btn btn-danger d-flex" style="margin-top: 2.3em;">
                      <span class="material-symbols-outlined">delete</span>
                      <span class="gap-logo">Hapus</span>
                    </button>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="nohp">NO HP*</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="email">Email*</label>
                    <input type="text" class="form-control" id="email" name="email" required>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tinggibadan">tinggi badan*</label>
                    <input type="text" class="form-control" id="tinggibadan" name="tinggibadan" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="beratbadan">berat badan*</label>
                    <input type="text" class="form-control" id="beratbadan" name="beratbadan" required>
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
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Riwayat pendidikan</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="TblSim">
                  <thead class="thead-light">
                    <tr>
                      <th>Pendidikan</th>
                      <th>Nama Sekolah</th>
                      <th>Jurusan</th>
                      <th>kota</th>
                      <th>tahun</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>SD</td>
                      <td><input type="text" name="namasekolah[]"></td>
                      <td><input type="text" name="jurusan[]"></td>
                      <td><input type="text" name="kota[]"></td>
                      <td><input type="text" name="tahun[]"></td>
                    </tr>
                    <tr>
                      <td>SLTP</td>
                      <td><input type="text" name="namasekolah[]"></td>
                      <td><input type="text" name="jurusan[]"></td>
                      <td><input type="text" name="kota[]"></td>
                      <td><input type="text" name="tahun[]"></td>
                    </tr>
                    <tr>
                      <td>SMA</td>
                      <td><input type="text" name="namasekolah[]"></td>
                      {{-- <td><input type="text" name="jurusan[]"></td> --}}
                      <th>
                        <select class="form-control" id="jurusan[]" name="jurusan[]">
                          <option value="" disabled selected>jurusan</option>
                          @foreach ($SMA as $sma )
                          <option value="{{ $sma->id }}">{{ $sma->nama }}</option>
                          @endforeach
                        </select>
                      </th>
                      <td><input type="text" name="kota[]"></td>
                      <td><input type="text" name="tahun[]"></td>
                    </tr>
                    <tr>
                      <td>Akademi</td>
                      <td><input type="text" name="namasekolah[]"></td>
                      {{-- <td><input type="text" name="jurusan[]"></td> --}}
                      <th>
                        <select class="form-control" id="jurusan[]" name="jurusan[]">
                          <option value="" disabled selected>jurusan</option>
                          @foreach ($Sederajat as $sederajat )
                          <option value="{{ $sederajat->id }}">{{ $sederajat->nama }}</option>
                          @endforeach
                        </select>
                      </th>
                      <td><input type="text" name="kota[]"></td>
                      <td><input type="text" name="tahun[]"></td>
                    </tr>
                    <tr>
                      <td>S1</td>
                      <td><input type="text" name="namasekolah[]"></td>
                      <td><input type="text" name="jurusan[]"></td>
                      <td><input type="text" name="kota[]"></td>
                      <td><input type="text" name="tahun[]"></td>
                    </tr>
                    <tr>
                      <td>S2</td>
                      <td><input type="text" name="namasekolah[]"></td>
                      <td><input type="text" name="jurusan[]"></td>
                      <td><input type="text" name="kota[]"></td>
                      <td><input type="text" name="tahun[]"></td>
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
                <div class="col-3">
                  <h3 class="text-uppercase text-muted ls-1 mb-1">Riwayat Pekerjaan</h3>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="TblSim">
                  <thead class="thead-light">
                    <tr>
                      <th>Nama Perushaan</th>
                      <th>Jenis Perushaan</th>
                      <th>Alamat Prushaan</th>
                      <th>Jabatan</th>
                      <th>Nama Atasan/ Jabatan</th>
                      <th>Lama Bekerja</th>
                      <th>+</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <div class="row" style="margin-top: 1.7em">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">gaji yang diterima</label>
                    <input type="text" class="form-control" id="gaji" name="gaji">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">tujangan yang diterima</label>
                    <input type="text" class="form-control" id="tunjangan" name="tunjangan">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tanggungjawab">Gambarkan kedudukan Saudara dalam struktur organisasi perusahaan</label>
                    <input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
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
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gajiharapan">gaji yang yang diharapkan*</label>
                    <input type="text" class="form-control" id="gajiharapan" name="gajiharapan" required>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujanganharapan">tujangan yang diharapkan*</label>
                    <input type="text" class="form-control" id="tujanganharapan" name="tujanganharapan" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="bertugasluarkota">bersedia Bertugas ke luar kota*</label>
                    {{-- <input type="text" class="form-control" id="bertugasluarkota" name="bertugasluarkota"> --}}
                    <select class="form-control" id="bertugasluarkota" name="bertugasluarkota" required>
                      <option value="" disabled selected>Bertugas ke luar kota</option>
                      <option value="Ya">Ya</option>
                      <option value="Tidak">Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujanganharapan">bersedia Ditempatkan di luar kota</label>
                    {{-- <input type="text" class="form-control" id="tujanganharapan" name="tujanganharapan"> --}}
                    <select class="form-control" id="tujanganharapan" name="tujanganharapan" required>
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
        <button type="submit" class="btn btn-primary btnsbmt">Primary</button>
      </div>
    </div>
  </form>

  <div id='ntf' hidden>
    <h1>halaman butuh akses lokasi</h1>
  </div>
  
  <script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/form.js') }}"></script>
</body>
