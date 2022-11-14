@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<style>
  .btnhide{
    padding: 0.3em !important;
    margin-left: 2.7em;
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
            <h6 class="h2 text-white d-inline-block mb-0">Dashboards</h6>
            <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
              <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i></a></li>
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboards</a></li>
                <li class="breadcrumb-item active" aria-current="page">HRD</li>
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
        <div class="col-xl-12">
          <div class="card bg-default">
            <div class="card-header bg-transparent">
              <div class="row align-items-center">
                <div class="col-11">
                  <h6 class="text-light text-uppercase ls-1 mb-1">Overview</h6>
                  <h5 class="h3 text-white mb-0">PROSES</h5>
                </div>
                <div class="col-1">
                  <button id="btnhide_summary" type="button" class="btn btn-danger d-flex btnhide" data-value="0">
                    <span id="span_summary" class="material-symbols-outlined">
                      close_fullscreen
                    </span>
                  </button>
                </div>
              </div>
            </div>
            <div id="body_summary" class="card-body">
              <div class="row" id="summary">
                {{-- disni --}}

              </div>
            </div>
          </div>
        </div>
    </div>

    {{-- TABLE Filter --}}
    <div class="row">
      <div class="col-xl-12">
        <div class="card">
          <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                <h5 class="h3 mb-0">Filter</h5>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row d-flex">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Start Period</label>
                  <input class="form-control" type="date" value="" id="filter_Speriod" name="filter_Speriod">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Eperiod">End Period</label>
                  <input class="form-control" type="date" value="" id="filter_Eperiod" name="filter_Eperiod">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Umur</label>
                  <div class="d-flex">
                    <input class="form-control" type="number"  min="0" max="100" id="startAge" name="startAge">
                    <label style="margin:0.5em;">s/d</label>
                    <input class="form-control" type="number"  min="0" max="100" id="endAge" name="endAge">
                  </div>
                </div>
              </div>
              {{-- <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Gender</label>
                  <select id="f_gender" class="form-control js-example-basic-multiple " name="f_gender[]" multiple="multiple">
                    <option value="Pria">Pria</option>
                    <option value="Wanita">Wanita</option>
                  </select>
                </div>
              </div> --}}
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Pendidikan</label>
                  <select id="f_pendidikan" class="form-control js-example-basic-multiple " name="f_pendidikan[]" multiple="multiple">
                    @foreach ($ListPendidikan as $pendidikan )
                      <option value="{{ $pendidikan->pendidikan }}">{{ $pendidikan->pendidikan }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_jurusan">Jurusan</label>
                  <select id="f_jurusans" class="form-control js-example-basic-multiple " name="f_jurusan[]" multiple="multiple">
                    @foreach ($ListJurusan as $jurusan )
                      <option value="{{ $jurusan->nama }}">{{ $jurusan->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            
            <div class="row">
              {{-- <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Lama kerja</label>
                  <select id="f_lamakerja" class="form-control js-example-basic-multiple " name="f_lamakerja[]" multiple="multiple">
                      <option value="0">0 Tahun</option>
                      <option value="1">1 - 2 Tahun</option>
                      <option value="2">2 - 3 Tahun</option>
                      <option value="3">3 - 4 Tahun</option>
                      <option value="4">4 - 5 Tahun</option>
                      <option value="5">5> Tahun</option>
                  </select>
                </div>
              </div> --}}
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_job">Apply</label>
                  <select id="f_job" class="form-control js-example-basic-multiple " name="f_job[]" multiple="multiple">
                    @foreach ($ListJob as $job )
                      <option value="{{ $job->nama }}">{{ $job->nama }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Status</label>
                  <select id="f_status" class="form-control js-example-basic-multiple " name="f_status[]" multiple="multiple">
                    @foreach ($ListStatus as $status )
                      <option value="{{ $status->proses }}">{{ $status->proses }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-3">
                <div class="form-group">
                  <label class="form-control-label" for="filter_Speriod">Domisili</label>
                  <select id="f_domisili" class="form-control js-example-basic-multiple " name="f_domisili[]" multiple="multiple">
                    @foreach ($Domisili as $Domisili )
                      <option value="{{ $Domisili->kabupaten }}">{{ $Domisili->kabupaten }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
            <button id="filterdashboard" type="button" class="btn btn-primary btnsbmt">Filter</button>
          </div>
        </div>
      </div>
    </div>
    <div id="notif">
      
    </div>
    {{-- {{dd(session()->get('user')['organisasi']) }} --}}
    {{-- TABLE KANDIDAT --}}
    <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header bg-transparent">
            <div class="row align-items-center">
              <div class="col-3">
                <h6 class="text-uppercase text-muted ls-1 mb-1">Overview</h6>
                <h5 class="h3 mb-0">Kandidat</h5>
              </div>
              <div class="d-flex col-8">
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-tambah-groupschedule">
                  <span class="material-symbols-outlined">add</span>
                  <span class="gap-logo">Schedule</span>
                </button>
                <button type="button" class="btn btn-success d-flex" data-toggle="modal" data-target=".modal-transfer">
                  <span class="material-symbols-outlined">change_circle</span>
                  <span class="gap-logo">transfer</span>
                </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="TblKandidat" style="width: 100%">
                <thead class="thead-light">
                  <tr>
                    <th  class="thseacrh"><input type="checkbox" id="cekAll-kandidat"></th>
                    <th  >Usia</th>
                    <th >Domisili</th>
                    <th >Gender</th>
                    <th >Pendidikan</th>
                    <th >Jurusan</th>
                    <th >Pengalaman</th>
                    <th >Bidang lini</th>
                    <th >Lama Kerja</th>
                    <th >Penempatan luar indo</th>
                    {{-- @if (session()->get('user')['organisasi']!='3') --}}
                    <th >ditempatkan luar indo</th>
                    {{-- @endif --}}
                    <th >SIM</th>
                    <th >Apply</th>
                    <th >Status</th>
                    <th >Detail</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{--!!START MODAL TAMBAH!!--}}
  <div class="modal fade bd-example-modal-xl modal-tambah-groupschedule" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                  <label class="form-control-label" for="namagroup">Nama Group</label>
                  <input type="text" class="form-control" id="namagroup" name="namagroup">
                </div>
              </div>
              {{-- <div class="col-md-4">
                <div class="form-group">
                  <label class="form-control-label" for="posisi">Posisi</label>
                  <input type="text" class="form-control" id="posisi" name="posisi" value="{{ $applyas[0]->nama }}" readonly>
                </div>
              </div> --}}
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
  
  {{--!!START MODAL TRANSFER!!--}}
  <div class="modal fade modal-transfer"  tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <select id="organisasi" class="form-control" name="organisasi">
            <option value="" selected disabled>NAMA Organisasi</option>
            @foreach ($list_organisasi as $organisasi )
            <option value="{{ $organisasi->id }}">{{ $organisasi->nama }}</option>
            @endforeach
          </select>
        </div>
        <div class="modal-footer">
          <button type="button" id="btntransfer" class="btn btn-primary">Transfer</button>
        </div>
      </div>
    </div>
  </div>
  {{--!!END MODAL TRANSFER!!--}}
  
</div> 

<!-- Code begins here -->


{{-- !!!!!!! END  DIKOPI DARI SINI !!!!!!! --}}
@endsection

@section('script')
  <script language="JavaScript" type="text/javascript" src="{{ asset('js/home.js') }}"></script>
@endsection