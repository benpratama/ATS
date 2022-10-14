$( document ).ready(function() {
  $("#lob_sublob").select2();
  clearModal();
  add_akses();
  showAkses();
  delete_Akses();
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

function clearModal(){
  $('.modal-tambah-aksesmpp').on('hide.bs.modal', function() {
      $('#username').val('');
      $('#lob_sublob').val(null).trigger('change');
  })
}

function add_akses(){
  var id_user=""
  var id_organisasi=""
  $('#username').change(function(){
    id_user=$('#username').val();
    id_organisasi = $(this).find(':selected').attr('data-idOrganisasi')
});

  $('#btnAdd-akses').on('click',function(){
    var id_lob=$("select[name='lob_sublob[]']").map(function(){return $(this).val();}).get();
    // var id_user=$('#username').val();
    // var id_organisasi = $('#username').attr('data-idOrganisasi');
    if(id_user != null && id_lob.length>0){
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      $.ajax({
          _token: '{{ csrf_token() }}',
          url: '/hrdats/menu/add/akses',
          type: 'post',
          data: {
              id_lob:id_lob,
              id_user:id_user,
              id_organisasi:id_organisasi
          }
        }).done((data) => {
          $(".modal-tambah-aksesmpp").modal('hide');
          $('#tblAksesMPP').DataTable().ajax.reload();
          console.log(JSON.stringify(data));
      });
      // console.log('valid',id_user,id_lob,id_organisasi)
    }else{
      console.log('tdk valid',id_user,id_lob)
    }
  })
}

function showAkses(){
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/dashboard/hrd/detail',
  //     type: 'post',
  //     data: {
  //       Speriod:Speriod,
  //       Eperiod:Eperiod,
  //       Sumur:Sumur,
  //       Eumur:Eumur,
  //       pendidikan:pendidikan,
  //       jurusan:jurusan,
  //       job:job,
  //       status:status,
  //       domisili:domisili
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });


  $('#tblAksesMPP').DataTable().destroy();
  $('.filters').remove();

  $('#tblAksesMPP thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#tblAksesMPP thead');

  $('#tblAksesMPP').DataTable({
    orderCellsTop: true,
    fixedHeader: true,
    initComplete: function () {
      var api = this.api();
          api
            .columns()
            .eq(0)
            .each(function (colIdx) {
              // Set the header cell to contain the input element
              var cell = $('.filters th').eq(
                $(api.column(colIdx).header()).index()
              );

              var title = $(cell).text();
              if(title!='' && title!="Active"){
                $(cell).html('<input type="text" style="width:100%" placeholder="' + title + '" />');
              }else{
                $(cell).html('');
              }
                    
 
              // On every keypress in this input
              $(
                  'input',
                  $('.filters th').eq($(api.column(colIdx).header()).index())
              )
              .off('keyup change')
              .on('change', function (e) {
                // Get the search value
                $(this).attr('title', $(this).val());
                var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
                  // var cursorPosition = this.selectionStart;
                  // Search the column for that value
                  api
                      .column(colIdx)
                      .search(
                          this.value != ''
                              ? regexr.replace('{search}', '(((' + this.value + ')))')
                              : '',
                          this.value != '',
                          this.value == ''
                      )
                      .draw();
              })
              .on('keyup', function (e) {
                  var cursorPosition = this.selectionStart;
                  e.stopPropagation();

                  $(this).trigger('change');
                  $(this)
                      .focus()[0]
                      
                      .setSelectionRange(cursorPosition, cursorPosition);
              });
            });
    },
    "scrollY":        "650px",
    "scrollCollapse": true,
    aLengthMenu: [
      [5,10,25,50,100 , -1],
      [5,10,25,50,100 , "All"]
    ],
    iDisplayLength: 5,
    ajax: {
    url: "/hrdats/menu/getMPP",
            data:{},
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
          render: (data, type, row, meta)=> {
              return '<input type="checkbox" class="cek-akses" value="'+row.id+'">'
          }
        },
        {
            data: 'active',
            defaultContent: '',
            render: (data, type, row, meta)=> {

                switch(data){
                    case'1':
                    return'<label class="custom-toggle">'+
                                '<input type="checkbox" onclick="checkAkses(this)" checked value="'+row.id+'">'+
                                '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                            '</label>'
                    break;
                    case'0':
                    return'<label class="custom-toggle">'+
                                '<input type="checkbox" onclick="checkAkses(this)" value="'+row.id+'">'+
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
            data: 'nama',
            defaultContent: ''
        },
        {
          data: 'title',
          defaultContent: ''
        },
        {
          data: 'department',
          defaultContent: ''
        },
        {
          data: 'akses',
          defaultContent: ''
        }
    ] 
  });

  //buat check
  $('#cekAll-akses').change(function(){
    $("input.cek-akses:checkbox").prop("checked",$(this).prop("checked"));
})
}

function checkAkses(obj){
  if (obj.checked==false) {
      // console.log('nonactive')
      var active=0;
  } else {
      // console.log('active')
      var active=1;
  }
  
  var id_akses= obj.value;

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/menu/active/akses',
      type: 'post',
      data: {
          active:active,
          id_akses:id_akses
      }
    }).done((data) => {
      $('#tblAksesMPP').DataTable().ajax.reload();
      // console.log(JSON.stringify(data));
  });

}

function delete_Akses(){
  $('#btnDel-akses').on('click', function() {
      //ini buat ambil ID-nya
      var arrId_akses=[];
      var cek = $('.cek-akses')
      for(var i=0; cek[i]; ++i){
          if(cek[i].checked){
              arrId_akses.push(cek[i].value);
          }
      }
      if(arrId_akses.length>0){
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
                      url: '/hrdats/menu/del/akses',
                      type: 'post',
                      data: {
                        arrId_akses:arrId_akses
                      }
                  }).done((data) => {
                      $('#tblAksesMPP').DataTable().ajax.reload();
                      console.log(JSON.stringify(data));
                  });
                  alert();
              }
          })
      }
  })
}