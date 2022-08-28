$( document ).ready(function() {
  ShowSummary()
  ShowDetail()
  // DatabtaleSearch()
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

function ShowDetail(){
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
                    $(cell).html('<input type="text" placeholder="' + title + '" />');
 
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
              id_Organisasi:1
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
            data: 'lamakerja',
            defaultContent: ''
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

function DatabtaleSearch(){
  $('#DTsearch .thseacrh').each(function () {
    var title = $(this).text();
    $(this).html('<input type="text" placeholder="Search ' + title + '" />');
  });
}