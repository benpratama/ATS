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

  modal()
  getSchedule()
  onlineORonsite()
  create_schedule()
  $('#ccto').select2();
  $('#labMCU').select2();
  hidde();

  $('#schedule, #proses').on('change',function(){tampilin_email()})
  $('#schedule, #proses').on('change',function(){modalInformasi()})
});


function modal(){
  $('.modal-tambah-schedule').on('show.bs.modal', function() {
    $('#schedule').val('');
    $('#proses').val('');
    $('#onlineonsite').attr('hidden',false)
    $('#btnAdd-schedule').attr('hidden',false);
    hidde()
    $('#tglWaktu').val('');
    $('#ccto').val(null).trigger('change');
    $('#konten').val('')

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
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" value="'+data[0][i].namaSekolah+'" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" value="'+data[0][i].namaSekolah+'"></td>'
            }
            
            if (pendidikans[index]=='SMA') {
              html+='<td>'
              if (data[3]==true) {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45" disabled>'
              } else {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              }
             
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
              if (data[3]==true) {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45" disabled>'
              } else {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              }
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
              if (data[3]==true) {
                html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45" value="'+data[0][i].jurusan+'" disabled></td>'
              } else {
                html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45" value="'+data[0][i].jurusan+'"></td>'
              }
              
            }
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45" value="'+data[0][i].kota+'"disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45" value="'+data[0][i].kota+'"></td>'
            }
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45" value="'+data[0][i].tahun+'" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45" value="'+data[0][i].tahun+'"></td>'
            }
            
            html+='</tr>'
            index++
            if (i<data[0].length-1) {
              i+=1;
            }
          }else{
            html+='<tr>'
            html+=  '<td>'+pendidikans[index]+'</td>'
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45"></td>'
            }
            
            if (pendidikans[index]=='SMA') {
              html+='<td>'
              if (data[3]==true) {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45" disabled>'
              } else {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              }
              
              html+=    '<option value="" selected>jurusan</option>'
              data[1].forEach(element => {
                html+= '<option value="'+element.nama+'">'+element.nama+'</option>'
              });
            html+=  '</select>'
            html+='</td>'
            } else if(pendidikans[index]=='Akademi') {
              html+='<td>'
              if (data[3]==true) {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45" disabled>'
              }else{
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              }
              
              html+=    '<option value="" selected>jurusan</option>'
              data[2].forEach(element => {
                  html+= '<option value="'+element.nama+'">'+element.nama+'</option>'
              });
              html+=  '</select>'
              html+='</td>'
            }else{
              if (data[3]==true) {
                html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45" disabled></td>'
              } else {
                html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
              }
              
            }
            // html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45"></td>'
            }
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45"></td>'
            }
            html+='</tr>'
            index++
          }
        }else{
          html+='<tr>'
            html+=  '<td>'+pendidikans[index]+'</td>'
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" ></td>'
            }
           
            if (pendidikans[index]=='SMA') {
              html+='<td>'
              if (data[3]==true) {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45" disabled>'
              } else {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              }
              
              html+=    '<option value="" selected>jurusan</option>'
              data[1].forEach(element => {
                html+= '<option value="'+element.id+'">'+element.nama+'</option>'
              });
            html+=  '</select>'
            html+='</td>'
            } else if(pendidikans[index]=='Akademi') {
              html+='<td>'
              if (data[3]==true) {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45" disabled>'
              } else {
                html+=  '<select class="form-control" id="jurusan[]" name="jurusan[]" maxlength="45">'
              }
              
              html+=    '<option value="" selected>jurusan</option>'
              data[2].forEach(element => {
                  html+= '<option value="'+element.id+'">'+element.nama+'</option>'
              });
              html+=  '</select>'
              html+='</td>'
            }else{
              if (data[3]) {
                html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45" disabled></td>'
              } else {
                html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
              }
              
            }
            // html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45"></td>'
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45"></td>'
            }
            if (data[3]==true) {
              html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45" disabled></td>'
            } else {
              html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45"></td>'
            }
            html+='</tr>'
            index++
        }
        
      }
      $('#tbody_pendidikan').append(html);
    })
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
          html+=        '<input class="form-control" id="checkrow'+data_pekerjaan+'"  type="date" name="end_perusahaan[]" maxlength="220" value="'+element.endPerushaan+'" >'
        }
        
        html +=       "<div class='form-check'>"
        if (data[1]==true) {
          html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"' disabled>"
        } else {
          html +=         "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_pekerjaan+"'>"
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
      // console.log(JSON.stringify(data));
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
          if (element.id==data[0][index]['sim']) {
            html+='<option value="'+element.id+'"selected>'+element.nama+'</option>'
          }else{
            html+='<option value="'+element.id+'">'+element.nama+'</option>'
          }
        });
        html+=    '</select>'
        html+=  '</td>'
        html+=  '<td>'
        if (data[2]==true) {
          html+=    '<input name="nosim[]" class="form-control" type="text" value="'+data[0][index]['nosim']+'"required disabled >'
        } else {
          html+=    '<input name="nosim[]" class="form-control" type="text" value="'+data[0][index]['nosim']+'"required >'
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
      // console.log(JSON.stringify(data));
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
            if (data[6]==true) {
              html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+data[0][i].namaKelurga+'" disabled>'
            } else {
              html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+data[0][i].namaKelurga+'">'
            }
            html+=    '</div>'

            html+=  '</div>'
            html+=  '<div class="col-md-2">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="usia">Usia</label>'
            if (data[6]==true) {
              html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+data[0][i].usiaKeluarga+'" disabled>'
            } else {
              html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+data[0][i].usiaKeluarga+'">'
            }
            
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-1">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="LP">L/P</label>'
            if (data[6]==true) {
              html+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
            } else {
              html+=      '<select class="form-control" id="LP" name="LP[]">'
            }
    
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
            if (data[6]==true) {
              html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+data[0][i].pendidikanKeluarga+'" disabled>'
            } else {
              html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+data[0][i].pendidikanKeluarga+'">'
            }
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            if (data[6]==true) {
              html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+data[0][i].perushaanKeluarga+'" disabled>'
            } else {
              html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+data[0][i].perushaanKeluarga+'">'
            }
            
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
            if (data[6]==true) {
              html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
            } else {
              html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
            }
            
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-2">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="usia">Usia</label>'
            if (data[6]==true) {
              html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
            } else {
              html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
            }
            
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-1">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="LP">L/P</label>'
            if (data[6]==true) {
              html+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
            } else {
              html+=      '<select class="form-control" id="LP" name="LP[]">'
            }
            
            html+='<option value="" selected>L/P</option>'
            html+='<option value="L" >L</option>'
            html+='<option value="P">P</option>'
            html+=      '</select>'
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
            if (data[6]==true) {
              html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
            } else {
              html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
            }
            
            html+=    '</div>'
            html+=  '</div>'
            html+=  '<div class="col-md-3">'
            html+=    '<div class="form-group">'
            html+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            if (data[6]==true) {
              html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
            } else {
              html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
            }
            
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
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
          }
          
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-2">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="usia">Usia</label>'
          if (data[6]==true) {
            html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
          } else {
            html+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
          }
          
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-1">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="LP">L/P</label>'
          if (data[6]==true) {
            html+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
          } else {
            html+=      '<select class="form-control" id="LP" name="LP[]">'
          }
          
          html+='<option value="" selected>L/P</option>'
          html+='<option value="L" >L</option>'
          html+='<option value="P">P</option>'
          html+=      '</select>'
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
          }
          
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
          }
          
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
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" value="'+data[5][index].alamatKeluarga+'" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" value="'+data[5][index].alamatKeluarga+'">'
          }
          
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">alamat</label>'
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="notlp" name="notlp[]" maxlength="45" value="'+data[5][index].tlpKeluarga+'" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="notlp" name="notlp[]" maxlength="45" value="'+data[5][index].tlpKeluarga+'">'
          }
          
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
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" >'
          }
          
          html+=    '</div>'
          html+=  '</div>'
          html+=  '<div class="col-md-3">'
          html+=    '<div class="form-group">'
          html+=      '<label class="form-control-label" for="nama">alamat</label>'
          if (data[6]==true) {
            html+=      '<input type="text" class="form-control" id="notlp" name="notlp[]" maxlength="45" disabled>'
          } else {
            html+=      '<input type="text" class="form-control" id="notlp" name="notlp[]" maxlength="45">'
          }
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
        if (data[6]==true) {
          html2+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'" disabled>'
        } else {
          html2+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'">'
        }
        
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-2">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="usia">Usia</label>'
        if (data[6]==true) {
          html2+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'"- disabled>'
        } else {
          html2+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'">'
        }
        
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-1">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="LP">L/P</label>'
        if (data[6]==true) {
          html2+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
        } else {
          html2+=      '<select class="form-control" id="LP" name="LP[]">'
        }
        
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
        if (data[6]==true) {
          html2+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'" disabled>'
        } else {
          html2+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'">'
        }
        
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        if (data[6]==true) {
          html2+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'" disabled>'
        } else {
          html2+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'">'
        }
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
        if (data[6]==true) {
          html2+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
        } else {
          html2+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
        }
        
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-2">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="usia">Usia</label>'
        if (data[6]==true) {
          html2+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
        } else {
          html2+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">'
        }
        
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-1">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="LP">L/P</label>'
        if (data[6]==true) {
          html2+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
        } else {
          html2+=      '<select class="form-control" id="LP" name="LP[]">'
        }
        
        html2+=         '<option value="" selected>L/P</option>'
        html2+=         '<option value="L" >L</option>'
        html2+=         '<option value="P">P</option>'
        html2+=      '</select>'
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        if (data[6]==true) {
          html2+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
        } else {
          html2+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90">'
        }
        
        html2+=    '</div>'
        html2+=  '</div>'
        html2+=  '<div class="col-md-3">'
        html2+=    '<div class="form-group">'
        html2+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        if (data[6]==true) {
          html2+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
        } else {
          html2+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
        }
        
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
        if (data[6]==true) {
          html3+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'" disabled>'
        } else {
          html3+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'">'
        }
        
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-2">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="usia">Usia</label>'
        if (data[6]==true) {
          html3+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'" disabled>'
        } else {
          html3+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'">'
        }
        
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-1">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="LP">L/P</label>'
        if (data[6]==true) {
          html3+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
        } else {
          html3+=      '<select class="form-control" id="LP" name="LP[]">'
        }

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
        if (data[6]==true) {
          html3+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'" disabled>'
        } else {
          html3+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'">'
        }
        
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        if (data[6]==true) {
          html3+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'" disabled>'
        } else {
          html3+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'">'
        }
        
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
        if (data[6]==true) {
          html3+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
        } else {
          html3+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90">'
        }
        
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-2">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="usia">Usia</label>'
        if (data[6]==true) {
          html3+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
        } else {
          html3+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">'
        }
        
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-1">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="LP">L/P</label>'
        if (data[6]==true) {
          html3+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
        } else {
          html3+=      '<select class="form-control" id="LP" name="LP[]">'
        }
        
        html3+=         '<option value="" selected>L/P</option>'
        html3+=         '<option value="L" >L</option>'
        html3+=         '<option value="P">P</option>'
        html3+=      '</select>'
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        if (data[6]==true) {
          html3+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
        } else {
          html3+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90">'
        }
        
        html3+=    '</div>'
        html3+=  '</div>'
        html3+=  '<div class="col-md-3">'
        html3+=    '<div class="form-group">'
        html3+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        if (data[6]==true) {
          html3+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
        } else {
          html3+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
        }
        
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
        if (data[6]==true) {
          html4+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'" disabled>'
        } else {
          html4+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+element.namaKelurga+'">'
        }
        
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-2">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="usia">Usia</label>'
        if (data[6]==true) {
          html4+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'" disabled>'
        } else {
          html4+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+element.usiaKeluarga+'">'
        }
        
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-1">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="LP">L/P</label>'
        if (data[6]==true) {
          html4+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
        } else {
          html4+=      '<select class="form-control" id="LP" name="LP[]">'
        }
        
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
        if (data[6]==true) {
          html4+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'" disabled>'
        } else {
          html4+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+element.pendidikanKeluarga+'">'
        }
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        if (data[6]==true) {
          html4+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'" disabled>'
        } else {
          html4+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+element.perushaanKeluarga+'">'
        }
        
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
        if (data[6]==true) {
          html4+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
        } else {
          html4+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
        }
        
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-2">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="usia">Usia</label>'
        if (data[6]==true) {
          html4+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
        } else {
          html4+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200">'
        }
        
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-1">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="LP">L/P</label>'
        if (data[6]==true) {
          html4+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
        } else {
          html4+=      '<select class="form-control" id="LP" name="LP[]">'
        }
        
        html4+=         '<option value="" selected>L/P</option>'
        html4+=         '<option value="L" >L</option>'
        html4+=         '<option value="P">P</option>'
        html4+=      '</select>'
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
        if (data[6]==true) {
          html4+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
        } else {
          html4+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90">'
        }
        
        html4+=    '</div>'
        html4+=  '</div>'
        html4+=  '<div class="col-md-3">'
        html4+=    '<div class="form-group">'
        html4+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
        if (data[6]==true) {
          html4+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
        } else {
          html4+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
        }
        
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
            if (data[6]==true) {
              html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+data[1][j].namaKelurga+'" disabled>'
            } else {
              html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" value="'+data[1][j].namaKelurga+'">'
            }
            
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-2">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="usia">Usia</label>'
            if (data[6]==true) {
              html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+data[1][j].usiaKeluarga+'" disabled>'
            } else {
              html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" value="'+data[1][j].usiaKeluarga+'">'
            }
            
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-1">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="LP">L/P</label>'
            if (data[6]==true) {
              html5+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
            } else {
              html5+=      '<select class="form-control" id="LP" name="LP[]">'
            }
            
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
            if (data[6]==true) {
              html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+data[1][j].pendidikanKeluarga+'" disabled>'
            } else {
              html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" value="'+data[1][j].pendidikanKeluarga+'">'
            }
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            if (data[6]==true) {
              html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+data[1][j].perushaanKeluarga+'" disabled>'
            } else {
              html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" value="'+data[1][j].perushaanKeluarga+'">'
            }
            
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
            if (data[6]==true) {
              html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
            } else {
              html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
            }
            
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-2">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="usia">Usia</label>'
            if (data[6]==true) {
              html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
            } else {
              html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
            }
            
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-1">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="LP">L/P</label>'
            if (data[6]==true) {
              html5+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
            } else {
              html5+=      '<select class="form-control" id="LP" name="LP[]">'
            }
            
            html5+='<option value="" selected>L/P</option>'
            html5+='<option value="L" >L</option>'
            html5+='<option value="P">P</option>'
            html5+=      '</select>'
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
            if (data[6]==true) {
              html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
            } else {
              html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
            }
            
            html5+=    '</div>'
            html5+=  '</div>'
            html5+=  '<div class="col-md-3">'
            html5+=    '<div class="form-group">'
            html5+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
            if (data[6]==true) {
              html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
            } else {
              html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
            }
            
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
          if (data[6]==true) {
            html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" disabled>'
          } else {
            html5+=      '<input type="text" class="form-control" id="nama" name="nama[]" maxlength="90" >'
          }
          
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-2">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="usia">Usia</label>'
          if (data[6]==true) {
            html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" disabled>'
          } else {
            html5+=      '<input type="number" class="form-control" id="usia" name="usia[]" min="0" max="200" >'
          }
          
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-1">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="LP">L/P</label>'
          if (data[6]==true) {
            html5+=      '<select class="form-control" id="LP" name="LP[]" disabled>'
          } else {
            html5+=      '<select class="form-control" id="LP" name="LP[]">'
          }
          
          html5+='<option value="" selected>L/P</option>'
          html5+='<option value="L" >L</option>'
          html5+='<option value="P">P</option>'
          html5+=      '</select>'
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-3">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="pendidikan">PENDIDIKAN</label>'
          if (data[6]==true) {
            html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" disabled>'
          } else {
            html5+=      '<input type="text" class="form-control" id="pendidikan" name="pendidikan[]" maxlength="90" >'
          }
          html5+=    '</div>'
          html5+=  '</div>'
          html5+=  '<div class="col-md-3">'
          html5+=    '<div class="form-group">'
          html5+=      '<label class="form-control-label" for="namaperushaan">Perusahaan</label>'
          if (data[6]==true) {
            html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90" disabled>'
          } else {
            html5+=      '<input type="text" class="form-control" id="namaperushaan" name="namaperushaan[]" maxlength="90">'
          }
          
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
          if (data[6]==true) {
            html5+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" value="'+data[5][1].alamatKeluarga+'" disabled>'
          } else {
            html5+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" value="'+data[5][1].alamatKeluarga+'">'
          }
          
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
          if (data[6]==true) {
            html5+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" disabled>'
          } else {
            html5+=      '<input type="text" class="form-control" id="alamt" name="alamat[]" maxlength="1000" >'
          }
          
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
  id = $('#id_kandidat').val();
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

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getschedule/kandidat/'+id,
      type: 'get'
  }).done((data) => {
    // console.log(JSON.stringify(data));
  })
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
                return 'sdh terkirim'
              } else {
                return 'blm terkirim'
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
    order: [[1, 'desc']]
  }); 
}

function Modal_notes(id){
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
    if (data[0].Summary!=null && data[0].notes!=null ) {
      $('#notes').val(data[0].notes);
      $("#summary").val(data[0].Summary);
    }
  })

  $('#btn-notes').on('click',function(){
    notes = $('#notes').val()
    summary = $('#summary').val();

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

      $('.modal-tambah-schedule').modal('show');
      $('#informasi1 :input').attr('readonly',true)
      $('#btnAdd-schedule').attr('hidden',true);
      $('#f_ccto').attr('hidden',true);
      $('#tglWaktu').attr('readonly',true)
      $('#schedule').attr('readonly',true);
      $('#proses').attr('readonly',true);
      var schedule=data[0].id_Rekrutmen;
      var online=data[0].jenis;
      $('#schedule').val(schedule)
      $('#proses').val(online)
      if (schedule==2) {
        detail = JSON.parse(data[0].test)
        durasi_raw = detail.durasi
        durasi = durasi_raw.replace(" jam","")
        online=0

        $('#MCU').show();
        $('#onlineonsite').attr('hidden',true)
        $('#mcu_Durasi').val(durasi)
        $('#mcu_lab').val(detail.id_lab)
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

        $('#interviewHR_1').show()
        $('#interviewHR_1_Link').val(detail.interviewHR_1_Link)
        $('#interviewHR_1_MeetingID').val(detail.interviewHR_1_MeetingID)
        $('#interviewHR_1_Passcode').val(detail.interviewHR_1_Passcode)
        $('#interviewHR_1_BR').val(detail.interviewHR_1_BR)

      }else if(schedule==6 && online==1){
        detail = JSON.parse(data[0].test)

        $('#interviewuser_1').show()
        interviewuser_1_Link = $('#interviewuser_1_Link').val(detail.interviewuser_1_Link)
        interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val(detail.interviewuser_1_MeetingID)
        interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val(detail.interviewuser_1_Passcode)
        interviewuser_1_BR = $('#interviewuser_1_BR').val(detail.interviewuser_1_BR)

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
      }
      $('#btnEmail').attr('value',id)
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

      $('.modal-tambah-schedule').modal('show');
      $('#btnAdd-schedule').attr('hidden',true);
      $('#btnUpdate-schedule').attr('hidden',false);
      $('#schedule').attr('readonly',true);
      $('#proses').attr('readonly',true);
      $('#btnUpdate-schedule').attr('value',id);
      var schedule=data[0].id_Rekrutmen;
      var online=data[0].jenis;
      $('#schedule').val(schedule)
      $('#proses').val(online)
      if (schedule==2) {
        detail = JSON.parse(data[0].test)
        durasi_raw = detail.durasi
        durasi = durasi_raw.replace(" jam","")
        online=0

        $('#MCU').show();
        $('#onlineonsite').attr('hidden',true)
        $('#mcu_Durasi').val(durasi)
        $('#mcu_lab').val(detail.id_lab)
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

        $('#interviewHR_1').show()
        $('#interviewHR_1_Link').val(detail.interviewHR_1_Link)
        $('#interviewHR_1_MeetingID').val(detail.interviewHR_1_MeetingID)
        $('#interviewHR_1_Passcode').val(detail.interviewHR_1_Passcode)
        $('#interviewHR_1_BR').val(detail.interviewHR_1_BR)

      }else if(schedule==6 && online==1){
        detail = JSON.parse(data[0].test)

        $('#interviewuser_1').show()
        interviewuser_1_Link = $('#interviewuser_1_Link').val(detail.interviewuser_1_Link)
        interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val(detail.interviewuser_1_MeetingID)
        interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val(detail.interviewuser_1_Passcode)
        interviewuser_1_BR = $('#interviewuser_1_BR').val(detail.interviewuser_1_BR)

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
      }
      $('#btnEmail').attr('value',id)
      $('#tglWaktu').val(data[0].jadwal)
      if (data[0].ccEmail!=null) {
        emails=data[0].ccEmail
        var listemail = emails.split(",")
        $('#ccto').val(listemail).change();
      }
      tampilin_email(schedule,online)
  });

  $('#btnUpdate-schedule').on('click',function(){
    var id=$('#btnUpdate-schedule').val()
    schedule = $('#schedule').val();
    ccTo =$("select[name='ccto[]']").map(function(){return $(this).val();}).get();
    tglWaktu = $('#tglWaktu').val()
    online = $('#proses').val();
    detail={}

    if (schedule==2) {
      Durasi = $('#mcu_Durasi').val() +' jam'
      id_lab = $('#mcu_lab').val();
      online=0;

      detail={durasi:Durasi,id_lab:id_lab}  
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
      ccTo =$("select[name='ccto[]']").map(function(){return $(this).val();}).get();
      tglWaktu = $('#tglWaktu').val()
      online = $('#proses').val();
      detail={}
      

      if (schedule==2) {
        Durasi = $('#mcu_Durasi').val() +' jam'
        id_lab = $('#mcu_lab').val();
        online=0;

        detail={durasi:Durasi,id_lab:id_lab}  
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
  $('#interviewHR_1').hide()
  $('#interviewuser_1').hide()
  $('.offer_1').hide()
  $('.offer_2').hide()

  $('#informasi1 .form-control').val('')  
  $('#informasi1 :input').attr('readonly',false)
  $('#f_ccto').attr('hidden',false);
  $('#tglWaktu').attr('readonly',false)
  $('#btnUpdate-schedule').attr('hidden',true);
  $('#schedule').attr('readonly',false);
  $('#proses').attr('readonly',false);
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
    }else{
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

  var list_onsite=['2']
  if (list_onsite.includes(schedule)==true) {
    online= 0
  }

  if (schedule==2  && online==0) {
    $('#MCU').show();
  } else if(schedule==3 && online==1) {
    $('#psikotest_1').show();
  }else if(schedule==3 && online==0) {
    $('#psikotest_0').show();
  }else if(schedule==4 && online==1){
    $('#test_1').show();
  }else if(schedule==4 && online==0){
    $('#test_0').show();
  }else if(schedule==5 && online==1){
    $('#interviewHR_1').show();
  }else if(schedule==6 && online==1){
    $('#interviewuser_1').show();
  }else if(schedule==9 && online==1){
    $('.offer_1').show();
  }else if(schedule==9 && online==2){
    $('.offer_2').show();
  }

  
}

function tampilin_email(_schedule=null,_online=null){
  // console.log(_schedule,_online)
  $('#konten').val('')
  schedule = $('#schedule').val();
  online = $('#proses').val();
  var list_onsite=['2']

  if (list_onsite.includes(schedule)==true) {
    online= 0
  }
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
        online:online
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
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
    tglWaktu = tglWaktuRaw.replace("T", " Waktu: ");
    id_kandidat = $('#id_kandidat').val();
    id_email=$('#btnEmail').val()
    data={}
    console.log(schedule);
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

      var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
      var konten = konten.replace('[POSITION]',posisi)
      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[LINK ZOOM]',interviewHR_1_Link)
      var konten = konten.replace('[MEETING IS]',interviewHR_1_MeetingID)
      var konten = konten.replace('[PASSCODE]',interviewHR_1_Passcode)
      var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewHR_1_BR)

      data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:id_email}
    }else if(schedule==6 && online==1){
      interviewuser_1_Link = $('#interviewuser_1_Link').val()
      interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
      interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
      interviewuser_1_BR = $('#interviewuser_1_BR').val()

      var konten = konten.replace('[CANDIDAT NAME]',namaKandidat)
      var konten = konten.replace('[POSITION]',posisi)
      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[LINK ZOOM]',interviewuser_1_Link)
      var konten = konten.replace('[MEETING IS]',interviewuser_1_MeetingID)
      var konten = konten.replace('[PASSCODE]',interviewuser_1_Passcode)
      var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewuser_1_BR)

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
    }

    // console.log(id_kandidat)
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/send/email',
        type: 'post',
        // data: {
        //   konten:konten,
        //   id_kandidat:id_kandidat,
        //   id_lab:id_lab,
        //   id_proses:id_proses
        // }
        data:data
      }).done((data) => {
        console.log(JSON.stringify(data));
        $('#tblSchedule').DataTable().ajax.reload();
        // $('#summernote').summernote('code', '');
        // $('#summernote').summernote('code', $(konten));
    });
  })
  

}
