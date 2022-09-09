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
  AddDelSim()
  $('#kota1').select2();
  $('#kodepos').select2();
  $('#kota_koresponden').select2();
  $('#kodepos_koresponden').select2();
  $('#tempatlahir').select2();
  getPostCode();
  Row_perushaan();
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

data_sim =1;
function AddDelSim(){
  $('#btnAdd-sim').on('click',function(){
    data_sim+=1;

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/form-kandidat/get/sim',
      type: 'get'
    }).done((data) => {
      // console.log(JSON.stringify(data));
      var html  = "<div class='row' id='simbaris"+data_sim+"'>"
        html +=   "<div class='col-md-4'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='jenissim'>SIM yang dimiliki*</label>"
        html +=         "<select class='form-control sim' data-row='"+data_sim+"' name='sim[]' required>"
        html +=           "<option value='' disabled selected>SIM</option>"
        data.forEach(element => {
        html +=           "<option value='"+element.id+"'>"+element.nama+"</option>"
        });
        html +=         "</select>"    
        html +=     "</div>"
        html +=   "</div>"
        html +=   "<div class='col-md-6' id='nosimbaris"+data_sim+"' hidden>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='nosim'>No SIM</label>"
        html +=       "<input type='text' class='form-control nosim' data-row='"+data_sim+"' name='nosim[]'>"
        html +=     "</div>"
        html +=   "</div>"
        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<button id='btnDel-sim' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='simbaris"+data_sim+"'>"
        html +=         "<span class='material-symbols-outlined'>delete</span>"
        html +=         "<span class='gap-logo'>Hapus</span>"
        html +=     "</div>"
        html +=   "</div>"
        html += "</div>"

    $('#sims').append(html);
    });
  });

  $(document).on('click','#btnDel-sim',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })

  $(document).on('change','.sim',function(){
    var value = $(this).val();
    var obj = $(this).data('row');
    if (value==1 || value=="") {
      $('#nosimbaris'+obj).attr('hidden',true)
    }else{
      $('#nosimbaris'+obj).attr('hidden',false)
    }
    // console.log(value);
  })
}

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
    
    // var html  = "<tr id='baris"+baris_perusahaan+"' class='detail-perusahaan'>"
    //     html +=   "<td style='width: 17.25%;'>"
    //     html +=     "<input class='form-control'  type='text' name='nama_perushaan[]'>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 10%;'>"
    //     html +=     "<select class='form-control' id='status_perkawinan' name='jenis_perusahaan[]' required>"
    //     html +=       "<option value='' disabled selected>Jenis Perusahaan</option>"
    //     html +=       "<option value='Farmasi'>Farmasi</option>"
    //     html +=       "<option value='Bukan Farmasi'>Bukan Farmasi</option>"
    //     html +=     "</select>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 17.25%;'>"
    //     html +=     "<input class='form-control' type='text' name='alamat_perusahaan[]'>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 17.25%;'>"
    //     html +=     "<input class='form-control' type='text' name='jabatan_perusahaan[]'>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 17.25%;'>"
    //     html +=     "<input class='form-control' type='text' name='atasan_perusahaan[]'>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 8%;'>"
    //     html +=     "<input class='form-control' type='date' name='start_perusahaan[]'>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 8%;'>"
    //     html +=     "<input class='form-control' type='date' name='end_perusahaan[]'>"
    //     html +=   "</td>"   
    //     html +=   "<td style='width: 2%;'>"
    //     html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_perusahaan+"' id='btnDelRow-perusahaan'>"
    //     html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
    //     html +=     "</button>"
    //     html +=   "</td>"   
    //     html +="</tr>"
    var html  = "<tr id='baris"+baris_perusahaan+"' class='detail-perusahaan'>"
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control'  type='text' name='nama_perushaan[]'>"
        html +=   "</td>" 
        html +=   "<td style='width: 19%;'>"
        html +=     "<select class='form-control' id='status_perkawinan' name='jenis_perusahaan[]' required>"
        html +=       "<option value='' disabled selected>Jenis Perusahaan</option>"
        html +=       "<option value='Farmasi'>Farmasi</option>"
        html +=       "<option value='Bukan Farmasi'>Bukan Farmasi</option>"
        html +=     "</select>"
        html +=   "</td>" 
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control' type='text' name='alamat_perusahaan[]'>"
        html +=   "</td>"
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control' type='text' name='jabatan_perusahaan[]'>"
        html +=   "</td>"
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control' type='text' name='atasan_perusahaan[]'>"
        html +=   "</td>" 
        html +=   "<td style='width: 19%;'>"
        html +=     "<input class='form-control' type='text' name='lama_perusahaan[]'>"
        html +=   "</td>"   
        html +=   "<td style='width: 5%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_perusahaan+"' id='btnDelRow-perusahaan'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"

    $('#TblPerushaan').append(html);
    })
    
    $(document).on('click','#btnDelRow-perusahaan',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
    })

}