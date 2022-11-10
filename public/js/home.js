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
  kirimEmail();
  transferKandidat();
  modal()
  $('#schedule, #proses').on('change',function(){tampilin_email()})
  $('#schedule, #proses').on('change',function(){modalInformasi()})
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

// function ShowDetail(Speriod,Eperiod,Sumur,Eumur,pendidikan,jurusan,job,status,domisili){
//   // $.ajaxSetup({
//   //   headers: {
//   //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   //   }
//   // });
//   // $.ajax({
//   //     _token: '{{ csrf_token() }}',
//   //     url: '/hrdats/dashboard/hrd/detail',
//   //     type: 'post',
//   //     data: {
//   //       Speriod:Speriod,
//   //       Eperiod:Eperiod,
//   //       Sumur:Sumur,
//   //       Eumur:Eumur,
//   //       pendidikan:pendidikan,
//   //       jurusan:jurusan,
//   //       job:job,
//   //       status:status,
//   //       domisili:domisili
//   //     }
//   //   }).done((data) => {
//   //     console.log(JSON.stringify(data));
//   // });
//   $('#TblKandidat').DataTable().destroy();
//   $('.filters').remove();
//   $('#TblKandidat thead tr')
//         .clone(true)
//         .addClass('filters')
//         .appendTo('#TblKandidat thead');
        
//   $('#TblKandidat').DataTable({
//     orderCellsTop: true,
//     fixedHeader: true,
//     initComplete: function () {
//       var api = this.api();
//           api
//             .columns()
//             .eq(0)
//             .each(function (colIdx) {
//               // Set the header cell to contain the input element
//               var cell = $('.filters th').eq(
//                 $(api.column(colIdx).header()).index()
//               );

//               var title = $(cell).text();
//               if(title!='' && title!="Detail"){
//                 $(cell).html('<input type="text" style="width:100%" placeholder="' + title + '" />');
//               }else{
//                 $(cell).html('');
//               }
                    
 
//               // On every keypress in this input
//               $(
//                   'input',
//                   $('.filters th').eq($(api.column(colIdx).header()).index())
//               )
//               .off('keyup change')
//               .on('change', function (e) {
//                 // Get the search value
//                 $(this).attr('title', $(this).val());
//                 var regexr = '({search})'; //$(this).parents('th').find('select').val();
 
//                   // var cursorPosition = this.selectionStart;
//                   // Search the column for that value
//                   api
//                       .column(colIdx)
//                       .search(
//                           this.value != ''
//                               ? regexr.replace('{search}', '(((' + this.value + ')))')
//                               : '',
//                           this.value != '',
//                           this.value == ''
//                       )
//                       .draw();
//               })
//               .on('keyup', function (e) {
//                   var cursorPosition = this.selectionStart;
//                   e.stopPropagation();

//                   $(this).trigger('change');
//                   $(this)
//                       .focus()[0]
                      
//                       .setSelectionRange(cursorPosition, cursorPosition);
//               });
//             });
//     },
//     "scrollY":        "400px",
//     "scrollX": true,
//     "scrollCollapse": true,
//     pageLength : 5,
//         ajax: {
//           url: "/hrdats/dashboard/hrd/detail",
//           type: "POST",
//           data:{
//             Speriod:Speriod,
//             Eperiod:Eperiod,
//             Sumur:Sumur,
//             Eumur:Eumur,
//             pendidikan:pendidikan,
//             jurusan:jurusan,
//             job:job,
//             status:status,
//             domisili:domisili
//           },
//           dataSrc:""
//         },
//     "paging":true,
//     "bInfo" : false,
//     "lengthChange": false,
//     language: {
//         paginate: {
//             previous: "<i class='fas fa-angle-left'>",
//             next: "<i class='fas fa-angle-right'>"
//         }
//     },
//     columns: [
//         {
//             render: (data, type, row, meta)=> {
//                 return '<input type="checkbox" class="cek-kandidat" value="'+row.id+'">'
//             },
//         },
//         {
//             data: 'umur',
//             defaultContent: ''
//         },
//         {
//             data: 'kota1',
//             defaultContent: ''
//         },
//         {
//             data: 'gender',
//             defaultContent: ''
//         },
//         {
//             data: 'pendidikan',
//             defaultContent: ''
//         },
//         {
//             data: 'jurusan',
//             defaultContent: ''
//         },
//         {
//             data: 'pengalaman',
//             defaultContent: ''
//         },
//         {
//             data: 'bidang',
//             defaultContent: ''
//         },
//         {
//           defaultContent: '',
//           render: (data, type, row, meta)=> {
//             return row.tahun+' Tahun '+row.bulan+' Bulan '+row.hari+' Hari'
//           }
//         },
//         {
//             data: 'bertugasluarkota',
//             defaultContent: ''
//         },
//         {
//           data: 'ditempatkanluarkota',
//           defaultContent: ''
//         },
//         {
//           data: 'SIM',
//           defaultContent: ''
//         },
//         {
//           data: 'nama',
//           defaultContent: ''
//         },
//         {
//           data: 'proses',
//           defaultContent: ''
//         },
//         {
//             defaultContent: '',
//             render: (data, type, row, meta)=> {
//                 // return '<button type="button" class="btn btn-info" onclick="Modal_mcu(value)" data-toggle="modal" data-target=".modal-edit-mcu" value="'+row.id+'">Edit</button>'
//                 return '<a href="/hrdats/detail/kandidat/'+row.id+'/'+row.noidentitas+'" type="button" class="btn btn-info">Detail</a>'
//             }
//         }
//     ] 
//   });

//   //buat check
//   $('#cekAll-kandidat').change(function(){
//       $("input.cek-kandidat:checkbox").prop("checked",$(this).prop("checked"));
//   })
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
    

    if (schedule==2) {
      Durasi = $('#mcu_Durasi').val() +' jam'
      id_lab = $('#mcu_lab').val();
      online=0;

      detail={durasi:Durasi,id_lab:id_lab}  
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

      detail={interviewHR_1_Link:interviewHR_1_Link,interviewHR_1_MeetingID:interviewHR_1_MeetingID,interviewHR_1_Passcode:interviewHR_1_Passcode,interviewHR_1_BR:interviewHR_1_BR}
    }else if(schedule==6 && online==1){
      interviewuser_1_Link = $('#interviewuser_1_Link').val()
      interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
      interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
      interviewuser_1_BR = $('#interviewuser_1_BR').val()

      detail={interviewuser_1_Link:interviewuser_1_Link,interviewuser_1_MeetingID:interviewuser_1_MeetingID,interviewuser_1_Passcode:interviewuser_1_Passcode,interviewuser_1_BR:interviewuser_1_BR}
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
$('#interviewHR_1').hide()
$('#interviewuser_1').hide()
$('.offer_1').hide()
$('.offer_2').hide()

$('#informasi1 .form-control').val('')  
$('#informasi1 :input').attr('readonly',false)
$('#f_ccto').attr('hidden',false);
$('#tglWaktu').attr('readonly',false)
$('#btnUpdate-schedule').attr('hidden',true);
$('#schedule').attr('readonly',false);
$('#proses').attr('readonly',false);
}

function modalInformasi(){
  hidde()
  schedule = $('#schedule').val();
  online = $('#proses').val();

  var list_onsite=['2']
  if (list_onsite.includes(schedule)==true) {
    online= 0
  }

  if (schedule==2  && online==0) {
    $('#MCU').show();
  } else if(schedule==3 && online==1) {
    $('#psikotest_1').show();
  }else if(schedule==3 && online==0) {
    $('#psikotest_0').show();
  }else if(schedule==4 && online==1){
    $('#test_1').show();
  }else if(schedule==4 && online==0){
    $('#test_0').show();
  }else if(schedule==5 && online==1){
    $('#interviewHR_1').show();
  }else if(schedule==6 && online==1){
    $('#interviewuser_1').show();
  }else if(schedule==9 && online==1){
    $('.offer_1').show();
  }else if(schedule==9 && online==2){
    $('.offer_2').show();
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
  schedule = $('#schedule').val();
  online = $('#proses').val();
  var list_onsite=['2']

  if (list_onsite.includes(schedule)==true) {
    online= 0
  }
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
        online:online
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
    tglWaktu = tglWaktuRaw.replace("T", " Waktu: ");
    id_group=$('#btnEmail').val()
    data={}
    console.log(schedule);
    if (schedule==2) {
      Durasi = $('#mcu_Durasi').val() +' jam'
      id_lab = $('#mcu_lab').val(); 

      var konten = konten.replace('[DATE&TIME]',tglWaktu)
      var konten = konten.replace('[DURATION]',Durasi)
      data={konten:konten,arrId_kandidat:arrId_kandidat,id_lab:id_lab,schedule:schedule,id_group:id_group}
    }else if(schedule==3 && online==1){
      psikotest_1_Durasi = $('#psikotest_1_Durasi').val()
      psikotest_1_Link = $('#psikotest_1_Link').val()
      psikotest_1_PIC = $('#psikotest_1_PIC').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)
      var konten = konten.replace('[DURATION]',psikotest_1_Durasi)
      var konten = konten.replace('[TEST LINK]',psikotest_1_Link)
      var konten = konten.replace('[PIC’s NAME]',psikotest_1_PIC)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }else if(schedule==3 && online==0){
      psikotest_0_Address = $('#psikotest_0_Address').val()
      psikotest_0_Room = $('#psikotest_0_Room').val()
      psikotest_0_PIC = $('#psikotest_0_PIC').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[ADDRESS]',psikotest_0_Address)
      var konten = konten.replace('[ROOM]',psikotest_0_Room)
      var konten = konten.replace('[PIC’s NAME]',psikotest_0_PIC)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }else if(schedule==4 && online==1){
      test_1_Durasi = $('#test_1_Durasi').val()
      test_1_Link = $('#test_1_Link').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[DURATION]',test_1_Durasi)
      var konten = konten.replace('[TEST LINK]',test_1_Link)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }else if(schedule==4 && online==0){
      test_0_Durasi = $('#test_0_Durasi').val()
      test_0_lokasi = $('#test_0_lokasi').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[DURATION]',test_0_Durasi)
      var konten = konten.replace('[ADDRESS]',test_0_lokasi)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }else if(schedule==5 && online==1){
      interviewHR_1_Link = $('#interviewHR_1_Link').val()
      interviewHR_1_MeetingID = $('#interviewHR_1_MeetingID').val()
      interviewHR_1_Passcode = $('#interviewHR_1_Passcode').val()
      interviewHR_1_BR = $('#interviewHR_1_BR').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[LINK ZOOM]',interviewHR_1_Link)
      var konten = konten.replace('[MEETING IS]',interviewHR_1_MeetingID)
      var konten = konten.replace('[PASSCODE]',interviewHR_1_Passcode)
      var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewHR_1_BR)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }else if(schedule==6 && online==1){
      interviewuser_1_Link = $('#interviewuser_1_Link').val()
      interviewuser_1_MeetingID = $('#interviewuser_1_MeetingID').val()
      interviewuser_1_Passcode = $('#interviewuser_1_Passcode').val()
      interviewuser_1_BR = $('#interviewuser_1_BR').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[LINK ZOOM]',interviewuser_1_Link)
      var konten = konten.replace('[MEETING IS]',interviewuser_1_MeetingID)
      var konten = konten.replace('[PASSCODE]',interviewuser_1_Passcode)
      var konten = konten.replace('[BREAKOUT ROOM NAME]',interviewuser_1_BR)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
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

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }else if(schedule==9 && online==2){
      offer_2_Durasi = $('#offer_2_Durasi').val()
      offer_2_Deadline = $('#offer_2_Deadline').val()
      offer_2_URLPhase2 = $('#offer_2_URLPhase2').val()

      var konten = konten.replace('[DATE&TIME]',tglWaktu)

      var konten = konten.replace('[DURATION]',offer_2_Durasi)
      var konten = konten.replace('[DEADLINE]',offer_2_Deadline)
      var konten = konten.replace('[LINK TO DATABASE PHASE – 2]',offer_2_URLPhase2)

      data={konten:konten,arrId_kandidat:arrId_kandidat,schedule:schedule,id_group:id_group}
    }

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
        //   id_kandidat:id_kandidat,
        //   id_lab:id_lab,
        //   id_proses:id_proses
        // }
        data:data
      }).done((data) => {
        console.log(JSON.stringify(data));
        // $('#tblSchedule').DataTable().ajax.reload();
        $('.modal-tambah-groupschedule').modal('hide');
        modal()
        // $('#summernote').summernote('code', '');
        // $('#summernote').summernote('code', $(konten));
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
        console.log(JSON.stringify(data.length));
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