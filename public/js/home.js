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
  $('#ccto').select2();
  $('#labMCU').select2();
  
  create_schedule();
  hidde();
  modalInformasi();
  filterProses();
  transferKandidat();
  modal()
  getSchedule()
  kirimEmail()
  $('#schedule, #proses, #konfirmasi, #bahasa').on('change',function(){tampilin_email()})
  $('#schedule, #proses, #konfirmasi').on('change',function(){modalInformasi()})
});

// function ShowSummary(){
//   $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//   $.ajax({
//     _token: '{{ csrf_token() }}',
//     url: '/hrdats/dashboard/hrd/summary',
//     type: 'get'
//   }).done((data) => {
//     data.forEach(element => {
//       var html  = "<div class='col-xl-2 col-md-4'>"
//           html +=   "<div class='card card-stats'>"
//           html +=     "<div class='card-body'>"
//           html +=       "<div class='row'>"
//           html +=         "<div class='col'>"
//           html +=            "<h5 class='card-title text-uppercase text-muted mb-0'>"+element.proses+"</h5>"
//           html +=            "<span class='h2 font-weight-bold mb-0'>"+element.counts+"</span>"
//           html +=         "</div>"
//           html +=       "</div>"
//           html +=     "</div>"
//           html +=   "</div>"
//           html += "</div>"
      
//       $('#summary').append(html);
//     });
//   });
// }

function ShowSummary(Speriod,Eperiod){
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/dashboard/hrd/summary',
      type: 'post',
      data: {
        Speriod:Speriod,
        Eperiod:Eperiod
      }
    }).done((data) => {
      $('.sub_summary').remove();
      // console.log(JSON.stringify(data));
      data.forEach(element => {
        var html  = "<div class='col-xl-2 col-md-4 sub_summary'>"
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
    })
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
  ShowSummary(Speriod,Eperiod)
  })
}

// function ShowDetail(Speriod,Eperiod,Sumur,Eumur,pendidikan,jurusan,job,status,domisili){
//   $.ajaxSetup({
//     headers: {
//         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     }
//   });
//   $.ajax({
//       _token: '{{ csrf_token() }}',
//       url: '/hrdats/dashboard/hrd/detail',
//       type: 'post',
//       data: {
//         Speriod:Speriod,
//         Eperiod:Eperiod,
//         Sumur:Sumur,
//         Eumur:Eumur,
//         pendidikan:pendidikan,
//         jurusan:jurusan,
//         job:job,
//         status:status,
//         domisili:domisili
//       }
//     }).done((data) => {
//       console.log(JSON.stringify(data));
//   });
//   // $('#TblKandidat').DataTable().destroy();
//   // $('.filters').remove();
//   // $('#TblKandidat thead tr')
//   //       .clone(true)
//   //       .addClass('filters')
//   //       .appendTo('#TblKandidat thead');
        
//   // $('#TblKandidat').DataTable({
//   //   orderCellsTop: true,
//   //   fixedHeader: true,
//   //   initComplete: function () {
//   //     var api = this.api();
//   //         api
//   //           .columns()
//   //           .eq(0)
//   //           .each(function (colIdx) {
//   //             // Set the header cell to contain the input element
//   //             var cell = $('.filters th').eq(
//   //               $(api.column(colIdx).header()).index()
//   //             );

//   //             var title = $(cell).text();
//   //             if(title!='' && title!="Detail"){
//   //               $(cell).html('<input type="text" style="width:100%" placeholder="' + title + '" />');
//   //             }else{
//   //               $(cell).html('');
//   //             }
                    
 
//   //             // On every keypress in this input
//   //             $(
//   //                 'input',
//   //                 $('.filters th').eq($(api.column(colIdx).header()).index())
//   //             )
//   //             .off('keyup change')
//   //             .on('change', function (e) {
//   //               // Get the search value
//   //               $(this).attr('title', $(this).val());
//   //               var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
//   //                 // var cursorPosition = this.selectionStart;
//   //                 // Search the column for that value
//   //                 api
//   //                     .column(colIdx)
//   //                     .search(
//   //                         this.value != ''
//   //                             ? regexr.replace('{search}', '(((' + this.value + ')))')
//   //                             : '',
//   //                         this.value != '',
//   //                         this.value == ''
//   //                     )
//   //                     .draw();
//   //             })
//   //             .on('keyup', function (e) {
//   //                 var cursorPosition = this.selectionStart;
//   //                 e.stopPropagation();

//   //                 $(this).trigger('change');
//   //                 $(this)
//   //                     .focus()[0]
                      
//   //                     .setSelectionRange(cursorPosition, cursorPosition);
//   //             });
//   //           });
//   //   },
//   //   "scrollY":        "400px",
//   //   "scrollX": true,
//   //   "scrollCollapse": true,
//   //   pageLength : 5,
//   //       ajax: {
//   //         url: "/hrdats/dashboard/hrd/detail",
//   //         type: "POST",
//   //         data:{
//   //           Speriod:Speriod,
//   //           Eperiod:Eperiod,
//   //           Sumur:Sumur,
//   //           Eumur:Eumur,
//   //           pendidikan:pendidikan,
//   //           jurusan:jurusan,
//   //           job:job,
//   //           status:status,
//   //           domisili:domisili
//   //         },
//   //         dataSrc:""
//   //       },
//   //   "paging":true,
//   //   "bInfo" : false,
//   //   "lengthChange": false,
//   //   language: {
//   //       paginate: {
//   //           previous: "<i class='fas fa-angle-left'>",
//   //           next: "<i class='fas fa-angle-right'>"
//   //       }
//   //   },
//   //   columns: [
//   //       {
//   //           render: (data, type, row, meta)=> {
//   //               return '<input type="checkbox" class="cek-kandidat" value="'+row.id+'">'
//   //           },
//   //       },
//   //       {
//   //           data: 'umur',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //           data: 'domisilisaatini',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //           data: 'gender',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //           data: 'pendidikan',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //           data: 'jurusan',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //           data: 'pengalaman',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //           data: 'bidang',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //         defaultContent: '',
//   //         render: (data, type, row, meta)=> {
//   //           return row.tahun+' Tahun '+row.bulan+' Bulan '+row.hari+' Hari'
//   //         }
//   //       },
//   //       {
//   //           data: 'bertugasluarkota',
//   //           defaultContent: ''
//   //       },
//   //       {
//   //         data: 'ditempatkanluarkota',
//   //         defaultContent: ''
//   //       },
//   //       {
//   //         data: 'SIM',
//   //         defaultContent: ''
//   //       },
//   //       {
//   //         data: 'nama',
//   //         defaultContent: ''
//   //       },
//   //       {
//   //         data: 'proses',
//   //         defaultContent: ''
//   //       },
//   //       {
//   //           defaultContent: '',
//   //           render: (data, type, row, meta)=> {
//   //               // return '<button type="button" class="btn btn-info" onclick="Modal_mcu(value)" data-toggle="modal" data-target=".modal-edit-mcu" value="'+row.id+'">Edit</button>'
//   //               return '<a href="/hrdats/detail/kandidat/'+row.id+'/'+row.noidentitas+'" type="button" class="btn btn-info">Detail</a>'
//   //           }
//   //       }
//   //   ] 
//   // });

//   // buat check
//   // $('#cekAll-kandidat').change(function(){
//   //     $("input.cek-kandidat:checkbox").prop("checked",$(this).prop("checked"));
//   // })
// }

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
    aLengthMenu: [
      [5,10,25,50,100 , -1],
      [5,10,25,50,100 , "All"]
  ],
  iDisplayLength: 5,
  processing: true,
  serverSide: true,
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
          }
        },
    "paging":true,
    "bInfo" : true,
    "lengthChange": true,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
    columns: [
              {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                        return '<input type="checkbox" class="cek-kandidat" value="'+row.id+'">'
                    }
                },
                {
                  // data: 'jobfair',
                  defaultContent: '',
                  render: (data, type, row, meta)=> {
                    if (row.jobfair==1) {
                      return 'YA'
                    }else{
                      return 'TIDAK'
                    }
                  }
                },
                {
                    data: 'umur',
                    defaultContent: ''
                },
                {
                    data: 'CityName',
                    defaultContent: ''
                },
                {
                    data: 'gender',
                    defaultContent: '',
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
                    defaultContent: '',
                    render: (data, type, row, meta)=> {
                      if (row.jobfair==1 && row.updated_at==null) {
                        return ''
                      } else {
                        return data
                      }
                    }
                },
                {
                    data: 'bidang',
                    defaultContent: ''
                },
                {
                  defaultContent: '',
                  render: (data, type, row, meta)=> {
                    if (row.jobfair==1 && row.updated_at==null) {
                      return ''
                    } else {
                      return row.tahun+' Tahun '+row.bulan+' Bulan '+row.hari+' Hari'
                    }
                  }
                },
                {
                    data: 'bertugasluarkota',
                    defaultContent: '',
                },
                {
                  data: 'ditempatkanluarkota',
                  defaultContent: '',
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

//schedule
function create_schedule(){
  $('#btnAdd-schedule').on('click',function(){
    var arrId_kandidat=[];
    var cek = $('.cek-kandidat')
    for(var i=0; cek[i]; ++i){
        if(cek[i].checked){
          arrId_kandidat.push(cek[i].value);
        }
    }
    namagroup = $('#namagroup').val();
    schedule = $('#schedule').val();
    ccTo =$("select[name='ccto[]']").map(function(){return $(this).val();}).get();
    tglWaktu = $('#tglWaktu').val()
    online = $('#proses').val();
    detail={}
    
    if (konfirmasi==undefined) {
      if (schedule==2) {
        Durasi = $('#mcu_Durasi').val() +' jam'
        id_lab = $('#mcu_lab').val();
        nosurat = $('#mcu_nosurat').val();
        online=0;

        detail={durasi:Durasi,id_lab:id_lab,nosurat:nosurat}  
      }else if(schedule==3 && online==1){
        psikotest_1_Durasi = $('#psikotest_1_Durasi').val()
        psikotest_1_Link = $('#psikotest_1_Link').val()
        psikotest_1_PIC = $('#psikotest_1_PIC').val()

        detail={psikotest_1_Durasi:psikotest_1_Durasi,psikotest_1_Link:psikotest_1_Link,psikotest_1_PIC:psikotest_1_PIC}
      }else if(schedule==3 && online==0){
        psikotest_0_Address = $('#psikotest_0_Address').val()
        psikotest_0_Room = $('#psikotest_0_Room').val()
        psikotest_0_PIC = $('#psikotest_0_PIC').val()

        detail={psikotest_0_Address:psikotest_0_Address,psikotest_0_Room:psikotest_0_Room,psikotest_0_PIC:psikotest_0_PIC}
      }else if(schedule==4 && online==1){
        test_1_Durasi = $('#test_1_Durasi').val()
        test_1_Link = $('#test_1_Link').val()

        detail={test_1_Durasi:test_1_Durasi,test_1_Link:test_1_Link}
      }else if(schedule==4 && online==0){
        test_0_Durasi = $('#test_0_Durasi').val()
        test_0_lokasi = $('#test_0_lokasi').val()

        detail={test_0_Durasi:test_0_Durasi,test_0_lokasi:test_0_lokasi}
      }else if(schedule==5 && online==1){
        interviewHR_1_Link = $('#interviewHR_1_Link').val()
        interviewHR_1_MeetingID = $('#interviewHR_1_MeetingID').val()
        interviewHR_1_Passcode = $('#interviewHR_1_Passcode').val()
        interviewHR_1_BR = $('#interviewHR_1_BR').val()
        interviewHR_1_Durasi = $('#interviewHR_1_Durasi').val()
        interviewHR_1_User = $('#interviewHR_1_User').val()

        detail={interviewHR_1_Link:interviewHR_1_Link,interviewHR_1_MeetingID:interviewHR_1_MeetingID,
                interviewHR_1_Passcode:interviewHR_1_Passcode,interviewHR_1_BR:interviewHR_1_BR,
                interviewHR_1_Durasi:interviewHR_1_Durasi,interviewHR_1_User:interviewHR_1_User}
      }else if(schedule==6 && online==1){
        interviewuser_1_Link = $('#interviewuser_1_Link').val()
        interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
        interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
        interviewuser_1_BR = $('#interviewuser_1_BR').val()
        interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val()
        interviewuser_1_User = $('#interviewuser_1_User').val()

        detail={interviewuser_1_Link:interviewuser_1_Link,interviewuser_1_MeetingID:interviewuser_1_MeetingID,
                interviewuser_1_Passcode:interviewuser_1_Passcode,interviewuser_1_BR:interviewuser_1_BR,
                interviewuser_1_Durasi:interviewuser_1_Durasi,interviewuser_1_User:interviewuser_1_User}
      }else if(schedule==9 && online==1){
        offer_1_Link = $('#offer_1_Link').val()
        offer_1_MeetingID = $('#offer_1_MeetingID').val()
        offer_1_Passcode = $('#offer_1_Passcode').val()
        offer_1_BR = $('#offer_1_BR').val()
        offer_1_Durasi = $('#offer_1_Durasi').val()
        offer_1_Deadline = $('#offer_1_Deadline').val()
        offer_1_URLPhase2 = $('#offer_1_URLPhase2').val()

        detail={offer_1_Link:offer_1_Link,offer_1_MeetingID:offer_1_MeetingID,offer_1_Passcode:offer_1_Passcode,
          offer_1_BR:offer_1_BR,offer_1_Durasi:offer_1_Durasi,offer_1_Deadline:offer_1_Deadline,offer_1_URLPhase2:offer_1_URLPhase2
        }
      }else if(schedule==9 && online==2){
        offer_2_Durasi = $('#offer_2_Durasi').val()
        offer_2_Deadline = $('#offer_2_Deadline').val()
        offer_2_URLPhase2 = $('#offer_2_URLPhase2').val()

        detail={offer_2_Durasi:offer_2_Durasi,offer_2_Deadline:offer_2_Deadline,offer_2_URLPhase2:offer_2_URLPhase2}
      }
    }else{
      if(schedule==2){
        id_lab = $('#mcu_lab').val();
        nosurat = $('#mcu_nosurat').val();
        online=0;

        detail={id_lab:id_lab,nosurat:nosurat}
      }else if(schedule==5){
        interviewHR_1_nk_PIC = $('#interviewHR_1_nk_PIC').val()
        interviewHR_1_nk_LINK = $('#interviewHR_1_nk_LINK').val()

        detail={interviewHR_1_nk_PIC:interviewHR_1_nk_PIC,interviewHR_1_nk_LINK:interviewHR_1_nk_LINK,arrId_kandidat:arrId_kandidat}
      }else if(schedule==6){
        interviewUser_1_nk_PIC = $('#interviewUser_1_nk_PIC').val()
        interviewUser_1_nk_LINK = $('#interviewUser_1_nk_LINK').val()

        detail={interviewUser_1_nk_PIC:interviewUser_1_nk_PIC,interviewUser_1_nk_LINK:interviewUser_1_nk_LINK}
      }
    }
   
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/detail/setschedule/groupkandidat',
        type: 'post',
        data: {
          arrId_kandidat:arrId_kandidat,
          schedule:schedule,
          ccTo:ccTo,
          tglWaktu:tglWaktu,
          online:online,
          namagroup:namagroup,
          detail:detail
        }
      }).done((data) => {
        console.log(JSON.stringify(data));
        $('#btnEmail').attr('value',data)
        $('#id_log').attr('value',data)
        $('#TblGroupschedule').DataTable().ajax.reload();
        $('#TblKandidat').DataTable().ajax.reload();
        // $('#tblSchedule').DataTable().ajax.reload();
    });
  });
}

function hidde(){
$('#MCU').hide()
$('#psikotest_1').hide()
$('#psikotest_0').hide()
$('#test_1').hide()
$('#test_0').hide()
$('.interviewHR_1').hide()
$('.interviewuser_1').hide()
$('.offer_1').hide()
$('.offer_2').hide()

$('#MCU_nk').hide()
$('#interviewHR_1_nk').hide()
$('#interviewUser_1_nk').hide()

$('#informasi1 .form-control').val('')  
$('#informasi1 :input').attr('disabled',false)
$('#informasi2 .form-control').val('')  
$('#informasi2 :input').attr('disabled',false)

$('#f_ccto').attr('hidden',false);
$('#tglWaktu').attr('readonly',false)
$('#btnUpdate-schedule').attr('hidden',true);
$('#schedule').attr('disabled',false);
$('#proses').attr('disabled',false);
$('#tglWaktu').val('')
$('#btnEmail').attr('disabled',false)
$('#konfirmasi').attr('disabled',false);
}

function modalInformasi(){
  hidde()
  schedule = $('#schedule').val();
  online = $('#proses').val();
  konfirmasi = $('#konfirmasi').val()
  $('#gen-doc').attr('hidden',true)
  $('#namagroup').val('')
  $('#btnAdd-schedule').attr('hidden',false)
  $('.tglandcc').attr('hidden',false)
  var list_onsite=['2']
  if (list_onsite.includes(schedule)==true) {
    online= 0
  }

  if (schedule==2  && online==0) {
    $('#MCU').show();
    $('#gen-doc').attr('hidden',false)
  } else if(schedule==3 && online==1) {
    $('#psikotest_1').show();
  }else if(schedule==3 && online==0) {
    $('#psikotest_0').show();
  }else if(schedule==4 && online==1){
    $('#test_1').show();
  }else if(schedule==4 && online==0){
    $('#test_0').show();
  }else if(schedule==5 && online==1){
    $('.interviewHR_1').show();
  }else if(schedule==6 && online==1){
    $('.interviewuser_1').show();
  }else if(schedule==9 && online==1){
    $('.offer_1').show();
  }else if(schedule==9 && online==2){
    $('.offer_2').show();
  }else if(schedule==21){
    $('#btnAdd-schedule').attr('hidden',true)
    $('.tglandcc').attr('hidden',true)
    console.log('aditional')
  }

  if(konfirmasi== 0){
    if(schedule==2 && online==0){
      $('#MCU_nk').show();
      $('#gen-doc').attr('hidden',false)
    }else if(schedule==5 && online==1){
      $('#interviewHR_1_nk').show();
    }else if(schedule==6 && online==1){
      $('#interviewUser_1_nk').show();
    }
  }else if(konfirmasi== 1){
    $('#btnAdd-schedule').attr('hidden',true)
    $('#gen-doc').attr('hidden',true)
  }

  
}

function onlineORonsite(){
  $('#proses').on('change',function(){
    proses = $('#proses').val();
    if(proses==1){
      $('#f_online').attr('hidden',false)
      $('#f_onsite').attr('hidden',true)
    }else if(proses==0){
      $('#f_online').attr('hidden',true)
      $('#f_onsite').attr('hidden',false)
    }else{
      $('#f_online').attr('hidden',true)
      $('#f_onsite').attr('hidden',true)
    }
  })
}

function filterProses(){
  $('#schedule').on('change',function(){
    schedule = $('#schedule').val();
    if (schedule==2) { 
      $('#form_mcu').attr('hidden',false)
      $('#onlineonsite').attr('hidden',true)
      $('#proses').attr('required',false)
    }else{
      $('#form_mcu').attr('hidden',true)
      $('#onlineonsite').attr('hidden',false)
      $('#proses').attr('required',true)
      $('#mcu_nosurat').val('')
      $('#labMCU').val(null).trigger('change');
    }
  });
}

function tampilin_email(_schedule=null,_online=null){
  // console.log(_schedule,_online)
  $('#konten').val('')
  $('#btnAdd-schedule').attr('disabled',false)
  var schedule = $('#schedule').val();
  var online = $('#proses').val();
  var konfirmasi = $('#konfirmasi').val();
  var organisasi = $('#id_Organisasi').val();
  var bahasa = $('#bahasa').val();
  var list_onsite=['2']
  var list_organisasi=['1','3']
  if (list_onsite.includes(schedule)==true) {
    online= 0
  }
  if(list_organisasi.includes(organisasi)){
    konfirmasi=0;
  }
  if(organisasi==1 || organisasi==2){
    bahasa=0
  }
  if(konfirmasi==1){
    $('#btnAdd-schedule').attr('disabled',true)
  }
  // console.log(schedule,online,organisasi,konfirmasi)
  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/konten/email',
      type: 'post',
      data: {
        schedule:schedule,
        online:online,
        organisasi:organisasi,
        konfirmasi:konfirmasi,
        bahasa:bahasa
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      if (data.length>0) {
        konten = data[0].konten
        $('#konten').val(konten)
      }
      // $('#summernote').summernote('code', '');
      // $('#summernote').summernote('code', $(konten));
  });
}

function modal(){
  $('.modal-tambah-groupschedule').on('hidden.bs.modal', function() {
    $('#namagroup').val('');
    $('#btnEmail').removeAttr("value");
    $('#schedule').val('');
    $('#proses').val('');
    $('#onlineonsite').attr('hidden',false)
    $('#btnAdd-schedule').attr('hidden',false);
    hidde()
    $('#tglWaktu').val('');
    $('#ccto').val(null).trigger('change');
    $('#konten').val('')
    $('#Tblsend').attr('hidden',true)
    $('#namagroup').attr('disabled',false)
    $('#Tblsend').DataTable().destroy();
  })
  $('.modal-transfer').on('hidden.bs.modal', function() {
    $('#organisasi').val('')
  })
}

function kirimEmail(){
  $('#btnEmail').on('click',function(){
    var arrId_kandidat=[];
    var cek = $('.cek-kandidat')
    for(var i=0; cek[i]; ++i){
        if(cek[i].checked){
          arrId_kandidat.push(cek[i].value);
        }
    }
    schedule = $('#schedule').val();
    online = $('#proses').val();

    konten = $('#konten').val();
    tglWaktuRaw = $('#tglWaktu').val();
    tglWaktuRaw = $('#tglWaktu').val();
    if (tglWaktuRaw.includes("T00:00")) {
      tglWaktu = tglWaktuRaw.replace("T00:00", "");
    } else {
      tglWaktu = tglWaktuRaw.replace("T", " Waktu: ");
    }
    id_group=$('#btnEmail').val()
    var organisasi = $('#id_Organisasi').val();
    data={}
    var list_organisasi=['1','3']
    var pic_name = $('#PICname').text();

    if (list_organisasi.includes(organisasi)) {

      if (schedule==2) {
        Durasi = $('#mcu_Durasi').val() +' jam'
        id_lab = $('#mcu_lab').val(); 

        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[DURATION]',Durasi)
        data={konten:konten,id_lab:id_lab,schedule:schedule,id_group:id_group}
      }else if(schedule==3 && online==1){
        psikotest_1_Durasi = $('#psikotest_1_Durasi').val()
        psikotest_1_Link = $('#psikotest_1_Link').val()
        psikotest_1_PIC = $('#psikotest_1_PIC').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[DURATION]',psikotest_1_Durasi)
        var konten = konten.replace('[TEST LINK]',psikotest_1_Link)
        var konten = konten.replace('[PIC’s NAME]',psikotest_1_PIC)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==3 && online==0){
        psikotest_0_Address = $('#psikotest_0_Address').val()
        psikotest_0_Room = $('#psikotest_0_Room').val()
        psikotest_0_PIC = $('#psikotest_0_PIC').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[ADDRESS]',psikotest_0_Address)
        var konten = konten.replace('[ROOM]',psikotest_0_Room)
        var konten = konten.replace('[PIC’s NAME]',psikotest_0_PIC)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==4 && online==1){
        test_1_Durasi = $('#test_1_Durasi').val()
        test_1_Link = $('#test_1_Link').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',test_1_Durasi)
        var konten = konten.replace('[TEST LINK]',test_1_Link)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==4 && online==0){
        test_0_Durasi = $('#test_0_Durasi').val()
        test_0_lokasi = $('#test_0_lokasi').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',test_0_Durasi)
        var konten = konten.replace('[ADDRESS]',test_0_lokasi)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==5 && online==1){
        interviewHR_1_Link = $('#interviewHR_1_Link').val()
        interviewHR_1_MeetingID = $('#interviewHR_1_MeetingID').val()
        interviewHR_1_Passcode = $('#interviewHR_1_Passcode').val()
        interviewHR_1_BR = $('#interviewHR_1_BR').val()
        interviewHR_1_Durasi = $('#interviewHR_1_Durasi').val()
        interviewHR_1_User = $('#interviewHR_1_User').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[LINK ZOOM]',interviewHR_1_Link)
        var konten = konten.replace('[MEETING IS]',interviewHR_1_MeetingID)
        var konten = konten.replace('[PASSCODE]',interviewHR_1_Passcode)
        var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewHR_1_BR)
        var konten = konten.replace('[DURATION]',interviewHR_1_Durasi)
        var konten = konten.replace(' [USER/INTERVIEWER]',interviewHR_1_User)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==6 && online==1){
        interviewuser_1_Link = $('#interviewuser_1_Link').val()
        interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
        interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
        interviewuser_1_BR = $('#interviewuser_1_BR').val()
        interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val()
        interviewuser_1_User = $('#interviewuser_1_User').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[LINK ZOOM]',interviewuser_1_Link)
        var konten = konten.replace('[MEETING IS]',interviewuser_1_MeetingID)
        var konten = konten.replace('[PASSCODE]',interviewuser_1_Passcode)
        var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewuser_1_BR)
        var konten = konten.replace('[DURATION]',interviewuser_1_Durasi)
        var konten = konten.replace(' [USER/INTERVIEWER]',interviewuser_1_User)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==9 && online==1){
        offer_1_Link = $('#offer_1_Link').val()
        offer_1_MeetingID = $('#offer_1_MeetingID').val()
        offer_1_Passcode = $('#offer_1_Passcode').val()
        offer_1_BR = $('#offer_1_BR').val()
        offer_1_Durasi = $('#offer_1_Durasi').val()
        offer_1_Deadline = $('#offer_1_Deadline').val()
        offer_1_URLPhase2 = $('#offer_1_URLPhase2').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',offer_1_Durasi)
        var konten = konten.replace('[LINK ZOOM]',offer_1_Link)
        var konten = konten.replace('[MEETING IS]',offer_1_MeetingID)
        var konten = konten.replace('[PASSCODE]',offer_1_Passcode)
        var konten = konten.replace('[BREAKOUT ROOM NAME]',offer_1_BR)
        var konten = konten.replace('[DEADLINE]',offer_1_Deadline)
        var konten = konten.replace('[LINK TO DATABASE PHASE – 2]',offer_1_URLPhase2)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==9 && online==2){
        offer_2_Durasi = $('#offer_2_Durasi').val()
        offer_2_Deadline = $('#offer_2_Deadline').val()
        offer_2_URLPhase2 = $('#offer_2_URLPhase2').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)

        var konten = konten.replace('[DURATION]',offer_2_Durasi)
        var konten = konten.replace('[DEADLINE]',offer_2_Deadline)
        var konten = konten.replace('[LINK TO DATABASE PHASE – 2]',offer_2_URLPhase2)

        data={konten:konten,schedule:schedule,id_group:id_group}
      }
    }else{
      var konfirmasi = $('#konfirmasi').val();
      if (schedule==5 && online==1 && konfirmasi==0) {
        interviewHR_1_nk_LINK = $('#interviewHR_1_nk_LINK').val()
        interviewHR_1_nk_PIC = $('#interviewHR_1_nk_PIC').val()
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        

        var konten = konten.replace('[LINK]',interviewHR_1_nk_LINK)
        var konten = konten.replace('[PIC NAME]',interviewHR_1_nk_PIC)
        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==6 && online==1 && konfirmasi==0){
        interviewuser_1_Link = $('#interviewuser_1_Link').val()

        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        var konten = konten.replace('[PIC NAME]',pic_name)

        var konten = konten.replace('[LINK]',interviewUser_1_nk_LINK)
        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==3 && online==1 && konfirmasi==0){
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        data={konten:konten,schedule:schedule,id_group:id_group}
      }else if(schedule==3 && online==1 && konfirmasi==1){
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        data={konten:konten,schedule:schedule,arrId_kandidat:arrId_kandidat}
      }else if(schedule==2 && konfirmasi==1){
        // id_lab = $('#mcu_lab').val();
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        data={konten:konten,schedule:schedule,arrId_kandidat:arrId_kandidat}
      }else if(schedule==2 && konfirmasi==0){
        var konten = konten.replace('[DATE&TIME]',tglWaktu)
        id_lab = $('#mcu_lab').val(); 

        data={konten:konten,id_lab:id_lab,schedule:schedule,id_group:id_group}
      }else if(schedule==21){
        data={konten:konten,id_kandidat:id_kandidat,schedule:schedule,id_email:null}
      }
    }

    // console.log(arrId_kandidat);
    // console.log(id_kandidat)
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/send/groupemail',
        type: 'post',
        // data: {
        //   konten:konten,
        //   id_group:id_group
        // }
        data:data
      }).done((data) => {
        console.log(JSON.stringify(data));
        // $('#tblSchedule').DataTable().ajax.reload();
        // $('.modal-tambah-groupschedule').modal('hide');
        // modal()
    });
  })
  

}

function transferKandidat(){
  $('#btntransfer').on('click',function(){
    var arrId_kandidat=[];
    var cek = $('.cek-kandidat')
    for(var i=0; cek[i]; ++i){
        if(cek[i].checked){
          arrId_kandidat.push(cek[i].value);
        }
    }
    var id_Organisasi = $('#organisasi').val();
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/dashboard/hrd/transfer',
        type: 'post',
        data: {
          id_Organisasi:id_Organisasi,
          arrId_kandidat:arrId_kandidat
        }
      }).done((data) => {
        console.log(JSON.stringify(data));
        html=""
        if (data.length!=0) {
          data.forEach(element => {
            html += "<div class='alert alert-danger alert-dismissible fade show' role='alert'>"
            html +=   "<span class='alert-icon'><i class='ni ni-notification-70'></i></span>"
            html +=   "<span class='alert-text'><strong>Danger!</strong>"
            html +=     "&emsp;"+element.namalengkap+" Terdaftar di NO FPTK <strong>"+element.nofptk+"</strong>"
            html +=   "</span>"
            html +=     "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>"
            html +=       "<span aria-hidden='true'>&times;</span>"
            html +=     "</button>"
            html += "</div>"
          });
          $('#notif').append(html)
        }
        $('#TblKandidat').DataTable().ajax.reload();
        $('.modal-transfer').modal('toggle');
        modal()
    });
  })
  
}

function getSchedule(){
  
  // $.ajaxSetup({
  //   headers: {
  //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  //   }
  // });
  // $.ajax({
  //     _token: '{{ csrf_token() }}',
  //     url: '/hrdats/dashboard/getschedule',
  //     type: 'get',
  //     data: {
  //     }
  //   }).done((data) => {
  //     console.log(JSON.stringify(data));
  // });

  $('#TblGroupschedule').DataTable({
    "scrollY":        "400px",
    "scrollCollapse": true,
    aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
    ],
    iDisplayLength: 5,
    ajax: {
    url: "/hrdats/dashboard/getschedule",
            data:{},
            dataSrc:""
        },
    "paging":true,
    "bInfo" : true,
    "lengthChange": true,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
    columns: [
        {
            data: 'namaGroup',
            defaultContent: ''
        },
        {
            data: 'proses',
            defaultContent: ''
        },
        {
            data: 'created_by',
            defaultContent: ''
        },
        {
            // data: 'created_at',
            // defaultContent: ''
            render: (data, type, row, meta)=> {
              return row.created_at.replace(':00.000','')
            }
        },
        // {
        //     defaultContent: '',
        //     render: (data, type, row, meta)=> {
        //         return '<button type="button" class="btn btn-info" onclick="Modal_sim(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.namaGroup+'">Detail</button>'
        //     }
        // },
        {
          defaultContent: '',
          
          render: (data, type, row, meta)=> {
              return '<button type="button" class="btn btn-info" onclick="show_detail(this)" data-toggle="modal" data-target=".modal-tambah-groupschedule" value="'+row.namaGroup+'" data-proses="'+row.id_Rekrutmen+'">Email</button>'
            // if (row.proses=='Apply') {
            //   return 'NULL'
            // } else {
            //   if (new Date(row.created_by)>today) {
            //     return '<button type="button" class="btn btn-info" onclick="show_detail(this)" data-toggle="modal" data-target=".modal-tambah-groupschedule" value="'+row.namaGroup+'" data-proses="'+row.id_Rekrutmen+'">Email</button>'
            //   } else {
            //     return '<button type="button" class="btn btn-info" onclick="show_detail(this)" data-toggle="modal" data-target=".modal-tambah-groupschedule" value="'+row.namaGroup+'" data-proses="'+row.id_Rekrutmen+'" disabled>Email</button>'
            //   }
            // }
          }
        }
    ],
    order: [[3, 'desc']]
  }); 
}

function show_detail(obj){
  var value =  $(obj).val();
  var proses = $(obj).data('proses');
  var today = new Date().toLocaleDateString();
    // $.ajaxSetup({
    //   headers: {
    //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //   }
    // });
    // $.ajax({
    //     _token: '{{ csrf_token() }}',
    //     url: '/hrdats/dashboard/hrd/schedule/getkandiat',
    //     type: 'post',
    //     data: {
    //       value:value,
    //       proses:proses
    //     }
    //   }).done((data) => {
    //     console.log(JSON.stringify(data));
    // });

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
      _token: '{{ csrf_token() }}',
      url: '/hrdats/dashboard/email/'+value+'/'+proses,
      type: 'get',
      data: {
      }
    }).done((data) => {
      // console.log(JSON.stringify(data));
      var id_organisasi = $('#id_Organisasi').val();
      $('#gen-doc').attr('hidden',true)
      $('#informasi1 :input').attr('disabled',true)
      $('#informasi2 :input').attr('disabled',true)
      $('#btnAdd-schedule').attr('hidden',true);
      $('#f_ccto').attr('hidden',true);
      $('#tglWaktu').attr('readonly',true)
      $('#schedule').attr('disabled',true);
      $('#proses').attr('disabled',true);
      $('#konfirmasi').val(0);
      $('#konfirmasi').attr('disabled',true)
      var schedule=data[0].id_Rekrutmen;
      var online=data[0].jenis;
      $('#schedule').val(schedule)
      $('#proses').val(online)
      $('#namagroup').val(data[0].namaGroup)
      $('#namagroup').attr('disabled',true)
      $('#id_log').attr('value',data[0].namaGroup)

      if(data[0].jadwal.split(" ")[0]<data[1]){
        $('#btnEmail').attr('disabled',true)
      }


      if (schedule==21) {
        online=1
      }
      // console.log(id_organisasi)
      if (id_organisasi!=2) {
        console.log('1')
        if (schedule==2) {
          detail = JSON.parse(data[0].test)
          durasi_raw = detail.durasi
          durasi = durasi_raw.replace(" jam","")
          online=0
  
          $('#MCU').show();
          $('#gen-doc').attr('hidden',false)
          $('#onlineonsite').attr('hidden',true)
          $('#mcu_Durasi').val(durasi)
          $('#mcu_lab').val(detail.id_lab)
          $('#mcu_nosurat').val(detail.nosurat)
        }else if(schedule==3 && online==1){
          detail = JSON.parse(data[0].test)
          durasi_raw = detail.psikotest_1_Durasi
          durasi = durasi_raw.replace(" jam","")
          
          $('#psikotest_1').show()
          $('#psikotest_1_Durasi').val(durasi)
          
          $('#psikotest_1_Link').val(detail.psikotest_1_Link)
          $('#psikotest_1_PIC').val(detail.psikotest_1_PIC)
        }else if(schedule==3 && online==0){
          detail = JSON.parse(data[0].test)
          
          $('#psikotest_0').show()
          $('#psikotest_0_Address').val(detail.psikotest_0_Address)
          $('#psikotest_0_Room').val(detail.psikotest_0_Room)
          $('#psikotest_0_PIC').val(detail.psikotest_0_PIC)
    
          
        }else if(schedule==4 && online==1){
          detail = JSON.parse(data[0].test)
          $('#test_1').show()
          $('#test_1_Durasi').val(detail.test_1_Durasi)
          $('#test_1_Link').val(detail.test_1_Link)
    
        }else if(schedule==4 && online==0){
          detail = JSON.parse(data[0].test)
  
          $('#test_0').show()
          $('#test_0_Durasi').val(detail.test_0_Durasi)
          $('#test_0_lokasi').val(detail.test_0_lokasi)
    
        }else if(schedule==5 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.interviewHR_1').show()
          $('#interviewHR_1_Link').val(detail.interviewHR_1_Link)
          $('#interviewHR_1_MeetingID').val(detail.interviewHR_1_MeetingID)
          $('#interviewHR_1_Passcode').val(detail.interviewHR_1_Passcode)
          $('#interviewHR_1_BR').val(detail.interviewHR_1_BR)
          $('#interviewHR_1_Durasi').val(detail.interviewHR_1_Durasi)
          $('#interviewHR_1_User').val(detail.interviewHR_1_User)
  
        }else if(schedule==6 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.interviewuser_1').show()
          interviewuser_1_Link = $('#interviewuser_1_Link').val(detail.interviewuser_1_Link)
          interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val(detail.interviewuser_1_MeetingID)
          interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val(detail.interviewuser_1_Passcode)
          interviewuser_1_BR = $('#interviewuser_1_BR').val(detail.interviewuser_1_BR)
          interviewuser_1_Durasi = $('#interviewuser_1_Durasi').val(detail.interviewuser_1_Durasi)
          interviewuser_1_User = $('#interviewuser_1_User').val(detail.interviewuser_1_User)
  
        }else if(schedule==9 && online==1){
          detail = JSON.parse(data[0].test)
  
          $('.offer_1').show()
          $('#offer_1_Link').val(detail.offer_1_Link)
          $('#offer_1_MeetingID').val(detail.offer_1_MeetingID)
          $('#offer_1_Passcode').val(detail.offer_1_Passcode)
          $('#offer_1_BR').val(detail.offer_1_BR)
          $('#offer_1_Durasi').val(detail.offer_1_Durasi)
          $('#offer_1_Deadline').val(detail.offer_1_Deadline)
          $('#offer_1_URLPhase2').val(detail.offer_1_URLPhase2)
    
        }else if(schedule==9 && online==2){
          detail = JSON.parse(data[0].test)
  
          $('.offer_2').show()
          offer_2_Durasi = $('#offer_2_Durasi').val(detail.offer_2_Durasi)
          offer_2_Deadline = $('#offer_2_Deadline').val(detail.offer_2_Deadline)
          offer_2_URLPhase2 = $('#offer_2_URLPhase2').val(detail.offer_2_URLPhase2)
        }
      } else {
        console.log('2')
        console.log(schedule)
        if(schedule==2){
          detail = JSON.parse(data[0].test)

          $('#MCU_nk').show();
          $('#mcu_lab').val(detail.id_lab)
          $('#onlineonsite').attr('hidden',true)
          $('#gen-doc').attr('hidden',false)
          $('#mcu_nosurat').val(detail.nosurat)
        }else if(schedule==5){
          console.log('tasdasd')
          detail = JSON.parse(data[0].test)

          $('#interviewHR_1_nk').show();
          $('#interviewHR_1_nk_PIC').val(detail.interviewHR_1_nk_PIC)
          $('#interviewHR_1_nk_LINK').val(detail.interviewHR_1_nk_LINK)

        }else if(schedule==6){
          detail = JSON.parse(data[0].test)

          $('#interviewUser_1_nk').show();
          $('#interviewUser_1_nk_PIC').val(detail.interviewUser_1_nk_PIC)
          $('#interviewUser_1_nk_LINK').val(detail.interviewUser_1_nk_LINK)
        }
      }
      
      $('#btnEmail').attr('value',data[0].namaGroup)
      $('#tglWaktu').val(data[0].jadwal)

      if (data[0].ccEmail!=null) {
        emails=data[0].ccEmail
        var listemail = emails.split(",")
        $('#ccto').val(listemail).change();
      }
      tampilin_email(schedule,online)
  });

  $('#Tblsend').DataTable().destroy();
  $('#Tblsend').attr('hidden',false)
  $('#Tblsend').DataTable({
    "scrollY":        "400px",
    "scrollCollapse": true,
    aLengthMenu: [
        [5,10,25,50,100 , -1],
        [5,10,25,50,100 , "All"]
    ],
    iDisplayLength: 5,
    ajax: {
    url: "/hrdats/dashboard/hrd/schedule/getkandiat",
    type: "POST",
    data:{
      value:value,
      proses:proses
    },
    dataSrc:""
        },
    "paging":true,
    "bInfo" : false,
    "lengthChange": false,
    'searching': false,
    language: {
        paginate: {
            previous: "<i class='fas fa-angle-left'>",
            next: "<i class='fas fa-angle-right'>"
        }
    },
    columns: [
        {
            data: 'namalengkap',
            defaultContent: ''
        },
        {
            data: 'email',
            defaultContent: ''
        }
    ] 
  });
}