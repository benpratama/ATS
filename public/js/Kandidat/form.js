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
  AddDelSIM()
  hideSIM();
  $('#kota1').select2();
  $('#kodepos').select2();
  $('#kota_koresponden').select2();
  $('#kodepos_koresponden').select2();
  $('#tempatlahir').select2();
  getPostCode();
  Row_perushaan();
  numberWithCommas();
  validatesize();

  /**PROINT */
  list_tlp()
  list_email()
  AddDelPendidikan()
  AddDelRiwayat();
  checkRiwayat();
});

// const options = {
//   enableHighAccuracy: true,
//   timeout: 5000,
//   maximumAge: 0
// };

// function success(pos) {
//   const crd = pos.coords;
//   if (crd.latitude!=null && crd.longitude!=null) {
//     $('#frm').removeAttr('hidden');
//     // $('#ntf').attr("hidden",true);
//     console.log(`Latitude : ${crd.latitude}`);
//     console.log(`Longitude: ${crd.longitude}`);
//   }
//   // console.log('Your current position is:');
//   // console.log(`Latitude : ${crd.latitude}`);
//   // console.log(`Longitude: ${crd.longitude}`);
//   // console.log(`More or less ${crd.accuracy} meters.`);
// }

// function error(err) {
//   // console.warn(`ERROR(${err.code}): ${err.message}`);
//   $('#ntf').removeAttr('hidden');
//   // $('#frm').attr("hidden",true);
// }

// navigator.geolocation.getCurrentPosition(success, error, options);

// data_sim =1;
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
//         html +=       "<input type='text' class='form-control nosim' data-row='"+data_sim+"' name='nosim[]' maxlength='45'>"
//         html +=     "</div>"
//         html +=   "</div>"
//         html +=   "<div class='col-md-2'>"
//         html +=     "<div class='form-group'>"
//         html +=       "<button id='btnDel-sim' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='simbaris"+data_sim+"'>"
//         html +=         "<span class='material-symbols-outlined'>delete</span>"
//         html +=         "<span class='gap-logo'>Hapus</span>"
//         html +=       "</button>"
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
  $('#kota1').on('change',function(){
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

var baris_perusahaan=0
function Row_perushaan(){
  $('#btnAddRow-perusahaan').on('click',function(){
    baris_perusahaan+=1;
    
    var html  = "<tr id='baris"+baris_perusahaan+"' class='detail-perusahaan'>"
        html +=   "<td style='width: 17.25%;'>"
        html +=     "<input class='form-control'  type='text' name='nama_perushaan[]' maxlength='220'>"
        html +=   "</td>" 
        html +=   "<td style='width: 10%;'>"
        html +=     "<select class='form-control' id='status_perkawinan' name='jenis_perusahaan[]' required>"
        html +=       "<option value='' disabled selected>Jenis Perusahaan</option>"
        html +=       "<option value='Farmasi'>Farmasi</option>"
        html +=       "<option value='Bukan Farmasi'>Bukan Farmasi</option>"
        html +=     "</select>"
        html +=   "</td>" 
        html +=   "<td style='width: 17.25%;'>"
        html +=     "<input class='form-control' type='text' name='alamat_perusahaan[]' maxlength='220'>"
        html +=   "</td>"
        html +=   "<td style='width: 17.25%;'>"
        html +=     "<input class='form-control' type='text' name='jabatan_perusahaan[]' maxlength='220'>"
        html +=   "</td>"
        html +=   "<td style='width: 17.25%;'>"
        html +=     "<input class='form-control' type='text' name='atasan_perusahaan[]' maxlength='220'>"
        html +=   "</td>" 
        html +=   "<td style='width: 8%;'>"
        html +=     "<input class='form-control' type='date' name='start_perusahaan[]'>"
        html +=   "</td>"
        html +=   "<td style='width: 8%;'>"
        html +=     "<input class='form-control' type='date' name='end_perusahaan[]' id='checkrow"+baris_perusahaan+"'>"
        html +=     "<div class='form-check'>"
        html +=        "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+baris_perusahaan+"'>"
        html +=        "<label class='form-check-label' for='checkclose'> Sampai Sekarang </label>"
        html +=     "</div>"
        html +=   "</td>"   
        html +=   "<td style='width: 2%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_perusahaan+"' id='btnDelRow-perusahaan'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"
    // var html  = "<tr id='baris"+baris_perusahaan+"' class='detail-perusahaan'>"
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control'  type='text' name='nama_perushaan[]' maxlength='220'>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<select class='form-control' id='status_perkawinan' name='jenis_perusahaan[]' required>"
    //     html +=       "<option value='' disabled selected>Jenis Perusahaan</option>"
    //     html +=       "<option value='Farmasi'>Farmasi</option>"
    //     html +=       "<option value='Bukan Farmasi'>Bukan Farmasi</option>"
    //     html +=     "</select>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control' type='text' name='alamat_perusahaan[]' maxlength='220'>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control' type='text' name='jabatan_perusahaan[]' maxlength='220'>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control' type='text' name='atasan_perusahaan[]' maxlength='220'>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control' type='number' name='lama_perusahaan[]' min='1' max='10000'>"
    //     html +=   "</td>"   
    //     html +=   "<td style='width: 5%;'>"
    //     html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_perusahaan+"' id='btnDelRow-perusahaan'>"
    //     html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
    //     html +=     "</button>"
    //     html +=   "</td>"   
    //     html +="</tr>"

    $('#TblPerushaan').append(html);
    })
    
    $(document).on('click','#btnDelRow-perusahaan',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
    })

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

function notif(){
  Swal.fire({
    title: 'File terlalu besar, max size 5MB',
    showClass: {
      popup: 'animate__animated animate__fadeInDown'
    },
    hideClass: {
      popup: 'animate__animated animate__fadeOutUp'
    }
  })
}

function validatesize(){
  $('#gambarkedudukan').bind('change', function() {
    var _size = this.files[0].size;
    var size=_size;
    var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
    i=0;while(_size>900){_size/=1024;i++;}
    var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        console.log('FILE SIZE = ',exactSize);
        
    if(size>5000000){
      $('#gambarkedudukan').val('');
      notif();
    }
  });
  $('#cv').bind('change', function() {
    var _size = this.files[0].size;
    var size=_size;
    var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
    i=0;while(_size>900){_size/=1024;i++;}
    var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        console.log('FILE SIZE = ',exactSize);
        
    if(size>5000000){
      $('#cv').val('');
      notif();
    }
  });
  $('#foto').bind('change', function() {
    var _size = this.files[0].size;
    var size=_size;
    var fSExt = new Array('Bytes', 'KB', 'MB', 'GB'),
    i=0;while(_size>900){_size/=1024;i++;}
    var exactSize = (Math.round(_size*100)/100)+' '+fSExt[i];
        console.log('FILE SIZE = ',exactSize);
        
    if(size>5000000){
      $('#foto').val('');
      notif();
    }
  });
}

var baris_tlp=1
function list_tlp(){
  /**AddDel Tlp */
  $('#btnAdd-notlp').on('click',function(){
    baris_tlp+=1;
    var html=''

    html +="<div class='row' id='tlp"+baris_tlp+"'>"

    html +=   "<div class='col-md-2'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='notlp'>Tipe</label>"
    html +=       "<select class='form-control' id='tipe_Tlp' name='tipe_Tlp[]' data-rowattr='attr_tlp"+baris_tlp+"' required>"
    html +=         "<option value='' disabled selected>Tipe Tlp</option>"
    html +=         "<option value='H'>Rumah</option>"
    html +=         "<option value='P'>Seluler</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-1 attr_tlp"+baris_tlp+"'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='notlp'>Area*</label>"
    html +=       "<input type='text' class='form-control' id='Area_Tlp' name='Area_Tlp[]' maxlength='45' required>"
    html +=     "</div>"
    html +=   "</div>"
    
    html +=   "<div class='col-md-2'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='notlp'>Nomer Tlp*</label>"
    html +=       "<input type='text' class='form-control' id='no_Tlp' name='no_Tlp[]' maxlength='45' required>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-1'>"
    html +=     "<div class='form-group'>"
    html +=       "<button id='btnDel-tlp' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='tlp"+baris_tlp+"'>"
    html +=         "<span class='material-symbols-outlined'>delete</span>"
    html +=       "</button>"
    html +=     "</div>"
    html +=   "</div>"
    
    html +="</div>"

    $('#list_tlp').append(html);
  })

  $(document).on('click','#btnDel-tlp',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })

  /**hide Area */
  $(document).on('change','#tipe_Tlp',function(){
    var value = $(this).val();
    var obj = $(this).data('rowattr');
    console.log(obj)
    if (value=="P" || value=="") {
      console.log(obj)
      $('.'+obj).attr('hidden',true)
      $('.'+obj+' :input').prop('required',false);
      $('.'+obj+' :input').val('')
    }else{
      $('.'+obj+' :input').prop('required',true);
      $('.'+obj).attr('hidden',false)
    }
  })
}

var baris_email=1
function list_email(){
  $('#btnAdd-email').on('click',function(){
    baris_email+=1;
    var html =''

    html +="<div class='row' id='email"+baris_email+"'>"

    html +=   "<div class='col-md-1'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='email'>Tipe</label>"
    html +=       "<select class='form-control' id='tipe_Tlp' name='tipe_Email[]' required>"
    html +=         "<option value='' disabled selected>Tipe Email</option>"
    html +=         "<option value='C'>Corp</option>"
    html +=         "<option value='P'>Pribadi</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='email'>Email</label>"
    html +=       "<input type='email' class='form-control' id='email' name='email[]' maxlength='45' required>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-1'>"
    html +=     "<div class='form-group'>"
    html +=       "<button id='btnDel-email' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='email"+baris_email+"'>"
    html +=         "<span class='material-symbols-outlined'>delete</span>"
    html +=       "</button>"
    html +=     "</div>"

    html +="</div>"

    $('#list_email').append(html);
  })

  $(document).on('click','#btnDel-email',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}

data_sim = 1;
function AddDelSIM(){
  $('#btnAdd-sim').on('click',function(){
    data_sim+=1;
    var html=''
    // $.ajaxSetup({
    //   headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });
    // $.ajax({
    //   _token: '{{ csrf_token() }}',
    //   url: '/form-kandidat/get/sim',
    //   type: 'get'
    // }).done((data) => {
      // console.log(JSON.stringify(data));
    html  ="<div class='row' id='sim"+data_sim+"'>"
    html +=   "<div class='col-md-2'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='SIM'>Jenis*</label>"
    html +=       "<select class='form-control' id='jenis_SIM' name='jenis_SIM[]' data-rowattr='attr_sim"+data_sim+"' required>"
    html +=         "<option value='' disabled selected>Jenis SIM</option>"
    html +=         "<option value='0'>Tidak punya</option>"
    html +=         "<option value='1'>A</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-3 attr_sim"+data_sim+"'>"
    html +=      "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='SIM'>NO SIM</label>"
    html +=         "<input type='text' class='form-control' id='no_SIM' name='no_SIM[]'>"
    html +=      "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-3 attr_sim"+data_sim+"'>"
    html +=      "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='SIM'>Masa Berlaku</label>"
    html +=         "<input type='text' class='form-control' id='exp_sim' name='exp_sim[]'>"
    html +=      "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-3 attr_sim"+data_sim+"'>"
    html +=      "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='SIM'>Kota Penerbit</label>"
    html +=         "<input type='text' class='form-control' id='kota_sim' name='kota_sim[]'>"
    html +=      "</div>"
    html +=   "</div>"

    html +=   "<div class='col-md-1 attr_sim"+data_sim+"'>"
    html +=     "<div class='form-group'>"
    html +=       "<button id='btnDel-sim' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='sim"+data_sim+"'>"
    html +=         "<span class='material-symbols-outlined'>delete</span>"
    html +=       "</button>"
    html +=     "</div>"
    html +=   "</div>"
    html +="</div>"

    $('#list_sim').append(html);
    // });
  });

  $(document).on('click','#btnDel-sim',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}
function hideSIM(){
  $(document).on('change','#jenis_SIM',function(){
    var value = $(this).val();
    var obj = $(this).data('rowattr');
    if (value==0 || value=="") {
      console.log(obj)
      $('.'+obj).attr('hidden',true)
      $('.'+obj+' :input').val('')
    }else{
      $('.'+obj).attr('hidden',false)
    }
  })
}

data_pendidikan=0
function AddDelPendidikan(){
  $('#btnAdd-pendidikan').on('click',function(){
    data_pendidikan+=1;
    var html=''
    html+="<div id='p_"+data_pendidikan+"' class='brdr'>"

    html +=  "<div class='row'>"
    html +=    "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='Pendidikan'>Tingkat*</label>"
    html +=       "<select class='form-control' id='tingkap_p' name='tingkap_p[]' required>"
    html +=         "<option value='' disabled selected>Tingkat pendidikan</option>"
    html +=         "<option value='1'>SD</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=    "</div>"

    html +=    "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='Pendidikan'>Jurusan*</label>"
    html +=       "<select class='form-control' id='jurusan_p' name='jurusan_p[]' required>"
    html +=         "<option value='' disabled selected>Jurusan Pendidikan</option>"
    html +=         "<option value='1'>SD</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=    "</div>"

    html +=    "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='Pendidikan'>Nama Institusi</label>"
    html +=       "<input class='form-control' type='text' id='namaInst_p' name='namaInst_p[]'>"
    html +=     "</div>"
    html +=    "</div>"
    html +=  "</div>"

    html +=  "<div class='row'>"
    html +=   "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='Pendidikan'>kota</label>"
    html +=       "<select class='form-control' id='kota_p' name='kota_p[]' >"
    html +=         "<option value='' disabled selected>Kota Pendidikan</option>"
    html +=         "<option value='1'>Bekasi</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"

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

    html +=   "<div class='col-md-1'>"
    html +=     "<div class='form-group'>"
    html +=       "<button id='btnDel-pendidikan' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='p_"+data_pendidikan+"'>"
    html +=         "<span class='material-symbols-outlined'>delete</span>"
    html +=       "</button>"
    html +=     "</div>"
    html +=   "</div>"

    html +=  "</div>"

    html+="</div>"

    $('#list_pendidikan').append(html);
  })

  $(document).on('click','#btnDel-pendidikan',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}

data_riwayat=0
function AddDelRiwayat(){
  $('#btnAdd-riwayat').on('click',function(){
    data_riwayat+=1;
    var html=''

    html +="<div id='r_"+data_riwayat+"' class='brdr'>"

    html +=   "<div class='row'>"
    html +=     "<div class='col-md-4'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Nama Perusahaan*</label>"
    html +=         "<input type='text' class='form-control' id='nama_Rpekerjaan' name='nama_Rpekerjaan[]' required>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-4'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Alamat Perusahaan*</label>"
    html +=         "<input type='text' class='form-control' id='alamat_Rpekerjaan' name='alamat_Rpekerjaan[]' required>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='row'>"
    html +=     "<div class='col-md-2'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Farmasi/Non farmasi*</label>"
    html +=         "<select class='form-control' id='fnf_Rpekerjaan' name='fnf_Rpekerjaan[]' required>"
    html +=           "<option value='' disabled selected>Farmasi/Non farmasi*</option>"
    html +=           "<option value='0'>Farmasi</option>"
    html +=           "<option value='1'>Non Farmasi</option>"
    html +=         "</select>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-3'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Jabatan*</label>"
    html +=         "<input type='text' class='form-control' id='jabatan_Rpekerjaan' name='jabatan_Rpekerjaan[]' required>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-3'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Nama Atasan/Jabatan*</label>"
    html +=         "<input type='text' class='form-control' id='atasan_Rpekerjaan' name='atasan_Rpekerjaan[]' required>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "</div>"

    html +=   "<div class='row'>"
    html +=     "<div class='col-md-2'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Tahun Masuk*</label>"
    html +=         "<input type='number' class='form-control' id='ThnMasuk_Rpekerjaan' name='ThnMasuk_Rpekerjaan[]' min=1700 max=2100 required>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-2'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='Rpekerjaan'>Tahun Keluar*</label>"
    html +=         "<input type='number' class='form-control' id='checkrow"+data_riwayat+"' name='ThnKeluar_Rpekerjaan[]' min=1700 max=2100 required>"
    html +=         "<div class='form-check'>"
    html +=           "<input class='form-check-input' type='checkbox' id='checknow' data-row='checkrow"+data_riwayat+"'>"
    html +=           "<label class='form-check-label' for='Rpekerjaan'> Sampai Sekarang </label>"
    html +=         "</div>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-1'>"
    html +=       "<div class='form-group'>"
    html +=         "<button id='btnDel-riwayat' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='r_"+data_riwayat+"'>"
    html +=           "<span class='material-symbols-outlined'>delete</span>"
    html +=         "</button>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "</div>"

    html +="</div>"

    $('#list_riwayat').append(html);
  })

  $(document).on('click','#btnDel-riwayat',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}

function checkRiwayat(){
  $(document).on('change','#checknow',function(){
    // console.log($(this).is(":checked"))
    result = $(this).is(":checked")
    if (result==true) {
      var row = $(this).data('row')
      // console.log(row);
      $('#'+row).val('')
      $('#'+row).attr('readonly',true)
    } else {
      var row = $(this).data('row')
      // console.log(row);
      $('#'+row).attr('readonly',false)
    }
    
  })
}