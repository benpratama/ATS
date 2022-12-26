$( document ).ready(function() {
  loadTbl_RqFPTK()
  loadTbl_RqMPP()
  filter1()
  filterstart()
  ShowSummary()
  filter_FPTK()
  // downloadLHW()
  // Row_kandidat()
  // update_Fptk()
  // detailKandidat()
  // Update_modal()
  // clearModal()
  // filter()
  // exportDataFPTK()
  // clearFilter()
  // cek_posisi_organisasi();

  $('#filter_nofptk').select2();
  $('#filter_namapeminta').select2();
  $('#filter_lob').select2();
  $('#filter_lokasi').select2();
  $('#filter_status').select2();
  
  // $('#filter_namaatasan').select2();
  // $('#filter_posisi').select2();
  // $('#filter_lokasi').select2();
  // $('#filter_status').select2();
});

// --------FPTK-------------


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
var Speriod =''
var Eperiod =''

function filter_FPTK(){
  $('#btnFilter_FPTK').on('click',function(){
    Speriod= $('#filter_Speriod').val()
    Eperiod= $('#filter_Eperiod').val()
    id_User = $('#id_User').text();
    NIK = $('#NIK').text();
    id_dept = $('#id_dept').text();

    //field
    var nofptk=$("select[name='filter_nofptk[]']").map(function(){return $(this).val();}).get();
    var lokasi=$("select[name='filter_lokasi[]']").map(function(){return $(this).val();}).get();
    var status=$("select[name='filter_status[]']").map(function(){return $(this).val();}).get();
    var lob=$("select[name='filter_lob[]']").map(function(){return $(this).val();}).get();
    var namapeminta=$("select[name='filter_namapeminta[]']").map(function(){return $(this).val();}).get();
    // console.log(namapeminta);
    loadTbl_RqFPTK(nofptk,lokasi,status,lob,namapeminta)
    ShowSummary();
  })
  
}


function filter1(){
  // $('#filterfptk').on('click',function(){
  //   var filter_Speriod=$('#filter_Speriod').val();
  //   var filter_Eperiod=$('#filter_Eperiod').val();
  //   var nofptk=$("select[name='filter_nofptk[]']").map(function(){return $(this).val();}).get();
  //   var namapeminta=$("select[name='filter_namapeminta[]']").map(function(){return $(this).val();}).get();
  //   var namaatasan=$("select[name='filter_namaatasan[]']").map(function(){return $(this).val();}).get();
  //   var posisi=$("select[name='filter_posisi[]']").map(function(){return $(this).val();}).get();
  //   var lokasi=$("select[name='filter_lokasi[]']").map(function(){return $(this).val();}).get();
  //   var status=$("select[name='filter_status[]']").map(function(){return $(this).val();}).get();

  //   $('#F_startTgl').text(filter_Speriod);
  //   $('#F_endTgl').text(filter_Eperiod);

  //   loadTbl_FPTK(
  //               filter_Speriod,
  //               filter_Eperiod,
  //               nofptk,
  //               namapeminta,
  //               namaatasan,
  //               posisi,
  //               lokasi,
  //               status
  //               )
  // });

  
  $('#filter_Speriod').on('change',function(){functionfilter()})
  $('#filter_Eperiod').on('change',function(){functionfilter()})
}

function functionfilter(){
  $("#filter_nofptk option").remove();
  $("#filter_namapeminta option").remove();
  $("#filter_lokasi option").remove();
  Speriod= $('#filter_Speriod').val()
  Eperiod= $('#filter_Eperiod').val()
  id_User = $('#id_User').text();
  // console.log(id_User);
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    _token: '{{ csrf_token() }}',
    url: '/hrdats/requestor/filterdashboard',
    type: 'post',
    data: {
      Speriod:Speriod,
      Eperiod:Eperiod,
      id_User:id_User
    }
  }).done((data) => {
    // console.log(JSON.stringify(data[2]));
    for (let i = 0; i < data[0].length; i++) {
      // html+='<option value="'+data.nofptk+'">'+data.nofptk+'</option>'
      $('#filter_nofptk').append($('<option>', {
        value: data[0][i].nofptk,
        text: data[0][i].nofptk
      }));
    }

    for (let j = 0; j < data[1].length; j++) {
      $('#filter_namapeminta').append($('<option>', {
        value: data[1][j].namapeminta,
        text: data[1][j].namapeminta
      }));
    }

    for (let k = 0; k < data[2].length; k++) {
      $('#filter_lokasi').append($('<option>', {
        value: data[2][k].penempatan,
        text: data[2][k].penempatan
      }));
    }
});

}

function filterstart(){
  $("#filter_nofptk option").remove();
  $("#filter_namapeminta option").remove();
  $("#filter_lokasi option").remove();
  var Speriod= $('#filter_Speriod').val()
  var Eperiod= $('#filter_Eperiod').val()
  // var NIK = $('#NIK').text();
  var id_User = $('#id_User').text();
  var id_dept = $('#id_dept').text();

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/requestor/filterdashboard',
      type: 'post',
      data: {
        Speriod:Speriod,
        Eperiod:Eperiod,
        id_User:id_User,
        id_dept:id_dept
      }
    }).done((data) => {
      // console.log(JSON.stringify(data[3]));

      for (let i = 0; i < data[0].length; i++) {
        // html+='<option value="'+data.nofptk+'">'+data.nofptk+'</option>'
        $('#filter_nofptk').append($('<option>', {
          value: data[0][i].nofptk,
          text: data[0][i].nofptk
        }));
      }

      for (let j = 0; j < data[1].length; j++) {
        $('#filter_namapeminta').append($('<option>', {
          value: data[1][j].namapeminta,
          text: data[1][j].namapeminta
        }));
      }

      for (let k = 0; k < data[2].length; k++) {
        $('#filter_lokasi').append($('<option>', {
          value: data[2][k].penempatan,
          text: data[2][k].penempatan
        }));
      }

      for (let l = 0; l < data[3].length; l++) {
        $('#filter_lob').append($('<option>', {
          value: data[3][l].id_MLobandSub,
          text: data[3][l].nama
        }));
      }
  });
}

function ShowSummary(){
  var Speriod= $('#filter_Speriod').val()
  var Eperiod= $('#filter_Eperiod').val()
  var NIK = $('#NIK').text();
  var id_User = $('#id_User').text();
  var id_dept = $('#id_dept').text();
  $('.summarycard').remove();
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    _token: '{{ csrf_token() }}',
    url: '/hrdats/requestor/summaryfptk',
    type: 'post',
    data: {
      Speriod:Speriod,
      Eperiod:Eperiod,
      NIK:NIK,
      id_User:id_User,
      id_dept:id_dept
    }
  }).done((data) => {
    // console.log(JSON.stringify(data));
    data.forEach(element => {
      var html  = "<div class='col-xl-2 col-md-4 summarycard'>"
          html +=   "<div class='card card-stats'>"
          html +=     "<div class='card-body'>"
          html +=       "<div class='row'>"
          html +=         "<div class='col'>"
          html +=            "<h5 class='card-title text-uppercase text-muted mb-0'>"+element.keterangan+"</h5>"
          html +=            "<span class='h2 font-weight-bold mb-0'>"+element.counts+"</span>"
          html +=         "</div>"
          html +=       "</div>"
          html +=     "</div>"
          html +=   "</div>"
          html += "</div>"
      
      $('#summary').append(html);
    });
  });
}

function loadTbl_RqFPTK(nofptk=null,lokasi=null,status=null,lob=null,namapeminta=null){
  var Speriod= $('#filter_Speriod').val()
  var Eperiod= $('#filter_Eperiod').val()
  var NIK = $('#NIK').text();
  var id_User = $('#id_User').text();
  var id_dept = $('#id_dept').text();
  var flag_atasan = $('#flag_atasan').text();
  // console.log(nofptk,lokasi,status,lob,namapeminta)
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/requestor/listfptk',
  //     type: 'post',
  //     data: {
  //       nik:NIK,
  //       id_User:id_User,
  //       id_dept:id_dept,
  //       nofptk:nofptk,
  //       lokasi:lokasi,
  //       status:status,
  //       lob:lob,
  //       namapeminta:namapeminta
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });
  
if (flag_atasan==1) {
  $('#TblReqFPTKAtasan').DataTable().destroy();
  $('#TblReqFPTKAtasan').DataTable({
      "scrollY":        "650px",
      "scrollX": true,
      "scrollCollapse": true,
      aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
      ],
      iDisplayLength: 5,
      ajax: {
        url: "/hrdats/requestor/listfptk",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  
        data:{
          Speriod:Speriod,
          Eperiod:Eperiod,
          nik:NIK,
          id_User:id_User,
          id_dept:id_dept,
          nofptk:nofptk,
          lokasi:lokasi,
          status:status,
          lob:lob,
          namapeminta:namapeminta
        },
        dataSrc:""
      },
      "paging":true,
      "bInfo" : false,
      "lengthChange": true,
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
            data: 'namapeminta',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'lobandsub',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'penempatan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'namaygdigantikan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'alasandigantikan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'keterangan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'namalengkap',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'proses',
            defaultContent: 'Tidak ada data'
          },
          {
              defaultContent: '',
              render: (data, type, row, meta)=> {
                  // return '<button type="button" class="btn btn-info" onclick="Modal_fptk(value)" data-toggle="modal" data-target=".modal-detail-fptk" value="'+row.id+'">Detail</button>'
                  // return '<a class="btn btn-info" href="/hrdats/detail/kandidat/'+row.id_TKandidat+'/'+row.noidentitas+'">Detail</a>'
                  if (row.id_TKandidat==null) {
                    return '<a class="btn btn-info" disabled>Detail</a>'
                  } else {
                    return '<a class="btn btn-info" href="/hrdats/detail/kandidat/'+row.id_TKandidat+'/'+row.noidentitas+'">Detail</a>'
                  }
              }
          }
      ] 
    });
} else {
  $('#TblReqFPTK').DataTable().destroy();
  $('#TblReqFPTK').DataTable({
      "scrollY":        "650px",
      "scrollX": true,
      "scrollCollapse": true,
      aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
      ],
      iDisplayLength: 5,
      ajax: {
        url: "/hrdats/requestor/listfptk",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  
        data:{
          Speriod:Speriod,
          Eperiod:Eperiod,
          nik:NIK,
          id_User:id_User,
          id_dept:id_dept,
          nofptk:nofptk,
          lokasi:lokasi,
          status:status
        },
        dataSrc:""
      },
      "paging":true,
      "bInfo" : false,
      "lengthChange": true,
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
            data: 'penempatan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'namaygdigantikan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'alasandigantikan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'keterangan',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'namalengkap',
            defaultContent: 'Tidak ada data'
          },
          {
            data: 'proses',
            defaultContent: 'Tidak ada data'
          },
          {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                // return '<button type="button" class="btn btn-info" onclick="Modal_fptk(value)" data-toggle="modal" data-target=".modal-detail-fptk" value="'+row.id+'">Detail</button>'
                if (row.golongan==null || row.namalengkap==null) {
                  return '<button type="button"  class="btn btn-danger d-flex" data-toggle="modal" data-target="#modalLHW" disabled>LHW</button>'
                } else {
                  return '<button type="button" onclick="Modal_LHW(this)" class="btn btn-danger d-flex" data-toggle="modal" data-target="#modalLHW" data-golongan="'+row.golongan+'" data-idfptk="'+row.id+'" data-idkandidat="'+row.idkandidat+'">LHW</button>'
                }
                
            }
          },
          {
              defaultContent: '',
              render: (data, type, row, meta)=> {
                  // return '<button type="button" class="btn btn-info" onclick="Modal_fptk(value)" data-toggle="modal" data-target=".modal-detail-fptk" value="'+row.id+'">Detail</button>'
                  if (row.id_TKandidat==null) {
                    return '<a class="btn btn-info" disabled>Detail</a>'
                  } else {
                    return '<a class="btn btn-info" href="/hrdats/detail/kandidat/'+row.id_TKandidat+'/'+row.noidentitas+'">Detail</a>'
                  }
                 
              }
          }
      ] 
    });
  }
  
}

function Modal_LHW(obj){
 golongan= $(obj).data('golongan')
 idkandidat= $(obj).data('idkandidat')
 idfptk= $(obj).data('idfptk')
//  console.log(asd)
  $('#idfptk').val(idfptk)
  $('#downloadLHW').attr("href", "/hrdats/requestor/lhw/"+golongan+"/"+idkandidat+"/"+idfptk)
}


//--------END FPTK------------

//----------MPP---------------

function loadTbl_RqMPP(){
  
  $('#filtermpp').on('click', function() {
    $('.datampp').remove();
    var key_be=['gol 7-8','gol 6','gol 5','gol 4','gol 3','gol 1-2','ttlPermanen','ttlTemporary']
    var be =[];
    var val_actual = []
    var key_actual = [8,7,6,5,4,3,2,1]
    var actual=[]
    var val
    var val2
    var permanen=0

    var filter_thn = $('#filter_tahunBE').val();
    var filter_lob = $('#filter_lob').val();

    // $('#inf_thn').text(filter_thn);
    // $('#inf_lob').text(filter_lob);
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/requestor/show/mpp',
        type: 'post',
        data: {
            thn:filter_thn,
            lob:filter_lob
        }
      }).done((data) => {
        if (data[2].length>0) {
          for (let index = 0; index < key_actual.length; index++) {
            if (data[2][0][key_actual[index]]==null) {
              val = 0;
            }else{
              val = parseInt(data[2][0][key_actual[index]]);
            }
            permanen = permanen + val;
            val_actual.push(val)
          }
          actual.push(val_actual[0]+val_actual[1],val_actual[2],val_actual[3],val_actual[4],val_actual[5],val_actual[6]+val_actual[7],permanen,0)
        }else{
          actual.push(0,0,0,0,0,0,0,0)
        }
        
        if (data[1].length>0) {
          for (let index = 0; index < key_be.length; index++) {
            if (data[1][0][key_be[index]]==null) {
              val2 = 0;
            } else {
              val2 = data[1][0][key_be[index]];
            }
            be.push(val2)
          }
        }

        // START Table
        var html=''
        for (let index = 0; index < data[0].length; index++) {
          html+='<tr class="datampp">'
          html+=  '<td>'+data[0][index]+'</td>'
          if (data[1].length<=0) {
            // ini kalo gak ada data BE
            html+=  '<td>'+'data belum ada'+'</td>'
          } else {
            html+=  '<td><input class="form-control" type="number" name=UpdateBE[] value='+be[index]+' min="0" readonly></input></td>'
          }
          html+=  '<td>'+actual[index]+'</td>'
          if (data[1].length<=0) {
            // ini kalo gak ada data BE
            html+=  '<td>'+'data belum ada'+'</td>'
          } else {
            html+=  '<td>'+(be[index]-actual[index])+'</td>'
          }
          
          html+='</tr>'
        }
        $('#detail').append(html);
        // END TABLE

        // console.log(JSON.stringify(data));
      });
  });
}
//----------END MPP-----------

