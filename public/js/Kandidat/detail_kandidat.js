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
  gen_url()
  getPostCode()
  hide()
  get_sim()
  adddelete_sim()
  get_Pendidikan()
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
  sakit()
  psikologis()
  saudara()
  filterProses();
  $('.modal-tambah-schedule').on('show.bs.modal', function() {
    $('#ccto').select2();
    $('#labMCU').select2();
  })
  modal()
  getSchedule()
  onlineORonsite()
  create_schedule()
});

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
//pengaturan form MODAL TAMBAH
function onlineORonsite(){
$('#proses').on('change',function(){
  proses = $('#proses').val();
  if(proses=='Online'){
    $('#f_online').attr('hidden',false)
    $('#f_onsite').attr('hidden',true)
  }else if(proses=='On-site'){
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
    }else{
      $('#form_mcu').attr('hidden',true)
      $('#onlineonsite').attr('hidden',false)
      $('#proses').attr('required',true)
      $('#mcu_nosurat').val('')
      $('#labMCU').val(null).trigger('change');
    }
  });
}

function addSchedule(){
  $('#btnAdd-schedule').on('click',function(){
    
  })
}


function modal(){
  $('.modal-tambah-schedule').on('show.bs.modal', function() {
    $('#schedule').val('');
    $('#poses').val('');
    $('#ol_link').val('');
    $('#ol_meetID').val('');
    $('#ol_pass').val('');
    $('#ol_Br').val('');
    $('#tglWaktu').val('');
    $('#ccto').val(null).trigger('change');

    //mcu
    $('#form_mcu').attr('hidden',true)
    $('#onlineonsite').attr('hidden',false)
    $('#proses').attr('required',true)
    $('#mcu_nosurat').val('')
    $('#labMCU').val(null).trigger('change');
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
      // console.log(JSON.stringify(data[0]));
      var pendidikans = ['SD','SLTP','SMA','Akademi','S1','S2'];
      var html=''
      var i=0;
      for (let index = 0; index < pendidikans.length;) {
        if(data[0].length>0){
          if(pendidikans[index]==data[0][i].pendidikan){
            html+='<tr>'
            html+=  '<td>'+pendidikans[index]+'</td>'
            html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" value="'+data[0][i].namaSekolah+'"></td>'
            if (pendidikans[index]=='SMA') {
              html+='<td>'
              html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              html+=    '<option value="" selected>jurusan</option>'
              data[1].forEach(element => {
                if (element.nama==data[0][i].jurusan) {
                  html+= '<option value="'+element.nama+'" selected>'+element.nama+'</option>'
                } else {
                  html+= '<option value="'+element.nama+'">'+element.nama+'</option>'
                }
              });
            html+=  '</select>'
            html+='</td>'
            } else if(pendidikans[index]=='Akademi') {
              html+='<td>'
              html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              html+=    '<option value="" selected>jurusan</option>'
              data[2].forEach(element => {
                if (element.nama==data[0][i].jurusan) {
                  html+= '<option value="'+element.nama+'" selected>'+element.nama+'</option>'
                } else {
                  html+= '<option value="'+element.nama+'">'+element.nama+'</option>'
                }
              });
              html+=  '</select>'
              html+='</td>'
            }else{
              html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45" value="'+data[0][i].jurusan+'"></td>'
            }
            
            html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45" value="'+data[0][i].kota+'"></td>'
            html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45" value="'+data[0][i].tahun+'"></td>'
            html+='</tr>'
            index++
            if (i<data[0].length-1) {
              i+=1;
            }
          }else{
            html+='<tr>'
            html+=  '<td>'+pendidikans[index]+'</td>'
            html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45"></td>'
            if (pendidikans[index]=='SMA') {
              html+='<td>'
              html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              html+=    '<option value="" selected>jurusan</option>'
              data[1].forEach(element => {
                html+= '<option value="'+element.nama+'">'+element.nama+'</option>'
              });
            html+=  '</select>'
            html+='</td>'
            } else if(pendidikans[index]=='Akademi') {
              html+='<td>'
              html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              html+=    '<option value="" selected>jurusan</option>'
              data[2].forEach(element => {
                  html+= '<option value="'+element.nama+'">'+element.nama+'</option>'
              });
              html+=  '</select>'
              html+='</td>'
            }else{
              html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
            }
            // html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
            html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45"></td>'
            html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45"></td>'
            html+='</tr>'
            index++
          }
        }else{
          html+='<tr>'
            html+=  '<td>'+pendidikans[index]+'</td>'
            html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45"></td>'
            if (pendidikans[index]=='SMA') {
              html+='<td>'
              html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              html+=    '<option value="" selected>jurusan</option>'
              data[1].forEach(element => {
                html+= '<option value="'+element.id+'">'+element.nama+'</option>'
              });
            html+=  '</select>'
            html+='</td>'
            } else if(pendidikans[index]=='Akademi') {
              html+='<td>'
              html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              html+=    '<option value="" selected>jurusan</option>'
              data[2].forEach(element => {
                  html+= '<option value="'+element.id+'">'+element.nama+'</option>'
              });
              html+=  '</select>'
              html+='</td>'
            }else{
              html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
            }
            // html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
            html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45"></td>'
            html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45"></td>'
            html+='</tr>'
            index++
        }
        
      }
      $('#tbody_pendidikan').append(html);
    })
}
data_pekerjaan = 0;
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
      var html=''
      data.forEach(element => {
        data_pekerjaan+=1;
        html+='<div class="border-rw" id="pekerjaan_rw'+data_pekerjaan+'">'
        html+='<div class="row">'
        html+=  '<div class="col-md-4">'
        html+=    '<div class="form-group">'
        html+=      '<label class="form-control-label" for="nama_perushaan">NAMA PERUSHAAN</label>'
        html+=      '<input class="form-control"  type="text" name="nama_perushaan[]" maxlength="220" value="'+element.namaPerusahaan+'">'
        html+=    '</div>'
        html+=  '</div>'

        html+=  '<div class="col-md-3">'
        html+=    '<div class="form-group">'
        html+=      '<label class="form-control-label" for="jenis_perusahaan">JENIS</label>'
        html+=      '<select class="form-control" id="status_perkawinan" name="jenis_perusahaan[]" required>'
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
        html+=      '<input class="form-control"  type="text" name="alamat_perusahaan[]" maxlength="220" value="'+element.alamatPerusahaan+'">'
        html+=    '</div>'
        html+=  '</div>'
        html+='</div>'

        // 2
        html+='<div class="row">'
        html+=    '<div class="col-md-5">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="jabatan_perusahaan">JABATAN</label>'
        html+=        '<input class="form-control"  type="text" name="jabatan_perusahaan[]" maxlength="220" value="'+element.jabatanPerusahaan+'">'
        html+=      '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-5">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="atasan_perusahaan">NAMA ATASAN/ JABATAN</label>'
        html+=        '<input class="form-control"  type="text" name="atasan_perusahaan[]" maxlength="220" value="'+element.atasanPerusahaan+'">'
        html+=      '</div>'
        html+=    '</div>'
        html+=  '</div>'

        //3
        html+=  '<div class="row">'
        html+=    '<div class="col-md-3">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="jabatan_perusahaan">START KERJA</label>'
        html+=        '<input class="form-control"  type="date" name="start_perusahaan[]" maxlength="220" value="'+element.startPerushaan+'">'
        html+=      '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-3">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="atasan_perusahaan">END KERJA</label>'
        html+=        '<input class="form-control" id="checkrow'+data_pekerjaan+'"  type="date" name="end_perusahaan[]" maxlength="220" value="'+element.endPerushaan+'" >'
        html +=       "<div class='form-check'>"
        html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"'>"
        html +=         "<label class='form-check-label' for='checkclose'> Sampai Sekarang </label>"
        html +=       "</div>"
        html+=      '</div>'
        html+=    '</div>'

        html+=    '<div class="col-md-2">'
        html+=      '<div class="form-group">'
        html+=        '<label class="form-control-label" for="alamat_perusahaan">Delete</label>'
        html+=        '<button type="button" class="btn btn-primary form-control btnDel-pekerjaan" data-row="pekerjaan_rw'+data_pekerjaan+'">Delete</button>'
        html+=      '</div>'
        html+=    '</div>'
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
      var html=''
      for (let index = 0; index < data[0].length; index++) {
        data_sim+=1;
        // console.log("datasim1= "+data_sim)
        html+='<tr class="simbaris'+data_sim+'">'
        html+=  '<td>'
        html+=    '<select name="sim[]" class="form-control">'
        data[1].forEach(element => {
          if (element.id==data[0][index]['sim']) {
            html+='<option value="'+element.id+'"selected>'+element.nama+'</option>'
          }else{
            html+='<option value="'+element.id+'">'+element.nama+'</option>'
          }
        });
        html+=    '</select>'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input name="nosim[]" class="form-control" type="text" value="'+data[0][index]['nosim']+'"required>'
        html+=  '</td>'
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-sim' data-row='simbaris"+data_sim+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
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
        console.log(JSON.stringify(data));
        data_sim+=1;
        var html=''
        html+='<tr class="simbaris'+data_sim+'">'
        html+=  '<td>'
        html+=    '<select name="sim[]" class="form-control">'
        data.forEach(element => {
        html+=      '<option value="'+element.id+'">'+element.nama+'</option>'
        });
        html+=    '</select>'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input name="nosim[]" class="form-control" type="text" required>'
        html+=  '</td>'
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-sim' data-row='simbaris"+data_sim+"'required>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
        html+='</tr>'

        $('#tbody_sim').append(html);
      });
  })
}

data_pelatihan=0;
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
      for (let index = 0; index < data.length; index++) {
        data_pelatihan+=1;
        html+='<tr class="pelatihanbaris'+data_pelatihan+'">'
        html+=  '<td>'
        html+=    '<input class="form-control"  type="text" name="jenis_pelatihan[]" value="'+data[index].jenisPlthn+'" maxlength="200">'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input class="form-control" type="text" name="penyelenggara_pelatihan[]" maxlength="200" value="'+data[index].penyelenggaraPlthn+'">'
        html+=  '</td>'
        html+=  '<td>'
        html+=    '<input class="form-control" type="number" min="1800" max="2050" name="tahun_pelatihan[]" value="'+data[index].tahunPlthn+'">'
        html+=  '</td>'
        html+=  '<td>'
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-pelatihan' data-row='pelatihanbaris"+data_pelatihan+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
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

data_bahasa = 0;
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
      for (let index = 0; index < data.length; index++) {
        data_bahasa+=1;
        html+='<tr class="bahasabaris'+data_bahasa+'">'
        html+=  '<td>'
        html+=    '<input class="form-control"  type="text" name="bahasa[]" maxlength="250" value="'+data[index].bahasa+'">'
        html+=  '</td>'
        html+=  '<td>'
        html +=     "<select class='form-control' id='berbicara[]' name='berbicara[]' required>"
        if (data[index].berbicara=='Baik') {
        html +=       "<option value='Baik'selected>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else if(data[index].berbicara=='Cukup'){
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
        html +=     "<select class='form-control' id='menulis[]' name='menulis[]' required>"
        if (data[index].menulis=='Baik') {
        html +=       "<option value='Baik'selected>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else if(data[index].menulis=='Cukup'){
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
        html +=     "<select class='form-control' id='membaca[]' name='membaca[]' required>"
        if (data[index].membaca=='Baik') {
        html +=       "<option value='Baik'selected>Baik</option>"
        html +=       "<option value='Cukup'>Cukup</option>"
        html +=       "<option value='Kurang'>Kurang</option>"
        }else if(data[index].membaca=='Cukup'){
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
        html +=    "<button type='button' class='btn btn-danger d-flex btnDel-bahasa' data-row='bahasabaris"+data_bahasa+"'>"
        html +=       "<span class='material-symbols-outlined'>delete</span>"
        html +=    "</button>"
        html+=  '</td>'
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
      // console.log(JSON.stringify(data[0]));
      var html=''
      for (let index = 0; index < data.length; index++) {
        var html  = "<tr id='baris_organisasi"+baris_organisasi+"' class='detail_organisasi'>"
        html +=   "<td style='width: 23.75%;'>"
        html +=     '<input class="form-control"  type="text" name="nama_organisasi[]"  value="'+data[index].namaOrg+'" maxlength="220">'
        html +=   "</td>" 
        html +=   "<td style='width: 23.75%;'>"
        html +=     '<input class="form-control"  type="text" name="kota_organisasi[]" value="'+data[index].kotaOrg+'" maxlength="220">'
        html +=   "</td>"
        html +=   "<td style='width: 23.75%;'>"
        html +=     '<input class="form-control"  type="text" name="jabatan_organisasi[]" value="'+data[index].jabatanOrg+'" maxlength="220">'
        html +=   "</td>" 
        html +=   "<td style='width: 23.75%;'>"
        html +=     '<input class="form-control"  type="text" name="tahun_organisasi[]" value="'+data[index].tahunOrg+'" maxlength="220">'
        html +=   "</td>" 
        html +=   "<td style='width: 5%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris_organisasi"+baris_organisasi+"' id='btnDelRow-organisasi'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"
      }
      $('#tbody_organisasi').append(html);
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
      for (let index = 0; index < data.length; index++) {
          html  += "<tr id='baris_kenal"+baris_kenal+"' class='detail_kenal'>"
          html +=   "<td style='width: 47.5%;'>"
          html +=     '<input class="form-control"  type="text" name="nama_kenal[]" maxlength="80" value="'+data[index].namaKenalan+'">'
          html +=   "</td>" 
          html +=   "<td style='width: 47.5%;'>"
          html +=     '<input class="form-control"  type="text" name="hubungan_kenal[]" maxlength="80" value="'+data[index].hubunganKenalan+'">'
          html +=   "</td>"
          html +=   "<td style='width: 5%;'>"
          html +=     "<button type='button' class='btn btn-danger' data-row='baris_kenal"+baris_kenal+"' id='btnDelRow-kenal'>"
          html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
          html +=     "</button>"
          html +=   "</td>"   
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
      for (let index = 0; index < data.length; index++) {
        html += '<tr id="baris_saudara"+baris_saudara+" class="detail_saudara">'
        html +=   '<td style="width: 19%;">'
        html +=     '<input class="form-control"  type="text" name="hubungan_saudarafarmasi[]" maxlength="220" value="'+data[index].hubunganKrbt+'" required>'
        html +=   '</td>' 
        html +=   '<td style="width: 19%;">'
        html +=     '<input class="form-control"  type="text" name="nama_saudarafarmasi[]" maxlength="220" value="'+data[index].namaKrbt+'" required>'
        html +=   '</td>' 
        html +=   '<td style="width: 19%;">'
        html +=     '<select class="form-control" id="LPsaudara" name="LP_saudarafarmasi[]" required>'
        html +=       '<option value="" disabled selected>L/P</option>'
        if (data[index].genderKrbt=="L") {
          html +=       '<option value="L" selected>L</option>'
          html +=       '<option value="P">P</option>'
        } else if(data[index].genderKrbt=="P") {
          html +=       '<option value="L">L</option>'
          html +=       '<option value="P"selected>P</option>'
        }
        html +=     '</select>'
        html +=   '</td>' 
        html +=   '<td style="width: 19%;">'
        html +=     '<input class="form-control"  type="text" name="perushaan_saudarafarmasi[]" maxlength="220" value="'+data[index].nmperusahaanKrbt+'" required>'
        html +=   '</td>'
        html +=   '<td style="width: 19%;">'
        html +=     '<input class="form-control"  type="text" name="jabatan_saudarafarmasi[]"maxlength="220" value="'+data[index].jabatanKrbt+'" required>'
        html +=   '</td>'
        html +=   '<td style="width: 5%;">'
        html +=     '<button type="button" class="btn btn-danger" data-row="baris_saudara"'+baris_saudara+'" id="btnDelRow-saudarafarmasi">'
        html +=       '<span class="material-symbols-outlined" style="font-size: 15px;">delete</span>' 
        html +=     '</button>'
        html +=   '</td>'   
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
      // console.log(JSON.stringify(data[0][0].statusKeluarga));
      // console.log(data[0][1].statusKeluarga)

      var ayahIbu=['Ayah', 'Ibu'];
      var i=0;
      var html=""
      html+='<div class="border-rw">'
      if (data[0].length>0) {
        for (let index = 0; index < ayahIbu.length;) {
          if (ayahIbu[index]==data[0][i].statusKeluarga) {
            html+='<div class="row">'
            html+=  '<div class="col-md-4">'
            html+=    '<label class="form-control-label">'+data[0][i].statusKeluarga+'</label>'
            html+=  '</div>'
            html+='</div>'

            html+='<div class="row">'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="nama">NAMA</label>'
            html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+data[0][i].namaKelurga+'">'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-2">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="usia">Usia</label>'
            html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+data[0][i].usiaKeluarga+'">'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-1">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="LP">L/P</label>'
            html+=      '<select class="form-control" id="LP" name="LP[]">'
            if (data[0][i].genderKeluarga=="L") {
            html+='<option value="L" selected>L</option>'
            html+='<option value="P">P</option>'
            } else if(data[0][i].genderKeluarga=="P") {
            html+='<option value="L" >L</option>'
            html+='<option value="P" selected>P</option>'
            }else{
            html+='<option value="" selected>L/P</option>'
            html+='<option value="L" >L</option>'
            html+='<option value="P">P</option>'
            }
            html+=      '</select>'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
            html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+data[0][i].pendidikanKeluarga+'">'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+data[0][i].perushaanKeluarga+'">'
            html+=    '</div>'
            html+=  '</div>'
            html+='</div>'
            if (i<data[0].length-1) {
              i++;
            }
            index++;
          }else {
            // console.log('bawah ',index,i)
            html+='<div class="row">'
            html+=  '<div class="col-md-4">'
            html+=    '<label class="form-control-label">'+ayahIbu[index]+'</label>'
            html+=  '</div>'
            html+='</div>'

            html+='<div class="row">'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="nama">NAMA</label>'
            html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-2">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="usia">Usia</label>'
            html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-1">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="LP">L/P</label>'
            html+=      '<select class="form-control" id="LP" name="LP[]">'
            html+='<option value="" selected>L/P</option>'
            html+='<option value="L" >L</option>'
            html+='<option value="P">P</option>'
            html+=      '</select>'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
            html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
            html+=    '</div>'
            html+=  '</div>'
            html+='</div>'
            index++;
          }
        }
      }else{
        ayahIbu.forEach(element => {
          html+='<div class="row">'
          html+=  '<div class="col-md-4">'
          html+=    '<label class="form-control-label">'+element+'</label>'
          html+=  '</div>'
          html+='</div>'

          html+='<div class="row">'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">NAMA</label>'
          html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-2">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="usia">Usia</label>'
          html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-1">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="LP">L/P</label>'
          html+=      '<select class="form-control" id="LP" name="LP[]">'
          html+='<option value="" selected>L/P</option>'
          html+='<option value="L" >L</option>'
          html+='<option value="P">P</option>'
          html+=      '</select>'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
          html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
          html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
          html+=    '</div>'
          html+=  '</div>'
          html+='</div>'
        })
      }
      // jalan keluarga
      if (data[5].length>0) {
        for (let index = 0; index < 1; index++) {
          html+='<div class="row">'
          html+=  '<div class="col-md-4">'
          html+=    '<label class="form-control-label">'+data[5][index].statusAlamat+'</label>'
          html+=  '</div>'
          html+='</div>'

          html+='<div class="row">'
          html+=  '<div class="col-md-5">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">alamat</label>'
          html+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" value="'+data[5][index].alamatKeluarga+'">'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">alamat</label>'
          html+=      '<input type="text" class="form-control" id="notlp" name="notlp[]" maxlength="45" value="'+data[5][index].tlpKeluarga+'">'
          html+=    '</div>'
          html+=  '</div>'
          html+='</div>'
        }
      } else {
        html+='<div class="row">'
          html+=  '<div class="col-md-4">'
          html+=    '<label class="form-control-label">Alamat Keluarga</label>'
          html+=  '</div>'
          html+='</div>'

          html+='<div class="row">'
          html+=  '<div class="col-md-5">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">alamat</label>'
          html+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" >'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">alamat</label>'
          html+=      '<input type="text" class="form-control" id="notlp" name="notlp[]" maxlength="45">'
          html+=    '</div>'
          html+=  '</div>'
          html+='</div>'
      }
      html+= '</div>'
      $('#kelaurga1').append(html);

      var html2=""
      html2+='<div class="border-rw">'
      if (data[2].length>0) {
      data[2].forEach(element => {
        html2+='<div class="row">'
        html2+=  '<div class="col-md-4">'
        html2+=    '<label class="form-control-label">'+element.statusKeluarga+'</label>'
        html2+=  '</div>'
        html2+='</div>'

        html2+='<div class="row">'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="nama">NAMA</label>'
        html2+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-2">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="usia">Usia</label>'
        html2+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-1">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="LP">L/P</label>'
        html2+=      '<select class="form-control" id="LP" name="LP[]">'
        if (element.genderKeluarga=="L") {
        html2+='<option value="L" selected>L</option>'
        html2+='<option value="P">P</option>'
        } else if(element.genderKeluarga=="P") {
        html2+='<option value="L" >L</option>'
        html2+='<option value="P" selected>P</option>'
        }else{
        html2+='<option value="" selected>L/P</option>'
        html2+='<option value="L" >L</option>'
        html2+='<option value="P">P</option>'
        }
        html2+=      '</select>'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        html2+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        html2+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+='</div>'
      });
      }
      for (let index = data[2].length; index < 4;) {
        index+=1;
        html2+='<div class="row">'
        html2+=  '<div class="col-md-4">'
        html2+=    '<label class="form-control-label">kaka/Adik'+index+'</label>'
        html2+=  '</div>'
        html2+='</div>'

        html2+='<div class="row">'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="nama">NAMA</label>'
        html2+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-2">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="usia">Usia</label>'
        html2+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-1">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="LP">L/P</label>'
        html2+=      '<select class="form-control" id="LP" name="LP[]">'
        html2+=         '<option value="" selected>L/P</option>'
        html2+=         '<option value="L" >L</option>'
        html2+=         '<option value="P">P</option>'
        html2+=      '</select>'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        html2+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        html2+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+='</div>'
      }
      html2+= '</div>'
      $('#kelaurga2').append(html2);

      var html3=""
      html3+='<div class="border-rw">'
      if (data[3].length>0) {
      data[3].forEach(element => {
        html3+='<div class="row">'
        html3+=  '<div class="col-md-4">'
        html3+=    '<label class="form-control-label">'+element.statusKeluarga+'</label>'
        html3+=  '</div>'
        html3+='</div>'

        html3+='<div class="row">'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="nama">NAMA</label>'
        html3+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-2">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="usia">Usia</label>'
        html3+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-1">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="LP">L/P</label>'
        html3+=      '<select class="form-control" id="LP" name="LP[]">'
        if (element.genderKeluarga=="L") {
        html3+='<option value="L" selected>L</option>'
        html3+='<option value="P">P</option>'
        } else if(element.genderKeluarga=="P") {
        html3+='<option value="L" >L</option>'
        html3+='<option value="P" selected>P</option>'
        }else{
        html3+='<option value="" selected>L/P</option>'
        html3+='<option value="L" >L</option>'
        html3+='<option value="P">P</option>'
        }
        html3+=      '</select>'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        html3+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        html3+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+='</div>'
      });
      }else{
        html3+='<div class="row">'
        html3+=  '<div class="col-md-4">'
        html3+=    '<label class="form-control-label">Suami/Istri</label>'
        html3+=  '</div>'
        html3+='</div>'

        html3+='<div class="row">'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="nama">NAMA</label>'
        html3+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-2">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="usia">Usia</label>'
        html3+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-1">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="LP">L/P</label>'
        html3+=      '<select class="form-control" id="LP" name="LP[]">'
        html3+=         '<option value="" selected>L/P</option>'
        html3+=         '<option value="L" >L</option>'
        html3+=         '<option value="P">P</option>'
        html3+=      '</select>'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        html3+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        html3+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+='</div>'
      }
      html3+= '</div>'
      $('#kelaurga3').append(html3);

      var html4=""
      html4+='<div class="border-rw">'
      if (data[4].length>0) {
      data[4].forEach(element => {
        html4+='<div class="row">'
        html4+=  '<div class="col-md-4">'
        html4+=    '<label class="form-control-label">'+element.statusKeluarga+'</label>'
        html4+=  '</div>'
        html4+='</div>'

        html4+='<div class="row">'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="nama">NAMA</label>'
        html4+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-2">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="usia">Usia</label>'
        html4+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-1">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="LP">L/P</label>'
        html4+=      '<select class="form-control" id="LP" name="LP[]">'
        if (element.genderKeluarga=="L") {
        html4+='<option value="L" selected>L</option>'
        html4+='<option value="P">P</option>'
        } else if(element.genderKeluarga=="P") {
        html4+='<option value="L" >L</option>'
        html4+='<option value="P" selected>P</option>'
        }else{
        html4+='<option value="" selected>L/P</option>'
        html4+='<option value="L" >L</option>'
        html4+='<option value="P">P</option>'
        }
        html4+=      '</select>'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        html4+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        html4+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+='</div>'
      });
      }
      for (let index = data[4].length; index < 4;) {
        index+=1;
        html4+='<div class="row">'
        html4+=  '<div class="col-md-4">'
        html4+=    '<label class="form-control-label">Anak'+index+'</label>'
        html4+=  '</div>'
        html4+='</div>'

        html4+='<div class="row">'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="nama">NAMA</label>'
        html4+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-2">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="usia">Usia</label>'
        html4+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-1">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="LP">L/P</label>'
        html4+=      '<select class="form-control" id="LP" name="LP[]">'
        html4+=         '<option value="" selected>L/P</option>'
        html4+=         '<option value="L" >L</option>'
        html4+=         '<option value="P">P</option>'
        html4+=      '</select>'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        html4+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        html4+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+='</div>'
      }
      html4+= '</div>'
      $('#kelaurga4').append(html4);

      var ayahIbumertua =['Ayah Mertua','Ibu Mertua']
      var j=0;
      var html5=""
      html5+='<div class="border-rw">'
      if (data[1].length>0) {
        for (let index = 0; index < ayahIbumertua.length;) {
          if (ayahIbumertua[index]==data[1][j].statusKeluarga) {
            // console.log(data[1][j].statusKeluarga)
            html5+='<div class="row">'
            html5+=  '<div class="col-md-4">'
            html5+=    '<label class="form-control-label">'+data[1][j].statusKeluarga+'</label>'
            html5+=  '</div>'
            html5+='</div>'

            html5+='<div class="row">'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="nama">NAMA</label>'
            html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+data[1][j].namaKelurga+'">'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-2">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="usia">Usia</label>'
            html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+data[1][j].usiaKeluarga+'">'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-1">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="LP">L/P</label>'
            html5+=      '<select class="form-control" id="LP" name="LP[]">'
            if (data[1][j].genderKeluarga=="L") {
            html5+='<option value="L" selected>L</option>'
            html5+='<option value="P">P</option>'
            } else if(data[1][j].genderKeluarga=="P") {
            html5+='<option value="L" >L</option>'
            html5+='<option value="P" selected>P</option>'
            }else{
            html5+='<option value="" selected>L/P</option>'
            html5+='<option value="L" >L</option>'
            html5+='<option value="P">P</option>'
            }
            html5+=      '</select>'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
            html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+data[1][j].pendidikanKeluarga+'">'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+data[1][j].perushaanKeluarga+'">'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+='</div>'
            if (j<data[1].length-1) {
              j++;
            }
            index++;
          }else {
            // console.log('bawah ',index,i)
            html5+='<div class="row">'
            html5+=  '<div class="col-md-4">'
            html5+=    '<label class="form-control-label">'+ayahIbumertua[index]+'</label>'
            html5+=  '</div>'
            html5+='</div>'

            html5+='<div class="row">'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="nama">NAMA</label>'
            html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-2">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="usia">Usia</label>'
            html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-1">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="LP">L/P</label>'
            html5+=      '<select class="form-control" id="LP" name="LP[]">'
            html5+='<option value="" selected>L/P</option>'
            html5+='<option value="L" >L</option>'
            html5+='<option value="P">P</option>'
            html5+=      '</select>'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
            html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+='</div>'
            index++;
          }
        }
      }else{
        ayahIbumertua.forEach(element => {
          html5+='<div class="row">'
          html5+=  '<div class="col-md-4">'
          html5+=    '<label class="form-control-label">'+element+'</label>'
          html5+=  '</div>'
          html5+='</div>'

          html5+='<div class="row">'
          html5+=  '<div class="col-md-3">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="nama">NAMA</label>'
          html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-2">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="usia">Usia</label>'
          html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-1">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="LP">L/P</label>'
          html5+=      '<select class="form-control" id="LP" name="LP[]">'
          html5+='<option value="" selected>L/P</option>'
          html5+='<option value="L" >L</option>'
          html5+='<option value="P">P</option>'
          html5+=      '</select>'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-3">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
          html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-3">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
          html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+='</div>'
        })
      }
      if (data[5].length>0) {
          html5+='<div class="row">'
          html5+=  '<div class="col-md-4">'
          html5+=    '<label class="form-control-label">'+data[5][1].statusAlamat+'</label>'
          html5+=  '</div>'
          html5+='</div>'

          html5+='<div class="row">'
          html5+=  '<div class="col-md-5">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="nama">alamat</label>'
          html5+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" value="'+data[5][1].alamatKeluarga+'">'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+='</div>'
      } else {
        html5+='<div class="row">'
          html5+=  '<div class="col-md-4">'
          html5+=    '<label class="form-control-label">Alamat Keluarga</label>'
          html5+=  '</div>'
          html5+='</div>'

          html5+='<div class="row">'
          html5+=  '<div class="col-md-5">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="nama">alamat</label>'
          html5+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" >'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+='</div>'
      }
      html5+= '</div>'
      $('#kelaurga5').append(html5);
    });
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
  id = $('#id_kandidatModal').val();
  today = new Date();
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
  //   console.log(JSON.stringify(data));
  // })
  // $('#tblSchedule').DataTable({
    
  //   "scrollY":        "400px",
  //   "scrollCollapse": true,
  //   pageLength : 5,
  //   ajax: {
  //   url: '/hrdats/detail/getschedule/kandidat/'+id,
  //           data:{},
  //           dataSrc:""
  //       },
  //   "paging":true,
  //   "bInfo" : false,
  //   "lengthChange": false,
  //   language: {
  //       paginate: {
  //           previous: "<i class='fas fa-angle-left'>",
  //           next: "<i class='fas fa-angle-right'>"
  //       }
  //   },
  //   columns: [
  //       {
  //           data: 'proses',
  //           defaultContent: ''
  //       },
  //       {
  //         data: 'created_at',
  //         defaultContent: 'NULL'
  //       },
  //       {
  //         data: 'Summary',
  //         defaultContent: 'NULL'
  //       },
  //       {
  //           defaultContent: '',
  //           render: (data, type, row, meta)=> {
  //             if (row.proses=='Apply') {
  //               return'NULL'
  //             } else {
  //               return '<button type="button" class="btn btn-info" onclick="Modal_notes(this)" data-toggle="modal" data-target=".modal-notes" value="'+row.id+'" data-statusp="'+row.proses+'">Note</button>'
  //             }
                
  //           }
  //       },
  //       {
  //         defaultContent: '',
  //         render: (data, type, row, meta)=> {
  //             if (row.proses=='Apply') {
  //               return 'NULL'
  //             } else {
  //               if (row.created_at<today) {
  //                 return '<button type="button" class="btn btn-info" onclick="Modal_sim(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'">Edit</button>'
  //               } else {
  //                 return '<button type="button" class="btn btn-info" onclick="Modal_sim(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'" disabled>Edit</button>'
  //               }
                
  //             }
  //         }
  //       }
  //   ],
  //   order: [[1, 'desc']]
  // }); 
}

function Modal_notes(obj){
  //buat tampilin judul notes
  statpro=$(obj).data("statusp")
  $('#titleNotes').text('Note for '+statpro)

  val = $(obj).val()
  $('#id_schedule').val(val);

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getschedule/notes/'+val,
      type: 'get'
  }).done((data) => {
    console.log(JSON.stringify(data));
    $('#notes').text(data[0].Notes);
    $("#summary").val(data[0].Summary);
  })
}

function create_schedule(){
    $('#btnAdd-schedule').on('click',function(){
      id_kandidat = $('#id_kandidat').val();
      id_Organisasi = $('#id_Organisasi').val();
      applyas = $('#applyas').val();
      schedule = $('#schedule').val();
      tglWaktu = $('#tglWaktu').val()
      ccTo =$("select[name='ccto[]']").map(function(){return $(this).val();}).get();
      // ----
      proses = $('#proses').val();
      // ol/on
      ol_link = $('#ol_link').val();
      ol_meetID = $('#ol_meetID').val();
      ol_pass = $('#ol_pass').val();
      ol_Br = $('#ol_Br').val();
      os_alamat = $('#os_alamat').val()
      os_ruangan = $('#os_ruangan').val()
      os_bertemu = $('#os_bertemu').val()

      //MCU
      mcu_nosurat = $('#mcu_nosurat').val()
      mcu_Durasi = $('#mcu_Durasi').val()
      mcu_lab = $('#mcu_lab').val()

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
            id_Organisasi:id_Organisasi,
            applyas:applyas,
            schedule:schedule,
            tglWaktu:tglWaktu,
            ccTo:ccTo,
            // proses
            proses:proses,
            // ol/off
            ol_link:ol_link,
            ol_meetID:ol_meetID,
            ol_pass:ol_pass,
            ol_Br:ol_Br,
            os_alamat:os_alamat,
            os_ruangan:os_ruangan,
            os_bertemu:os_bertemu,
            // MCU
            mcu_nosurat:mcu_nosurat,
            mcu_Durasi:mcu_Durasi,
            mcu_lab:mcu_lab
          }
        }).done((data) => {
          console.log(JSON.stringify(data));
      });
    });
}