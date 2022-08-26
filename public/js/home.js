$( document ).ready(function() {
  ShowSummary()
  ShowDetail()
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
  $('#TblKandidat').DataTable({
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
            }
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