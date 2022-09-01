$( document ).ready(function() {
  loadTbl_url();
  addUrl();
  clearModal();
});

function clearModal(){
  $('.modal-url').on('hide.bs.modal', function() {
      $('#TblDetailurl').DataTable().destroy();
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
          {
              render: (data, type, row, meta)=> {
                  return '<input type="checkbox" class="cek-url" value="'+row.id_Tjob+'">'
              }
          },
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

  //buat check
  $('#cekAll-url').change(function(){
      $("input.cek-url:checkbox").prop("checked",$(this).prop("checked"));
  })
}

function addUrl(){
  $('#btnAdd-url').on('click', function() {
      var source = $('#new_Source').val();
      var open =$('#open_url').val();
      var close =$('#close_url').val();

      console.log(source)
      console.log(open)
      console.log(close)
  })
}

function Modal_url(id){
  $('#TblDetailurl').DataTable({
    "scrollY":        "400px",
    "scrollCollapse": true,
    pageLength : 5,
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
                              '<input type="checkbox" onclick="checkSIMs(this)" checked value="'+row.id+'">'+
                              '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                          '</label>'
                  break;
                  case'0':
                  return'<label class="custom-toggle">'+
                              '<input type="checkbox" onclick="checkSIMs(this)" value="'+row.id+'">'+
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
                return '<button type="button" class="btn btn-info" onclick="Modal_url2(value)" data-toggle="modal" data-target=".modal-detailurl" value="'+row.id+'">Update</button>'
            }
        }
    ] 
  });
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
    $('#edit_open_url').val(data[0].openlink);
    $('#edit_close_url').val(data[0].closelink);
    $('#edit_Notes').val(data[0].noteslink);
    console.log(JSON.stringify(data));
  });
}