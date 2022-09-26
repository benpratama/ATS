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
});

function gen_url(){
  $('#btnGen-url').on('click',function(){
    $('#urlphase2').val('')
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
        $('#urlphase2').val(host+'/form-kandidat/phase2/'+data)
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
      var html=''
      data.forEach(element => {
        // html+='<tr>'
        // html+=  '<td> <input type="text" class="form-control" name="pendidikan[]" maxlength="45" value="'+element.pendidikan+'" readonly></td>'
        // html+=  '<td><input type="text" class="form-control" name="namasekolah[]" maxlength="45" value="'+element.namaSekolah+'"></td>'
        // html+=  '<td><input type="text" class="form-control" name="jurusan[]" maxlength="45" value="'+element.jurusan+'"></td>'
        // html+=  '<td><input type="text" class="form-control" name="kota[]" maxlength="45" value="'+element.kota+'"></td>'
        // html+=  '<td><input type="text" class="form-control" name="tahun[]" maxlength="45" value="'+element.tahun+'"></td>'
        // html+='</tr>'
        html+='<tr>'
        html+=  '<td>'+element.pendidikan+'</td>'
        html+=  '<td>'+element.namaSekolah+'</td>'
        html+=  '<td>'+element.jurusan+'</td>'
        html+=  '<td>'+element.kota+'</td>'
        html+=  '<td>'+element.tahun+'</td>'
        html+='</tr>'
      });
      $('#tbody_pendidikan').append(html);
    })
}

function get_Pekerjaan(){
  id_kandidat = $('#id_kandidat').val();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/detail/getpekerjaan/kandidat/'+id_kandidat,
      type: 'get'
    }).done((data) => {
      console.log(JSON.stringify(data));
      var html=''
      data.forEach(element => {
        html+='<tr>'
        html+=  '<td><input class="form-control"  type="text" name="nama_perushaan[]" maxlength="220" value="'+element.namaPerusahaan+'"></td>'
        html+=  '<td>'
        // html+=    '<input class="form-control"  type="text" name="jenis_perusahaan[]" maxlength="220" value="'+element.jenisPerusahaan+'">'
        html+=      "<select class='form-control' id='status_perkawinan' name='jenis_perusahaan[]' required>"
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
        html +=     "</select>"
        html+=  '</td>'
        html+=  '<td><input class="form-control"  type="text" name="alamat_perusahaan[]" maxlength="220" value="'+element.alamatPerusahaan+'"></td>'
        html+=  '<td><input class="form-control"  type="text" name="jabatan_perusahaan[]" maxlength="220" value="'+element.jabatanPerusahaan+'"></td>'
        html+=  '<td><input class="form-control"  type="text" name="atasan_perusahaan[]" maxlength="220" value="'+element.atasanPerusahaan+'"></td>'
        html+=  '<td><input class="form-control"  type="date" name="start_perusahaan[]" maxlength="220" value="'+element.startPerushaan+'"></td>'
        html+=  '<td><input class="form-control"  type="date" name="end_perusahaan[]" maxlength="220" value="'+element.endPerushaan+'"></td>'
        html+='</tr>'
      });
      $('#tbody_pekerjaan').append(html);
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
      // console.log(JSON.stringify(data[0][0]['nosim']));
      var html=''
      for (let index = 0; index < data[0].length; index++) {
        data_sim+=1;
        // console.log("datasim1= "+data_sim)
        html+='<tr class="simbaris'+data_sim+'">'
        html+=  '<td>'
        html+=    '<select name="sim[]" class="form-control">'
        data[1].forEach(element => {
          if (element.id==data[0][index]['sim']) {
            html+='<option value="'+element.nama+'"selected>'+element.nama+'</option>'
          }else{
            html+='<option value="'+element.nama+'">'+element.nama+'</option>'
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
        html+=      '<option value="'+element.nama+'">'+element.nama+'</option>'
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