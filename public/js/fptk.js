$( document ).ready(function() {
  loadTbl_FPTK()
  Row_kandidat()
  update_Fptk()
  detailKandidat()
  Update_modal()
  clearModal()
  filter()

  $('#filter_nofptk').select2();
  $('#filter_namapeminta').select2();
  $('#filter_namaatasan').select2();
  $('#filter_posisi').select2();
  $('#filter_lokasi').select2();
  $('#filter_status').select2();
});
function clearModal(){
  $('.modal-detail-kandidat').on('hide.bs.modal', function() {
      $('#edit-keterangan').val('');
      $('#edit-jenis').val('');
      $('#edit-sumber').val('');
      $('#kandidat').text('')
      $('#fptk').text('')
  })
}

function filter(){
  $('#filterfptk').on('click',function(){
    var filter_Speriod=$('#filter_Speriod').val();
    var filter_Eperiod=$('#filter_Eperiod').val();
    var nofptk=$("select[name='filter_nofptk[]']").map(function(){return $(this).val();}).get();
    var namapeminta=$("select[name='filter_namapeminta[]']").map(function(){return $(this).val();}).get();
    var namaatasan=$("select[name='filter_namaatasan[]']").map(function(){return $(this).val();}).get();
    var posisi=$("select[name='filter_posisi[]']").map(function(){return $(this).val();}).get();
    var lokasi=$("select[name='filter_lokasi[]']").map(function(){return $(this).val();}).get();
    var status=$("select[name='filter_status[]']").map(function(){return $(this).val();}).get();

    loadTbl_FPTK(
                filter_Speriod,
                filter_Eperiod,
                nofptk,
                namapeminta,
                namaatasan,
                posisi,
                lokasi,
                status
                )
  });
}


function loadTbl_FPTK(filter_Speriod,filter_Eperiod,nofptk,namapeminta,namaatasan,posisi,lokasi,status){

  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/hrd/show/fptk',
  //     type: 'post',
  //     data: {
  //       filter_Speriod:filter_Speriod,
  //         filter_Eperiod:filter_Eperiod,
  //         nofptk:nofptk,
  //         namapeminta:namapeminta,
  //         namaatasan:namaatasan,
  //         posisi:posisi,
  //         lokasi:lokasi,
  //         status:status
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });

  $('#TblFptk').DataTable().destroy();
  $('#TblFptk').DataTable({
      "scrollY":        "400px",
      // "scrollX": true,
      "scrollCollapse": true,
      pageLength : 5,
      ajax: {
        url: "/hrdats/hrd/show/fptk",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  
        data:{
          filter_Speriod:filter_Speriod,
          filter_Eperiod:filter_Eperiod,
          nofptk:nofptk,
          namapeminta:namapeminta,
          namaatasan:namaatasan,
          posisi:posisi,
          lokasi:lokasi,
          status:status
        },
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
            data: 'nofptk',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'tgldisetujui',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'namapeminta',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'namaatasanlangusng',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'posisi',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'penempatan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'keterangan',
            defaultContent: 'Tidak ada data'
          },
          {
              defaultContent: '',
              render: (data, type, row, meta)=> {
                  // return '<button type="button" class="btn btn-info" onclick="Modal_fptk(value)" data-toggle="modal" data-target=".modal-detail-fptk" value="'+row.id+'">Detail</button>'
                  return '<a class="btn btn-info" href="/hrdats/hrd/show/detail/fptk/'+row.id+'">Detail</a>'
              }
          }
      ] 
  });
}

// --------
function alert(){
  const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
  })
  
  Toast.fire({
  icon: 'success',
  title: 'Proses Berhasil'
  })
}

var baris_kandidat=0
function Row_kandidat(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/hrd/show/kandidat/fptk',
      type: 'get'
    }).done((data) => {
      $('#btnAddRow-kandidat').on('click',function(){
        baris_kandidat+=1;
        
        var html  = "<tr id='baris"+baris_kandidat+"' class='detail-perusahaan'>"
            html +=   "<td style='width: 50%;'>"
            html +=     "<select class='js-example-basic-single form-control fptkkandidat' name='fptkkandidat[]'>"
            html +=       "<option value='' disabled selected>ID Kandidat</option>"
            data.forEach(element => {
            html+=        "<option value="+element.id+">"+element.noidentitas+' - '+element.namalengkap+"</option>"
            });
            html +=     "</select>"
            html +=   "</td>" 
            html +=   "<td style='width: 10%;'>"
            html +=     "<input class='form-control' type='date' name='tgl_konfirm[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 10%;'>"
            html +=     "<input class='form-control' type='date' name='tgl_join[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 10%;'>"
            html +=     "<input class='form-control' type='date' name='tgl_batal[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-info' onclick='Modal_fptk(value)' data-toggle='modal' data-target='.modal-detail-kandidat' value='"+baris_kandidat+"' disabled>Detail</button>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_kandidat+"' id='btnDelRow-kandidat'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"
    
        $('#Tblkandidat').append(html);
        })
    });    
    $(document).on('click','#btnDelRow-kandidat',function(){
      var hapus = $(this).data('row')
      // console.log(hapus);
      $('#'+hapus).remove();
    })
}

function detailKandidat(){
  var url = window.location.href;
  var result =  url.includes("/hrdats/hrd/show/detail/fptk/");
  if (result==true) {
    var id = $('#id_fptk').text()
    // console.log(id);
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/hrd/show/detailkandidat/fptk/'+id,
        type: 'get'
      }).done((data) => {
        data[0].forEach(elements => {
          baris_kandidat+=1;
          var html  = "<tr id='baris"+baris_kandidat+"' class='detail-perusahaan'>"
              html +=   "<td style='width: 50%;'>"
              html +=     "<select class='js-example-basic-single form-control fptkkandidat' name='fptkkandidat[]' >"
              html +=       "<option value='' disabled selected>ID Kandidat</option>"
              data[1].forEach(element => {
                if (element.id==elements.id_TKandidat) {
                  html+=        "<option value="+element.id+" selected>"+element.noidentitas+' - '+element.namalengkap+"</option>"
                }else{
                  html+=        "<option value="+element.id+">"+element.noidentitas+' - '+element.namalengkap+"</option>"
                }
              });
              // html+=        "<option value="+elements.id_TKandidat+">"+element.noidentitas+' - '+element.namalengkap+"</option>"
              html +=     "</select>"
              html +=   "</td>" 
              html +=   "<td style='width: 10%;'>"
              html +=     "<input class='form-control' type='date' name='tgl_konfirm[]' value='"+elements.tglkonfirm+"'>"
              html +=   "</td>" 
              html +=   "<td style='width: 10%;'>"
              html +=     "<input class='form-control' type='date' name='tgl_join[]' value='"+elements.tgljoin+"'>" 
              html +=   "</td>" 
              html +=   "<td style='width: 10%;'>"
              html +=     "<input class='form-control' type='date' name='tgl_batal[]' value='"+elements.tglbatal+"'>"
              html +=   "</td>" 
              html +=   "<td style='width: 5%;'>"
              html +=     "<button type='button' class='btn btn-info' onclick='Modal_detail_kandidat(this)' data-toggle='modal' data-target='.modal-detail-kandidat' data-kandidat='"+elements.id_TKandidat+"' data-fptk='"+elements.id_TFPTK+"'>Detail</button>"
              html +=   "</td>"   
              html +=   "<td style='width: 5%;'>"
              html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_kandidat+"' id='btnDelRow-kandidat'>"
              html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
              html +=     "</button>"
              html +=   "</td>"   
              html +="</tr>"
      
          $('#Tblkandidat').append(html);
        });
        // console.log(data[0]);
      });
  }
}

function update_Fptk(){
  $('#btnUpdateFPTK').on('click',function(){
    var nofptk = $('#nofptk').val();
    var status = $('#status').val();
    var tgl_inputfptk = $('#tgl_inputfptk').val();
    var tgl_disetujui = $('#tgl_disetujui').val();
    var nikpeminta = $('#nikpeminta').val();
    var namapeminta = $('#namapeminta').val();
    var namaatasanlangusng = $('#atasanlangsung').val();
    var posisi = $('#posisi').val();
    var lobandsub = $('#lobandsub').val();
    var penempatan = $('#penempatan').val();
    var alasandigantikan = $('#alasan').val();
    var namaygdigantikan = $('#namadigantikan').val();
    var namaSpvDm = $('#namaspvdm').val();
    var pic = $('#pic').val();
    var namakarybergabung = $('#namabergabung').val();
    var leadtime = $('#leadtime').val();
    var id_fptk = $('#btnUpdateFPTK').data('value');

    var id_kandidat = $("select[name='fptkkandidat[]']").map(function(){return $(this).val();}).get();
    var tgl_konfirm = $("input[name='tgl_konfirm[]']").map(function(){return $(this).val();}).get();
    var tgl_join= $("input[name='tgl_join[]']").map(function(){return $(this).val();}).get();
    var tgl_batal = $("input[name='tgl_batal[]']").map(function(){return $(this).val();}).get();

    // console.log(tgl_konfirm);
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/hrd/update/fptk',
        type: 'post',
        data: {
          nofptk:nofptk,
          status:status,
          tgl_inputfptk:tgl_inputfptk,
          tgl_disetujui:tgl_disetujui,
          nikpeminta:nikpeminta,
          namapeminta:namapeminta,
          namaatasanlangusng:namaatasanlangusng,
          posisi:posisi,
          lobandsub:lobandsub,
          penempatan:penempatan,
          alasandigantikan:alasandigantikan,
          namaygdigantikan:namaygdigantikan,
          namaSpvDm:namaSpvDm,
          pic:pic,
          namakarybergabung:namakarybergabung,
          leadtime:leadtime,
          id_kandidat:id_kandidat,
          id_fptk:id_fptk,
          tgl_konfirm:tgl_konfirm,
          tgl_join:tgl_join,
          tgl_batal:tgl_batal
        }
      }).done((data) => {
        location.reload()
        console.log(JSON.stringify(data));
    });
    alert();
  });
}

function Modal_detail_kandidat (obj){
  var url = window.location.href;
  var result =  url.includes("/hrdats/hrd/show/detail/fptk/");
  if (result==true) {
    var id_kandidat = $(obj).data('kandidat');
    var id_fptk = $(obj).data('fptk');
    // console.log(id);
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/hrd/modaldetail/kandiat/fptk/'+id_fptk+'/'+id_kandidat,
        type: 'get'
      }).done((data) => {
        $('#edit-keterangan').val(data[0].ket);
        $('#edit-jenis').val(data[0].jenis);
        $('#edit-sumber').val(data[0].sumber);
        $('#kandidat').text(id_kandidat);
        $('#fptk').text(id_fptk);
        // console.log(JSON.stringify(data));
      });
  }
}

function Update_modal(){
  $('#btnEdit-kandidat').on('click',function(){
    var keterangan = $('#edit-keterangan').val();
    var jenis = $('#edit-jenis').val();
    var id_kandidat = $('#kandidat').text();
    var id_fptk = $('#fptk').text();

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/hrd/show/updatemodal/fptk/',
        type: 'post',
        data: {
            keterangan:keterangan,
            jenis:jenis,
            id_kandidat:id_kandidat,
            id_fptk:id_fptk
        }
      }).done((data) => {
        $(".modal-detail-kandidat").modal('hide');
        console.log(JSON.stringify(data));
    });
  });
}