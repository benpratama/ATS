$( document ).ready(function() {
  loadTbl_url();
  addUrl();
  clearModal();
  Edit_Url();
  delete_Url();
});

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

function confirm(){
  Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
  if (result.isConfirmed) {
      alert()
  }
  })
}

function clearModal(){
  $('.modal-url').on('hide.bs.modal', function() {
      $('#TblDetailurl').DataTable().destroy();
      $('#new_Source').val();
      $('#new_note').val();
      $('#open_url').val();
      $('#close_url').val();
  })
  $('.modal-detail-url').on('hide.bs.modal', function() {
    $('#edit_Notes').val('');
    $('#edit_open_url').val('');
    $('#edit_close_url').val('');
    $('#btnEdit-url').val('');
  })
}

function loadTbl_url(){
  $('#TblUrl').DataTable({
      "scrollY":        "400px",
      "scrollCollapse": true,
      pageLength : 5,
      ajax: {
      url: "/hrdats/hrd/show/link",
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
          // {
          //     render: (data, type, row, meta)=> {
          //         return '<input type="checkbox" class="cek-url" value="'+row.id_Tjob+'">'
          //     }
          // },
          {
              data: 'nama',
              defaultContent: ''
          },
          {
            data: 'jumlah',
            defaultContent: ''
          },
          {
              defaultContent: '',
              render: (data, type, row, meta)=> {
                  return '<button type="button" class="btn btn-info" onclick="Modal_url(value)" data-toggle="modal" data-target=".modal-url" value="'+row.id_Tjob+'">Detail</button>'
              }
          }
      ] 
  });
}
function addUrl(){
  $('#checkclose').on('change',function(){
    $check = $('#checkclose').prop('checked')
    if ($check==true) {
      $('#close_url').attr('disabled',true)
      $('#close_url').val('9999-12-12T23:59');
    } else {
      $('#close_url').attr('disabled',false)
      $('#close_url').val('');
    }
  })

  $('#btnAdd-url').on('click', function() {
      var source = $('#new_Source').val();
      var id_job = $('#btnAdd-url').val();
      var open =$('#open_url').val();
      var close =$('#close_url').val();
      var notes =$('#new_note').val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          _token: '{{ csrf_token() }}',
          url: '/hrdats/hrd/add/link',
          type: 'post',
          data: {
            source:source,
            notes:notes,
            open:open,
            close:close,
            id_job:id_job
          }
        }).done((data) => {
          $('#new_Source').val('');
          $('#new_note').val('');
          $('#open_url').val('');
          $('#close_url').val('');
          $('#TblUrl').DataTable().ajax.reload();
          $('#TblDetailurl').DataTable().ajax.reload();
          console.log(JSON.stringify(data));
          alert();
      });
  })
}
function Modal_url(id){
  $('#btnAdd-url').val(id);
  $('#TblDetailurl').DataTable({
    "scrollX": true,
    "scrollY":        "400px",
    "scrollCollapse": true,
    pageLength : 3,
    ajax: {
    url: "/hrdats/hrd/modal/link/"+id,
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
            render: (data, type, row, meta)=> {
                return '<input type="checkbox" class="cek-detailurl" value="'+row.id+'">'
            }
        },
        {
          data: 'active',
          defaultContent: '',
          render: (data, type, row, meta)=> {

              switch(data){
                  case'1':
                  return'<label class="custom-toggle">'+
                              '<input type="checkbox" onclick="checkUrl(this)" checked value="'+row.id+'">'+
                              '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                          '</label>'
                  break;
                  case'0':
                  return'<label class="custom-toggle">'+
                              '<input type="checkbox" onclick="checkUrl(this)" value="'+row.id+'">'+
                              '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                          '</label>'
                  break;
                  default:
                      return data;
                      break;
              }
              
          }
        },
        {
            data: 'source',
            defaultContent: ''
        },
        {
          data: 'openlink',
          defaultContent: ''
        },
        {
          data: 'closelink',
          defaultContent: ''
        },
        {
          data: 'url',
          defaultContent: ''
        },
        {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                return '<button type="button" class="btn btn-info" onclick="Modal_url2(value)" data-toggle="modal" data-target=".modal-detail-url" value="'+row.id+'">Update</button>'
            }
        }
    ] 
  });

  //buat check
  $('#cekAll-detailurl').change(function(){
    $("input.cek-detailurl:checkbox").prop("checked",$(this).prop("checked"));
  })
}
function Modal_url2(id){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    _token: '{{ csrf_token() }}',
    url: '/hrdats/hrd/modal2/link/'+id,
    type: 'get'
  }).done((data) => {
    $('#edit_Source').val(data[0].source);
    $('#edit_open_url').val(data[0].openlink.slice(0, 16));
    $('#edit_close_url').val(data[0].closelink.slice(0, 16));
    $('#edit_Notes').val(data[0].noteslink);
    $('#btnEdit-url').val(id);
    // console.log(JSON.stringify(data));
  });
}
function Edit_Url(){
  $('#edit_checkclose').on('change',function(){
    $check = $('#edit_checkclose').prop('checked')
    if ($check==true) {
      $('#edit_close_url').attr('disabled',true)
      $('#edit_close_url').val('9999-12-12T23:59');
    } else {
      $('#edit_close_url').attr('disabled',false)
      $('#edit_close_url').val('');
    }
  })

  $('#btnEdit-url').on('click', function() {
      var editnote = $('#edit_Notes').val();
      var editopenlink = $('#edit_open_url').val();
      var editcloselink = $('#edit_close_url').val();
      var idurl = $('#btnEdit-url').val();

      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          _token: '{{ csrf_token() }}',
          url: '/hrdats/hrd/edit/link',
          type: 'post',
          data: {
            editnote:editnote,
            editopenlink:editopenlink,
            editcloselink:editcloselink,
            idurl:idurl
          }
        }).done((data) => {
          $(".modal-detail-url").modal('hide');
          $('#TblDetailurl').DataTable().ajax.reload();
          console.log(JSON.stringify(data));
          alert();
      });
  })
}
function checkUrl(obj){
  if (obj.checked==false) {
      console.log('nonactive')
      var active=0;
  } else {
      console.log('active')
      var active=1;
  }
  
  var id_Url= obj.value;

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/hrd/active/link',
      type: 'post',
      data: {
          active:active,
          id_Url:id_Url
      }
    }).done((data) => {
      $('#TblDetailurl').DataTable().ajax.reload();
      console.log(JSON.stringify(data));
  });

}
function delete_Url(){
  $('#btnDel-url').on('click', function() {
    var arrId_url=[];
      var cek = $('.cek-detailurl')
      for(var i=0; cek[i]; ++i){
          if(cek[i].checked){
              arrId_url.push(cek[i].value);
          }
      }
      if (arrId_url.length>0) {
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });
              $.ajax({
                  _token: '{{ csrf_token() }}',
                  url: '/hrdats/hrd/del/link',
                  type: 'post',
                  data: {
                    arrId_url:arrId_url
                  }
                }).done((data) => {
                  $('#TblDetailurl').DataTable().ajax.reload();
                  // console.log(JSON.stringify(data));
                });
              // console.log(arrId_url);
              alert()
          }
      })
      }
  })
}