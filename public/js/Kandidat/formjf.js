$( document ).ready(function() {
  AddDelPendidikan()
  AddDelSIM();
  hideSIM();
  $('#tempatlahir').select2();
  $('#domisili').select2();
});

 data_pendidikan =1;
function AddDelPendidikan(){
  $('#btnAdd-pendidikan').on('click',function(){
    data_pendidikan+=1;
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
    html  ="<div class='row' id='pendidikan"+data_pendidikan+"'>"
    html +=   "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='pendidikan'>Jenis*</label>"
    html +=       "<select class='form-control' id='jenis_pendidikan' name='jenis_pendidikan[]' required>"
    html +=         "<option value='' selected disabled>Jenis Pendidikan</option>"
    html +=         "<option value='1'>S1</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"
    html +=   "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='pendidikan'>Nama Institusi*</label>"
    html +=       "<select class='form-control' id='nama_pendidikan' name='nama_pendidikan[]' required>"
    html +=         "<option value='' selected disabled>Nama Institusi</option>"
    html +=         "<option value='UMN'>UMN</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"
    html +=   "<div class='col-md-3'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='pendidikan'>Jurusan*</label>"
    html +=       "<select class='form-control' id='jurusan_pendidikan' name='jurusan_pendidikan[]' required>"
    html +=         "<option value='' selected disabled>Jurusan</option>"
    html +=         "<option value='IT'>IT</option>"
    html +=       "</select>"
    html +=     "</div>"
    html +=   "</div>"
    html +=   "<div class='col-md-2'>"
    html +=     "<div class='form-group'>"
    html +=       "<label class='form-control-label' for='pendidikan'>Nilai*</label>"
    html +=       "<input type='number' step='0.01' class='form-control' id='nilai_pendidikan' name='nilai_pendidikan[]'  min=0 max=100 required>"
    html +=     "</div>"
    html +=   "</div>"
    html +=   "<div class='col-md-1'>"
    html +=     "<div class='form-group'>"
    html +=       "<button id='btnDel-pendidikan' type='button' class='btn btn-danger d-flex' style='margin-top: 2.3em;' data-row='pendidikan"+data_pendidikan+"'>"
    html +=         "<span class='material-symbols-outlined'>delete</span>"
    html +=       "</button>"
    html +=     "</div>"
    html +=   "</div>"
    html +="</div>"

    $('#list_pendidikan').append(html);
    // });
  });

  $(document).on('click','#btnDel-pendidikan',function(){
    var hapus = $(this).data('row')
    // console.log(hapus);
    $('#'+hapus).remove();
  })
}

/** */
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
