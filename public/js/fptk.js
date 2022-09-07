$( document ).ready(function() {
  loadTbl_FPTK()
  Row_kandidat()
  update_Fptk()
  detailKandidat()
});

function loadTbl_FPTK(){
  $('#TblFptk').DataTable({
      "scrollY":        "400px",
      // "scrollX": true,
      "scrollCollapse": true,
      pageLength : 5,
      ajax: {
      url: "/hrdats/hrd/show/fptk",
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
            data: 'status',
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
            html +=     "<button type='button' class='btn btn-info' onclick='Modal_fptk(value)' data-toggle='modal' data-target='.modal-detail-fptk' value='"+baris_kandidat+"'>Detail</button>"
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
  }

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
            html +=     "<input class='form-control' type='date' name='tgl_konfirm[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 10%;'>"
            html +=     "<input class='form-control' type='date' name='tgl_join[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 10%;'>"
            html +=     "<input class='form-control' type='date' name='tgl_batal[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-info' onclick='Modal_fptk(value)' data-toggle='modal' data-target='.modal-detail-fptk' value='"+baris_kandidat+"'>Detail</button>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_kandidat+"' id='btnDelRow-kandidat'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"
    
        $('#Tblkandidat').append(html);
      });
      // console.log(data);
    });
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
    var organisasi = $('#organisasi').val();
    var penempatan = $('#penempatan').val();
    var alasandigantikan = $('#alasan').val();
    var namaygdigantikan = $('#namadigantikan').val();
    var namaSpvDm = $('#namaspvdm').val();
    var pic = $('#pic').val();
    var namakarybergabung = $('#namabergabung').val();
    var leadtime = $('#leadtime').val();
    var id_kandidat = $("select[name='fptkkandidat[]']").map(function(){return $(this).val();}).get();
    var id_fptk = $('#btnUpdateFPTK').data('value');
    // console.log(id_kandidat);
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
          organisasi:organisasi,
          penempatan:penempatan,
          alasandigantikan:alasandigantikan,
          namaygdigantikan:namaygdigantikan,
          namaSpvDm:namaSpvDm,
          pic:pic,
          namakarybergabung:namakarybergabung,
          leadtime:leadtime,
          id_kandidat:id_kandidat,
          id_fptk:id_fptk
        }
      }).done((data) => {
        location.reload()
        console.log(JSON.stringify(data));
    });

  });
}