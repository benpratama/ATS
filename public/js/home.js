$( document ).ready(function() {
  ShowSummary()
  ShowDetail()
  hide()
  filter()
  // GetName()
  $('#f_gender').select2();
  $('#f_pendidikan').select2();
  $('#f_jurusans').select2();
  $('#f_job').select2();
  $('#f_status').select2();
  $('#f_domisili').select2();
});

function ShowSummary(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    _token: '{{ csrf_token() }}',
    url: '/hrdats/dashboard/hrd/summary',
    type: 'get'
  }).done((data) => {
    data.forEach(element => {
      var html  = "<div class='col-xl-2 col-md-4'>"
          html +=   "<div class='card card-stats'>"
          html +=     "<div class='card-body'>"
          html +=       "<div class='row'>"
          html +=         "<div class='col'>"
          html +=            "<h5 class='card-title text-uppercase text-muted mb-0'>"+element.proses+"</h5>"
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

function filter(){
  $('#filterdashboard').on('click',function(){
    var Speriod = $('#filter_Speriod').val()
    var Eperiod = $('#filter_Eperiod').val()
    var Sumur = $('#startAge').val()
    var Eumur = $('#endAge').val()
    var pendidikan=$("select[name='f_pendidikan[]']").map(function(){return $(this).val();}).get();
    var jurusan=$("select[name='f_jurusan[]']").map(function(){return $(this).val();}).get();
    var job=$("select[name='f_job[]']").map(function(){return $(this).val();}).get();
    var status=$("select[name='f_status[]']").map(function(){return $(this).val();}).get();
    var domisili=$("select[name='f_domisili[]']").map(function(){return $(this).val();}).get();
  
  
  ShowDetail(Speriod,Eperiod,Sumur,Eumur,pendidikan,jurusan,job,status,domisili)
  })
}

function ShowDetail(Speriod,Eperiod,Sumur,Eumur,pendidikan,jurusan,job,status,domisili){
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
  $('#TblKandidat').DataTable().destroy();
  $('.filters').remove();
  $('#TblKandidat thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#TblKandidat thead');
        
  $('#TblKandidat').DataTable({
    orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
  //                   console.log(title)
                    if(title!='' && title!="Detail"){
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
    "scrollY":        "400px",
    "scrollX": true,
    "scrollCollapse": true,
    pageLength : 5,
        ajax: {
          url: "/hrdats/dashboard/hrd/detail",
          type: "POST",
          data:{
            Speriod:Speriod,
            Eperiod:Eperiod,
            Sumur:Sumur,
            Eumur:Eumur,
            pendidikan:pendidikan,
            jurusan:jurusan,
            job:job,
            status:status,
            domisili:domisili
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
            render: (data, type, row, meta)=> {
                return '<input type="checkbox" class="cek-kandidat" value="'+row.id+'">'
            },
        },
        {
            data: 'umur',
            defaultContent: ''
        },
        {
            data: 'kota1',
            defaultContent: ''
        },
        {
            data: 'gender',
            defaultContent: ''
        },
        {
            data: 'pendidikan',
            defaultContent: ''
        },
        {
            data: 'jurusan',
            defaultContent: ''
        },
        {
            data: 'pengalaman',
            defaultContent: ''
        },
        {
            data: 'bidang',
            defaultContent: ''
        },
        {
          defaultContent: '',
          render: (data, type, row, meta)=> {
            return row.tahun+' Tahun '+row.bulan+' Bulan '+row.hari+' Hari'
          }
        },
        {
            data: 'bertugasluarkota',
            defaultContent: ''
        },
        {
          data: 'ditempatkanluarkota',
          defaultContent: ''
        },
        {
          data: 'SIM',
          defaultContent: ''
        },
        {
          data: 'nama',
          defaultContent: ''
        },
        {
          data: 'proses',
          defaultContent: ''
        },
        {
            defaultContent: '',
            render: (data, type, row, meta)=> {
                // return '<button type="button" class="btn btn-info" onclick="Modal_mcu(value)" data-toggle="modal" data-target=".modal-edit-mcu" value="'+row.id+'">Edit</button>'
                return '<a href="/hrdats/detail/kandidat/'+row.id+'/'+row.noidentitas+'" type="button" class="btn btn-info">Detail</a>'
            }
        }
    ] 
  });

  //buat check
  $('#cekAll-kandidat').change(function(){
      $("input.cek-kandidat:checkbox").prop("checked",$(this).prop("checked"));
  })
}

function ShowDetail(Speriod,Eperiod,Sumur,Eumur,pendidikan,jurusan,job,status,domisili){
  $('#TblKandidat').DataTable().destroy();
  $('.filters').remove();

  $('#TblKandidat thead tr')
        .clone(true)
        .addClass('filters')
        .appendTo('#TblKandidat thead');

  $('#TblKandidat').DataTable({
    orderCellsTop: true,
        fixedHeader: true,
        initComplete: function () {
            var api = this.api();
 
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    // Set the header cell to contain the input element
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                    var title = $(cell).text();
                    if(title!='' && title!="Detail"){
                      $(cell).html('<input style="width:100%" type="text" placeholder="' + title + '" />');
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
    "scrollY":        "400px",
    "scrollX": true,
    "scrollCollapse": true,
    pageLength : 5,
        ajax: {
          url: "/hrdats/dashboard/hrd/detail",
          type: "POST",
          data:{
            Speriod:Speriod,
            Eperiod:Eperiod,
            Sumur:Sumur,
            Eumur:Eumur,
            pendidikan:pendidikan,
            jurusan:jurusan,
            job:job,
            status:status,
            domisili:domisili
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
                    render: (data, type, row, meta)=> {
                        return '<input type="checkbox" class="cek-kandidat" value="'+row.id+'">'
                    },
                },
                {
                    data: 'umur',
                    defaultContent: ''
                },
                {
                    data: 'kota1',
                    defaultContent: ''
                },
                {
                    data: 'gender',
                    defaultContent: ''
                },
                {
                    data: 'pendidikan',
                    defaultContent: ''
                },
                {
                    data: 'jurusan',
                    defaultContent: ''
                },
                {
                    data: 'pengalaman',
                    defaultContent: ''
                },
                {
                    data: 'bidang',
                    defaultContent: ''
                },
                {
                  defaultContent: '',
                  render: (data, type, row, meta)=> {
                    return row.tahun+' Tahun '+row.bulan+' Bulan '+row.hari+' Hari'
                  }
                },
                {
                    data: 'bertugasluarkota',
                    defaultContent: ''
                },
                {
                  data: 'ditempatkanluarkota',
                  defaultContent: ''
                },
                {
                  data: 'SIM',
                  defaultContent: ''
                },
                {
                  data: 'nama',
                  defaultContent: ''
                },
                {
                  data: 'proses',
                  defaultContent: ''
                },
                {
                    defaultContent: '',
                    render: (data, type, row, meta)=> {
                        // return '<button type="button" class="btn btn-info" onclick="Modal_mcu(value)" data-toggle="modal" data-target=".modal-edit-mcu" value="'+row.id+'">Edit</button>'
                        return '<a href="/hrdats/detail/kandidat/'+row.id+'/'+row.noidentitas+'" type="button" class="btn btn-info">Detail</a>'
                    }
                }
    ] 
  });

  //buat check
  $('#cekAll-kandidat').change(function(){
      $("input.cek-kandidat:checkbox").prop("checked",$(this).prop("checked"));
  })
}

function GetName(){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/dashboard/hrd/name',
      type: 'get'
    }).done((data) => {
      console.log(JSON.stringify(data));
      $('#welcome').text(data);
    });
}

function hide(){
  $('#btnhide_summary').on('click', function() {
    var value = $('#btnhide_summary').data('value');
    if (value==0) {
    $('#body_summary').attr('hidden',true)
    $('#span_summary').text('open_in_full')
    $('#btnhide_summary').removeClass("btn-danger")
    $('#btnhide_summary').addClass("btn-success")
    $('#btnhide_summary').data('value',1);
    } else {
      $('#body_summary').attr('hidden',false)
      $('#span_summary').text('close_fullscreen')
      $('#btnhide_summary').removeClass("btn-success")
      $('#btnhide_summary').addClass("btn-danger")
      $('#btnhide_summary').data('value',0);
    }
   
  });
}
