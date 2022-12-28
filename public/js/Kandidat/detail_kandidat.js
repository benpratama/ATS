// navigator.geolocation.getCurrentPosition(position => {
//   console.log(position)
// }, error => {
//     console.error(error)
// }, {
//   timeout: 10000,
//   maximumAge: 10000,
//   enableHighAccuracy: true
// })
$( document ).ready(function() {
  kirimEmail()
  gen_url()
  getPostCode()
  hide()
  get_sim()
  adddelete_sim()
  get_Pendidikan()
  adddelete_pendidikan()
  get_Pekerjaan()
  page()
  numberWithCommas()
  adddelete_pekerjaan()
  get_pelatihan()
  adddelete_pelatihan()
  get_bahasa()
  adddelete_bahasa()
  adddelete_organisasi()
  get_organisasi()
  get_kenal()
  adddelete_kenal()
  get_saudara()
  adddelete_saudara()
  get_keluarga()
  AddDelKeluarga()
  sakit()
  psikologis()
  saudara()
  filterProses();
  showlogFPTK();

  modal()
  getSchedule()
  onlineORonsite()
  create_schedule()
  $('#ccto').select2();
  $('#labMCU').select2();
  $('#tempatlahir').select2();
  hidde();

  gen_url1();
  $('#schedule, #proses, #konfirmasi, #bahasa').on('change',function(){tampilin_email()})
  $('#schedule, #proses, #konfirmasi').on('change',function(){modalInformasi()})
  $('#vendorPsikotest').on('change',function(){GenDock()})

  getKontak()
  AddDell_kontak()
});


function modal(){
  $('.modal-tambah-schedule').on('show.bs.modal', function() {
    $('#schedule').val('');
    $('#proses').val('');
    $('#konfirmasi').val('');
    $('#onlineonsite').attr('hidden',false)
    $('#btnAdd-schedule').attr('hidden',false);
    hidde()
    $('#tglWaktu').val('');
    $('#ccto').val(null).trigger('change');
    $('#konten').val('')
    $('#bahasa').val(0)
  })

  $('.modal-list-major').on('hide.bs.modal', function() {
    $('#TblMajor').DataTable().destroy();
    $("#TblMajor > tbody"). empty();
  })

  $('.modal-notes').on('hide.bs.modal', function() {
    $('#notes').val('')
    $('#summary').val('')
    $('#notes').val('')
    $('#btn-notes').removeAttr( "value" )
  })

  $('.modal-fkpk').on('hide.bs.modal', function() {
    $(':input','#formfkpk')
      .not(':button, :submit, :reset, :hidden')
      .val('')
      .prop('checked', false)
      .prop('selected', false);
  })
}

function gen_url(){
  $('#btnGen-url').on('click',function(){
    $('#urlphase2').text('')
    var id_kandidat = $('#btnGen-url').val();
    var noidentitas = $('#btnGen-url').data('noidentitas');

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/detail/kandidat/genurl',
        type: 'post',
        data: {
          id_kandidat:id_kandidat,
          noidentitas:noidentitas
        }
      }).done((data) => {
        host = window.location.origin;
        $('#urlphase2').text(host+'/form-kandidat/phase2/'+data)
        console.log(host);
      });
  })
}

function gen_url1(){
  $('#btnGen-url1').on('click',function(){
    $('#urlphase1').text('')
    var id_kandidat = $('#btnGen-url1').val();
    var noidentitas = $('#btnGen-url1').data('noidentitas');
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/detail/kandidat/genurl1',
        type: 'post',
        data: {
          id_kandidat:id_kandidat,
          noidentitas:noidentitas
        }
      }).done((data) => {
        host = window.location.origin;
        $('#urlphase1').text(host+'/form-kandidat/'+data)
        console.log(host);
      });
  })
}

// function AddDelSim(){
//   $('#btnAdd-sim').on('click',function(){
//     data_sim+=1;

//     $.ajaxSetup({
//       headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//       }
//     });
//     $.ajax({
//       _token: '{{ csrf_token() }}',
//       url: '/form-kandidat/get/sim',
//       type: 'get'
//     }).done((data) => {
//       // console.log(JSON.stringify(data));
//       var html  = "<div class='row' id='simbaris"+data_sim+"'>"
//         html +=   "<div class='col-md-4'>"
//         html +=     "<div class='form-group'>"
//         html +=       "<label class='form-control-label' for='jenissim'>SIM yang dimiliki*</label>"
//         html +=         "<select class='form-control sim' data-row='"+data_sim+"' name='sim[]' required>"
//         html +=           "<option value='' disabled selected>SIM</option>"
//         data.forEach(element => {
//         html +=           "<option value='"+element.id+"'>"+element.nama+"</option>"
//         });
//         html +=         "</select>"    
//         html +=     "</div>"
//         html +=   "</div>"
//         html +=   "<div class='col-md-6' id='nosimbaris"+data_sim+"' hidden>"
//         html +=     "<div class='form-group'>"
//         html +=       "<label class='form-control-label' for='nosim'>No SIM</label>"
//         html +=       "<input type='text' class='form-control nosim' data-row='"+data_sim+"' name='nosim[]'>"
//         html +=     "</div>"
//         html +=   "</div>"
//         html +=   "<div class='col-md-2'>"
//         html +=     "<div class='form-group'>"
//         html +=       "<button id='btnDel-sim' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='simbaris"+data_sim+"'>"
//         html +=         "<span class='material-symbols-outlined'>delete</span>"
//         html +=         "<span class='gap-logo'>Hapus</span>"
//         html +=     "</div>"
//         html +=   "</div>"
//         html += "</div>"

//     $('#sims').append(html);
//     });
//   });

//   $(document).on('click','#btnDel-sim',function(){
//     var hapus = $(this).data('row')
//     // console.log(hapus);
//     $('#'+hapus).remove();
//   })

//   $(document).on('change','.sim',function(){
//     var value = $(this).val();
//     var obj = $(this).data('row');
//     if (value==1 || value=="") {
//       $('#nosimbaris'+obj).attr('hidden',true)
//     }else{
//       $('#nosimbaris'+obj).attr('hidden',false)
//     }
//     // console.log(value);
//   })
// }

function getPostCode(){
  $('#kota1').on('ready',function(){
    var kota = $('#kota1').val();
    $('.kodepos').remove();

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/form-kandidat/kodepos',
      type: 'post',
      data: {
        kota:kota
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      var html  = ""
      data.forEach(element => {
        html +="<option class='kodepos' value='"+element.kodepos+"'>"+element.kodepos+"</option>"
        // console.log(element.kodepos)
      });
      $('#kodepos').append(html);
    });

  });

  $('#kota_koresponden').on('change',function(){
    var kota = $('#kota_koresponden').val();
    $('.kodepos_koresponden').remove();

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/form-kandidat/kodepos',
      type: 'post',
      data: {
        kota:kota
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      var html2  = ""
      data.forEach(element => {
        html2 +="<option class='kodepos_koresponden' value='"+element.kodepos+"'>"+element.kodepos+"</option>"
        // console.log(element.kodepos)
      });
      $('#kodepos_koresponden').append(html2);
    });
    
  });
}

// var baris_perusahaan=0
// function Row_perushaan(){
//   $('#btnAddRow-perusahaan').on('click',function(){
//     baris_perusahaan+=1;
    
//     var html  = "<tr id='baris"+baris_perusahaan+"' class='detail-perusahaan'>"
//         html +=   "<td style='width: 19%;'>"
//         html +=     "<input class='form-control'  type='text' name='nama_perushaan[]'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 19%;'>"
//         html +=     "<select class='form-control' id='status_perkawinan' name='jenis_perusahaan[]' required>"
//         html +=       "<option value='' disabled selected>Jenis Perusahaan</option>"
//         html +=       "<option value='Farmasi'>Farmasi</option>"
//         html +=       "<option value='Bukan Farmasi'>Bukan Farmasi</option>"
//         html +=     "</select>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 19%;'>"
//         html +=     "<input class='form-control' type='text' name='alamat_perusahaan[]'>"
//         html +=   "</td>"
//         html +=   "<td style='width: 19%;'>"
//         html +=     "<input class='form-control' type='text' name='jabatan_perusahaan[]'>"
//         html +=   "</td>"
//         html +=   "<td style='width: 19%;'>"
//         html +=     "<input class='form-control' type='text' name='atasan_perusahaan[]'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 19%;'>"
//         html +=     "<input class='form-control' type='text' name='lama_perusahaan[]'>"
//         html +=   "</td>"   
//         html +=   "<td style='width: 5%;'>"
//         html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_perusahaan+"' id='btnDelRow-perusahaan'>"
//         html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
//         html +=     "</button>"
//         html +=   "</td>"   
//         html +="</tr>"

//     $('#TblPerushaan').append(html);

//     $(document).on('click','#btnDelRow-perusahaan',function(){
//       var hapus = $(this).data('row')
//       // console.log(hapus);
//       $('#'+hapus).remove();
//   })
// })
// }

function hide(){
  $('#btnhide_kontak').on('click', function() {
    var value = $('#btnhide_kontak').data('value');
    if (value==0) {
      $('#body_kontak').attr('hidden',true)
      $('#span_kontak').text('open_in_full')
      $('#btnhide_kontak').removeClass("btn-danger")
      $('#btnhide_kontak').addClass("btn-success")
      $('#btnhide_kontak').data('value',1);
    } else {
      $('#body_kontak').attr('hidden',false)
      $('#span_kontak').text('close_fullscreen')
      $('#btnhide_kontak').removeClass("btn-success")
      $('#btnhide_kontak').addClass("btn-danger")
      $('#btnhide_kontak').data('value',0);
    }
  });

  $('#btnhide_alamat').on('click', function() {
    var value = $('#btnhide_alamat').data('value');
    if (value==0) {
      $('#body_alamat').attr('hidden',true)
      $('#span_alamat').text('open_in_full')
      $('#btnhide_alamat').removeClass("btn-danger")
      $('#btnhide_alamat').addClass("btn-success")
      $('#btnhide_alamat').data('value',1);
    } else {
      $('#body_alamat').attr('hidden',false)
      $('#span_alamat').text('close_fullscreen')
      $('#btnhide_alamat').removeClass("btn-success")
      $('#btnhide_alamat').addClass("btn-danger")
      $('#btnhide_alamat').data('value',0);
    }
  });

  $('#btnhide_sim').on('click', function() {
    var value = $('#btnhide_sim').data('value');
    if (value==0) {
      $('#body_sim').attr('hidden',true)
      $('#span_sim').text('open_in_full')
      $('#btnhide_sim').removeClass("btn-danger")
      $('#btnhide_sim').addClass("btn-success")
      $('#btnhide_sim').data('value',1);
    } else {
      $('#body_sim').attr('hidden',false)
      $('#span_sim').text('close_fullscreen')
      $('#btnhide_sim').removeClass("btn-success")
      $('#btnhide_sim').addClass("btn-danger")
      $('#btnhide_sim').data('value',0);
    }
   
  });

  $('#btnhide_pendidikan').on('click', function() {
    var value = $('#btnhide_pendidikan').data('value');
    if (value==0) {
      $('#body_pendidikan').attr('hidden',true)
      $('#span_pendidikan').text('open_in_full')
      $('#btnhide_pendidikan').removeClass("btn-danger")
      $('#btnhide_pendidikan').addClass("btn-success")
      $('#btnhide_pendidikan').data('value',1);
    } else {
      $('#body_pendidikan').attr('hidden',false)
      $('#span_pendidikan').text('close_fullscreen')
      $('#btnhide_pendidikan').removeClass("btn-success")
      $('#btnhide_pendidikan').addClass("btn-danger")
      $('#btnhide_pendidikan').data('value',0);
    }
  });

  $('#btnhide_pekerjaan').on('click', function() {
    var value = $('#btnhide_pekerjaan').data('value');
    if (value==0) {
      $('#body_pekerjaan').attr('hidden',true)
      $('#span_pekerjaan').text('open_in_full')
      $('#btnhide_pekerjaan').removeClass("btn-danger")
      $('#btnhide_pekerjaan').addClass("btn-success")
      $('#btnhide_pekerjaan').data('value',1);
    } else {
      $('#body_pekerjaan').attr('hidden',false)
      $('#span_pekerjaan').text('close_fullscreen')
      $('#btnhide_pekerjaan').removeClass("btn-success")
      $('#btnhide_pekerjaan').addClass("btn-danger")
      $('#btnhide_pekerjaan').data('value',0);
    }
  });

  $('#btnhide_data').on('click', function() {
    var value = $('#btnhide_data').data('value');
    if (value==0) {
      $('#body_data').attr('hidden',true)
      $('#span_data').text('open_in_full')
      $('#btnhide_data').removeClass("btn-danger")
      $('#btnhide_data').addClass("btn-success")
      $('#btnhide_data').data('value',1);
    } else {
      $('#body_data').attr('hidden',false)
      $('#span_data').text('close_fullscreen')
      $('#btnhide_data').removeClass("btn-success")
      $('#btnhide_data').addClass("btn-danger")
      $('#btnhide_data').data('value',0);
    }
  });

  $('#btnhide_pelatihan').on('click', function() {
    var value = $('#btnhide_pelatihan').data('value');
    if (value==0) {
      $('#body_pelatihan').attr('hidden',true)
      $('#span_pelatihan').text('open_in_full')
      $('#btnhide_pelatihan').removeClass("btn-danger")
      $('#btnhide_pelatihan').addClass("btn-success")
      $('#btnhide_pelatihan').data('value',1);
    } else {
      $('#body_pelatihan').attr('hidden',false)
      $('#span_pelatihan').text('close_fullscreen')
      $('#btnhide_pelatihan').removeClass("btn-success")
      $('#btnhide_pelatihan').addClass("btn-danger")
      $('#btnhide_pelatihan').data('value',0);
    }
  });

  $('#btnhide_pendidikan2').on('click', function() {
    var value = $('#btnhide_pendidikan2').data('value');
    if (value==0) {
      $('#body_pendidikan2').attr('hidden',true)
      $('#span_pendidikan2').text('open_in_full')
      $('#btnhide_pendidikan2').removeClass("btn-danger")
      $('#btnhide_pendidikan2').addClass("btn-success")
      $('#btnhide_pendidikan2').data('value',1);
    } else {
      $('#body_pendidikan2').attr('hidden',false)
      $('#span_pendidikan2').text('close_fullscreen')
      $('#btnhide_pendidikan2').removeClass("btn-success")
      $('#btnhide_pendidikan2').addClass("btn-danger")
      $('#btnhide_pendidikan2').data('value',0);
    }
  });

  $('#btnhide_aktivitas').on('click', function() {
    var value = $('#btnhide_aktivitas').data('value');
    if (value==0) {
      $('#body_aktivitas').attr('hidden',true)
      $('#span_aktivitas').text('open_in_full')
      $('#btnhide_aktivitas').removeClass("btn-danger")
      $('#btnhide_aktivitas').addClass("btn-success")
      $('#btnhide_aktivitas').data('value',1);
    } else {
      $('#body_aktivitas').attr('hidden',false)
      $('#span_aktivitas').text('close_fullscreen')
      $('#btnhide_aktivitas').removeClass("btn-success")
      $('#btnhide_aktivitas').addClass("btn-danger")
      $('#btnhide_aktivitas').data('value',0);
    }
  });

  $('#btnhide_keluarga').on('click', function() {
    var value = $('#btnhide_keluarga').data('value');
    if (value==0) {
      $('#body_keluarga').attr('hidden',true)
      $('#span_keluarga').text('open_in_full')
      $('#btnhide_keluarga').removeClass("btn-danger")
      $('#btnhide_keluarga').addClass("btn-success")
      $('#btnhide_keluarga').data('value',1);
    } else {
      $('#body_keluarga').attr('hidden',false)
      $('#span_keluarga').text('close_fullscreen')
      $('#btnhide_keluarga').removeClass("btn-success")
      $('#btnhide_keluarga').addClass("btn-danger")
      $('#btnhide_keluarga').data('value',0);
    }
  });

  $('#btnhide_lain2').on('click', function() {
    var value = $('#btnhide_lain2').data('value');
    if (value==0) {
      $('#body_lain2').attr('hidden',true)
      $('#span_lain2').text('open_in_full')
      $('#btnhide_lain2').removeClass("btn-danger")
      $('#btnhide_lain2').addClass("btn-success")
      $('#btnhide_lain2').data('value',1);
    } else {
      $('#body_lain2').attr('hidden',false)
      $('#span_lain2').text('close_fullscreen')
      $('#btnhide_lain2').removeClass("btn-success")
      $('#btnhide_lain2').addClass("btn-danger")
      $('#btnhide_lain2').data('value',0);
    }
  });
}

function sakit(){
  $('#sakit').on('change',function(){
    var sakit= $('#sakit').val();

    if(sakit=='Ya'){
      $('#rowsakitkapan').removeAttr('hidden');
      $('#sakitkapan').attr("required",true);
      console.log('yaa')
    }else{
      $('#rowsakitkapan').attr("hidden",true);
      $('#sakitkapan').val('');
      $('#sakitkapan').attr("required",false);
      console.log('tdk')
    }

  })
}

function psikologis(){
  $('#psikologis').on('change',function(){
    var psikologis = $('#psikologis').val();

    if (psikologis=='Ya') {
      $('.rowpsikologis').removeAttr('hidden');
      $('#psikologiskapan').attr("required",true);
      $('#psikologislembaga').attr("required",true);
      $('#psikologistujuan').attr("required",true);
    } else {
      $('.rowpsikologis').attr("hidden",true);
      $('#psikologiskapan').val('');
      $('#psikologislembaga').val('');
      $('#psikologistujuan').val('');

      $('#psikologiskapan').attr("required",false);
      $('#psikologislembaga').attr("required",false);
      $('#psikologistujuan').attr("required",false);
    }
  });
}

function saudara(){
  $('#kerabat').on('change',function(){
    var kerabat = $('#kerabat').val();

    if (kerabat=='Ya') {
      $('#Tblsaudarafarmasi').removeAttr('hidden');
    } else {
      $('#Tblsaudarafarmasi').attr("hidden",true);
      $('.detail_saudara').remove();
    }
  });
}

function page(){
  $('#p1').on('click', function() {
    $('.p1').attr('hidden',false)
    $('.p2').attr('hidden',true)
    $('#p2').removeClass("active")
    $('#p1').addClass('active')
  });
  $('#p2').on('click', function() {
    $('.p2').attr('hidden',false)
    $('.p1').attr('hidden',true)
    $('#p1').removeClass("active")
    $('#p2').addClass('active')
  });
}

var data_pendidikan=0
function get_Pendidikan(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getpendidikan/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data[3]));
      data[0].forEach(element1 => {
        data_pendidikan+=1;
        var html =""
        html +="<div id='pendidikan"+data_pendidikan+"' class='border-rw'>"
        html +=  "<div class='row'>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Tingkat*</label>"
        if (data[3]==true) {
          html +=         "<select class='form-control' id='tingkap_p' name='tingkap_p[]' disabled>"
        } else {
          html +=         "<select class='form-control' id='tingkap_p' name='tingkap_p[]' required>"
        }
        
        html +=           "<option value='' disabled selected>Tingkat pendidikan</option>"
        data[1].forEach(element2 => {
          if (element1.jenisPendidikan==element2.EduLvlId) {
            // console.log(element2.EduLvlName)
          html +=           "<option value='"+element2.EduLvlId+"' selected>"+element2.EduLvlName+"</option>"
          } else {
          html +=           "<option value='"+element2.EduLvlId+"'>"+element2.EduLvlName+"</option>"
          }
        });
        html +=         "</select>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Jurusan*</label>"
        if (data[3]==true) {
          html +=         "<input class='form-control' type='text' id='jurusan_p' name='jurusan_p[]' value='"+element1.jurusanPendidikan.trim()+"' disabled>"  
        }else{
          html +=         "<input class='form-control' type='text' id='jurusan_p' name='jurusan_p[]' value='"+element1.jurusanPendidikan.trim()+"' required>"  
        }
        
        html +=       "</div>"    
        html +=     "</div>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Nama Institusi*</label>"
        if (data[3]==true) {
          html +=         "<input class='form-control' type='text' id='namaInst_p' name='namaInst_p[]' value='"+element1.namaPendidikan.trim()+"' disabled>" 
        }else{
          html +=         "<input class='form-control' type='text' id='namaInst_p' name='namaInst_p[]' value='"+element1.namaPendidikan.trim()+"' required>" 
        }
        html +=       "</div>"    
        html +=     "</div>"

        html +=     "<div class='col-md-2'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='pendidikan'>Nilai*</label>"
        if (data[3]==true) {
          html +=         "<input type='number' step='0.01' class='form-control' id='nilai_pendidikan' name='nilai_pendidikan[]' value='"+element1.nilai+"' min=0 max=100 disabled>"
        }else{
          html +=         "<input type='number' step='0.01' class='form-control' id='nilai_pendidikan' name='nilai_pendidikan[]' value='"+element1.nilai+"' min=0 max=100 required>"
        }
        html +=       "</div>"
        html +=     "</div>"

        html +=  "</div>"
        html +=  "<div class='row'>"
        html +=    "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>kota</label>"
        if (data[3]==true) {
          html +=         "<select class='form-control' id='kota_p' name='kota_p[]' disabled>"
        }else{
          html +=         "<select class='form-control' id='kota_p' name='kota_p[]'>"
        }
        
        html +=           "<option value=''selected>Kota Pendidikan</option>"
        data[2].forEach(element3 => {
          // html +=           "<option value='"+element3.CityId+"'>"+element3.CityName+"</option>"
          // console.log(element1.kota)
          if (element1.kota==element3.CityId) {
            html +=           "<option value='"+element3.CityId+"' selected>"+element3.CityName+"</option>"
            html +=           "<option value='"+element3.CityId+"'>"+element3.CityName+"</option>"
            // console.log(element3.CityId,element3.CityName)
          }else{

            html +=           "<option value='"+element3.CityId+"'>"+element3.CityName+"</option>"
            // console.log(element3.CityId,element3.CityName)
          }
        });
        html +=         "</select>"
        html +=       "</div>"
        html +=    "</div>"

        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='Pendidikan'>Tahun Mulai</label>"
        if (data[3]==true) {
          html +=       "<input class='form-control' type='number' id='thnMulai_p' name='thnMulai_p[]' value='"+element1.tahunmulai+"' min=1800 max=2100 disabled>"
        }else{
          html +=       "<input class='form-control' type='number' id='thnMulai_p' name='thnMulai_p[]' value='"+element1.tahunmulai+"' min=1800 max=2100>"
        }
        
        html +=     "</div>"
        html +=   "</div>"
    
        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='Pendidikan'>Tahun Selesai</label>"
        if (data[3]==true) {
          html +=       "<input class='form-control' type='number' id='thnSelesai_p' name='thnSelesai_p[]' value='"+element1.tahunselesai+"' min=1800 max=2100 disabled>"
        } else {
          html +=       "<input class='form-control' type='number' id='thnSelesai_p' name='thnSelesai_p[]' value='"+element1.tahunselesai+"' min=1800 max=2100>"
        }
        
        html +=     "</div>"
        html +=   "</div>"

        if (data[3]!=true) {
          html+=    '<div class="col-md-2">'
          html+=      '<div class="form-group">'
          html+=        '<label class="form-control-label" for="data_pendidikan">Delete</label>'
          html+=        '<button type="button" class="btn btn-danger form-control btnDel-pendidikan" data-row="pendidikan'+data_pendidikan+'">Delete</button>'
          html+=      '</div>'
          html+=    '</div>'
        }
        

        html +=  "</div>"
        html +="<hr class='my-4'>"
        html +=  "<div class='row'>"
        html +=     "<div class='col-md-5'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Jurusan*(proint)</label>"
        if (element1.jurusanPendidikanHR==null) {
          html +=         "<input class='form-control' type='text' id='major"+data_pendidikan+"' name='jurusan_p_proint[]' readonly>"  
        } else {
          html +=         "<input class='form-control' type='text' id='major"+data_pendidikan+"' name='jurusan_p_proint[]' value='"+element1.jurusanPendidikanHR+"|"+element1.id_jurusanPendidikan+"' readonly>"   
        }
        html +=       "</div>"    
        html +=     "</div>"

        if (data[3]!=true) {
        html+=    '<div class="col-md-1">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">List</label>'
        html +=       "<button id='list_jurusan' onclick='Modal_major(this)' value='major"+data_pendidikan+"' type='button' class='btn btn-success d-flex' data-target='.modal-list-major' data-toggle='modal'>"
        html +=         "<span id='span_pendidikan' class='material-symbols-outlined'>"
        html +=           "view_list"
        html +=         "</span>"
        html +=       "</button>"
        html+=      '</div>'
        html+=    '</div>'
        }

        html +=     "<div class='col-md-5'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Nama Institusi*(proint)</label>"
        if (element1.namaPendidikanHR==null) {
          html +=         "<input class='form-control' type='text' id='inst"+data_pendidikan+"' name='namaInst_p_proint[]'  readonly>"   
        } else {
          html +=         "<input class='form-control' type='text' id='inst"+data_pendidikan+"' name='namaInst_p_proint[]' value='"+element1.namaPendidikanHR+"|"+element1.id_namaPendidikan+"' readonly>"   
        }
        html +=       "</div>"    
        html +=     "</div>"

        if (data[3]!=true) {
        html+=    '<div class="col-md-1">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">List</label>'
        html +=       "<button id='list_inst' onclick='Modal_inst(this)' value='inst"+data_pendidikan+"' type='button' class='btn btn-success d-flex' data-target='.modal-list-inst' data-toggle='modal'>"
        html +=         "<span id='span_pendidikan' class='material-symbols-outlined'>"
        html +=           "view_list"
        html +=         "</span>"
        html +=       "</button>"
        html+=      '</div>'
        html+=    '</div>'
        html +=  "</div>"
        }
        html +="</div>"

        $('#list_pendidikan').append(html);
      });
    })
}

function adddelete_pendidikan(){
  $(document).on('click','.btnDel-pendidikan',function(){
    var hapus = $(this).data('row')
    $('#'+hapus).remove();
    
  })

  $('#btnAddRow-pendidikan').on('click',function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/form-kandidat/get/edulvlandcity',
        type: 'get'
      }).done((data) => {
        data_pendidikan+=1;
        var html =""
        html +="<div id='pendidikan"+data_pendidikan+"' class='border-rw'>"
        html +=  "<div class='row'>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Tingkat*</label>"
        html +=         "<select class='form-control' id='tingkap_p' name='tingkap_p[]' required>"
        html +=           "<option value='' selected>Tingkat pendidikan</option>"
        data[0].forEach(element2 => {
          html +=           "<option value='"+element2.EduLvlId+"'>"+element2.EduLvlName+"</option>"
        });
        html +=         "</select>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Jurusan*</label>"
        html +=         "<input class='form-control' type='text' id='jurusan_p' name='jurusan_p[]' required>"  
        html +=       "</div>"    
        html +=     "</div>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Nama Institusi*</label>"
        html +=         "<input class='form-control' type='text' id='namaInst_p' name='namaInst_p[]' required>"  
        html +=       "</div>"    
        html +=     "</div>"

        html +=     "<div class='col-md-2'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='pendidikan'>Nilai*</label>"
        html +=         "<input type='number' step='0.01' class='form-control' id='nilai_pendidikan' name='nilai_pendidikan[]' min=0 max=100 required>"
        html +=       "</div>"
        html +=     "</div>"

        html +=  "</div>"
        html +=  "<div class='row'>"
        html +=    "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>kota</label>"
        html +=         "<select class='form-control' id='kota_p' name='kota_p[]'>"
        html +=           "<option value=''selected>Kota Pendidikan</option>"
        data[1].forEach(element3 => {
        html +=           "<option value='"+element3.CityId+"'>"+element3.CityName+"</option>"
        });
        html +=         "</select>"
        html +=       "</div>"
        html +=    "</div>"

        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='Pendidikan'>Tahun Mulai</label>"
        html +=       "<input class='form-control' type='number' id='thnMulai_p' name='thnMulai_p[]' min=1800 max=2100>"
        html +=     "</div>"
        html +=   "</div>"
    
        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='Pendidikan'>Tahun Selesai</label>"
        html +=       "<input class='form-control' type='number' id='thnSelesai_p' name='thnSelesai_p[]' min=1800 max=2100>"
        html +=     "</div>"
        html +=   "</div>"

        html+=    '<div class="col-md-2">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="data_pendidikan">Delete</label>'
        html+=        '<button type="button" class="btn btn-danger form-control btnDel-pendidikan" data-row="pendidikan'+data_pendidikan+'">Delete</button>'
        html+=      '</div>'
        html+=    '</div>'

        html +=  "</div>"
        html +="<hr class='my-4'>"
        html +=  "<div class='row'>"
        html +=     "<div class='col-md-5'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Jurusan*(proint)</label>"
        html +=         "<input class='form-control' type='text' id='major"+data_pendidikan+"' name='jurusan_p_proint[]' readonly>"  
        html +=       "</div>"    
        html +=     "</div>"
        html+=    '<div class="col-md-1">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">List</label>'
        html +=       "<button id='list_jurusan' onclick='Modal_major(this)' value='major"+data_pendidikan+"' type='button' class='btn btn-success d-flex' data-target='.modal-list-major' data-toggle='modal'>"
        html +=         "<span id='span_pendidikan' class='material-symbols-outlined'>"
        html +=           "view_list"
        html +=         "</span>"
        html +=       "</button>"
        html+=      '</div>'
        html+=    '</div>'


        html +=     "<div class='col-md-5'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='Pendidikan'>Nama Institusi*(proint)</label>"
        html +=         "<input class='form-control' type='text' id='inst"+data_pendidikan+"' name='namaInst_p_proint[]'  readonly>"   
        html +=       "</div>"    
        html +=     "</div>"
        html+=    '<div class="col-md-1">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">List</label>'
        html +=       "<button id='list_inst' onclick='Modal_inst(this)' value='inst"+data_pendidikan+"' type='button' class='btn btn-success d-flex' data-target='.modal-list-inst' data-toggle='modal'>"
        html +=         "<span id='span_pendidikan' class='material-symbols-outlined'>"
        html +=           "view_list"
        html +=         "</span>"
        html +=       "</button>"
        html+=      '</div>'
        html+=    '</div>'
        html +=  "</div>"

        html +="</div>"
        
        $('#list_pendidikan').append(html);
      })
    
  });

}

var data_pekerjaan = 0;
function get_Pekerjaan(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getpekerjaan/kandidat/'+id_kandidat,
      type: 'get',
      data: {
       
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      var html=''
      data[0].forEach(element => {
        data_pekerjaan+=1;
        html+='<div class="border-rw" id="pekerjaan_rw'+data_pekerjaan+'">'
        html+='<div class="row">'
        html+=  '<div class="col-md-4">'
        html+=    '<div class="form-group">'
        html+=      '<label class="form-control-label" for="nama_perushaan">NAMA PERUSHAAN</label>'
        if (data[1]==true) {
          html+=      '<input class="form-control"  type="text" name="nama_perushaan[]" maxlength="220" value="'+element.namaPerusahaan+'" disabled>'
        } else {
          html+=      '<input class="form-control"  type="text" name="nama_perushaan[]" maxlength="220" value="'+element.namaPerusahaan+'">'
        }
        
        html+=    '</div>'
        html+=  '</div>'

        html+=  '<div class="col-md-3">'
        html+=    '<div class="form-group">'
        html+=      '<label class="form-control-label" for="jenis_perusahaan">JENIS</label>'
        if (data[1]==true) {
          html+=      '<select class="form-control" id="status_perkawinan" name="jenis_perusahaan[]" required disabled>'
        } else {
          html+=      '<select class="form-control" id="status_perkawinan" name="jenis_perusahaan[]" required>'
        }
        
        if (element.jenisPerusahaan=='Farmasi') {
        html +=       "<option value='Farmasi' selected>Farmasi</option>"
        } else {
        html +=       "<option value='Farmasi'>Farmasi</option>"
        }
        if (element.jenisPerusahaan=='Bukan Farmasi') {
        html +=       "<option value='Bukan Farmasi' selected>Bukan Farmasi</option>"  
        } else {
        html +=       "<option value='Bukan Farmasi'>Bukan Farmasi</option>"  
        }
        html+=     '</select>'    
        html+=    '</div>'
        html+=  '</div>'

        html+=  '<div class="col-md-5">'
        html+=    '<div class="form-group">'
        html+=      '<label class="form-control-label" for="alamat_perusahaan">ALAMAT PRUSHAAN</label>'
        if (data[1]==true) {
          html+=      '<input class="form-control"  type="text" name="alamat_perusahaan[]" maxlength="220" value="'+element.alamatPerusahaan+'" disabled>'
        } else {
          html+=      '<input class="form-control"  type="text" name="alamat_perusahaan[]" maxlength="220" value="'+element.alamatPerusahaan+'">'
        }
        
        html+=    '</div>'
        html+=  '</div>'
        html+='</div>'

        // 2
        html+='<div class="row">'
        html+=    '<div class="col-md-5">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="jabatan_perusahaan">JABATAN</label>'
        if (data[1]==true) {
          html+=        '<input class="form-control"  type="text" name="jabatan_perusahaan[]" maxlength="220" value="'+element.jabatanPerusahaan+'"disabled>'
        } else {
          html+=        '<input class="form-control"  type="text" name="jabatan_perusahaan[]" maxlength="220" value="'+element.jabatanPerusahaan+'">'
        }
        
        html+=      '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-5">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="atasan_perusahaan">NAMA ATASAN/ JABATAN</label>'
        if (data[1]==true) {
          html+=        '<input class="form-control"  type="text" name="atasan_perusahaan[]" maxlength="220" value="'+element.atasanPerusahaan+'" disabled>'
        } else {
          html+=        '<input class="form-control"  type="text" name="atasan_perusahaan[]" maxlength="220" value="'+element.atasanPerusahaan+'">'
        }
        
        html+=      '</div>'
        html+=    '</div>'
        html+=  '</div>'

        //3
        html+=  '<div class="row">'
        html+=    '<div class="col-md-3">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="jabatan_perusahaan">START KERJA</label>'
        if (data[1]==true) {
          html+=        '<input class="form-control"  type="date" name="start_perusahaan[]" maxlength="220" value="'+element.startPerushaan+'" disabled>'
        } else {
          html+=        '<input class="form-control"  type="date" name="start_perusahaan[]" maxlength="220" value="'+element.startPerushaan+'">'
        }
        
        html+=      '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-3">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="atasan_perusahaan">END KERJA</label>'
        if (data[1]==true) {
          html+=        '<input class="form-control" id="checkrow'+data_pekerjaan+'"  type="date" name="end_perusahaan[]" maxlength="220" value="'+element.endPerushaan+'" disabled>'
        } else {
          if (element.endPerushaan==null) {
            html+=        '<input class="form-control" id="checkrow'+data_pekerjaan+'"  type="date" name="end_perusahaan[]" maxlength="220" readonly>'  
          } else {
            html+=        '<input class="form-control" id="checkrow'+data_pekerjaan+'"  type="date" name="end_perusahaan[]" maxlength="220" value="'+element.endPerushaan+'" >'
          }
          
        }
        
        html +=       "<div class='form-check'>"
        if (data[1]==true) {
          if (element.endPerushaan==null) {
            html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"'checked disabled>"  
          } else {
            html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"' disabled>"
          }
        } else {
          if (element.endPerushaan==null) {
            html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"'checked>"  
          } else {
            html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"'>"
          }
          
        }
        html +=         "<label class='form-check-label' for='checkclose'> Sampai Sekarang </label>"
        html +=       "</div>"
        html+=      '</div>'
        html+=    '</div>'

        if (!data[1]==true) {
        html+=    '<div class="col-md-2">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">Delete</label>'
        html+=        '<button type="button" class="btn btn-primary form-control btnDel-pekerjaan" data-row="pekerjaan_rw'+data_pekerjaan+'">Delete</button>'
        html+=      '</div>'
        html+=    '</div>'
        }
        html+=  '</div>'
        html+='</div>'
      });
      $('#rw_p').append(html);
    });
}

function adddelete_pekerjaan(){
  $(document).on('click','.btnDel-pekerjaan',function(){
    var hapus = $(this).data('row')
    $('#'+hapus).remove();
    
  })

  $('#btnAddRow-pekerjaan').on('click',function(){
    data_pekerjaan+=1;
        html="";
        html+='<div class="border-rw" id="pekerjaan_rw'+data_pekerjaan+'">'
        html+=  '<div class="row">'
        html+=    '<div class="col-md-4">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="nama_perushaan">NAMA PERUSHAAN</label>'
        html+=        '<input class="form-control"  type="text" name="nama_perushaan[]" maxlength="220">'
        html+=       '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-3">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="jenis_perusahaan">JENIS</label>'
        html+=        '<select class="form-control" id="status_perkawinan" name="jenis_perusahaan[]" required>'
        html+=          "<option value='Farmasi'>Farmasi</option>"
        html+=          "<option value='Bukan Farmasi'>Bukan Farmasi</option>"
        html+=        '</select>'    
        html+=      '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-5">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">ALAMAT PRUSHAAN</label>'
        html+=        '<input class="form-control"  type="text" name="alamat_perusahaan[]" maxlength="220">'
        html+=      '</div>'
        html+=    '</div>'
        html+=  '</div>'

        // 2
        html+=  '<div class="row">'
        html+=      '<div class="col-md-5">'
        html+=        '<div class="form-group">'
        html+=          '<label class="form-control-label" for="jabatan_perusahaan">JABATAN</label>'
        html+=          '<input class="form-control"  type="text" name="jabatan_perusahaan[]" maxlength="220">'
        html+=        '</div>'
        html+=      '</div>'

        html+=      '<div class="col-md-5">'
        html+=        '<div class="form-group">'
        html+=          '<label class="form-control-label" for="atasan_perusahaan">NAMA ATASAN/ JABATAN</label>'
        html+=          '<input class="form-control"  type="text" name="atasan_perusahaan[]" maxlength="220">'
        html+=        '</div>'
        html+=      '</div>'
        html+=  '</div>'

        //3
        html+=   '<div class="row">'
        html+=      '<div class="col-md-3">'
        html+=        '<div class="form-group">'
        html+=          '<label class="form-control-label" for="jabatan_perusahaan">START KERJA</label>'
        html+=          '<input class="form-control"  type="date" name="start_perusahaan[]" maxlength="220">'
        html+=        '</div>'
        html+=      '</div>'

        html+=      '<div class="col-md-3">'
        html+=        '<div class="form-group">'
        html+=          '<label class="form-control-label" for="atasan_perusahaan">END KERJA</label>'
        html+=          '<input class="form-control" id="checkrow'+data_pekerjaan+'"  type="date" name="end_perusahaan[]" maxlength="220">'
        html +=         "<div class='form-check'>"
        html +=             "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"'>"
        html +=             "<label class='form-check-label' for='checkclose'> Sampai Sekarang </label>"
        html +=         "</div>"
        html+=        '</div>'
        html+=      '</div>'

        html+=      '<div class="col-md-2">'
        html+=        '<div class="form-group">'
        html+=          '<label class="form-control-label" for="alamat_perusahaan">Delete</label>'
        html+=          '<button type="button" class="btn btn-primary form-control btnDel-pekerjaan" data-row="pekerjaan_rw'+data_pekerjaan+'">Delete</button>'
        html+=        '</div>'
        html+=      '</div>'
        html+=    '</div>'
        html+='</div>'
      $('#rw_p').append(html);
  });

  $(document).on('change','#checknow',function(){
    // console.log($(this).is(":checked"))
    result = $(this).is(":checked")
    if (result==true) {
      var row = $(this).data('row')
      console.log(row);
      $('#'+row).val('')
      $('#'+row).attr('readonly',true)
    } else {
      var row = $(this).data('row')
      console.log(row);
      $('#'+row).attr('readonly',false)
    }
    
  })
}

data_sim=0;
function get_sim(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getsim/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data[0]));
      // console.log(JSON.stringify(data[0]));
      var html=''
      for (let index = 0; index < data[0].length; index++) {
        data_sim+=1;
        // console.log("datasim1= "+data_sim)
        html+='<tr class="simbaris'+data_sim+'">'
        html+=  '<td>'
        if (data[2]==true) {
        html+=    '<select name="sim[]" class="form-control" disabled>'
        } else {
          html+=    '<select name="sim[]" class="form-control">'
        }
        data[1].forEach(element => {
          if (element.id_proint==data[0][index]['cardType']) {
            html+='<option value="'+element.id_proint+'"selected>'+element.nama+'</option>'
          }else{
            html+='<option value="'+element.id_proint+'">'+element.nama+'</option>'
          }
        });
        html+=    '</select>'
        html+=  '</td>'
        html+=  '<td>'
        if (data[2]==true) {
          html+=    '<input name="nosim[]" class="form-control" type="text" value="'+data[0][index]['cardNumber']+'" disabled >'
        } else {
          html+=    '<input name="nosim[]" class="form-control" type="text" value="'+data[0][index]['cardNumber']+'" >'
        }
       
        html+=  '</td>'
        html+=  '<td>'
        if (data[2]==true) {
          html+=    '<input name="publisher[]" class="form-control" type="text" value="'+data[0][index]['publisher']+'" disabled >'
        } else {
          html+=    '<input name="publisher[]" class="form-control" type="text" value="'+data[0][index]['publisher']+'" >'
        }
       
        html+=  '</td>'
        html+=  '<td>'
        if (data[2]==true) {
          html+=    '<input name="expired[]" class="form-control" type="date" value="'+data[0][index]['expiredDate']+'"disabled >'
        } else {
          html+=    '<input name="expired[]" class="form-control" type="date" value="'+data[0][index]['expiredDate']+'" >'
        }
       
        html+=  '</td>'
        if (data[2]==true) {
        html+=  '<td hidden>'
        html+=  '</td>'
        } else {
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-sim' data-row='simbaris"+data_sim+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
        }
        html+='</tr>'
      }
      $('#tbody_sim').append(html);
    });
}

function adddelete_sim(){
  $(document).on('click','.btnDel-sim',function(){
    var hapus = $(this).data('row')
    $('.'+hapus).remove();
    
  })
  $('#btnAddRow-sim').on('click',function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/detail/listsim',
        type: 'get'
      }).done((data) => {
        // console.log(JSON.stringify(data));
        data_sim+=1;
        var html=''
        html+='<tr class="simbaris'+data_sim+'">'
        html+=  '<td>'
        html+=    '<select name="sim[]" class="form-control">'
        html +=     "<option value='' disabled selected>Jenis SIM</option>"
        data.forEach(element => {
        html+=      '<option value="'+element.id_proint+'">'+element.nama+'</option>'
        });
        html+=    '</select>'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input name="nosim[]" class="form-control" type="text">'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input name="publisher[]" class="form-control" type="text">'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input name="expired[]" class="form-control" type="date">'
        html+=  '</td>'
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-sim' data-row='simbaris"+data_sim+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
        html+='</tr>'

        $('#tbody_sim').append(html);
      });
  })
}

var data_pelatihan=0;
function get_pelatihan(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getpelatihan/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data[0]));
      var html=''
      for (let index = 0; index < data[0].length; index++) {
        data_pelatihan+=1;
        html+='<tr class="pelatihanbaris'+data_pelatihan+'">'
        html+=  '<td>'
        if (data[1]==true) {
          html+=    '<input class="form-control"  type="text" name="jenis_pelatihan[]" value="'+data[0][index].jenisPlthn+'" maxlength="200" disabled>'
        } else {
          html+=    '<input class="form-control"  type="text" name="jenis_pelatihan[]" value="'+data[0][index].jenisPlthn+'" maxlength="200">'
        }
        
        html+=  '</td>'
        html+=  '<td>'
        if (data[1]==true) {
          html+=    '<input class="form-control" type="text" name="penyelenggara_pelatihan[]" maxlength="200" value="'+data[0][index].penyelenggaraPlthn+'" disabled>'
        } else {
          html+=    '<input class="form-control" type="text" name="penyelenggara_pelatihan[]" maxlength="200" value="'+data[0][index].penyelenggaraPlthn+'">'
        }
        
        html+=  '</td>'
        html+=  '<td>'
        if (data[1]==true) {
          html+=    '<input class="form-control" type="number" min="1800" max="2050" name="tahun_pelatihan[]" value="'+data[0][index].tahunPlthn+'" disabled>'
        } else {
          html+=    '<input class="form-control" type="number" min="1800" max="2050" name="tahun_pelatihan[]" value="'+data[0][index].tahunPlthn+'">'
        }
        html+=  '</td>'
        if (data[1]!=true) {
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-pelatihan' data-row='pelatihanbaris"+data_pelatihan+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
        }
        
        html+='</tr>'
      }
      $('#tbody_pelatihan').append(html);
    });
}

function adddelete_pelatihan(){
  $(document).on('click','.btnDel-pelatihan',function(){
    var hapus = $(this).data('row')
    $('.'+hapus).remove();
    // console.log(hapus)    
  })
  $('#btnAddRow-pelatihan').on('click',function(){
    var html=''
    data_pelatihan+=1;
    html+='<tr class="pelatihanbaris'+data_pelatihan+'">'
    html+=  '<td>'
    html+=    '<input class="form-control"  type="text" name="jenis_pelatihan[]" maxlength="200">'
    html+=  '</td>'
    html+=  '<td>'
    html+=    '<input class="form-control" type="text" name="penyelenggara_pelatihan[]" maxlength="200">'
    html+=  '</td>'
    html+=  '<td>'
    html+=    '<input class="form-control" type="number" min="1800" max="2050"  name="tahun_pelatihan[]">'
    html+=  '</td>'
    html+=  '<td>'
    html +=    "<button type='button' class='btn btn-danger d-flex btnDel-pelatihan' data-row='pelatihanbaris"+data_pelatihan+"'>"
    html +=       "<span class='material-symbols-outlined'>delete</span>"
    html +=    "</button>"
    html+=  '</td>'
    html+='</tr>'
    $('#tbody_pelatihan').append(html);
  })
}

var data_bahasa = 0;
function get_bahasa(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getbahasa/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data[0]));
      var html=''
      for (let index = 0; index < data[0].length; index++) {
        data_bahasa+=1;
        html+='<tr class="bahasabaris'+data_bahasa+'">'
        html+=  '<td>'
        if (data[1]==true) {
          html+=    '<input class="form-control"  type="text" name="bahasa[]" maxlength="250" value="'+data[0][index].bahasa+'" disabled>'
        } else {
          html+=    '<input class="form-control"  type="text" name="bahasa[]" maxlength="250" value="'+data[0][index].bahasa+'">'
        }
        
        html+=  '</td>'
        html+=  '<td>'
        if (data[1]==true) {
          html +=     "<select class='form-control' id='berbicara[]' name='berbicara[]' required disabled>"
        } else {
          html +=     "<select class='form-control' id='berbicara[]' name='berbicara[]' required>"
        }
        
        if (data[0][index].berbicara=='Baik') {
        html +=       "<option value='Baik'selected>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else if(data[0][index].berbicara=='Cukup'){
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup' selected>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else{
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'selected>Kurang</option>"
        }
        html +=     "</select>"
        html+=  '</td>'
        
        html+=  '<td>'
        if (data[1]==true) {
          html +=     "<select class='form-control' id='menulis[]' name='menulis[]' required disabled>"
        } else {
          html +=     "<select class='form-control' id='menulis[]' name='menulis[]' required>"
        }
        
        if (data[0][index].menulis=='Baik') {
        html +=       "<option value='Baik'selected>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else if(data[0][index].menulis=='Cukup'){
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup' selected>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else{
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'selected>Kurang</option>"
        }
        html +=     "</select>"
        html+=  '</td>'

        html+=  '<td>'
        if (data[1]==true) {
          html +=     "<select class='form-control' id='membaca[]' name='membaca[]' required disabled>"
        } else {
          html +=     "<select class='form-control' id='membaca[]' name='membaca[]' required>"
        }
        
        if (data[0][index].membaca=='Baik') {
        html +=       "<option value='Baik'selected>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else if(data[0][index].membaca=='Cukup'){
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup' selected>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else{
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'selected>Kurang</option>"
        }
        html +=     "</select>"
        html+=  '</td>'
        if (data[1]!=true) {
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-bahasa' data-row='bahasabaris"+data_bahasa+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
        }
        
        html+='</tr>'
      }
      $('#tbody_bahasa').append(html);
    });
}

function adddelete_bahasa(){
  $(document).on('click','.btnDel-bahasa',function(){
    var hapus = $(this).data('row')
    $('.'+hapus).remove();
    // console.log(hapus)    
  })
  $('#btnAddRow-bahasa').on('click',function(){
    data_bahasa+=1;
    var html = '<tr class="bahasabaris'+data_bahasa+'">'
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<input class='form-control'  type='text' name='bahasa[]' maxlength='250'>"
        html +=   "</td>" 
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<select class='form-control' id='berbicara[]' name='berbicara[]' required>"
        html +=       "<option value='' disabled selected>Berbicara</option>"
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>KUrang</option>"
        html +=     "</select>"
        html +=   "</td>"
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<select class='form-control' id='menulis[]' name='menulis[]' required>"
        html +=       "<option value='' disabled selected>Menulis</option>"
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>KUrang</option>"
        html +=     "</select>"
        html +=   "</td>" 
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<select class='form-control' id='membaca[]' name='membaca[]' required>"
        html +=       "<option value='' disabled selected>Membaca</option>"
        html +=       "<option value='Baik'>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>KUrang</option>"
        html +=     "</select>"
        html +=   "</td>" 
        html+=    '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-bahasa' data-row='bahasabaris"+data_bahasa+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=    '</td>' 
        html +="</tr>"
    $('#tbody_bahasa').append(html);
  })
}

var baris_organisasi=0
function get_organisasi(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getorganisasi/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      var html=''
      for (let index = 0; index < data[0].length; index++) {
        var html  = "<tr id='baris_organisasi"+baris_organisasi+"' class='detail_organisasi'>"
        html +=   "<td style='width: 23.75%;'>"
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="nama_organisasi[]"  value="'+data[0][index].namaOrg+'" maxlength="220" disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="nama_organisasi[]"  value="'+data[0][index].namaOrg+'" maxlength="220">'
        }
        html +=   "</td>" 

        html +=   "<td style='width: 23.75%;'>"
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="kota_organisasi[]" value="'+data[0][index].kotaOrg+'" maxlength="220" disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="kota_organisasi[]" value="'+data[0][index].kotaOrg+'" maxlength="220">'
        }
        html +=   "</td>"

        html +=   "<td style='width: 23.75%;'>"
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="jabatan_organisasi[]" value="'+data[0][index].jabatanOrg+'" maxlength="220" disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="jabatan_organisasi[]" value="'+data[0][index].jabatanOrg+'" maxlength="220">'
        }
        html +=   "</td>"

        html +=   "<td style='width: 23.75%;'>"
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="tahun_organisasi[]" value="'+data[0][index].tahunOrg+'" maxlength="220" disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="tahun_organisasi[]" value="'+data[0][index].tahunOrg+'" maxlength="220">'
        }
        html +=   "</td>"

        if (data[1]!=true) {
          html +=   "<td style='width: 5%;'>"
          html +=     "<button type='button' class='btn btn-danger' data-row='baris_organisasi"+baris_organisasi+"' id='btnDelRow-organisasi'>"
          html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
          html +=     "</button>"
          html +=   "</td>"      
        }

        html +="</tr>"
        $('#tbody_organisasi').append(html);
      }
      
    });
}

function adddelete_organisasi(){
  $('#btnAddRow-organisasi').on('click',function(){
    baris_organisasi+=1;
    
    var html  = "<tr id='baris_organisasi"+baris_organisasi+"' class='detail_organisasi'>"
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<input class='form-control'  type='text' name='nama_organisasi[]' maxlength='220'>"
        html +=   "</td>" 
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<input class='form-control'  type='text' name='kota_organisasi[]' maxlength='220'>"
        html +=   "</td>"
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<input class='form-control'  type='text' name='jabatan_organisasi[]' maxlength='220'>"
        html +=   "</td>" 
        html +=   "<td style='width: 23.75%;'>"
        html +=     "<input class='form-control'  type='text' name='tahun_organisasi[]' maxlength='220'>"
        html +=   "</td>" 
        html +=   "<td style='width: 5%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris_organisasi"+baris_organisasi+"' id='btnDelRow-organisasi'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"

    $('#tbody_organisasi').append(html);
  })
    $(document).on('click','#btnDelRow-organisasi',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_kenal=0
function get_kenal(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getkenal/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data[0]));
      var html ='';
      for (let index = 0; index < data[0].length; index++) {
          html  += "<tr id='baris_kenal"+baris_kenal+"' class='detail_kenal'>"
          html +=   "<td style='width: 47.5%;'>"
          if (data[1]==true) {
            html +=     '<input class="form-control"  type="text" name="nama_kenal[]" maxlength="80" value="'+data[0][index].namaKenalan+'" disabled>'
          } else {
            html +=     '<input class="form-control"  type="text" name="nama_kenal[]" maxlength="80" value="'+data[0][index].namaKenalan+'">'
          }
          html +=   "</td>" 

          html +=   "<td style='width: 47.5%;'>"
          if (data[1]==true) {
            html +=     '<input class="form-control"  type="text" name="hubungan_kenal[]" maxlength="80" value="'+data[0][index].hubunganKenalan+'" disabled>'
          } else {
            html +=     '<input class="form-control"  type="text" name="hubungan_kenal[]" maxlength="80" value="'+data[0][index].hubunganKenalan+'">'
          }
          
          html +=   "</td>"
          if (data[1]!=true) {
          html +=   "<td style='width: 5%;'>"
          html +=     "<button type='button' class='btn btn-danger' data-row='baris_kenal"+baris_kenal+"' id='btnDelRow-kenal'>"
          html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
          html +=     "</button>"
          html +=   "</td>"   
          }
          
          html +="</tr>"
      }
      $('#tbody_kenal').append(html);
    });
}

function adddelete_kenal(){
  $('#btnAddRow-kenal').on('click',function(){
    baris_kenal+=1;
    
    var html  = "<tr id='baris_kenal"+baris_kenal+"' class='detail_kenal'>"
        html +=   "<td style='width: 47.5%;'>"
        html +=     "<input class='form-control'  type='text' name='nama_kenal[]' maxlength='80'>"
        html +=   "</td>" 
        html +=   "<td style='width: 47.5%;'>"
        html +=     "<input class='form-control'  type='text' name='hubungan_kenal[]' maxlength='80'>"
        html +=   "</td>"
        html +=   "<td style='width: 5%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris_kenal"+baris_kenal+"' id='btnDelRow-kenal'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"

    $('#tbody_kenal').append(html);
  })
    $(document).on('click','#btnDelRow-kenal',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_saudara=0
function get_saudara(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getkerabat/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data[0]));
      var html ='';
      for (let index = 0; index < data[0].length; index++) {
        html += '<tr id="baris_saudara"+baris_saudara+" class="detail_saudara">'
        html +=   '<td style="width: 19%;">'
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="hubungan_saudarafarmasi[]" maxlength="220" value="'+data[0][index].hubunganKrbt+'" required disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="hubungan_saudarafarmasi[]" maxlength="220" value="'+data[0][index].hubunganKrbt+'" required>'
        }
        html +=   '</td>' 

        html +=   '<td style="width: 19%;">'
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="nama_saudarafarmasi[]" maxlength="220" value="'+data[0][index].namaKrbt+'" required disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="nama_saudarafarmasi[]" maxlength="220" value="'+data[0][index].namaKrbt+'" required>'
        }
        html +=   '</td>' 

        html +=   '<td style="width: 19%;">'
        if (data[1]==true) {
          html +=     '<select class="form-control" id="LPsaudara" name="LP_saudarafarmasi[]" required disabled>'
        } else {
          html +=     '<select class="form-control" id="LPsaudara" name="LP_saudarafarmasi[]" required>'
        }
        html +=       '<option value="" disabled selected>L/P</option>'
        if (data[0][index].genderKrbt=="L") {
          html +=       '<option value="L" selected>L</option>'
          html +=       '<option value="P">P</option>'
        } else if(data[0][index].genderKrbt=="P") {
          html +=       '<option value="L">L</option>'
          html +=       '<option value="P"selected>P</option>'
        }
        html +=     '</select>'
        html +=   '</td>' 
        html +=   '<td style="width: 19%;">'
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="perushaan_saudarafarmasi[]" maxlength="220" value="'+data[0][index].nmperusahaanKrbt+'" required disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="perushaan_saudarafarmasi[]" maxlength="220" value="'+data[0][index].nmperusahaanKrbt+'" required>'
        }
        html +=   '</td>'

        html +=   '<td style="width: 19%;">'
        if (data[1]==true) {
          html +=     '<input class="form-control"  type="text" name="jabatan_saudarafarmasi[]"maxlength="220" value="'+data[0][index].jabatanKrbt+'" required disabled>'
        } else {
          html +=     '<input class="form-control"  type="text" name="jabatan_saudarafarmasi[]"maxlength="220" value="'+data[0][index].jabatanKrbt+'" required>'
        }
        html +=   '</td>'
        if (data[1]!=true) {
          html +=   '<td style="width: 5%;">'
          html +=     '<button type="button" class="btn btn-danger" data-row="baris_saudara"'+baris_saudara+'" id="btnDelRow-saudarafarmasi">'
          html +=       '<span class="material-symbols-outlined" style="font-size: 15px;">delete</span>' 
          html +=     '</button>'
          html +=   '</td>'
        }
        html +='</tr>'
      }
      $('#tbody_saudara').append(html);
    });
}

function adddelete_saudara(){
  $('#btnAddRow-saudarafarmasi').on('click',function(){
    baris_saudara+=1;
    
    var html  = "<tr id='baris_saudara"+baris_saudara+"' class='detail_saudara'>"
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control'  type='text' name='hubungan_saudarafarmasi[]' maxlength='220' required>"
        html +=   "</td>" 
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control'  type='text' name='nama_saudarafarmasi[]' maxlength='220' required>"
        html +=   "</td>" 
        html +=   "<td style='width: 19%;'>"
        html +=     "<select class='form-control' id='LPsaudara' name='LP_saudarafarmasi[]' required>"
        html +=       "<option value='' disabled selected>L/P</option>"
        html +=       "<option value='L'>L</option>"
        html +=       "<option value='P'>P</option>"
        html +=     "</select>"
        html +=   "</td>" 
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control'  type='text' name='perushaan_saudarafarmasi[]' maxlength='220' required>"
        html +=   "</td>"
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control'  type='text' name='jabatan_saudarafarmasi[]'maxlength='220' required>"
        html +=   "</td>"
        html +=   "<td style='width: 5%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris_saudara"+baris_saudara+"' id='btnDelRow-saudarafarmasi'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"

    $('#tbody_saudara').append(html);
  })
    $(document).on('click','#btnDelRow-saudarafarmasi',function(){
      var hapus = $(this).data('row')
      console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_keluarga =0
function get_keluarga(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getkeluarga/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      data[0].forEach(element1 => {
        baris_keluarga+=1;
        var html =''
        html +="<div id='keluarga"+baris_keluarga+"' class='border-rw'>"
        html +=   "<div class='row'>"
        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Hubungan*</label>"
        if (data[2]==true) {
          html +=         "<select class='form-control' id='hubungan_kel' name='hubungan_kel[]' disabled>"
        } else {
          html +=         "<select class='form-control' id='hubungan_kel' name='hubungan_kel[]'>"
        }
        
        html +=           "<option value='' disabled selected>Hubungan</option>"
        data[1].forEach(element => {
          if (element1.hubungan==element.FamRelId) {
            html +=           "<option value='"+element.FamRelId+"' selected>"+element.FamRelName+"</option>" 
          } else {
            html +=           "<option value='"+element.FamRelId+"'>"+element.FamRelName+"</option>" 
          }
        
        });
        html +=         "</select>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Nama*</label>"
        if (data[2]==true) {
          html +=         "<input type='text' class='form-control' id='nama_kel' name='nama_kel[]' value='"+element1.nama+"' maxlength='2000' disabled>"
        }else{
          html +=         "<input type='text' class='form-control' id='nama_kel' name='nama_kel[]' value='"+element1.nama+"' maxlength='2000'>"
        }
        
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-2'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Gender</label>"
        if (data[2]==true) {
          html +=         "<select class='form-control' id='gender_kel' name='gender_kel[]' disabled>"
        }else{
          html +=         "<select class='form-control' id='gender_kel' name='gender_kel[]'>"
        }
        
        if (element1.gender==1) {
          html +=           "<option value='1' selected>Pria</option>"
          html +=           "<option value='2'>Wanita</option>"
        } else {
          html +=           "<option value='1'>Pria</option>"
          html +=           "<option value='2' selected>Wanita</option>"
        }

        html +=         "</select>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-2'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Tanggal Lahir*</label>"
        if (data[2]==true) {
          html +=         "<input type='date' class='form-control' id='tgl_kel' name='tgl_kel[]' value='"+element1.tgl_lahir.replace(" 00:00:00.000", "")+"' disabled>"
        }else{
          html +=         "<input type='date' class='form-control' id='tgl_kel' name='tgl_kel[]' value='"+element1.tgl_lahir.replace(" 00:00:00.000", "")+"' required>"
        }
        
        html +=       "</div>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='row'>"
        html +=     "<div class='col-md-6'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Alamat</label>"
        if (data[2]==true) {
          html +=         "<input type='text' class='form-control' id='alamat_kel' value='"+element1.alamat+"' name='alamat_kel[]' disabled>"
        }else{
          html +=         "<input type='text' class='form-control' id='alamat_kel' value='"+element1.alamat+"' name='alamat_kel[]'>"
        }
        
        html +=       "</div>"
        html +=     "</div>"
        if (data[2]!=true) {
          html +=     "<div class='col-md-1'>"
          html +=       "<div class='form-group'>"
          html +=         "<button id='btnDel-keluarga' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='keluarga"+baris_keluarga+"'>"
          html +=           "<span class='material-symbols-outlined'>delete</span>"
          html +=         "</button>"
          html +=       "</div>"
          html +=     "</div>"
        }
       
        html +=   "</div>"

        html +="</div>"
        
        $('#list_keluarga').append(html);
      });
    });
}

function AddDelKeluarga(){
  $('#btnAdd-keluarga').on('click',function(){
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/form-kandidat/get/famrel',
        type: 'get',
      }).done((data) => {
        baris_keluarga+=1;
        var html =''
        html +="<div id='keluarga"+baris_keluarga+"' class='border-rw'>"
        html +=   "<div class='row'>"
        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Hubungan*</label>"
        html +=         "<select class='form-control' id='hubungan_kel' name='hubungan_kel[]'>"
        html +=           "<option value='' disabled selected>Hubungan</option>"
        data.forEach(element => {
        html +=           "<option value='"+element.FamRelId+"'>"+element.FamRelName+"</option>" 
        });
        html +=         "</select>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-3'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Nama*</label>"
        html +=         "<input type='text' class='form-control' id='nama_kel' name='nama_kel[]' maxlength='2000'>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-2'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Gender</label>"
        html +=         "<select class='form-control' id='gender_kel' name='gender_kel[]'>"
        html +=           "<option value='' disabled selected>Gender</option>"
        html +=           "<option value='1'>Pria</option>"
        html +=           "<option value='2'>Wanita</option>"
        html +=         "</select>"
        html +=       "</div>"
        html +=     "</div>"

        html +=     "<div class='col-md-2'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Tanggal Lahir*</label>"
        html +=         "<input type='date' class='form-control' id='tgl_kel' name='tgl_kel[]' required>"
        html +=       "</div>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='row'>"
        html +=     "<div class='col-md-6'>"
        html +=       "<div class='form-group'>"
        html +=         "<label class='form-control-label' for='keluarga'>Alamat</label>"
        html +=         "<input type='text' class='form-control' id='alamat_kel' name='alamat_kel[]'>"
        html +=       "</div>"
        html +=     "</div>"
        html +=     "<div class='col-md-1'>"
        html +=       "<div class='form-group'>"
        html +=         "<button id='btnDel-keluarga' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='keluarga"+baris_keluarga+"'>"
        html +=           "<span class='material-symbols-outlined'>delete</span>"
        html +=         "</button>"
        html +=       "</div>"
        html +=     "</div>"
        html +=   "</div>"

        html +="</div>"

        $('#list_keluarga').append(html);
    });
    
  })
  $(document).on('click','#btnDel-keluarga',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}


function numberWithCommas() {
  $('#gaji').keyup(function(event) {
    if(event.which >= 37 && event.which <= 40) return;

    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  })

  $('#gajiharapan').keyup(function(event) {
    if(event.which >= 37 && event.which <= 40) return;

    $(this).val(function(index, value) {
      return value
      .replace(/\D/g, "")
      .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
      ;
    });
  })
}

//BAGIAN SCHEDULE
function getSchedule(){
  id = $('#id_kandidat').val();
  info_disabled = $('#info_disabled').val()
  today = new Date();
  // console.log(id);
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/detail/getschedule/kandidat/'+id,
  //     type: 'get',
  //     data: {
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  //     for(var d of data){
  //       var jadwal = new Date(d.jadwal)
  //       console.log(jadwal>today)
  //     }
  // });

  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/detail/getschedule/kandidat/'+id,
  //     type: 'get'
  // }).done((data) => {
  //   // console.log(JSON.stringify(data));
  // })
  if (info_disabled=='') {
    $('#tblSchedule').DataTable({
    
      "scrollY":        "400px",
      "scrollCollapse": true,
      pageLength : 5,
      ajax: {
      url: '/hrdats/detail/getschedule/kandidat/'+id,
              data:{},
              dataSrc:""
          },
      "paging":true,
      "bInfo" : false,
      "lengthChange": false,
      language: {
          paginate: {
              previous: "<i class='fas fa-angle-left'>",
              next: "<i class='fas fa-angle-right'>"
          }
      },
      columns: [
          {
              data: 'proses',
              defaultContent: ''
          },
          {
            data: 'nama',
            defaultContent: ''
          },
          {
            data: 'job',
            defaultContent: ''
          },
          { 
            data: 'created_at',
            defaultContent: 'NULL'
          },
          {
            data: 'jadwal',
            defaultContent: 'NULL'
          },
          {
            defaultContent: '',
              render: (data, type, row, meta)=> {
                if (row.sendEmail==1) {
                  return 'SUDAH TERKIRIM'
                } else {
                  return 'BELUM TERKIRIM'
                }
                  
              }
          },
          {
            defaultContent: '',
              render: (data, type, row, meta)=> {
                if (row.sendWA==1) {
                  return 'WA TERKIRIM'
                } else if(row.sendWA==2){
                  return 'WA GAGAL'
                }else {
                  return 'WA BELUM TERKIRIM'
                }
                  
              }
          },
          {
            data: 'Summary',
            defaultContent: 'NULL'
          },
          {
              defaultContent: '',
              render: (data, type, row, meta)=> {
                if (row.proses=='Apply') {
                  return'NULL'
                } else {
                  return '<button type="button" class="btn btn-info" onclick="Modal_notes(value)" data-toggle="modal" data-target=".modal-notes" value="'+row.id+'" data-statusp="'+row.proses+'">Note</button>'
                }
                  
              }
          },
          {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                if (row.proses=='Apply') {
                  return 'NULL'
                } else {
                  if (new Date(row.jadwal)>today) {
                    return '<button type="button" class="btn btn-info" onclick="edit_schedule(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'">Edit</button>'
                  } else {
                    return '<button type="button" class="btn btn-info" onclick="edit_schedule(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'" disabled>Edit</button>'
                  }
                  
                }
            }
          },
          {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                if (row.proses=='Apply') {
                  return 'NULL'
                } else {
                  if (new Date(row.jadwal)>today) {
                    return '<button type="button" class="btn btn-info" onclick="show_detail(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'">Send Email</button>'
                  } else {
                    return '<button type="button" class="btn btn-info" onclick="show_detail(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'" disabled>Send Email</button>'
                  }
                }
            }
          }
      ],
      order: [[3, 'desc']]
    }); 
  } else {
    $('#tblSchedule').DataTable({
    
      "scrollY":        "400px",
      "scrollCollapse": true,
      pageLength : 5,
      ajax: {
      url: '/hrdats/detail/getschedule/kandidat/'+id,
              data:{},
              dataSrc:""
          },
      "paging":true,
      "bInfo" : false,
      "lengthChange": false,
      language: {
          paginate: {
              previous: "<i class='fas fa-angle-left'>",
              next: "<i class='fas fa-angle-right'>"
          }
      },
      columns: [
          {
              data: 'proses',
              defaultContent: ''
          },
          {
            data: 'nama',
            defaultContent: ''
          },
          {
            data: 'job',
            defaultContent: ''
          },
          { 
            data: 'created_at',
            defaultContent: 'NULL'
          },
          {
            data: 'jadwal',
            defaultContent: 'NULL'
          },
          {
            defaultContent: '',
              render: (data, type, row, meta)=> {
                if (row.sendEmail==1) {
                  return 'SUDAH TERKIRIM'
                } else {
                  return 'BELUM TERKIRIM'
                }
                  
              }
          },
          {
            defaultContent: '',
              render: (data, type, row, meta)=> {
                if (row.sendWA==1) {
                  return 'WA TERKIRIM'
                } else if(row.sendWA==2){
                  return 'WA GAGAL'
                }else {
                  return 'WA BELUM TERKIRIM'
                }
                  
              }
          },
          {
            data: 'Summary',
            defaultContent: 'NULL'
          },
          {
              defaultContent: '',
              render: (data, type, row, meta)=> {
                if (row.proses=='Apply') {
                  return'NULL'
                } else {
                  return '<button type="button" class="btn btn-info" onclick="Modal_notes(value)" data-toggle="modal" data-target=".modal-notes" value="'+row.id+'" data-statusp="'+row.proses+'">Note</button>'
                }
                  
              }
          }
      ],
      order: [[3, 'desc']]
    }); 
  }
  
}

function Modal_notes(id){
  console.log(id);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getschedule/notes/'+id,
      type: 'get'
  }).done((data) => {
    // console.log(JSON.stringify(data));
    // if (data[0].Summary!=null && data[0].notes!=null ) {
      $('#notes').val(data[0].notes);
      $("#summary").val(data[0].Summary);
      $('#btn-notes').attr('value',id)
    // }
  })

  $('#btn-notes').on('click',function(){
    notes = $('#notes').val()
    summary = $('#summary').val();
    id = $('#btn-notes').val();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/detail/getschedule/update/notes',
        type: 'post',
        data:{
          id:id,
          notes:notes,
          summary:summary
        }
      }).done((data) => {
        console.log(JSON.stringify(data));
        $('.modal-notes').modal('hide');
        $('#tblSchedule').DataTable().ajax.reload();
    });
  })
}

function show_detail(id){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/email/'+id,
      type: 'get',
      data: {
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      var id_organisasi = $('#id_Organisasi').val();
      console.log(id_organisasi)
      $('#gen-doc').attr('hidden',true)
      $('.modal-tambah-schedule').modal('show');
      $('#informasi1 :input').attr('disabled',true)
      $('#informasi2 :input').attr('disabled',true)
      $('#btnAdd-schedule').attr('hidden',true);
      $('#f_ccto').attr('hidden',true);
      $('#tglWaktu').attr('readonly',true)
      $('#schedule').attr('disabled',true);
      $('#proses').attr('disabled',true);
      $('#konfirmasi').val(0);
      $('#konfirmasi').attr('disabled',true)
      var schedule=data[0].id_Rekrutmen;
      var online=data[0].jenis;
      $('#schedule').val(schedule)
      $('#proses').val(online)

      if (schedule==21) {
        online=1
      }

      if (id_organisasi!=2) {
        if (schedule==2) {
          detail = JSON.parse(data[0].test)
          durasi_raw = detail.durasi
          durasi = durasi_raw.replace(" jam","")
          online=0
  
          $('#MCU').show();
          $('#onlineonsite').attr('hidden',true)
          $('#gen-doc').attr('hidden',false)
          $('#mcu_Durasi').val(durasi)
          $('#mcu_lab').val(detail.id_lab)
          $('#mcu_nosurat').val(detail.nosurat)
        }else if(schedule==3 && online==1){
          detail = JSON.parse(data[0].test)
          durasi_raw = detail.psikotest_1_Durasi
          durasi = durasi_raw.replace(" jam","")
          
          $('#psikotest_1').show()
          $('#psikotest_1_Durasi').val(durasi)
          
          $('#psikotest_1_Link').val(detail.psikotest_1_Link)
          $('#psikotest_1_PIC').val(detail.psikotest_1_PIC)
        }else if(schedule==3 && online==0){
          detail = JSON.parse(data[0].test)
          
          $('#psikotest_0').show()
          $('#psikotest_0_Address').val(detail.psikotest_0_Address)
          $('#psikotest_0_Room').val(detail.psikotest_0_Room)
          $('#psikotest_0_PIC').val(detail.psikotest_0_PIC)
    
          
        }else if(schedule==4 && online==1){
          detail = JSON.parse(data[0].test)
          $('#test_1').show()
          $('#test_1_Durasi').val(detail.test_1_Durasi)
          $('#test_1_Link').val(detail.test_1_Link)
    
        }else if(schedule==4 && online==0){
          detail = JSON.parse(data[0].test)
  
          $('#test_0').show()
          $('#test_0_Durasi').val(detail.test_0_Durasi)
          $('#test_0_lokasi').val(detail.test_0_lokasi)
    
        }else if(schedule==5 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.interviewHR_1').show()
          $('#interviewHR_1_Link').val(detail.interviewHR_1_Link)
          $('#interviewHR_1_MeetingID').val(detail.interviewHR_1_MeetingID)
          $('#interviewHR_1_Passcode').val(detail.interviewHR_1_Passcode)
          $('#interviewHR_1_BR').val(detail.interviewHR_1_BR)
          $('#interviewHR_1_Durasi').val(detail.interviewHR_1_Durasi)
          $('#interviewHR_1_User').val(detail.interviewHR_1_User)
  
        }else if(schedule==6 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.interviewuser_1').show()
          interviewuser_1_Link = $('#interviewuser_1_Link').val(detail.interviewuser_1_Link)
          interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val(detail.interviewuser_1_MeetingID)
          interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val(detail.interviewuser_1_Passcode)
          interviewuser_1_BR = $('#interviewuser_1_BR').val(detail.interviewuser_1_BR)
          interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val(detail.interviewuser_1_Durasi)
          interviewuser_1_User = $('#interviewuser_1_User').val(detail.interviewuser_1_User)
  
        }else if(schedule==9 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.offer_1').show()
          $('#offer_1_Link').val(detail.offer_1_Link)
          $('#offer_1_MeetingID').val(detail.offer_1_MeetingID)
          $('#offer_1_Passcode').val(detail.offer_1_Passcode)
          $('#offer_1_BR').val(detail.offer_1_BR)
          $('#offer_1_Durasi').val(detail.offer_1_Durasi)
          $('#offer_1_Deadline').val(detail.offer_1_Deadline)
          $('#offer_1_URLPhase2').val(detail.offer_1_URLPhase2)
    
        }else if(schedule==9 && online==2){
          detail = JSON.parse(data[0].test)
  
          $('.offer_2').show()
          offer_2_Durasi = $('#offer_2_Durasi').val(detail.offer_2_Durasi)
          offer_2_Deadline = $('#offer_2_Deadline').val(detail.offer_2_Deadline)
          offer_2_URLPhase2 = $('#offer_2_URLPhase2').val(detail.offer_2_URLPhase2)
        }else if(schedule==7){
          detail = JSON.parse(data[0].test)
          time = detail.time
          dress = detail.dress
          online=0

          $('.accepted').show();
          $('#time').val(time)
          $('#dress').val(dress)
        }
      } else {
        if(schedule==2){
          detail = JSON.parse(data[0].test)

          $('#MCU_nk').show();
          $('#mcu_lab').val(detail.id_lab)
          $('#gen-doc').attr('hidden',false)
          $('#onlineonsite').attr('hidden',true)
          $('#mcu_nosurat').val(detail.nosurat)
        }else if(schedule==5){
          detail = JSON.parse(data[0].test)

          $('#interviewHR_1_nk').show();
          $('#interviewHR_1_nk_PIC').val(detail.interviewHR_1_nk_PIC)
          $('#interviewHR_1_nk_LINK').val(detail.interviewHR_1_nk_LINK)

        }else if(schedule==6){
          detail = JSON.parse(data[0].test)

          $('#interviewUser_1_nk').show();
          $('#interviewUser_1_nk_PIC').val(detail.interviewUser_1_nk_PIC)
          $('#interviewUser_1_nk_LINK').val(detail.interviewUser_1_nk_LINK)
        }
      }
      
      $('#btnEmail').attr('value',id)
      $('#id_log').attr('value',id)
      $('#tglWaktu').val(data[0].jadwal)
      if (data[0].ccEmail!=null) {
        emails=data[0].ccEmail
        var listemail = emails.split(",")
        $('#ccto').val(listemail).change();
      }
      tampilin_email(schedule,online)
  });
}

function edit_schedule(id){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/email/'+id,
      type: 'get',
      data: {
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      $('#Pisikotest_list').attr('hidden',true)
      $('.modal-tambah-schedule').modal('show');
      $('#btnAdd-schedule').attr('hidden',true);
      $('#btnUpdate-schedule').attr('hidden',false);
      $('#f_solutiva').attr('hidden',true)
      $('#f_firstasia').attr('hidden',true)
      $('#schedule').attr('disabled',true);
      $('#proses').attr('disabled',true);
      $('#f_solutiva').attr('hidden',true)
      $('#konfirmasi').val(0);
      $('#konfirmasi').attr('disabled',true)
      $('#btnUpdate-schedule').attr('value',id);
      var schedule=data[0].id_Rekrutmen;
      var online=data[0].jenis;
      $('#schedule').val(schedule)
      $('#proses').val(online)
      $('#gen-doc').attr('hidden',true)
      var id_organisasi = $('#id_Organisasi').val()
      console.log(id_organisasi);
      if(id_organisasi!='2'){
        if (schedule==2) {
          detail = JSON.parse(data[0].test)
          durasi_raw = detail.durasi
          durasi = durasi_raw.replace(" jam","")
          $('#gen-doc').attr('hidden',false)
          online=0
  
          $('#MCU').show();
          $('#onlineonsite').attr('hidden',true)
          $('#mcu_Durasi').val(durasi)
          $('#mcu_lab').val(detail.id_lab)
          $('#mcu_nosurat').val(detail.nosurat)
        }else if(schedule==3 && online==1){
          detail = JSON.parse(data[0].test)
          durasi_raw = detail.psikotest_1_Durasi
          durasi = durasi_raw.replace(" jam","")
          vendor = detail.idVendor
          
          $('#psikotest_1').show()
          $('#Pisikotest_list').attr('hidden',false)
          $('#psikotest_1_Durasi').val(durasi)
          
          $('#psikotest_1_Link').val(detail.psikotest_1_Link)
          $('#psikotest_1_PIC').val(detail.psikotest_1_PIC)
          $('#vendorPsikotest').val(vendor)

          if (vendor==30) {
            $('#f_solutiva').attr('hidden',false)
          } else if(vendor==31) {
            $('#f_firstasia').attr('hidden',false)
          }
          
        }else if(schedule==3 && online==0){
          detail = JSON.parse(data[0].test)
          vendor = detail.idVendor
          
          $('#psikotest_0').show()
          $('#Pisikotest_list').attr('hidden',false)
          $('#psikotest_0_Address').val(detail.psikotest_0_Address)
          $('#psikotest_0_Room').val(detail.psikotest_0_Room)
          $('#psikotest_0_PIC').val(detail.psikotest_0_PIC)
          $('#vendorPsikotest').val(vendor)

          if (vendor==30) {
            $('#f_solutiva').attr('hidden',false)
          } else if(vendor==31) {
            $('#f_firstasia').attr('hidden',false)
          }
          
        }else if(schedule==4 && online==1){
          detail = JSON.parse(data[0].test)
          $('#test_1').show()
          $('#test_1_Durasi').val(detail.test_1_Durasi)
          $('#test_1_Link').val(detail.test_1_Link)
    
        }else if(schedule==4 && online==0){
          detail = JSON.parse(data[0].test)
  
          $('#test_0').show()
          $('#test_0_Durasi').val(detail.test_0_Durasi)
          $('#test_0_lokasi').val(detail.test_0_lokasi)
    
        }else if(schedule==5 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.interviewHR_1').show()
          $('#interviewHR_1_Link').val(detail.interviewHR_1_Link)
          $('#interviewHR_1_MeetingID').val(detail.interviewHR_1_MeetingID)
          $('#interviewHR_1_Passcode').val(detail.interviewHR_1_Passcode)
          $('#interviewHR_1_BR').val(detail.interviewHR_1_BR)
          $('#interviewHR_1_Durasi').val(detail.interviewHR_1_Durasi)
          $('#interviewHR_1_User').val(detail.interviewHR_1_User)
  
        }else if(schedule==6 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.interviewuser_1').show()
          interviewuser_1_Link = $('#interviewuser_1_Link').val(detail.interviewuser_1_Link)
          interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val(detail.interviewuser_1_MeetingID)
          interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val(detail.interviewuser_1_Passcode)
          interviewuser_1_BR = $('#interviewuser_1_BR').val(detail.interviewuser_1_BR)
          interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val(detail.interviewuser_1_Durasi)
          interviewuser_1_User = $('#interviewuser_1_User').val(detail.interviewuser_1_User)
  
        }else if(schedule==9 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.offer_1').show()
          $('#offer_1_Link').val(detail.offer_1_Link)
          $('#offer_1_MeetingID').val(detail.offer_1_MeetingID)
          $('#offer_1_Passcode').val(detail.offer_1_Passcode)
          $('#offer_1_BR').val(detail.offer_1_BR)
          $('#offer_1_Durasi').val(detail.offer_1_Durasi)
          $('#offer_1_Deadline').val(detail.offer_1_Deadline)
          $('#offer_1_URLPhase2').val(detail.offer_1_URLPhase2)
    
        }else if(schedule==9 && online==2){
          detail = JSON.parse(data[0].test)
  
          $('.offer_2').show()
          offer_2_Durasi = $('#offer_2_Durasi').val(detail.offer_2_Durasi)
          offer_2_Deadline = $('#offer_2_Deadline').val(detail.offer_2_Deadline)
          offer_2_URLPhase2 = $('#offer_2_URLPhase2').val(detail.offer_2_URLPhase2)
        }else if(schedule==7){
          detail = JSON.parse(data[0].test)
          time = detail.time
          dress = detail.dress
          online=0

          $('.accepted').show();
          $('#time').val(time)
          $('#dress').val(dress)
        }
      }else{
        if(schedule==2){
          detail = JSON.parse(data[0].test)

          $('#MCU_nk').show();
          $('#mcu_lab').val(detail.id_lab)
          $('#mcu_nosurat').val(detail.nosurat)
        }else if(schedule==5){
          detail = JSON.parse(data[0].test)

          $('#interviewHR_1_nk').show();
          $('#interviewHR_1_nk_PIC').val(detail.interviewHR_1_nk_PIC)
          $('#interviewHR_1_nk_LINK').val(detail.interviewHR_1_nk_LINK)

        }else if(schedule==6){
          detail = JSON.parse(data[0].test)

          $('#interviewUser_1_nk').show();
          $('#interviewUser_1_nk_PIC').val(detail.interviewUser_1_nk_PIC)
          $('#interviewUser_1_nk_LINK').val(detail.interviewUser_1_nk_LINK)
        }
      }
      
      $('#btnEmail').attr('value',id)
      // $('#id_log_p').attr('value',id)
      $("input[name='id_log_p']").attr('value',id)
      $('#id_log').val(id);
      $('#tglWaktu').val(data[0].jadwal)
      if (data[0].ccEmail!=null) {
        emails=data[0].ccEmail
        var listemail = emails.split(",")
        $('#ccto').val(listemail).change();
      }
      tampilin_email(schedule,online)
  });

  $('#btnUpdate-schedule').on('click',function(){
    $('#Pisikotest_list').attr('hidden',true)
    var id=$('#btnUpdate-schedule').val()
    schedule = $('#schedule').val();
    konfirmasi = $('#konfirmasi').val()
    ccTo =$("select[name='ccto[]']").map(function(){return $(this).val();}).get();
    tglWaktu = $('#tglWaktu').val()
    online = $('#proses').val();
    detail={}

    if (konfirmasi==undefined) {
      if (schedule==2) {
        Durasi = $('#mcu_Durasi').val() +' jam'
        id_lab = $('#mcu_lab').val();
        nosurat = $('#mcu_nosurat').val();
  
        online=0;
  
        detail={durasi:Durasi,id_lab:id_lab,nosurat:nosurat}  
      }else if(schedule==3 && online==1){
        psikotest_1_Durasi = $('#psikotest_1_Durasi').val()
        psikotest_1_Link = $('#psikotest_1_Link').val()
        psikotest_1_PIC = $('#psikotest_1_PIC').val()
  
        detail={psikotest_1_Durasi:psikotest_1_Durasi,psikotest_1_Link:psikotest_1_Link,psikotest_1_PIC:psikotest_1_PIC}
      }else if(schedule==3 && online==0){
        psikotest_0_Address = $('#psikotest_0_Address').val()
        psikotest_0_Room = $('#psikotest_0_Room').val()
        psikotest_0_PIC = $('#psikotest_0_PIC').val()
  
        detail={psikotest_0_Address:psikotest_0_Address,psikotest_0_Room:psikotest_0_Room,psikotest_0_PIC:psikotest_0_PIC}
      }else if(schedule==4 && online==1){
        test_1_Durasi = $('#test_1_Durasi').val()
        test_1_Link = $('#test_1_Link').val()
  
        detail={test_1_Durasi:test_1_Durasi,test_1_Link:test_1_Link}
      }else if(schedule==4 && online==0){
        test_0_Durasi = $('#test_0_Durasi').val()
        test_0_lokasi = $('#test_0_lokasi').val()
  
        detail={test_0_Durasi:test_0_Durasi,test_0_lokasi:test_0_lokasi}
      }else if(schedule==5 && online==1){
        interviewHR_1_Link = $('#interviewHR_1_Link').val()
        interviewHR_1_MeetingID = $('#interviewHR_1_MeetingID').val()
        interviewHR_1_Passcode = $('#interviewHR_1_Passcode').val()
        interviewHR_1_BR = $('#interviewHR_1_BR').val()
  
        detail={interviewHR_1_Link:interviewHR_1_Link,interviewHR_1_MeetingID:interviewHR_1_MeetingID,interviewHR_1_Passcode:interviewHR_1_Passcode,interviewHR_1_BR:interviewHR_1_BR}
      }else if(schedule==6 && online==1){
        interviewuser_1_Link = $('#interviewuser_1_Link').val()
        interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
        interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
        interviewuser_1_BR = $('#interviewuser_1_BR').val()
  
        detail={interviewuser_1_Link:interviewuser_1_Link,interviewuser_1_MeetingID:interviewuser_1_MeetingID,interviewuser_1_Passcode:interviewuser_1_Passcode,interviewuser_1_BR:interviewuser_1_BR}
      }else if(schedule==9 && online==1){
        offer_1_Link = $('#offer_1_Link').val()
        offer_1_MeetingID = $('#offer_1_MeetingID').val()
        offer_1_Passcode = $('#offer_1_Passcode').val()
        offer_1_BR = $('#offer_1_BR').val()
        offer_1_Durasi = $('#offer_1_Durasi').val()
        offer_1_Deadline = $('#offer_1_Deadline').val()
        offer_1_URLPhase2 = $('#offer_1_URLPhase2').val()
  
        detail={offer_1_Link:offer_1_Link,offer_1_MeetingID:offer_1_MeetingID,offer_1_Passcode:offer_1_Passcode,
          offer_1_BR:offer_1_BR,offer_1_Durasi:offer_1_Durasi,offer_1_Deadline:offer_1_Deadline,offer_1_URLPhase2:offer_1_URLPhase2
        }
      }else if(schedule==9 && online==2){
        offer_2_Durasi = $('#offer_2_Durasi').val()
        offer_2_Deadline = $('#offer_2_Deadline').val()
        offer_2_URLPhase2 = $('#offer_2_URLPhase2').val()
  
        detail={offer_2_Durasi:offer_2_Durasi,offer_2_Deadline:offer_2_Deadline,offer_2_URLPhase2:offer_2_URLPhase2}
      }
    } else {
      if(schedule==2){
        id_lab = $('#mcu_lab').val();
        nosurat = $('#mcu_nosurat').val();

        detail={id_lab:id_lab,nosurat:nosurat}
      }else if(schedule==5){
        interviewHR_1_nk_PIC = $('#interviewHR_1_nk_PIC').val()
        interviewHR_1_nk_LINK = $('#interviewHR_1_nk_LINK').val()

        detail={interviewHR_1_nk_PIC:interviewHR_1_nk_PIC,interviewHR_1_nk_LINK:interviewHR_1_nk_LINK}
      }else if(schedule==6){
        interviewUser_1_nk_PIC = $('#interviewUser_1_nk_PIC').val()
        interviewUser_1_nk_LINK = $('#interviewUser_1_nk_LINK').val()

        detail={interviewUser_1_nk_PIC:interviewUser_1_nk_PIC,interviewUser_1_nk_LINK:interviewUser_1_nk_LINK}
      }
    }
    

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/edit/schedule',
        type: 'post',
        data: {
          id:id,
          ccTo:ccTo,
          tglWaktu:tglWaktu,
          detail:detail
        }
      }).done((data) => {
        console.log(JSON.stringify(data));
        $('#tblSchedule').DataTable().ajax.reload();
    });

  })
}

function create_schedule(){
    $('#btnAdd-schedule').on('click',function(){
      id_kandidat = $('#id_kandidat').val();
      schedule = $('#schedule').val();
      konfirmasi = $('#konfirmasi').val()
      ccTo =$("select[name='ccto[]']").map(function(){return $(this).val();}).get();
      tglWaktu = $('#tglWaktu').val()
      online = $('#proses').val();
      detail={}
      
      if (konfirmasi==undefined) {
        if (schedule==2) {
          Durasi = $('#mcu_Durasi').val() +' jam'
          id_lab = $('#mcu_lab').val();
          nosurat = $('#mcu_nosurat').val();
          online=0;
  
          detail={durasi:Durasi,id_lab:id_lab,nosurat:nosurat}  
        }else if(schedule==3 && online==1){
          psikotest_1_Durasi = $('#psikotest_1_Durasi').val()
          psikotest_1_Link = $('#psikotest_1_Link').val()
          psikotest_1_PIC = $('#psikotest_1_PIC').val()
          idVendor = $('#vendorPsikotest').val()
    
          detail={psikotest_1_Durasi:psikotest_1_Durasi,psikotest_1_Link:psikotest_1_Link,psikotest_1_PIC:psikotest_1_PIC,idVendor:idVendor}
        }else if(schedule==3 && online==0){
          psikotest_0_Address = $('#psikotest_0_Address').val()
          psikotest_0_Room = $('#psikotest_0_Room').val()
          psikotest_0_PIC = $('#psikotest_0_PIC').val()
          idVendor = $('#vendorPsikotest').val()
    
          detail={psikotest_0_Address:psikotest_0_Address,psikotest_0_Room:psikotest_0_Room,psikotest_0_PIC:psikotest_0_PIC,idVendor:idVendor}
        }else if(schedule==4 && online==1){
          test_1_Durasi = $('#test_1_Durasi').val()
          test_1_Link = $('#test_1_Link').val()
    
          detail={test_1_Durasi:test_1_Durasi,test_1_Link:test_1_Link}
        }else if(schedule==4 && online==0){
          test_0_Durasi = $('#test_0_Durasi').val()
          test_0_lokasi = $('#test_0_lokasi').val()
    
          detail={test_0_Durasi:test_0_Durasi,test_0_lokasi:test_0_lokasi}
        }else if(schedule==5 && online==1){
          interviewHR_1_Link = $('#interviewHR_1_Link').val()
          interviewHR_1_MeetingID = $('#interviewHR_1_MeetingID').val()
          interviewHR_1_Passcode = $('#interviewHR_1_Passcode').val()
          interviewHR_1_BR = $('#interviewHR_1_BR').val()
          interviewHR_1_Durasi = $('#interviewHR_1_Durasi').val()
          interviewHR_1_User = $('#interviewHR_1_User').val()
    
          detail={interviewHR_1_Link:interviewHR_1_Link,interviewHR_1_MeetingID:interviewHR_1_MeetingID,
                  interviewHR_1_Passcode:interviewHR_1_Passcode,interviewHR_1_BR:interviewHR_1_BR,
                  interviewHR_1_Durasi:interviewHR_1_Durasi,interviewHR_1_User:interviewHR_1_User}
        }else if(schedule==6 && online==1){
          interviewuser_1_Link = $('#interviewuser_1_Link').val()
          interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
          interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
          interviewuser_1_BR = $('#interviewuser_1_BR').val()
          interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val()
          interviewuser_1_User = $('#interviewuser_1_User').val()
  
          detail={interviewuser_1_Link:interviewuser_1_Link,interviewuser_1_MeetingID:interviewuser_1_MeetingID,
                  interviewuser_1_Passcode:interviewuser_1_Passcode,interviewuser_1_BR:interviewuser_1_BR,
                  interviewuser_1_Durasi:interviewuser_1_Durasi,interviewuser_1_User:interviewuser_1_User}
        }else if(schedule==9 && online==1){
          offer_1_Link = $('#offer_1_Link').val()
          offer_1_MeetingID = $('#offer_1_MeetingID').val()
          offer_1_Passcode = $('#offer_1_Passcode').val()
          offer_1_BR = $('#offer_1_BR').val()
          offer_1_Durasi = $('#offer_1_Durasi').val()
          offer_1_Deadline = $('#offer_1_Deadline').val()
          offer_1_URLPhase2 = $('#offer_1_URLPhase2').val()
    
          detail={offer_1_Link:offer_1_Link,offer_1_MeetingID:offer_1_MeetingID,offer_1_Passcode:offer_1_Passcode,
            offer_1_BR:offer_1_BR,offer_1_Durasi:offer_1_Durasi,offer_1_Deadline:offer_1_Deadline,offer_1_URLPhase2:offer_1_URLPhase2
          }
        }else if(schedule==9 && online==2){
          offer_2_Durasi = $('#offer_2_Durasi').val()
          offer_2_Deadline = $('#offer_2_Deadline').val()
          offer_2_URLPhase2 = $('#offer_2_URLPhase2').val()
    
          detail={offer_2_Durasi:offer_2_Durasi,offer_2_Deadline:offer_2_Deadline,offer_2_URLPhase2:offer_2_URLPhase2}
        }else if(schedule==7){
          time = $('#time').val();
          dress = $('#dress').val();
          online=0;

          detail={time:time,dress:dress}  
        }else if(schedule==8){
          detail={}
        }
      } else {
        if(schedule==2){
          id_lab = $('#mcu_lab').val();
          nosurat = $('#mcu_nosurat').val();
          online=0;
  
          detail={id_lab:id_lab,nosurat:nosurat}
        }else if(schedule==5){
          interviewHR_1_nk_PIC = $('#interviewHR_1_nk_PIC').val()
          interviewHR_1_nk_LINK = $('#interviewHR_1_nk_LINK').val()

          detail={interviewHR_1_nk_PIC:interviewHR_1_nk_PIC,interviewHR_1_nk_LINK:interviewHR_1_nk_LINK}
        }else if(schedule==6){
          interviewUser_1_nk_PIC = $('#interviewUser_1_nk_PIC').val()
          interviewUser_1_nk_LINK = $('#interviewUser_1_nk_LINK').val()

          detail={interviewUser_1_nk_PIC:interviewUser_1_nk_PIC,interviewUser_1_nk_LINK:interviewUser_1_nk_LINK}
        }
      }
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          _token: '{{ csrf_token() }}',
          url: '/hrdats/detail/setschedule/kandidat',
          type: 'post',
          data: {
            id_kandidat:id_kandidat,
            schedule:schedule,
            ccTo:ccTo,
            tglWaktu:tglWaktu,
            online:online,
            detail:detail
          }
        }).done((data) => {
          console.log(JSON.stringify(data));
          $('#btnEmail').attr('value',data)
          $('#id_log').val(data)
          // $('#id_log_p').val(data)
          $("input[name='id_log_p']").val(data)
          $('#tblSchedule').DataTable().ajax.reload();
      });
    });
}

function hidde(){
  $('#MCU').hide()
  $('#psikotest_1').hide()
  $('#psikotest_0').hide()
  $('#test_1').hide()
  $('#test_0').hide()
  $('.interviewHR_1').hide()
  $('.interviewuser_1').hide()
  $('.offer_1').hide()
  $('.offer_2').hide()
  $('.accepted').hide()

  $('#MCU_nk').hide()
  $('#interviewHR_1_nk').hide()
  $('#interviewUser_1_nk').hide()

  $('#informasi1 .form-control').val('')  
  $('#informasi1 :input').attr('disabled',false)
  $('#informasi2 .form-control').val('')  
  $('#informasi2 :input').attr('disabled',false)

  $('#f_ccto').attr('hidden',false);
  $('#tglWaktu').attr('readonly',false)
  $('#btnUpdate-schedule').attr('hidden',true);
  $('#schedule').attr('disabled',false);
  $('#proses').attr('disabled',false);
  $('#konfirmasi').attr('disabled',false);
  $('#Pisikotest_list').attr('hidden',true)
  $('#f_solutiva').attr('hidden',true)
  $('#f_firstasia').attr('hidden',true)
  $('#vendorPsikotest').val('')

  $('#id_log').val('')
  $('#gen-doc').removeAttr('value')
  $('#id_log_p').removeAttr('value')
  $('#gen-doc-p').removeAttr('value')
  $('#btnEmail').removeAttr('value')
}

//pengaturan form MODAL TAMBAH
function onlineORonsite(){
$('#proses').on('change',function(){
  proses = $('#proses').val();
  if(proses==1){
    $('#f_online').attr('hidden',false)
    $('#f_onsite').attr('hidden',true)
  }else if(proses==0){
    $('#f_online').attr('hidden',true)
    $('#f_onsite').attr('hidden',false)
  }else{
    $('#f_online').attr('hidden',true)
    $('#f_onsite').attr('hidden',true)
  }
})
}

function filterProses(){
  $('#schedule').on('change',function(){
    schedule = $('#schedule').val();
    if (schedule==2) { 
      $('#form_mcu').attr('hidden',false)
      $('#onlineonsite').attr('hidden',true)
      $('#proses').attr('required',false)
    }else if( schedule==7){
      $('#onlineonsite').attr('hidden',true)
    }else if(schedule==8){
      $('#onlineonsite').attr('hidden',true)
    }
    else{
      $('#form_mcu').attr('hidden',true)
      $('#onlineonsite').attr('hidden',false)
      $('#proses').attr('required',true)
      $('#mcu_nosurat').val('')
      $('#labMCU').val(null).trigger('change');
    }
  });
}

function modalInformasi(){
  hidde()
  schedule = $('#schedule').val();
  online = $('#proses').val();
  konfirmasi = $('#konfirmasi').val()
  $('#Pisikotest_list').attr('hidden',true)
  $('#f_solutiva').attr('hidden',true)
  $('#f_firstasia').attr('hidden',true)
  var list_onsite=['2','7','8']
  if (list_onsite.includes(schedule)==true) {
    online= 0
  }
  
  $('#gen-doc').attr('hidden',true)
  $('#btnAdd-schedule').attr('hidden',false)
  $('.tglandcc').attr('hidden',false)
  if (schedule==2  && online==0) {
    $('#MCU').show();
    $('#gen-doc').attr('hidden',false)
  } else if(schedule==3 && online==1) {
    $('#psikotest_1').show();
    $('#Pisikotest_list').attr('hidden',false)
    // $('#f_solutiva').attr('hidden',false)
  }else if(schedule==3 && online==0) {
    $('#psikotest_0').show();
    $('#Pisikotest_list').attr('hidden',false)
    // $('#f_solutiva').attr('hidden',false)
  }else if(schedule==4 && online==1){
    $('#test_1').show();
  }else if(schedule==4 && online==0){
    $('#test_0').show();
  }else if(schedule==5 && online==1){
    $('.interviewHR_1').show();
  }else if(schedule==6 && online==1){
    $('.interviewuser_1').show();
  }else if(schedule==9 && online==1){
    $('.offer_1').show();
  }else if(schedule==9 && online==2){
    $('.offer_2').show();
  }else if(schedule==21){
    $('#btnAdd-schedule').attr('hidden',true)
    $('.tglandcc').attr('hidden',true)
    console.log('aditional')
  }else if(schedule==7 && online==0){
    $('.accepted').show();
  }

  if(konfirmasi== 0){
    if(schedule==2 && online==0){
      $('#MCU_nk').show();
      $('#gen-doc').attr('hidden',false)
    }else if(schedule==5 && online==1){
      $('#interviewHR_1_nk').show();
    }else if(schedule==6 && online==1){
      $('#interviewUser_1_nk').show();
    }
  }else if(konfirmasi== 1){
    $('#btnAdd-schedule').attr('hidden',true)
    $('#gen-doc-p').attr('hidden',true)
    $('#gen-doc').attr('hidden',true)
  }

}

function GenDock(){
  $('#f_solutiva').attr('hidden',true)
  $('#f_firstasia').attr('hidden',true)
  var vendorPsikotest = $('#vendorPsikotest').val()
  if(vendorPsikotest==30){
    $('#f_solutiva').attr('hidden',false)
  }else if(vendorPsikotest==31){
    $('#f_firstasia').attr('hidden',false)
  }
  console.log(vendorPsikotest);
}

function tampilin_email(_schedule=null,_online=null){
  // console.log(_schedule,_online)
  $('#konten').val('')
  // $('#btnAdd-schedule').attr('disabled',false)
  var schedule = $('#schedule').val();
  var online = $('#proses').val();
  var konfirmasi = $('#konfirmasi').val();
  var bahasa = $('#bahasa').val();
  var organisasi = $('#id_Organisasi').val();

  if(schedule==21){
    online=1;
    konfirmasi=0;
  }

  if(organisasi==1 || organisasi==2){
    bahasa=0
  }
  var list_onsite=['2','7','8']
  var list_organisasi=['1','3']
  // console.log(konfirmasi);
  if (list_onsite.includes(schedule)==true) {
    online= 0
  }
  if(list_organisasi.includes(organisasi)){
    konfirmasi=0;
  }
  // if(konfirmasi==1){
  //   $('#btnAdd-schedule').attr('disabled',true)
  // }
  console.log(organisasi,bahasa)

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/konten/email',
      type: 'post',
      data: {
        schedule:schedule,
        online:online,
        organisasi:organisasi,
        konfirmasi:konfirmasi,
        bahasa:bahasa
      }
    }).done((data) => {
      console.log(JSON.stringify(data));
      if (data.length>0) {
        konten = data[0].konten
        $('#konten').val(konten)
      }
      // $('#summernote').summernote('code', '');
      // $('#summernote').summernote('code', $(konten));
  });
}

function kirimEmail(){
  $('#btnEmail').on('click',function(){
    namaKandidat = $('#namalengkap').val();
    schedule = $('#schedule').val();
    posisi = $('#posisi').val();
    online = $('#proses').val();
    konten = $('#konten').val();
    tglWaktuRaw = $('#tglWaktu').val();
    if (tglWaktuRaw.includes("T00:00")) {
      tglWaktu = tglWaktuRaw.replace("T00:00", "");
    } else {
      tglWaktu = tglWaktuRaw.replace("T", " Waktu: ");
    }

    id_kandidat = $('#id_kandidat').val();
    id_email=$('#btnEmail').val()
    var organisasi = $('#id_Organisasi').val();
    var pic_name = $('#PICname').text();
    data={}
    console.log(tglWaktuRaw);
    var list_organisasi=['1','3']
    
    if (list_organisasi.includes(organisasi)) {
      // console.log('1,3')
      if (schedule==2) {
        Durasi = $('#mcu_Durasi').val() +' jam'
        id_lab = $('#mcu_lab').val(); 

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[DURATION]',Durasi)
        data={konten:konten,id_kandidat:id_kandidat,id_lab:id_lab,schedule:schedule,id_email:id_email}
      }else if(schedule==3 && online==1){
        psikotest_1_Durasi = $('#psikotest_1_Durasi').val()
        psikotest_1_Link = $('#psikotest_1_Link').val()
        psikotest_1_PIC = $('#psikotest_1_PIC').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[DURATION]',psikotest_1_Durasi)
        var konten = konten.replace('[TEST LINK]',psikotest_1_Link)
        var konten = konten.replace('[PIC’s NAME]',psikotest_1_PIC)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==3 && online==0){
        psikotest_0_Address = $('#psikotest_0_Address').val()
        psikotest_0_Room = $('#psikotest_0_Room').val()
        psikotest_0_PIC = $('#psikotest_0_PIC').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[ADDRESS]',psikotest_0_Address)
        var konten = konten.replace('[ROOM]',psikotest_0_Room)
        var konten = konten.replace('[PIC’s NAME]',psikotest_0_PIC)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==4 && online==1){
        test_1_Durasi = $('#test_1_Durasi').val()
        test_1_Link = $('#test_1_Link').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',test_1_Durasi)
        var konten = konten.replace('[TEST LINK]',test_1_Link)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==4 && online==0){
        test_0_Durasi = $('#test_0_Durasi').val()
        test_0_lokasi = $('#test_0_lokasi').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',test_0_Durasi)
        var konten = konten.replace('[ADDRESS]',test_0_lokasi)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==5 && online==1){
        interviewHR_1_Link = $('#interviewHR_1_Link').val()
        interviewHR_1_MeetingID = $('#interviewHR_1_MeetingID').val()
        interviewHR_1_Passcode = $('#interviewHR_1_Passcode').val()
        interviewHR_1_BR = $('#interviewHR_1_BR').val()
        interviewHR_1_Durasi = $('#interviewHR_1_Durasi').val()
        interviewHR_1_User = $('#interviewHR_1_User').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[LINK ZOOM]',interviewHR_1_Link)
        var konten = konten.replace('[MEETING IS]',interviewHR_1_MeetingID)
        var konten = konten.replace('[PASSCODE]',interviewHR_1_Passcode)
        var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewHR_1_BR)
        var konten = konten.replace('[DURATION]',interviewHR_1_Durasi)
        var konten = konten.replace(' [USER/INTERVIEWER]',interviewHR_1_User)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==6 && online==1){
        interviewuser_1_Link = $('#interviewuser_1_Link').val()
        interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
        interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
        interviewuser_1_BR = $('#interviewuser_1_BR').val()
        interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val()
        interviewuser_1_User = $('#interviewuser_1_User').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[LINK ZOOM]',interviewuser_1_Link)
        var konten = konten.replace('[MEETING IS]',interviewuser_1_MeetingID)
        var konten = konten.replace('[PASSCODE]',interviewuser_1_Passcode)
        var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewuser_1_BR)
        var konten = konten.replace('[DURATION]',interviewuser_1_Durasi)
        var konten = konten.replace(' [USER/INTERVIEWER]',interviewuser_1_User)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==9 && online==1){
        offer_1_Link = $('#offer_1_Link').val()
        offer_1_MeetingID = $('#offer_1_MeetingID').val()
        offer_1_Passcode = $('#offer_1_Passcode').val()
        offer_1_BR = $('#offer_1_BR').val()
        offer_1_Durasi = $('#offer_1_Durasi').val()
        offer_1_Deadline = $('#offer_1_Deadline').val()
        offer_1_URLPhase2 = $('#offer_1_URLPhase2').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',offer_1_Durasi)
        var konten = konten.replace('[LINK ZOOM]',offer_1_Link)
        var konten = konten.replace('[MEETING IS]',offer_1_MeetingID)
        var konten = konten.replace('[PASSCODE]',offer_1_Passcode)
        var konten = konten.replace('[BREAKOUT ROOM NAME]',offer_1_BR)
        var konten = konten.replace('[DEADLINE]',offer_1_Deadline)
        var konten = konten.replace('[LINK TO DATABASE PHASE – 2]',offer_1_URLPhase2)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==9 && online==2){
        offer_2_Durasi = $('#offer_2_Durasi').val()
        offer_2_Deadline = $('#offer_2_Deadline').val()
        offer_2_URLPhase2 = $('#offer_2_URLPhase2').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',offer_2_Durasi)
        var konten = konten.replace('[DEADLINE]',offer_2_Deadline)
        var konten = konten.replace('[LINK TO DATABASE PHASE – 2]',offer_2_URLPhase2)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==21){
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:null}
      }else if(schedule==7){
        time = $('#time').val();
        dress = $('#dress').val();

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[TIME]',time)
        var konten = konten.replace('[DRESS CODE]',dress)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==8){
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }
    } else {
      // console.log('2')
      var konfirmasi = $('#konfirmasi').val();
      if (schedule==5 && online==1 && konfirmasi==0) {
        interviewHR_1_nk_LINK = $('#interviewHR_1_nk_LINK').val()
        interviewHR_1_nk_PIC = $('#interviewHR_1_nk_PIC').val()
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[PIC NAME]',interviewHR_1_nk_PIC)

        var konten = konten.replace('[LINK]',interviewHR_1_nk_LINK)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==6 && online==1 && konfirmasi==0){
        interviewuser_1_Link = $('#interviewuser_1_Link').val()

        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[PIC NAME]',pic_name)

        var konten = konten.replace('[LINK]',interviewUser_1_nk_LINK)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==3 && online==1 && konfirmasi==0){
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==3 && online==1 && konfirmasi==1){
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[POSITION]',posisi)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==2 && konfirmasi==1){
        // id_lab = $('#mcu_lab').val();
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule}
      }else if(schedule==2 && konfirmasi==0){
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        id_lab = $('#mcu_lab').val(); 

        data={konten:konten,id_kandidat:id_kandidat,id_lab:id_lab,schedule:schedule,id_email:id_email}
      }else if(schedule==8 && konfirmasi==0){
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }else if(schedule==7 && konfirmasi ==0){
        var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
      }
      else if(schedule==21){
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:null}
      }
    }
    
    console.log(JSON.stringify(data));
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/send/email',
        type: 'post',
        data:data
      }).done((data) => {
        console.log(JSON.stringify(data));
        $('#tblSchedule').DataTable().ajax.reload();
    });
  })
  

}

function showlogFPTK(){
  var id = $('#id_kandidat').val();
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/detail/logfptk/'+id,
  //     type: 'get'
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  //   })

  $('#TbllogFPTK').DataTable({
    "scrollY":        "650px",
    "scrollCollapse": true,
    aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
    ],
    iDisplayLength: 5,
    // pageLength : 5,
    ajax: {
    url: '/hrdats/detail/logfptk/'+id,
            data:{},
            dataSrc:""
        },
    "paging":true,
    "bInfo" : false,
    "lengthChange": true,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
    columns: [
      {
          data: 'nofptk',
          defaultContent: ''
      },
      {
        data: 'namakandidat',
        defaultContent: ''
      },
      {
        data: 'status',
        defaultContent: ''
      },
      {
        // data: 'date',
        // defaultContent: ''
        render: (data, type, row, meta)=> {
          return row.date.replace(':00.000','')
        }
      },
      {
        data: 'PIC_name',
        defaultContent: ''
      }

    ],
    order: [[3, 'desc']]
  });
}

////---
var baris_tlp = 0;
var baris_email =0
function getKontak(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getkontak/kandidat/'+id_kandidat,
      type: 'get'
  }).done((data) => {
    // console.log(JSON.stringify(data));
    data[0].forEach(element => {
      baris_tlp +=1;
      // // console.log(element.phoneType)
      var html=''
      html +="<tr id='tlp"+baris_tlp+"'>"
      html +=   "<td>"
     
      if (data[2]==true) {
        html +=     "<select name='tipe_Tlp[]' class='form-control tipeTlp' data-row='Area_Tlp"+baris_tlp+"' disabled>"
      } else {
        html +=     "<select name='tipe_Tlp[]' class='form-control tipeTlp' data-row='Area_Tlp"+baris_tlp+"'>"
      }

      if (element.phoneType=='M ') {
        html +=         "<option value='M' selected>Seluler</option>"
        html +=         "<option value='H'>Rumah</option>"
      }else{
        html +=         "<option value='M'>Seluler</option>"
        html +=         "<option value='H' selected>Rumah</option>"
      }
      html +=     "</select>"
      html +=   "</td>"

      html +=   "<td>"
      if (element.phoneType=='M ') {
      html +=     "<input type='text' class='form-control' id='Area_Tlp"+baris_tlp+"' name='Area_Tlp[]' maxlength='45'  readonly>"
      } else {
        if (data[2]==true) {
          html +=     "<input type='text' class='form-control' id='Area_Tlp"+baris_tlp+"' name='Area_Tlp[]' value='"+element.areaCode.trim()+"'  maxlength='45' readonly>"
        }else{
          html +=     "<input type='text' class='form-control' id='Area_Tlp"+baris_tlp+"' name='Area_Tlp[]' value='"+element.areaCode.trim()+"'  maxlength='45' required>"
        }
      }
      html +=   "</td>"

      html +=   "<td>"
      if (data[2]==true) {
        html +=    "<input type='text' class='form-control' id='no_Tlp' name='no_Tlp[]' value='"+element.phoneNumber.trim()+"' maxlength='45' readonly>"
      }else{
        html +=    "<input type='text' class='form-control' id='no_Tlp' name='no_Tlp[]' value='"+element.phoneNumber.trim()+"' maxlength='45' required>"
      }
      
      html +=   "</td>"
      if (data[2]!=true) {
      html+=  '<td>'
      html +=    "<button type='button' class='btn btn-danger d-flex btnDel-tlp' data-row='tlp"+baris_tlp+"'>"
      html +=       "<span class='material-symbols-outlined'>delete</span>"
      html +=    "</button>"
      html+=  '</td>'
      }
      html +="</tr>"

      $('#tbody_tlp').append(html)

    });
    
    data[1].forEach(element => {
      baris_email+=1
      var html2=''

      html2 +="<tr id='email"+baris_email+"'>"
      html2 +=  "<td>"
      if (data[2]==true) {
        html2 +=       "<select class='form-control' id='tipe_Tlp' name='tipe_Email[]'  disabled>"
      }else{
        html2 +=       "<select class='form-control' id='tipe_Tlp' name='tipe_Email[]'  required>"
      }
      if (element.emailTpye=="H ") {
      html2 +=         "<option value='B'>Bisnis</option>"
      html2 +=         "<option value='H' selected>Pribadi</option>"
      } else {
      html2 +=         "<option value='B'selected>Bisnis</option>"
      html2 +=         "<option value='H'>Pribadi</option>"
      }
      html2 +=       "</select>"
      html2 +=  "</td>"
      html2 +=  "<td>"
      if (data[2]==true) {
      html2 +=       "<input type='email' class='form-control' id='email' name='email[]' value='"+element.email.trim()+"'maxlength='45' disabled>"
      }else{
      html2 +=       "<input type='email' class='form-control' id='email' name='email[]' value='"+element.email.trim()+"'maxlength='45' required>"
      }
      html2 +=  "</td>"
      if (data[2]!=true) {
      html2 +=  '<td>'
      html2 +=    "<button type='button' class='btn btn-danger d-flex btnDel-tlp' data-row='email"+baris_email+"'>"
      html2 +=       "<span class='material-symbols-outlined'>delete</span>"
      html2 +=    "</button>"
      html2 +=  '</td>'
      }
      
      html2 +="</tr>" 
      $('#tbody_email').append(html2)
    })

  });
}

function AddDell_kontak(){
  $(document).on('click','.btnDel-tlp',function(){
    var hapus = $(this).data('row')
    $('#'+hapus).remove();
    
  })

  $(document).on('change','.tipeTlp',function(){
    var data = $(this).data('row')
    var data1 = $(this).val();
    if(data1 == 'M'){
      $('#'+data).attr('readonly', true);
      $('#'+data).val('');
      $('#'+data).attr('required', false);
    }else{
      $('#'+data).attr('readonly', false);
      $('#'+data).attr('required', true);
    }
    console.log(data,data1);
  })

  $('#btnAddRow-tlp').on('click',function(){
      baris_tlp +=1;
      // // console.log(element.phoneType)
      var html=''
      html +="<tr id='tlp"+baris_tlp+"'>"
      html +=   "<td>"
      html +=     "<select name='tipe_Tlp[]' class='form-control tipeTlp' data-row='Area_Tlp"+baris_tlp+"' >"
      html +=         "<option disabled selected>Tipe Tlp</option>"
      html +=         "<option value='M'>Seluler</option>"
      html +=         "<option value='H'>Rumah</option>"
      html +=     "</select>"
      html +=   "</td>"

      html +=   "<td>"
      html +=     "<input type='text' class='form-control'  id='Area_Tlp"+baris_tlp+"' name='Area_Tlp[]'  maxlength='45' required>"
      html +=   "</td>"

      html +=   "<td>"
      html +=    "<input type='text' class='form-control' id='no_Tlp' name='no_Tlp[]' maxlength='45' required>"
      html +=   "</td>"

      html+=  '<td>'
      html +=    "<button type='button' class='btn btn-danger d-flex btnDel-tlp' data-row='tlp"+baris_tlp+"'>"
      html +=       "<span class='material-symbols-outlined'>delete</span>"
      html +=    "</button>"
      html+=  '</td>'
      html +="</tr>"
      $('#tbody_tlp').append(html)
  })

  $(document).on('click','.btnDel-email',function(){
    var hapus = $(this).data('row')
    $('#'+hapus).remove();
    
  })

  $('#btnAddRow-email').on('click',function(){
      baris_email +=1;
      // // console.log(element.phoneType)
      var html2=''
      html2 +="<tr id='email"+baris_email+"'>"
      html2 +=  "<td>"
      html2 +=       "<select class='form-control' id='tipe_Tlp' name='tipe_Email[]' required>"
      html2 +=         "<option value='' disabled selected>Tipe Email</option>"
      html2 +=         "<option value='B'>Bisnis</option>"
      html2 +=         "<option value='H'>Pribadi</option>"
      html2 +=       "</select>"
      html2 +=  "</td>"
      html2 +=  "<td>"
      html2 +=       "<input type='email' class='form-control' id='email' name='email[]' maxlength='45' required>"
      html2 +=  "</td>"
      html2+=  '<td>'
      html2 +=    "<button type='button' class='btn btn-danger d-flex btnDel-email' data-row='email"+baris_email+"'>"
      html2 +=       "<span class='material-symbols-outlined'>delete</span>"
      html2 +=    "</button>"
      html2+=  '</td>'
      html2 +="</tr>" 

      $('#tbody_email').append(html2)
  })
}

function Modal_major(obj){
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/detail/show/major',
  //     type: 'get',
  //     data: {
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });
  // $('#TblMajor').DataTable().destroy();
  $('#TblMajor').DataTable({
    "scrollY":        "400px",
    "scrollCollapse": true,
    aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
    ],
    iDisplayLength: 5,
    processing: true,
    serverSide: true,
    scroller:true,
    "paging": true,
    ajax: {
        
        url: "/hrdats/detail/show/major",
        data:{},
      },
    "paging":true,
    "bInfo" : true,
    "lengthChange": true,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
    columns: [
        {
            data: 'EduMjrName',
            defaultContent: ''
        },
        {
            data: 'EduMjrId',
            defaultContent: ''
        },
        {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                return '<button type="button" class="btn btn-info" onclick="select_major(this)" value="'+row.EduMjrName.trim()+'|'+row.EduMjrId+'" data-baris="'+obj.value+'" >Select</button>'
            }
        }
    ] 
  });
}


function Modal_inst(obj){
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/detail/show/major',
  //     type: 'get',
  //     data: {
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });
  // $('#TblMajor').DataTable().destroy();

  
  //on keyup, start the countdown

  var typingTimer;
  var doneTypingInterval = 1500;  
  var $input = $('#search_inst');
  $input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
  });

  //on keydown, clear the countdown 
  $input.on('keydown', function () {
    clearTimeout(typingTimer);
  });

  //user is "finished typing," do something
  function doneTyping () {
    var search = $('#search_inst').val()
    if (search.length>=5) {
      showdata_inst(obj,search)
    }
  }
}
function showdata_inst(obj,search){
  $('#TblInst').DataTable().destroy();
  $('#TblInst').DataTable({
    "scrollY":        "400px",
    "scrollCollapse": true,
    aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
    ],
    iDisplayLength: 5,
    scroller:true,
    "paging": true,
    ajax: {
        
        url: "/hrdats/detail/show/inst",
        data:{
          search:search
        },
        dataSrc:""
      },
    "paging":true,
    "bInfo" : true,
    "lengthChange": true,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
    columns: [
        {
            data: 'EduInsName',
            defaultContent: ''
        },
        {
            data: 'EduInsId',
            defaultContent: ''
        },
        {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                return '<button type="button" class="btn btn-info" onclick="select_inst(this)" value="'+row.EduInsName.trim()+'|'+row.EduInsId+'" data-baris="'+obj.value+'" >Select</button>'
            }
        }
    ] 
  });
}

function select_major(obj){
  $('.modal-list-major').modal('hide');
  var value = obj.value;
  var data_baris = $(obj).attr("data-baris")
  $('#'+data_baris).attr('value',value);
}

function select_inst(obj){
  $('.modal-list-inst').modal('hide');
  var value = obj.value;
  var data_baris = $(obj).attr("data-baris")
  $('#'+data_baris).attr('value',value);
}

// function gen_FKPK(){
//   $('#btnGen_FKPK').on('click',function(){
//     setTimeout(hidefkpk(), 5000);
//   });
// }

function final(obj){
  // console.log(obj);
  var value = obj.value;
  var schedule = $(obj).attr("data-schedule")
  if (schedule==7) {
    proses = 'Accepted'
  } else {
    proses = 'Rejected'
  }
  $('#schedule').val(proses)
  $('#schedule').attr('data-schedule_',schedule)
}

// function hidefkpk(){
//   $('.modal-fkpk').modal('hide');
// }