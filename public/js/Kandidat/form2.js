$( document ).ready(function() {
  $('#lingkungankerja').select2();
  // Row_pelatihan();
  AddDelPelatihan();
  // Row_bahasa();
  AddDelBahsa();
  // Row_organisasi();
  AddDelOrganisasi()
  // Row_kenal();
  AddDellKaryawan();
  Row_saudara();
  sakit();
  psikologis();
  saudara();
  AddDelKeluarga();
});

var data_pelatihan=0
// function Row_pelatihan(){
//   $('#btnAddRow-pelatihan').on('click',function(){
//     baris_pelatihan+=1;
    
//     var html  = "<tr id='baris_pelatihan"+baris_pelatihan+"' class='detail-pelatihan'>"
//         html +=   "<td style='width: 30%;'>"
//         html +=     "<input class='form-control'  type='text' name='jenis_pelatihan[]' maxlength='200'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 30%;'>"
//         html +=     "<input class='form-control' type='text' name='penyelenggara_pelatihan[]' maxlength='200'>"
//         html +=   "</td>"
//         html +=   "<td style='width: 30%;'>"
//         html +=     "<input class='form-control' type='number' min='1800' max='2050' name='tahun_pelatihan[]'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 10%;'>"
//         html +=     "<button type='button' class='btn btn-danger' data-row='baris_pelatihan"+baris_pelatihan+"' id='btnDelRow-pelatihan'>"
//         html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
//         html +=     "</button>"
//         html +=   "</td>"   
//         html +="</tr>"

//     $('#Tblpelatihan').append(html);
//   })
//     $(document).on('click','#btnDelRow-pelatihan',function(){
//       var hapus = $(this).data('row')
//       console.log(hapus);
//       $('#'+hapus).remove();
//   })
// }

function AddDelPelatihan(){
  $('#btnAdd-pelatihan').on('click',function(){
    data_pelatihan+=1;
    var html=''

    html += "<div id='pl_"+data_pelatihan+"' class='brdr'>"
    html +=   "<div class='row'>"
    html +=     "<div class='col-md-4'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='pelatihan'>Jenis Pelatihan/kursus</label>"
    html +=         "<input type='text' class='form-control' id='jenis_pelatihan' name='jenis_pelatihan[]'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-4'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='pelatihan'>Penyelenggara</label>"
    html +=         "<input type='text' class='form-control' id='penyelenggara_pelatihan' name='penyelenggara_pelatihan[]'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-2'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='pelatihan'>Tahun Pelaksana</label>"
    html +=         "<input type='number' class='form-control' id='tahun_pelatihan' name='tahun_pelatihan[]' min=1700 max=2100>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-1'>"
    html +=       "<div class='form-group'>"
    html +=         "<button id='btnDel-pelatihan' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='pl_"+data_pelatihan+"'>"
    html +=           "<span class='material-symbols-outlined'>delete</span>"
    html +=         "</button>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "</div>"
    html += "</div>"

    $('#list_pelatihan').append(html);
  })

  $(document).on('click','#btnDel-pelatihan',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}

var data_bahasa=0
function AddDelBahsa(){
  $('#btnAdd-bahasa').on('click',function(){
    data_bahasa+=1;
    var html=''

    html +="<div id='b_"+data_bahasa+"' class='brdr'>"
    html +=   "<div class='row'>"
    html +=     "<div class='col-md-3'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='bahasa'>Bahasa*</label>"
    html +=         "<input type='text' class='form-control' id='nama_bahasa' name='nama_bahasa[]' required>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "<div class='col-md-2'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='bahasa'>Bebicara*</label>"
    html +=       "<select class='form-control' id='berbicara_bahasa[]' name='berbicara_bahasa[]' required>"
    html +=         "<option value='' disabled selected>Berbicara</option>"
    html +=         "<option value='Baik'>Baik</option>"
    html +=         "<option value='Cukup'>Cukup</option>"
    html +=         "<option value='Kurang'>Kurang</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"
    html +=   "<div class='col-md-2'>"
    html +=      "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='bahasa'>Menulis*</label>"
    html +=         "<select class='form-control' id='menulis_bahasa[]' name='menulis_bahasa[]' required>"
    html +=           "<option value='' disabled selected>Menulis</option>"
    html +=           "<option value='Baik'>Baik</option>"
    html +=           "<option value='Cukup'>Cukup</option>"
    html +=           "<option value='Kurang'>Kurang</option>"
    html +=         "</select>"
    html +=       "</div>"
    html +=   "</div>"
    html +=   "<div class='col-md-2'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='bahasa'>Membaca*</label>"
    html +=       "<select class='form-control' id='membaca_bahasa[]' name='membaca_bahasa[]' required>"
    html +=         "<option value='' disabled selected>Membaca</option>"
    html +=         "<option value='Baik'>Baik</option>"
    html +=         "<option value='Cukup'>Cukup</option>"
    html +=         "<option value='Kurang'>Kurang</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=    "</div>"
    html +=     "<div class='col-md-1'>"
    html +=       "<div class='form-group'>"
    html +=         "<button id='btnDel-bahasa' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='b_"+data_bahasa+"'>"
    html +=           "<span class='material-symbols-outlined'>delete</span>"
    html +=         "</button>"
    html +=       "</div>"
    html +=     "</div>"
    html +=  "</div>"
    html +="</div>"

    $('#list_bahasa').append(html);
  })
  $(document).on('click','#btnDel-bahasa',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}
// function Row_bahasa(){
//   $('#btnAddRow-bahasa').on('click',function(){
//     baris_bahasa+=1;
    
//     var html  = "<tr id='baris_bahasa"+baris_bahasa+"' class='detail_bahasa'>"
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<input class='form-control'  type='text' name='bahasa[]' maxlength='250'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<select class='form-control' id='berbicara[]' name='berbicara[]' required>"
//         html +=       "<option value='' disabled selected>Berbicara</option>"
//         html +=       "<option value='Baik'>Baik</option>"
//         html +=       "<option value='Cukup'>Cukup</option>"
//         html +=       "<option value='Kurang'>KUrang</option>"
//         html +=     "</select>"
//         html +=   "</td>"
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<select class='form-control' id='menulis[]' name='menulis[]' required>"
//         html +=       "<option value='' disabled selected>Menulis</option>"
//         html +=       "<option value='Baik'>Baik</option>"
//         html +=       "<option value='Cukup'>Cukup</option>"
//         html +=       "<option value='Kurang'>KUrang</option>"
//         html +=     "</select>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<select class='form-control' id='membaca[]' name='membaca[]' required>"
//         html +=       "<option value='' disabled selected>Membaca</option>"
//         html +=       "<option value='Baik'>Baik</option>"
//         html +=       "<option value='Cukup'>Cukup</option>"
//         html +=       "<option value='Kurang'>KUrang</option>"
//         html +=     "</select>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 5%;'>"
//         html +=     "<button type='button' class='btn btn-danger' data-row='baris_bahasa"+baris_bahasa+"' id='btnDelRow-bahasa'>"
//         html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
//         html +=     "</button>"
//         html +=   "</td>"   
//         html +="</tr>"

//     $('#Tblbahasa').append(html);
//   })
//     $(document).on('click','#btnDelRow-bahasa',function(){
//       var hapus = $(this).data('row')
//       // console.log(hapus);
//       $('#'+hapus).remove();
//   })
// }

var data_organisasi=0
function AddDelOrganisasi(){
  $('#btnAdd-organisasi').on('click',function(){
    data_organisasi+=1;
    var html=''
    html +="<div id='o_"+data_organisasi+"' class='brdr'>"
    html +=   "<div class='row'>"
    html +=     "<div class='col-md-3'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='organisasi'>Nama Organisasi</label>"
    html +=         "<input type='text' class='form-control' id='nama_organisasi' name='nama_organisasi[]' maxlength='2000'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-3'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='organisasi'>Kota</label>"
    html +=         "<input type='text' class='form-control' id='kota_organisasi' name='kota_organisasi[]' maxlength='2000'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-3'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='organisasi'>Jabatan</label>"
    html +=         "<input type='text' class='form-control' id='jabatan_organisasi' name='jabatan_organisasi[]' maxlength='2000'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-2'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='organisasi'>dari/sampai (tahun)</label>"
    html +=         "<input type='text' class='form-control' id='tahun_organisasi' name='tahun_organisasi[]' placeholder='2000-2001'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-1'>"
    html +=       "<div class='form-group'>"
    html +=         "<button id='btnDel-organisasi' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='o_"+data_organisasi+"'>"
    html +=           "<span class='material-symbols-outlined'>delete</span>"
    html +=         "</button>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "</div>"
    html +="</div>"

    $('#list_organisasi').append(html);
  })

  $(document).on('click','#btnDel-organisasi',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}
// function Row_organisasi(){
//   $('#btnAddRow-organisasi').on('click',function(){
//     baris_organisasi+=1;
    
//     var html  = "<tr id='baris_organisasi"+baris_organisasi+"' class='detail_organisasi'>"
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<input class='form-control'  type='text' name='nama_organisasi[]' maxlength='220'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<input class='form-control'  type='text' name='kota_organisasi[]' maxlength='220'>"
//         html +=   "</td>"
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<input class='form-control'  type='text' name='jabatan_organisasi[]' maxlength='220'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 23.75%;'>"
//         html +=     "<input class='form-control'  type='text' name='tahun_organisasi[]' maxlength='220'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 5%;'>"
//         html +=     "<button type='button' class='btn btn-danger' data-row='baris_organisasi"+baris_organisasi+"' id='btnDelRow-organisasi'>"
//         html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
//         html +=     "</button>"
//         html +=   "</td>"   
//         html +="</tr>"

//     $('#Tblorganisasi').append(html);
//   })
//     $(document).on('click','#btnDelRow-organisasi',function(){
//       var hapus = $(this).data('row')
//       // console.log(hapus);
//       $('#'+hapus).remove();
//   })
// }

var data_kenal=0
function AddDellKaryawan(){
  $('#btnAdd-karyawan').on('click',function(){
    data_kenal+=1;
    var html =''

    html +="<div id='k_"+data_kenal+"' class='brdr'>"
    html +=   "<div class='row'>"
    html +=     "<div class='col-md-4'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='karyawan'>Nama</label>"
    html +=         "<input class='form-control' type='text' id='nama_karyawan' name='nama_karyawan[]'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-4'>"
    html +=       "<div class='form-group'>"
    html +=         "<label class='form-control-label' for='karyawan'>hubungan</label>"
    html +=         "<input class='form-control' type='text' id='hubungan_karyawan' name='hubungan_karyawan[]'>"
    html +=       "</div>"
    html +=     "</div>"
    html +=     "<div class='col-md-1'>"
    html +=       "<div class='form-group'>"
    html +=         "<button id='btnDel-karyawan' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='k_"+data_kenal+"'>"
    html +=           "<span class='material-symbols-outlined'>delete</span>"
    html +=         "</button>"
    html +=       "</div>"
    html +=     "</div>"
    html +=   "</div>"
    html +="</div>"

    $('#list_karyawan').append(html);
  })

  $(document).on('click','#btnDel-karyawan',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}
// function Row_kenal(){
//   $('#btnAddRow-kenal').on('click',function(){
//     baris_kenal+=1;
    
//     var html  = "<tr id='baris_kenal"+baris_kenal+"' class='detail_kenal'>"
//         html +=   "<td style='width: 47.5%;'>"
//         html +=     "<input class='form-control'  type='text' name='nama_kenal[]' maxlength='80'>"
//         html +=   "</td>" 
//         html +=   "<td style='width: 47.5%;'>"
//         html +=     "<input class='form-control'  type='text' name='hubungan_kenal[]' maxlength='80'>"
//         html +=   "</td>"
//         html +=   "<td style='width: 5%;'>"
//         html +=     "<button type='button' class='btn btn-danger' data-row='baris_kenal"+baris_kenal+"' id='btnDelRow-kenal'>"
//         html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
//         html +=     "</button>"
//         html +=   "</td>"   
//         html +="</tr>"

//     $('#Tblkenal').append(html);
//   })
//     $(document).on('click','#btnDelRow-kenal',function(){
//       var hapus = $(this).data('row')
//       // console.log(hapus);
//       $('#'+hapus).remove();
//   })
// }

var baris_saudara=0
function Row_saudara(){
  $('#btnAdd-saudarafarmasi').on('click',function(){
    baris_saudara+=1;
    var html = "<div class='row sdr' id='baris_saudara"+baris_saudara+"'>"

        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='kerabat'>Hubungan</label>"
        html +=       "<input class='form-control' type='text' id='hubungan_saudarafarmasi' name='hubungan_saudarafarmasi[]' maxlength='220'required>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='col-md-3'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='kerabat'>Nama</label>"
        html +=       "<input class='form-control' type='text' id='nama_saudarafarmasi' name='nama_saudarafarmasi[]' maxlength='220'required>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='col-md-1'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='kerabat'>Gender</label>"
        html +=       "<select class='form-control' id='LPsaudara' name='LP_saudarafarmasi[]' required>"
        html +=         "<option value='' disabled selected>L/P</option>"
        html +=         "<option value='L'>L</option>"
        html +=         "<option value='P'>P</option>"
        html +=       "</select>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='col-md-3'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='kerabat'>Nama Perushaan*</label>"
        html +=       "<input class='form-control' type='text' id='perushaan_saudarafarmasi' name='perushaan_saudarafarmasi[]' maxlength='220'required>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='col-md-2'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='kerabat'>Jabatan*</label>"
        html +=       "<input class='form-control' type='text' id='jabatan_saudarafarmasi' name='jabatan_saudarafarmasi[]' maxlength='220'required>"
        html +=     "</div>"
        html +=   "</div>"

        html +=   "<div class='col-md-1'>"
        html +=     "<div class='form-group'>"
        html +=       "<label class='form-control-label' for='kerabat'> </label>"
        html +=     "<button type='button' class='btn btn-danger' style='margin-top: 2.3em;' data-row='baris_saudara"+baris_saudara+"' id='btnDelRow-saudarafarmasi'>"
        html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
        html +=     "</button>"
        html +=     "</div>"
        html +=   "</div>"

        html += "</div>"
    // var html  = "<tr id='baris_saudara"+baris_saudara+"' class='detail_saudara'>"
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control'  type='text' name='hubungan_saudarafarmasi[]' maxlength='220' required>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control'  type='text' name='nama_saudarafarmasi[]' maxlength='220' required>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<select class='form-control' id='LPsaudara' name='LP_saudarafarmasi[]' required>"
    //     html +=       "<option value='' disabled selected>L/P</option>"
    //     html +=       "<option value='L'>L</option>"
    //     html +=       "<option value='P'>P</option>"
    //     html +=     "</select>"
    //     html +=   "</td>" 
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control'  type='text' name='perushaan_saudarafarmasi[]' maxlength='220' required>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 19%;'>"
    //     html +=     "<input class='form-control'  type='text' name='jabatan_saudarafarmasi[]'maxlength='220' required>"
    //     html +=   "</td>"
    //     html +=   "<td style='width: 5%;'>"
    //     html +=     "<button type='button' class='btn btn-danger' data-row='baris_saudara"+baris_saudara+"' id='btnDelRow-saudarafarmasi'>"
    //     html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
    //     html +=     "</button>"
    //     html +=   "</td>"   
    //     html +="</tr>"

    $('#datasaudarafarmasi').append(html);
  })
    $(document).on('click','#btnDelRow-saudarafarmasi',function(){
      var hapus = $(this).data('row')
      console.log(hapus);
      $('#'+hapus).remove();
  })
}

var baris_keluarga =0
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
        html +="<div id='keluarga"+baris_keluarga+"' class='brdr'>"
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
      $('.saudarafarmasi').removeAttr('hidden');
    } else {
      $('.saudarafarmasi').attr("hidden",true);
      $('.sdr').remove();
      $('.sdr1 :input').val('');
    }
  });
}