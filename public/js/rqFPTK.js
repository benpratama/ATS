$( document ).ready(function() {
  loadTbl_RqFPTK()
  // Row_kandidat()
  // update_Fptk()
  // detailKandidat()
  // Update_modal()
  // clearModal()
  // filter()
  // exportDataFPTK()
  // clearFilter()
  // cek_posisi_organisasi();

  // $('#filter_nofptk').select2();
  // $('#filter_namapeminta').select2();
  // $('#filter_namaatasan').select2();
  // $('#filter_posisi').select2();
  // $('#filter_lokasi').select2();
  // $('#filter_status').select2();
});


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

    $('#F_startTgl').text(filter_Speriod);
    $('#F_endTgl').text(filter_Eperiod);

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


function loadTbl_RqFPTK(){
  var NIK = $('#NIK').text();
  var id_User = $('#id_User').text();
  var id_dept = $('#id_dept').text();
  var id_User = $('#id_User').text();
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
  //       id_dept:id_dept
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });
  
  $('#TblReqFPTK').DataTable().destroy();
  $('#TblReqFPTK').DataTable({
      "scrollY":        "400px",
      "scrollX": true,
      "scrollCollapse": true,
      pageLength : 5,
      ajax: {
        url: "/hrdats/requestor/listfptk",
        type: "POST",
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },  
        data:{
          nik:NIK,
          id_User:id_User,
          id_dept:id_dept
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
                  return '<a class="btn btn-info" href="/hrdats/detail/kandidat/'+row.id_TKandidat+'/'+row.noidentitas+'">Detail</a>'
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

