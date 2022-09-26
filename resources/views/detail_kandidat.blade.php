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
      {{-- CARD SEBELAH KIRI --}}
      <div class="col-xl-4 order-xl-1">
        <div class="card card-profile">
          <img src="{{ asset('assets/img/theme/img-1-1000x600.jpg')}}" alt="Image placeholder" class="card-img-top">
          <div class="row justify-content-center">
            <div class="col-lg-3 order-lg-2">
              <div class="card-profile-image">
                <a href="{{ empty($info_kandidat->fotoCV)? asset('storage/kandidatFotos/noimg.png'):asset('storage/kandidatFotos/'.$info_kandidat->fotoCV)}}" target="_blank">
                  <img src="{{ empty($info_kandidat->fotoCV)? asset('storage/kandidatFotos/noimg.png'):asset('storage/kandidatFotos/'.$info_kandidat->fotoCV)}}" class="rounded-circle">
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
                </div>
              </div>
            </div>
            <div class="text-center">
              <h5 class="h3">
                {{ $info_kandidat->namalengkap }}<span class="font-weight-light">, {{ $umur }}</span>
              </h5>
              <div class="h5 font-weight-500">
                <i class="ni location_pin mr-2"></i>Tinggi Badan: {{ $info_kandidat->tinggibadan }}<br>
                <i class="ni location_pin mr-2"></i>Berat Badan: {{ $info_kandidat->beratbadan }}
              </div>
              <div class="h5 font-weight-500 mt-4">
                <i class="ni location_pin mr-2"></i>{{ $info_kandidat->email }}<br>
                <i class="ni location_pin mr-2"></i>{{ $info_kandidat->nohp }}
              </div>
              <div class="h5 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>{{ $FreshorNot }}<br>
                <i class="ni business_briefcase-24 mr-2"></i>{{ empty($pekerjaan->namaPerusahaan) ? "": $pekerjaan->namaPerusahaan }} - {{ empty($pekerjaan->jabatanPerusahaan) ? "": $pekerjaan->jabatanPerusahaan}}
              </div>
              <div class="mt-3">
                <i class="ni education_hat mr-2"></i>{{ $pendidikan->pendidikan }} {{ $pendidikan->namaSekolah }} {{ $pendidikan->jurusan }}
              </div>
              <div class="d-flex col-8 center mt-3">
                @if (!empty($info_kandidat->CV))
                  <a type="button" class="btn btn-sm btn-primary d-flex" href="{{ asset('storage/kandidatCVs/'.$info_kandidat->CV)}}" target="_blank">
                    <span class="material-symbols-outlined">description</span>
                    <span class="gap-logo">CV</span>
                  </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- END CARD SEBELAH KIRI --}}
      
      {{-- CARD SEBELAH KANAN --}}
      <div class="col-xl-8 order-xl-2">
        <form method="POST" action="{{ route('dk.UpdateForm1') }}" >
          @csrf
        <div class="card">
          <div class="card-header">
            <div class="row align-items-center">
              <div class="col-8">
                <input id="id_kandidat" name="id_kandidat" value="{{ $info_kandidat->id }}" hidden>
                <h3 class="mb-0">Kandidat id: {{ $info_kandidat->id }} </h3>
              </div>
              <div class="col-4 text-right">
                {{-- <a href="#!" class="btn btn-sm btn-primary">update</a> --}}
                <button type="submit" class="btn btn-primary btnsbmt">Update</button>
              </div>
            </div>
          </div>
          <div class="card-body">
            {{-- <h6 class="heading-small text-muted mb-4">Info Kandidat</h6> --}}
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
              <hr class="my-4" />
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">Tempat lahir</label>
                    <select class="js-example-basic-single form-control" name="tempatlahir" id="tempatlahir" required>
                      @foreach ($kotas as $kota )
                      <option value="{{ $kota->provinsi }}" {{ $kota->provinsi == $info_kandidat->tempatlahir ? 'selected' : ''}}>{{ $kota->provinsi }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tgllahir">Tanggal Lahir</label>
                    {{-- {{ dd($info_kandidat->tglLahir) }} --}}
                    <input class="form-control" type="date" id="tgllahir" name="tgllahir" value="{{ $info_kandidat->tglLahir}}" required>
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">URL proto</label>
                    <input type="text" class="form-control" id="porto" name="porto" value="{{ $info_kandidat->urlPorto }}">
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        </form>
      </div>
      {{-- END CARD SEBELAJ KANAN --}}
    </div>

    {{-- PAGE --}}
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item active" id='p1'><a class="page-link" type="button">1</a></li>
        <li class="page-item" id='p2'><a class="page-link" type="button" >2</a></li>
      </ul>
    </nav>
    {{-- PAGE --}}
    
    <form method="POST" action="{{ route('dk.UpdateForm1_1') }}" class="p1">
      @csrf
      <input name="id_kandidat2" value="{{ $info_kandidat->id }}" hidden>
      {{-- ALAMAT --}}
      <div class="row p1">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">Alamat</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_alamat" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_alamat" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_alamat" hidden>
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="alamatlengkap">Alamat Lengkap(KTP)</label>
                    <input type="text" class="form-control" id="alamatlengkap" name="alamatlengkap" value="{{ $info_kandidat->alamatlengkap}}" maxlength="220" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik" name="rumahmilik" required>
                      <option value="" disabled selected>rumah milik</option>
                      <option value="Sendiri" {{ "Sendiri" == $info_kandidat->rumahmilik ? 'selected' : ''}}>Sendiri</option>
                      <option value="Orangtua" {{ "Orangtua" == $info_kandidat->rumahmilik ? 'selected' : ''}}>Orangtua</option>
                      <option value="Sewa" {{ "Sewa" == $info_kandidat->rumahmilik ? 'selected' : ''}}>Sewa</option>
                      <option value="Indekost" {{ "Indekost" == $info_kandidat->rumahmilik ? 'selected' : ''}}>Indekost</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kota">Kota*</label>
                    <select class="js-example-basic-single form-control" name="kota1" id="kota1" required>
                      @foreach ($kotas as $kota )
                          <option value="{{ $kota->kabupaten }}" {{ $kota->kabupaten == $info_kandidat->kota1 ? 'selected' : ''}}>{{ $kota->kabupaten }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label id="temp_kodepos">{{ $info_kandidat->kodepos}}</label>
                    <label class="form-control-label" for="kodepos">kode pos</label>
                    <select class="js-example-basic-single form-control" name="kodepos" id="kodepos" required>
                      <option value="{{ $info_kandidat->kodepos }}" selected>{{ $info_kandidat->kodepos }}</option>
                    </select>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="alamat_koresponden">Alamat Korespondensi*</label>
                      <input type="text" class="form-control" id="alamat_koresponden" name="alamat_koresponden" value="{{ $info_kandidat->alamat_koresponden }}" maxlength="220" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik_koresponden" name="rumahmilik_koresponden" required>
                      <option value="" disabled selected>rumah milik</option>
                      <option value="Sendiri" {{ "Sendiri" == $info_kandidat->rumahmilik_koresponden ? 'selected' : ''}}>Sendiri</option>
                      <option value="Orangtua" {{ "Orangtua" == $info_kandidat->rumahmilik_koresponden ? 'selected' : ''}}>Orangtua</option>
                      <option value="Sewa" {{ "Sewa" == $info_kandidat->rumahmilik_koresponden ? 'selected' : ''}}>Sewa</option>
                      <option value="Indekost" {{ "Indekost" == $info_kandidat->rumahmilik_koresponden ? 'selected' : ''}}>Indekost</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="kota">Kota*</label>
                    <select class="js-example-basic-single form-control" name="kota_koresponden" id="kota_koresponden" required>
                      @foreach ($kotas as $kota )
                          <option value="{{ $kota->kabupaten }}" {{ $kota->kabupaten == $info_kandidat->kota_koresponden ? 'selected' : ''}}>{{ $kota->kabupaten }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label id="temp_kodepos">{{ $info_kandidat->kodepos}}</label>
                    <label class="form-control-label" for="kodepos">kode pos</label>
                    <select class="js-example-basic-single form-control" name="kodepos_koresponden" id="kodepos_koresponden" required>
                      <option value="{{ $info_kandidat->kodepos_koresponden }}" selected>{{ $info_kandidat->kodepos_koresponden }}</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- END ALAMAT --}}

      {{-- SIM --}}
      <div class="row p1">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">SIM</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_sim" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_sim" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_sim" hidden>
              <div class="table-responsive">
                <table class="table" id="TblSim">
                  <thead class="thead-light">
                    <tr>
                      <th>SIM</th>
                      <th>NO SIM</th>
                      <th>
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-sim">
                        <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="tbody_sim">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- END SIM --}}

      {{-- PENDIDIKAN --}}
      <div class="row p1">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">PENDIDIKAN</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_pendidikan" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_pendidikan" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_pendidikan" hidden>
              <div class="table-responsive">
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
                    <tbody id="tbody_pendidikan">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- END PENDIDIKAN --}}

      {{-- PEKERJAAN --}}
      <div class="row p1">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">PEKERJAAN</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_pekerjaan" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_pekerjaan" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_pekerjaan" hidden>
              <div class="table-responsive">
                <div class="table-responsive">
                  <table class="table" id="TblPerusahaan">
                    <thead class="thead-light">
                      <tr>
                        <th>NAMA PERUSHAAN</th>
                        <th>JENIS PERUSHAAN</th>
                        <th>ALAMAT PRUSHAAN</th>
                        <th>JABATAN</th>
                        <th>NAMA ATASAN/ JABATAN</th>
                        <th>START KERJA</th>
                        <th>END KERJA</th>
                      </tr>
                    </thead>
                    <tbody id="tbody_pekerjaan">
                    </tbody>
                  </table>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">gaji yang diterima terakhir</label>
                    <input type="text" class="form-control" id="gaji" name="gaji" value="{{ $info_kandidat->gaji }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">tujangan yang diterima terakhir</label>
                    <input type="text" class="form-control" id="tunjangan" name="tunjangan" value="{{ $info_kandidat->tunjangan }}">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="gambarkedudukan">Gambarkan kedudukan Saudara dalam struktur organisasi perusahaan</label>
                    
                    <a href="{{ empty($info_kandidat->gambarkedudukan)? asset('storage/kandidatFotoKedudukans/noimg.png'):asset('storage/kandidatFotoKedudukans/'.$info_kandidat->gambarkedudukan)}}" target="_blank">
                      <img src="{{ empty($info_kandidat->gambarkedudukan)? asset('storage/kandidatFotoKedudukans/noimg.png'):asset('storage/kandidatFotoKedudukans/'.$info_kandidat->gambarkedudukan)}}" style="max-height: 100%; max-width: 100%">
                    </a>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="tanggungjawab">jelaskan tugas dan tanggung jawab saudara</label>
                      <textarea class="form-control" id="tanggungjawab" rows="3" resize="none" name="tanggungjawab">{{$info_kandidat->tanggungjawab}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="tanggungjawab">prestasi yang pernah saudara lakukan</label>
                      <textarea class="form-control" id="tanggungjawab" rows="3" resize="none" name="tanggungjawab">{{$info_kandidat->prestasi}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">Jabatan yang Saudara inginkan</label>
                    <input type="text" class="form-control" id="jabatanharapan" name="jabatanharapan" maxlength="200" required value="{{ $info_kandidat->jabatanharapan }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">Gaji yang yang diharapkan</label>
                    <input type="text" class="form-control" id="gajiharapan" name="gajiharapan" required value="{{ $info_kandidat->gajiharapan }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">tujangan yang diharapkan</label>
                    <input type="text" class="form-control" id="tujanganharapan" name="tujanganharapan" maxlength="200" required value="{{ $info_kandidat->tujanganharapan }}">
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">bersedia Bertugas ke luar kota</label>
                    <select class="form-control" id="bertugasluarkota" name="bertugasluarkota" required>
                      <option value="Ya" {{$info_kandidat->bertugasluarkota=='Ya'? "selected":""  }}>Ya</option>
                      <option value="Tidak" {{$info_kandidat->bertugasluarkota=='Tidak'? "selected":""  }}>Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">bersedia Ditempatkan di luar kota</label>
                    <select class="form-control" id="ditempatkanluarkota" name="ditempatkanluarkota" required>
                      <option value="Ya" {{$info_kandidat->ditempatkanluarkota=='Ya'? "selected":""  }}>Ya</option>
                      <option value="Tidak" {{$info_kandidat->ditempatkanluarkota=='Tidak'? "selected":""  }}>Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
          </div>
        </div>
      </div>
      {{-- END PEKERJAAN --}}
      <button type="submit" class="btn btn-primary btnsbmt">Update</button>
    </form>
  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Kandidat/detail_kandidat.js') }}"></script>
@endsection