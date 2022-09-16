$( document ).ready(function() {
  $('#lingkungankerja').select2();
  Row_pelatihan();
  Row_bahasa();
  Row_organisasi();
  Row_kenal();
  Row_saudara();
  sakit();
  psikologis();
  saudara();
});

var baris_pelatihan=0
function Row_pelatihan(){
  $('#btnAddRow-pelatihan').on('click',function(){
    baris_pelatihan+=1;
    
    var html  = "<tr id='baris_pelatihan"+baris_pelatihan+"' class='detail-pelatihan'>"
        html +=   "<td style='width: 30%;'>"
        html +=     "<input class='form-control'  type='text' name='jenis_pelatihan[]' maxlength='200'>"
        html +=   "</td>" 
        html +=   "<td style='width: 30%;'>"
        html +=     "<input class='form-control' type='text' name='penyelenggara_pelatihan[]' maxlength='200'>"
        html +=   "</td>"
        html +=   "<td style='width: 30%;'>"
        html +=     "<input class='form-control' type='number' min='1800' max='2050' name='tahun_pelatihan[]'>"
        html +=   "</td>" 
        html +=   "<td style='width: 10%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris_pelatihan"+baris_pelatihan+"' id='btnDelRow-pelatihan'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"

    $('#Tblpelatihan').append(html);
  })
    $(document).on('click','#btnDelRow-pelatihan',function(){
      var hapus = $(this).data('row')
      console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_bahasa=0
function Row_bahasa(){
  $('#btnAddRow-bahasa').on('click',function(){
    baris_bahasa+=1;
    
    var html  = "<tr id='baris_bahasa"+baris_bahasa+"' class='detail_bahasa'>"
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
        html +=   "<td style='width: 5%;'>"
        html +=     "<button type='button' class='btn btn-danger' data-row='baris_bahasa"+baris_bahasa+"' id='btnDelRow-bahasa'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=   "</td>"   
        html +="</tr>"

    $('#Tblbahasa').append(html);
  })
    $(document).on('click','#btnDelRow-bahasa',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_organisasi=0
function Row_organisasi(){
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

    $('#Tblorganisasi').append(html);
  })
    $(document).on('click','#btnDelRow-organisasi',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_kenal=0
function Row_kenal(){
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

    $('#Tblkenal').append(html);
  })
    $(document).on('click','#btnDelRow-kenal',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_saudara=0
function Row_saudara(){
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

    $('#Tblsaudarafarmasi').append(html);
  })
    $(document).on('click','#btnDelRow-saudarafarmasi',function(){
      var hapus = $(this).data('row')
      console.log(hapus);
      $('#'+hapus).remove();
  })
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