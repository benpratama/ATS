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
  .border-rw{
    border-style: solid;
    border-color: coral;
    padding: 1em;
    margin: 0.5em;
  }
  </style>
  <link rel="stylesheet" href="{{ asset('css/summernote.css') }}" type="text/css">
  
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
                <li class="breadcrumb-item"><a href="#">Detail Kandidat</a></li>
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
                @if (!empty($pendidikan))
                  <i class="ni education_hat mr-2"></i>{{ $pendidikan->pendidikan }} {{ $pendidikan->namaSekolah }} {{ $pendidikan->jurusan }}
                @endif
              </div>
              <div class="h3 mt-4">
                <i class="ni business_briefcase-24 mr-2"></i>Melamar sebagai: {{ $applyas[0]->nama }}<br>
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
            {{-- START URL PAHSE 2 --}}
            <div class="row pt-3">
              <div class="col-md-8">
                  <textarea  rows="3" cols="20" wrap="hard" type="text" class="form-control" id="urlphase2" name="urlphase2" readonly>{{ $url_phase2 }}</textarea>
              </div>
              <div class="col-md-3">
                <button id="btnGen-url" type="button" class="btn btn-primary btnsbmt" value={{ $info_kandidat->id }} data-noidentitas={{ $info_kandidat->noidentitas }} {{ $disabled == "true" ? 'hidden' : ''}}>Generate</button>
              </div>
            </div>
            {{-- END URL PAHSE 2 --}}
            <div class="row">
              <div class="col-md-3">
                <button id="btnGen-url" type="button" class="btn btn-primary btnsbmt" value={{ $info_kandidat->id }} data-noidentitas={{ $info_kandidat->noidentitas }} {{ $disabled == "true" ? 'hidden' : ''}}>Generate</button>
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
                <input id="id_Organisasi" name="id_Organisasi" value="{{ $info_kandidat->id_Organisasi }}" hidden>
                <input id="applyas" name="applyas" value="{{ $applyas[0]->nama }}" hidden>
                <h3 class="mb-0">Kandidat id: {{ $info_kandidat->id }} </h3>
              </div>
              <div class="col-4 text-right">
                {{-- <a href="#!" class="btn btn-sm btn-primary">update</a> --}}
                <button type="submit" class="btn btn-primary btnsbmt" {{ $disabled == "true" ? 'hidden' : ''}}>Update</button>
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
                    <input type="text" id="namalengkap" name="namalengkap" class="form-control" placeholder="Nama Lengkap Kandidat" value="{{ $info_kandidat->namalengkap }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="gender">Gender</label>
                    <select class="form-control" id="gender" name="gender" {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="Pria" {{ $info_kandidat->gender == "Pria" ? 'selected' : ''}}>Pria</option>
                      <option value="Wanita"  {{ $info_kandidat->gender == "Wanita" ? 'selected' : ''}}>Wanita</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-4">
                  <div class="form-group">
                    <label class="form-control-label" for="status_perkawinan">Status Perkawinan</label>
                    <select class="form-control" id="status_perkawinan" name="status_perkawinan" {{ $disabled == "true" ? 'disabled' : ''}}>
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
                  <input type="text" class="form-control" id="noidentitas" name="noidentitas"placeholder="NO Identitas"  value="{{ $info_kandidat->noidentitas }}"  maxlength="45" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="npwp">NPWP</label>
                    <input type="text" class="form-control" id="npwp" name="npwp" value="{{ $info_kandidat->npwp }}" placeholder="NPWP" maxlength="45" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="nohp">NO HP</label>
                    <input type="text" class="form-control" id="nohp" name="nohp" value="{{ $info_kandidat->nohp }}" maxlength="45" placeholder="08123456789" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="npwp">Email</label>
                    <input type="email" class="form-control" id="email" value="{{ $info_kandidat->email }}" name="email" maxlength="45" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">Tempat lahir</label>
                    <select class="js-example-basic-single form-control" name="tempatlahir" id="tempatlahir" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                    <input class="form-control" type="date" id="tgllahir" name="tgllahir" value="{{ $info_kandidat->tglLahir}}" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <hr class="my-4" />
              <div class="row">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label class="form-control-label" for="tempatlahir">URL proto</label>
                    <input type="text" class="form-control" id="porto" name="porto" value="{{ $info_kandidat->urlPorto }}" {{ $disabled == "true" ? 'disabled' : ''}}>
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

    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">FPTK</h6>
                <h5 class="h3 mb-0">log</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TbllogFPTK">
                <thead class="thead-light">
                  <tr>
                    <th>No FPTK</th>
                    <th>Nama Kandidat</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Eksekutor</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

      {{-- START SCHEDULE --}}
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-3">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">SCHEDULE</h5>
                </div>
                <div class="d-flex col-8">
                  <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-schedule">
                    <span class="material-symbols-outlined">add</span>
                    <span class="gap-logo">Tambah</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_schedule">
              <div class="table-responsive">
                <table class="table" id="tblSchedule">
                  <thead class="thead-light">
                    <tr>
                      <th>Status</th>
                      <th>Tanggal Buat</th>
                      <th>Tanggal Proses</th>
                      <th>Email terkirim</th>
                      <th>Summary</th>
                      <th>Notes</th>
                      <th>Update</th>
                      <th>send email</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        {{--!!START MODAL TAMBAH!!--}}
        <div class="modal fade bd-example-modal-xl modal-tambah-schedule" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Schedule</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {{-- <form method="POST" action="{{ route('dk.SetSchedule') }}" >
                @csrf --}}

                {{-- INI INFORMASI KANDIDAT --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="namalengkap">Nama Kandidat</label>
                      <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="{{ $info_kandidat->namalengkap }}" readonly>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="posisi">Posisi</label>
                      <input type="text" class="form-control" id="posisi" name="posisi" value="{{ $applyas[0]->nama }}" readonly>
                    </div>
                  </div>
                </div>

                {{-- INI DITANYA PROESES SAMA JENISNYA --}}
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="schedule">list proses</label>
                      <select class="form-control" id="schedule" name="schedule" required>
                        <option value="" selected disabled>Proses</option>
                        @foreach ($list_proses as $proses )
                        <option value="{{ $proses->id }}">{{ $proses->proses }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4" id='onlineonsite'>
                    <div class="form-group">
                      <label class="form-control-label" for="proses">Online/On-site</label>
                      <select class="form-control" id="proses" name="proses" required>
                        <option value="" selected disabled>Online/Onsite/Phone</option>
                        <option value="1">Online</option>
                        <option value="0">On-site</option>
                        <option value="2">By phone</option>
                      </select>
                    </div>
                  </div>
                  @if (Auth::user()->id_Organisasi==2)
                  <div class="col-md-4" id='konfirmasi_'>
                    <div class="form-group">
                      <label class="form-control-label" for="konfirmasi">jenis Pesan</label>
                      <select class="form-control" id="konfirmasi" name="konfirmasi" required>
                        <option value="" selected disabled>Jenis Pesan</option>
                        <option value="1">Konfirmasi</option>
                        <option value="0">Bukan Konfirmasi</option>
                      </select>
                    </div>
                  </div>
                  @endif
                </div>
                <label id="id_Organisasi">{{ Auth::user()->id_Organisasi }}</label>
                <label id="PICname">{{ Auth::user()->nama }}</label>
                @if (in_array(Auth::user()->id_Organisasi, [1,3]))
                  <div id="informasi1">
                    <div class="row" id="MCU">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="mcu_nosurat">No Surat</label>
                          <input type="text" class="form-control" id="mcu_nosurat" name="mcu_nosurat" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="mcu_Durasi">Durasi (dalam jam)</label>
                          <input type="number" class="form-control" id="mcu_Durasi" name="Durasi" min=0 max=100>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="alamatlengkap">Lab</label>
                          <select id="mcu_lab" class="form-control" name="mcu_lab">
                            <option value="" selected disabled>NAMA LAB</option>
                            @foreach ($list_mcu as $mcu )
                            <option value="{{ $mcu->id }}">{{ $mcu->namaLab }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row" id="psikotest_1">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="psikotest_1_Durasi">Durasi (dalam jam)</label>
                          <input type="number" class="form-control" id="psikotest_1_Durasi" name="Durasi" min=0 max=100>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="psikotest_1_Link">Link</label>
                          <input type="text" class="form-control" id="psikotest_1_Link" name="psikotest_1_Link" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="psikotest_1_PIC">PIC</label>
                          <input type="text" class="form-control" id="psikotest_1_PIC" name="psikotest_1_PIC" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="psikotest_0">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="psikotest_0_Address">Address</label>
                          <input type="text" class="form-control" id="psikotest_0_Address" name="psikotest_0_Address" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="psikotest_0_Room">Room</label>
                          <input type="text" class="form-control" id="psikotest_0_Room" name="psikotest_0_Room" value="">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="psikotest_0_PIC">PIC</label>
                          <input type="text" class="form-control" id="psikotest_0_PIC" name="psikotest_0_PIC" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="test_1">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="test_1_Durasi">Durasi (dalam jam)</label>
                          <input type="number" class="form-control" id="test_1_Durasi" name="test_1_Durasi" min=0 max=100>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="test_1_Link">LINK</label>
                          <input type="text" class="form-control" id="test_1_Link" name="test_1_Link" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="test_0">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="test_0_Durasi">Durasi (dalam jam)</label>
                          <input type="number" class="form-control" id="test_0_Durasi" name="test_0_Durasi" min=0 max=100>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="test_0_lokasi">Lokasi</label>
                          <input type="text" class="form-control" id="test_0_lokasi" name="test_0_lokasi" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="interviewHR_1">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewHR_1_Link">LINK</label>
                          <input type="text" class="form-control" id="interviewHR_1_Link" name="interviewHR_1_Link" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewHR_1_MeetingID">Meeting ID</label>
                          <input type="text" class="form-control" id="interviewHR_1_MeetingID" name="interviewHR_1_MeetingID" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewHR_1_Passcode">Passcode</label>
                          <input type="text" class="form-control" id="interviewHR_1_Passcode" name="interviewHR_1_Passcode" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewHR_1_BR">Breakout Room</label>
                          <input type="text" class="form-control" id="interviewHR_1_BR" name="interviewHR_1_BR" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="interviewuser_1">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewuser_1_Link">LINK</label>
                          <input type="text" class="form-control" id="interviewuser_1_Link" name="interviewuser_1_Link" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewuser_1_MeetingID">Meeting ID</label>
                          <input type="text" class="form-control" id="interviewuser_1_MeetingID" name="interviewuser_1_MeetingID" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewuser_1_Passcode">Passcode</label>
                          <input type="text" class="form-control" id="interviewuser_1_Passcode" name="interviewuser_1_Passcode" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewuser_1_BR">Breakout Room</label>
                          <input type="text" class="form-control" id="interviewuser_1_BR" name="interviewuser_1_BR" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row offer_1">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_Link">LINK</label>
                          <input type="text" class="form-control" id="offer_1_Link" name="offer_1_Link" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_MeetingID">Meeting ID</label>
                          <input type="text" class="form-control" id="offer_1_MeetingID" name="offer_1_MeetingID" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_Passcode">Passcode</label>
                          <input type="text" class="form-control" id="offer_1_Passcode" name="offer_1_Passcode" value="">
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_BR">Breakout Room</label>
                          <input type="text" class="form-control" id="offer_1_BR" name="offer_1_BR" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row offer_1">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_Durasi">Durasi</label>
                          <input type="number" class="form-control" id="offer_1_Durasi" name="offer_1_Durasi"  min=0 max=100>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_Deadline">Deadline</label>
                          <input type="date" class="form-control" id="offer_1_Deadline" name="offer_1_Deadline" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_1_URLPhase2">Link Phase2</label>
                          <input type="text" class="form-control" id="offer_1_URLPhase2" name="offer_1_URLPhase2" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row offer_2">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_2_Durasi">Durasi</label>
                          <input type="number" class="form-control" id="offer_2_Durasi" name="offer_2_Durasi" min=0 max=100>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_2_Deadline">Deadline</label>
                          <input type="date" class="form-control" id="offer_2_Deadline" name="offer_2_Deadline" value="">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="form-control-label" for="offer_2_URLPhase2">Link Phase2</label>
                          <input type="text" class="form-control" id="offer_2_URLPhase2" name="offer_2_URLPhase2" value="">
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                  <div id="information2">
                    <div class="row" id="interviewHR_1">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewHR_1_Link">Link Interview</label>
                          <input type="text" class="form-control" id="interviewHR_1_Link" name="interviewHR_1_Link" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="interviewuser_1">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="form-control-label" for="interviewuser_1_Link">Link Interview</label>
                          <input type="text" class="form-control" id="interviewuser_1_Link" name="interviewuser_1_Link" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row" id="MCU">
                      {{-- <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="mcu_nosurat">No Surat</label>
                          <input type="text" class="form-control" id="mcu_nosurat" name="mcu_nosurat" value="">
                        </div>
                      </div> --}}
                      {{-- <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="mcu_Durasi">Durasi (dalam jam)</label>
                          <input type="number" class="form-control" id="mcu_Durasi" name="Durasi" min=0 max=100>
                        </div>
                      </div> --}}
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="form-control-label" for="alamatlengkap">Lab</label>
                          <select id="mcu_lab" class="form-control" name="mcu_lab">
                            <option value="" selected disabled>NAMA LAB</option>
                            @foreach ($list_mcu as $mcu )
                            <option value="{{ $mcu->id }}">{{ $mcu->namaLab }}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="alamatlengkap">Tanggal dan waktu</label>
                      <input type="datetime-local" class="form-control" id="tglWaktu" name="tglWaktu" value="">
                    </div>
                  </div>
                  <div class="col-md-8" id="f_ccto">
                    <div class="form-group">
                      <label class="form-control-label" for="alamatlengkap">TCC To:</label>
                      <select id="ccto" class="js-example-basic-multiple " name="ccto[]" multiple="multiple">
                        @foreach ($list_cc as $ccto )
                        <option value="{{ $ccto->email }}">{{ $ccto->nama }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="form-control-label" for="alamatlengkap">Email to kandidat</label>
                  {{-- <div id="summernote"></div> --}}
                  <textarea name="konten" id="konten" class="form-control" cols="30" rows="20"></textarea>
                </div>
                {{-- <div class="row">
                  <label class="form-control-label" for="alamatlengkap">Email to Vendor</label>
                  <div id="summernote2"></div>
                </div> --}}
              </div>
              <div class="modal-footer">
                <div class="row">
                  <button id="btnAdd-schedule" type="button" class="btn btn-primary">Save changes</button>
                  <button id="btnUpdate-schedule" type="button" class="btn btn-primary" hidden>Update</button>
                  <button id="btnEmail" type="button" class="btn btn-primary">Email</button>
                </div>
              </div>
            {{-- </form> --}}
          </div>
        </div>
        </div>
        {{--!!END MODAL TAMBAH!!--}}

        {{--!!START MODAL Notes!!--}}
        <div class="modal fade bd-example-modal-lg modal-notes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="titleNotes"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- <form method="POST" action="{{ route('dk.SetSchedule') }}" >
              @csrf --}}
            <div class="modal-body">
                <input id="id_schedule" name="id_schedule" hidden>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="alamatlengkap">Notes</label>
                      {{-- <textarea type="text" class="form-control" id="alamatlengkap" name="alamatlengkap" value="{{ $info_kandidat->namalengkap }}" textarea> --}}
                      <textarea class="form-control" id="notes" name="notes" rows="4" cols="50" required></textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="summary">Notes</label>
                      <select  class="form-control" name="summary" id="summary" required>
                        <option value="" selected disabled>Summary</option>
                        <option value="Lanjut">lanjut</option>
                        <option value="Pertimbangkan">Pertimbangkan</option>
                        <option value="Tolak">Tolak</option>
                      </select>
                    </div>
                  </div>
                </div>
              
            </div>
            <div class="modal-footer">
              <div class="row">
                <button id="btn-notes" type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
          {{-- </form> --}}
          </div>
        </div>
        </div>
        {{--!!END MODAL Notes!!--}}
      </div>
      {{-- END SCHEDULE --}}

    {{-- PAGE --}}
    <nav aria-label="Page navigation example">
      <ul class="pagination justify-content-center">
        <li class="page-item active" id='p1'><a class="page-link" type="button">1</a></li>
        <li class="page-item" id='p2'><a class="page-link" type="button" >2</a></li>
      </ul>
    </nav>
    {{-- PAGE --}}

    {{-- PHASE1 --}}
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
                    <input type="text" class="form-control" id="alamatlengkap" name="alamatlengkap" value="{{ $info_kandidat->alamatlengkap}}" maxlength="220" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik" name="rumahmilik" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                    <select class="js-example-basic-single form-control" name="kota1" id="kota1" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                    <select class="js-example-basic-single form-control" name="kodepos" id="kodepos" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                      <input type="text" class="form-control" id="alamat_koresponden" name="alamat_koresponden" value="{{ $info_kandidat->alamat_koresponden }}" maxlength="220" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="rumahmilik">Rumah Milik*</label>
                    <select class="form-control" id="rumahmilik_koresponden" name="rumahmilik_koresponden" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                    <select class="js-example-basic-single form-control" name="kota_koresponden" id="kota_koresponden" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                    <select class="js-example-basic-single form-control" name="kodepos_koresponden" id="kodepos_koresponden" required {{ $disabled == "true" ? 'disabled' : ''}}>
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
                  <button id="btnhide_sim" type="button" class="btn btn-success d-flex btnhide" data-value="1" >
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
                      <th {{ $disabled == "true" ? 'hidden' : ''}}>
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
              <div class="d-flex">
                <h5 class="h5 mb-0 mr-3">RIWAYAT PEKERJAAN</h5>
                <button type="button" class="btn btn-primary" id="btnAddRow-pekerjaan" {{ $disabled == "true" ? 'hidden' : ''}}>Tambah</button>
              </div>
              <div id="rw_p">
                {{-- isinya disni --}}
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">gaji yang diterima terakhir</label>
                    <input type="text" class="form-control" id="gaji" name="gaji" value="{{ $info_kandidat->gaji }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">tujangan yang diterima terakhir</label>
                    <input type="text" class="form-control" id="tunjangan" name="tunjangan" value="{{ $info_kandidat->tunjangan }}" {{ $disabled == "true" ? 'disabled' : ''}}>
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
                      <textarea class="form-control" id="tanggungjawab" rows="3" resize="none" name="tanggungjawab" {{ $disabled == "true" ? 'disabled' : ''}}>{{$info_kandidat->tanggungjawab}}</textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="form-control-label" for="tanggungjawab">prestasi yang pernah saudara lakukan</label>
                      <textarea class="form-control" id="tanggungjawab" rows="3" resize="none" name="tanggungjawab" {{ $disabled == "true" ? 'disabled' : ''}}>{{$info_kandidat->prestasi}}</textarea>
                    </div>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">Jabatan yang Saudara inginkan</label>
                    <input type="text" class="form-control" id="jabatanharapan" name="jabatanharapan" maxlength="200" required value="{{ $info_kandidat->jabatanharapan }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">Gaji yang yang diharapkan</label>
                    <input type="text" class="form-control" id="gajiharapan" name="gajiharapan" required value="{{ $info_kandidat->gajiharapan }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">tujangan yang diharapkan</label>
                    <input type="text" class="form-control" id="tujanganharapan" name="tujanganharapan" maxlength="200" required value="{{ $info_kandidat->tujanganharapan }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="gaji">bersedia Bertugas ke luar kota</label>
                    <select class="form-control" id="bertugasluarkota" name="bertugasluarkota" required {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="Ya" {{$info_kandidat->bertugasluarkota=='Ya'? "selected":""  }}>Ya</option>
                      <option value="Tidak" {{$info_kandidat->bertugasluarkota=='Tidak'? "selected":""  }}>Tidak</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tujangan">bersedia Ditempatkan di luar kota</label>
                    <select class="form-control" id="ditempatkanluarkota" name="ditempatkanluarkota" required {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="Ya" {{$info_kandidat->ditempatkanluarkota=='Ya'? "selected":""  }}>Ya</option>
                      <option value="Tidak" {{$info_kandidat->ditempatkanluarkota=='Tidak'? "selected":""  }}>Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- END PEKERJAAN --}}
      <button type="submit" class="btn btn-primary btnsbmt" {{ $disabled == "true" ? 'hidden' : ''}}>Update</button>
    </form>

    {{-- PHASE2 --}}
    @if (!empty($info_kandidat2))
    <form method="POST" action="{{ route('dk.UpdateForm2') }}" class="p2" hidden>
      @csrf
      <input name="id_kandidat3" value="{{ $info_kandidat->id }}" hidden>
      {{-- Start data --}}
      <div class="row p2">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">Data</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_data" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_data" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_data" hidden>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="goldarah">Golongan Darah</label>
                    <select class="form-control" id="goldarah" name="goldarah" required {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="O" {{ $info_kandidat2->golDarah=='O'?"selected":"" }} >O</option>
                      <option value="A" {{ $info_kandidat2->golDarah=='A'?"selected":"" }}>A</option>
                      <option value="B" {{ $info_kandidat2->golDarah=='B'?"selected":"" }}>B</option>
                      <option value="AB" {{ $info_kandidat2->golDarah=='AB'?"selected":"" }}>AB</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="tlprumah">Telp. rumah</label>
                    <input type="text" class="form-control" id="tlprumah" name="tlprumah" placeholder="(kode)12312123" maxlength="18" value="{{ $info_kandidat2->noTlp }}" required {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="alasan">Alasan / tujuan Saudara melamar di perusahaan ini :</label>
                    <input type="text" class="form-control" id="alasan" name="alasan" maxlength='2000' value="{{ $info_kandidat2->alasanMelamar }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="lingkungankerja">Lingkungan pekerjaan yang Saudara sukai :</label>
                    <input type="text" class="form-control" id="lingkungankerja" name="lingkungankerja" maxlength='2000' value="{{ $info_kandidat2->lingkunganKerja }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End data --}}

      {{-- Start pelatihan --}}
      <div class="row p2">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">PELATIHAN & KURSUS</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_pelatihan" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_pelatihan" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_pelatihan" hidden>
              <div class="table-responsive">
                <table class="table" id="Tblpelatihan">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 30%;">jenis Kursus/Pelatihan</th>
                      <th style="width: 30%;">Penyelenggara</th>
                      <th style="width: 30%;">Tahun Pelaksanaan</th>
                      <th style="width: 10%;" {{ $disabled == "true" ? 'hidden' : ''}}> 
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-pelatihan">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="tbody_pelatihan">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End pelatihan --}}

      {{-- Start pendidikan --}}
      <div class="row p2">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">Pendidikan</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_pendidikan2" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_pendidikan2" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_pendidikan2" hidden>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="prestasi">Prestasi karya luar biasa yang pernah Saudara peroleh selama pendidikan</label>
                    <textarea class="form-control" id="prestasi" rows="3" resize="none" name="prestasi" maxlength="2000" {{ $disabled == "true" ? 'disabled' : ''}}>{{ $info_kandidat2->prestasiPendidikan }}</textarea>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="karyailmiah">Tulisan / karya ilmiah yang pernah Saudara tulis ( Skripsi, artikel, buku, dsb) / tahun:</label>
                    <textarea class="form-control" id="karyailmiah" rows="3" resize="none" name="karyailmiah" maxlength="220" {{ $disabled == "true" ? 'disabled' : ''}}>{{ $info_kandidat2->tulisanIlmiah }}</textarea>
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
                        <th style="width: 5%;" {{ $disabled == "true" ? 'hidden' : ''}}> 
                          <button type="button" class="btn btn-success d-flex" id="btnAddRow-bahasa">
                            <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tbody_bahasa">

                    </tbody>
                  </table>
                </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End pendidikan --}}
      
      {{-- Start aktivitas sosial --}}
      <div class="row p2">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">AKTIVITAS SOSIAL DAN KEGIATAN LAIN</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_aktivitas" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_aktivitas" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_aktivitas" hidden>
              <label class="form-control-label" for="organisasi">Keanggotaan dalam organisasi / lembaga :</label>
                <div class="table-responsive">
                  <table class="table" id="Tblorganisasi">
                    <thead class="thead-light">
                      <tr>
                        <th style="width: 23.75%;">Nama Organisasi</th>
                        <th style="width: 23.75%;">Kota</th>
                        <th style="width: 23.75%;">Jabatan</th>
                        <th style="width: 23.75%;">Dari/Sampai(Tahun)</th>
                        <th style="width: 5%;" {{ $disabled == "true" ? 'hidden' : ''}}> 
                          <button type="button" class="btn btn-success d-flex" id="btnAddRow-organisasi">
                            <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                          </button>
                        </th>
                      </tr>
                    </thead>
                    <tbody id="tbody_organisasi">

                    </tbody>
                  </table>
                </div>
                <hr class="my-4">
                <div class="row" >
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="waktuluang">Kegiatan pada waktu luang</label>
                      <input type="text" class="form-control" id="waktuluang" name="waktuluang" maxlength='2000' value="{{ $info_kandidat2->kegiatan }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="suratkabar">Surat kabar / majalah yang sering dibaca</label>
                      <input type="text" class="form-control" id="suratkabar" name="suratkabar" maxlength='2000' value="{{ $info_kandidat2->suratKabar }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="form-control-label" for="topik">Topik yang diminati untuk dibaca</label>
                      <input type="text" class="form-control" id="topik" name="topik" maxlength='2000' value="{{ $info_kandidat2->topik }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End aktivitas sosial --}}

      {{-- Start keluarga --}}
      <div class="row p2">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">KELUARGA</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_keluarga" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_keluarga" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_keluarga" hidden>
              <div id="kelaurga1">
                {{-- isinya ayah ibu --}}
              </div>
              <div id="kelaurga2">
                {{-- isinya kakak adik --}}
              </div>
              <div id="kelaurga3">
                {{-- isinya suami istri --}}
              </div>
              <div id="kelaurga4">
                {{-- isinya anak --}}
              </div>
              <div id="kelaurga5">
                {{-- isinya mertua --}}
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End keluarga --}}

      {{-- Start Lain-lain --}}
      <div class="row p2">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-uppercase text-muted ls-1 mb-1">info kandidat</h6>
                  <h5 class="h3 mb-0">LAIN-LAIN</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_lain2" type="button" class="btn btn-success d-flex btnhide" data-value="1">
                    <span id="span_lain2" class="material-symbols-outlined">
                      open_in_full
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div class="card-body" id="body_lain2" hidden>
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="sakit">Pernahkah Saudara menderita sakit keras atau kecelakaan kerja ?*</label>
                    <select class="form-control" id="sakit" name="sakit" required {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="Ya" {{ $info_kandidat2->sakit=="Ya"?"selected":"" }}>Ya</option>
                      <option value="Tidak" {{ $info_kandidat2->sakit=="Tidak"?"selected":"" }}>Tidak</option>
                    </select>
                  </div>
                </div>
                @if ($info_kandidat2->sakit=="Ya")
                  <div class="col-md-6" id="rowsakitkapan">
                    <div class="form-group">
                      <label class="form-control-label" for="sakitkapan">kapan</label>
                      <input class="form-control" type="month" id="sakitkapan" name="sakitkapan" value="{{ $info_kandidat2->tahunSakit }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                @endif
              </div>
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="psikologis">Pernahkah Saudara mengikuti pemeriksaan psikologis ?</label>
                    <select class="form-control" id="psikologis" name="psikologis" required {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="Ya" {{ $info_kandidat2->sakit=="Ya"?"selected":"" }}>Ya</option>
                      <option value="Tidak" {{ $info_kandidat2->sakit=="Tidak"?"selected":"" }}>Tidak</option>
                    </select>
                  </div>
                </div>
                @if ($info_kandidat2->sakit=="Ya")
                  <div class="col-md-6 rowpsikologis" >
                    <div class="form-group">
                      <label class="form-control-label" for="psikologiskapan">kapan</label>
                      <input class="form-control" type="month" id="psikologiskapan" name="psikologiskapan" value="{{ $info_kandidat2->tahunPsikolog }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                @endif
              </div>
              @if ($info_kandidat2->sakit=="Ya")
                <div class="row rowpsikologis">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="psikologislembaga">Tempat / Lembaga</label>
                      <input class="form-control" type="text" id="psikologislembaga" name="psikologislembaga" maxlength='220' value="{{ $info_kandidat2->lembagaPsikolog }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="form-control-label" for="psikologistujuan">tujuan</label>
                      <input class="form-control" type="text" id="psikologistujuan" name="psikologistujuan" maxlength='220' value="{{ $info_kandidat2->tujuanPsikolog }}" {{ $disabled == "true" ? 'disabled' : ''}}>
                    </div>
                  </div>
                </div>
              @endif
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kendaraan">Jenis kendaraan yang digunakan</label>
                    <input class="form-control" type="text" id="kendaraan" name="kendaraan" maxlength='220' value={{ $info_kandidat2->jenisKendaraan }} {{ $disabled == "true" ? 'disabled' : ''}}>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kendaraanmilik">Milik</label>
                    <select id="kendaraanmilik" class="form-control" name="kendaraanmilik" {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="Pribadi" {{ $info_kandidat2->milikKendaraan=="Pribadi"?"selected":"" }}> Pribadi</option>
                      <option value="Orangtua" {{ $info_kandidat2->milikKendaraan=="Orangtua"?"selected":"" }}> Orangtua</option>
                      <option value="Dinas" {{ $info_kandidat2->milikKendaraan=="Dinas"?"selected":"" }}> Dinas</option>
                      <option value="Umum" {{ $info_kandidat2->milikKendaraan=="Umum"?"selected":"" }}> Umum</option>
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
                      <th style="width: 5%;" {{ $disabled == "true" ? 'hidden' : ''}}> 
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-kenal">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="tbody_kenal">

                  </tbody>
                </table>
              </div>
              <hr class="my-4">
              <div class="row" >
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-control-label" for="kendaraan"> Adakah kerabat atau anggota keluarga Saudara yang bekerja di perusahaan farmasi</label>
                    <select class="form-control" id="kerabat" name="kerabat" required {{ $disabled == "true" ? 'disabled' : ''}}>
                      <option value="" disabled selected>Ya/Tidak</option>
                      <option value="Ya" {{ $info_kandidat2->kerabatFarmasi=="Ya"?"selected":"" }}>Ya</option>
                      <option value="Tidak" {{ $info_kandidat2->kerabatFarmasi=="Tidak"?"selected":"" }}>Tidak</option>
                    </select>
                  </div>
                </div>
              </div>
              @if ($info_kandidat2->kerabatFarmasi=="Ya")
              <div class="table-responsive" >
                <table class="table" id="Tblsaudarafarmasi">
                  <thead class="thead-light">
                    <tr>
                      <th style="width: 19%;">Hubungan*</th>
                      <th style="width: 19%;">Nama*</th>
                      <th style="width: 19%;">L/P*</th>
                      <th style="width: 19%;">Nama Perushaan*</th>
                      <th style="width: 19%;">Jabatan*</th>
                      <th style="width: 5%;" {{ $disabled == "true" ? 'hidden' : ''}}> 
                        <button type="button" class="btn btn-success d-flex" id="btnAddRow-saudarafarmasi">
                          <span class="material-symbols-outlined" style="font-size: 15px;">add</span>
                        </button>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="tbody_saudara">

                  </tbody>
                </table>
              </div>
              @endif
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
                    @if (count($referensi)>0)
                        @foreach ($referensi as $ref )
                        <tr>
                          <td>
                            <input class="form-control" type="text" id="nama_referensi" name="nama_referensi[]" value="{{ $ref->namaRef }}" maxlength='95' {{ $disabled == "true" ? 'disabled' : ''}}>
                          </td>
                          <td>
                            <input class="form-control" type="text" id="alamat_referensi" name="alamat_referensi[]" value="{{ $ref->alamatRef }}" maxlength='220' {{ $disabled == "true" ? 'disabled' : ''}}>
                          </td>
                          <td>
                            <input class="form-control" type="text" id="pekerjaan_referensi" name="pekerjaan_referensi[]" value="{{ $ref->pekerjaanRef }}" maxlength='95' {{ $disabled == "true" ? 'disabled' : ''}}>
                          </td>
                          <td>
                            <input class="form-control" type="text" id="tlp_referensi" name="tlp_referensi[]" value="{{ $ref->tlpRef }}" maxlength='95' {{ $disabled == "true" ? 'disabled' : ''}}>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                    @for ($index=count($referensi); $index<2;$index++)
                      <tr>
                        <td>
                          <input class="form-control" type="text" id="nama_referensi" name="nama_referensi[]" maxlength='95' {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                        <td>
                          <input class="form-control" type="text" id="alamat_referensi" name="alamat_referensi[]" maxlength='220' {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                        <td>
                          <input class="form-control" type="text" id="pekerjaan_referensi" name="pekerjaan_referensi[]" maxlength='95' {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                        <td>
                          <input class="form-control" type="text" id="tlp_referensi" name="tlp_referensi[]" maxlength='95' {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                      </tr>
                    @endfor
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
                    @if (count($darurat)>0)
                      @foreach ($darurat as $dar )
                      <tr>
                        <td>
                          <input class="form-control" type="text" id="nama_kontakdarurat" name="nama_kontakdarurat[]" maxlength='95' value="{{ $dar->namaDart }}" required {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                        <td>
                          <input class="form-control" type="text" id="alamat_kontakdarurat" name="alamat_kontakdarurat[]" maxlength='220' value="{{ $dar->alamatDart }}" required {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                        <td>
                          <input class="form-control" type="text" id="tlp_kontakdarurat" name="tlp_kontakdarurat[]" maxlength='95' value="{{ $dar->tlpDart }}" required {{ $disabled == "true" ? 'disabled' : ''}}>
                        </td>
                      </tr>
                      @endforeach
                    @endif
                    @for ($index=count($darurat); $index<2;$index++)
                    <tr>
                      <td>
                        <input class="form-control" type="text" id="nama_kontakdarurat" name="nama_kontakdarurat[]" maxlength='95' required {{ $disabled == "true" ? 'disabled' : ''}}>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="alamat_kontakdarurat" name="alamat_kontakdarurat[]" maxlength='220' required {{ $disabled == "true" ? 'disabled' : ''}}>
                      </td>
                      <td>
                        <input class="form-control" type="text" id="tlp_kontakdarurat" name="tlp_kontakdarurat[]" maxlength='95' required {{ $disabled == "true" ? 'disabled' : ''}}>
                      </td>
                    </tr>
                    @endfor
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      {{-- End Lain-lain --}}
      <button type="submit" class="btn btn-primary btnsbmt" {{ $disabled == "true" ? 'hidden' : ''}}>Update</button>
    </form>
    @else
    <div class="row p2" hidden>  
      <div class="col-xl-12">
        <div class="card">
          <h1>DATA TIDAK ADA</h1>
        </div>
      </div>
    </div>
    @endif
    {{-- END DATA --}}


  </div>
{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}

@endsection

@section('script')
  <script src="{{ asset('js/summernote.js') }}"></script>
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/Kandidat/detail_kandidat.js') }}"></script>
@endsection