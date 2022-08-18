$( document ).ready(function() {
    clearModal();
    Row_MCU();
    Row_PSIKOTEST();

    loadTbl_MCU();
    delete_MCU();
    add_MCU();
    Edit_MCU();

    loadTbl_PSIKOTEST();
    delete_PSIKOTEST();
    add_PSIKOTEST();
    Edit_Psikotest();
});


var baris_mcu=0
function Row_MCU(){
    // add row table di tambah mcu dan edit mcu

    $('#btnAddRow-mcu').on('click',function(){
        baris_mcu+=1;
        
        var html  = "<tr id='baris"+baris_mcu+"' class='detail-mcu'>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='new-notlp[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='new-nofax[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='new-email[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='new-namapic[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='new-tlppic[]'>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_mcu+"' id='btnDelRow-mcu'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"

        $('#TblAddMcu').append(html);
    })

    $('#btnEditRow-mcu').on('click',function(){
        baris_mcu+=1;
        
        var html  = "<tr id='baris"+baris_mcu+"' class='detailEdit-mcu'>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-notlp[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-nofax[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-email[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-namapic[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-tlppic[]'>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_mcu+"' id='btnDelRow-mcu'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"

        $('#TblEditMcu').append(html);
    })

    $(document).on('click','#btnDelRow-mcu',function(){
        var hapus = $(this).data('row')
        // console.log(hapus);
        $('#'+hapus).remove();
    })
}

var baris_psikotest=0
function Row_PSIKOTEST(){
    // add row table di tambah mcu dan edit mcu

    $('#btnAddRow-psikotest').on('click',function(){
        baris_mcu+=1;
        
        var html  = "<tr id='baris"+baris_psikotest+"' class='detail-psikotest'>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='new-notlp-psikotest[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='new-nofax-psikotest[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='new-email-psikotest[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='new-namapic-psikotest[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='new-tlppic-psikotest[]'>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_psikotest+"' id='btnDelRow-psikotest'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"

        $('#TblAddPsikotest').append(html);
    })

    $('#btnEditRow-psikotest').on('click',function(){
        baris_mcu+=1;
        
        var html  = "<tr id='baris"+baris_psikotest+"' class='detailEdit-psikotest'>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-notlp-psikotest[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-nofax-psikotest[]'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-email-psikotest[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-namapic-psikotest[]'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-tlppic-psikotest[]'>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_psikotest+"' id='btnDelRow-psikotest'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"

        $('#TblEditPsikotest').append(html);
    })

    $(document).on('click','#btnDelRow-psikotest',function(){
        var hapus = $(this).data('row')
        // console.log(hapus);
        $('#'+hapus).remove();
    })
}



function clearModal(){
    $('.modal-tambah-mcu').on('hide.bs.modal', function() {
        $('#new-namavendor').val('');
        $('#new-namalab').val('');
        $('#new-alamat').val('');
        $('.detail-mcu').remove();
    })
    $('.modal-edit-mcu').on('hide.bs.modal', function() {
        $('#edit-namavendor').val('');
        $('#edit-namalab').val('');
        $('#edit-alamat').val('');
        $('#btnEdit-mcu').val('');
        $('.detailEdit-mcu').remove();
    })

    $('.modal-tambah-psikotest').on('hide.bs.modal', function() {
        $('#new-namavendor-psikotest').val('');
        $('#new-alamat-psikotest').val('');
        $('.detail-psikotest').remove();
    })
    $('.modal-edit-psikotest').on('hide.bs.modal', function() {
        $('#edit-namavendor-psikotest').val('');
        $('#edit-alamat-psikotest').val('');
        $('#btnEdit-mcu-psikotest').val('');
        $('.detailEdit-psikotest').remove();
    })
}


//----MCU----
function loadTbl_MCU(){
    $('#TblMcu').DataTable({
        "scrollY":        "400px",
        "scrollX": true,
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/mcu",
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
                    return '<input type="checkbox" class="cek-mcu" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkMCU(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkMCU(this)" value="'+row.id+'">'+
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
                data: 'namaVendor',
                defaultContent: ''
            },
            {
                data: 'NamaLab',
                defaultContent: ''
            },
            {
                data: 'alamat',
                defaultContent: ''
            },
            {
                data: 'noTlp',
                defaultContent: ''
            },
            {
                data: 'noFax',
                defaultContent: ''
            },
            {
                data: 'email',
                defaultContent: ''
            },
            {
                data: 'NamaPIC',
                defaultContent: ''
            },
            {
                data: 'noTlpPIC',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_mcu(value)" data-toggle="modal" data-target=".modal-edit-mcu" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-mcu').change(function(){
        $("input.cek-mcu:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_MCU(){
    $('#btnDel-mcu').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_mcu=[];
        var cek = $('.cek-mcu')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_mcu.push(cek[i].value);
            }
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/del/mcu',
            type: 'post',
            data: {
                arrId_mcu:arrId_mcu
            }
          }).done((data) => {
            $('#TblMcu').DataTable().ajax.reload();
            // console.log(JSON.stringify(data));
          });
    })
}
function add_MCU(){
    $('#btnAdd-mcu').on('click', function() {
        var new_namavendor = $('#new-namavendor').val();
        var new_namalab = $('#new-namalab').val();
        var new_alamat = $('#new-alamat').val();
        var new_notlp = $("input[name='new-notlp[]']").map(function(){return $(this).val();}).get();
        var new_nofax = $("input[name='new-nofax[]']").map(function(){return $(this).val();}).get();
        var new_email = $("input[name='new-email[]']").map(function(){return $(this).val();}).get();
        var new_namapic = $("input[name='new-namapic[]']").map(function(){return $(this).val();}).get();
        var new_tlppic = $("input[name='new-tlppic[]']").map(function(){return $(this).val();}).get();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/mcu',
            type: 'post',
            data: {
                new_namavendor:new_namavendor,
                new_namalab:new_namalab,
                new_alamat:new_alamat,
                new_notlp:new_notlp,
                new_nofax:new_nofax,
                new_email:new_email,
                new_namapic:new_namapic,
                new_tlppic:new_tlppic
            }
          }).done((data) => {
            $(".modal-tambah-mcu").modal('hide');
            $('#TblMcu').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
          });
    })
}
function Modal_mcu(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/mcu/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-mcu').val(id);
        $('#edit-namavendor').val(data[0][0].namaVendor);
        $('#edit-namalab').val(data[0][0].NamaLab);
        $('#edit-alamat').val(data[0][0].alamat);
        Gen_RowDataMCU(data[1]);
        // console.log(JSON.stringify(data[1]));
      });
}
function checkMCU(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_mcu= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/mcu',
        type: 'post',
        data: {
            active:active,
            id_mcu:id_mcu
        }
      }).done((data) => {
        $('#TblMcu').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_MCU(){
    $('#btnEdit-mcu').on('click', function() {
        var edit_namavendor = $('#edit-namavendor').val();
        var edit_namalab = $('#edit-namalab').val();
        var edit_alamat = $('#edit-alamat').val();
        var edit_notlp = $("input[name='edit-notlp[]']").map(function(){return $(this).val();}).get();
        var edit_nofax = $("input[name='edit-nofax[]']").map(function(){return $(this).val();}).get();
        var edit_email = $("input[name='edit-email[]']").map(function(){return $(this).val();}).get();
        var edit_namapic = $("input[name='edit-namapic[]']").map(function(){return $(this).val();}).get();
        var edit_tlppic = $("input[name='edit-tlppic[]']").map(function(){return $(this).val();}).get();
        var id_mcu=$('#btnEdit-mcu').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/mcu',
            type: 'post',
            data: {
                edit_namavendor:edit_namavendor,
                edit_namalab:edit_namalab,
                edit_alamat:edit_alamat,
                edit_notlp:edit_notlp,
                edit_nofax:edit_nofax,
                edit_email:edit_email,
                edit_namapic:edit_namapic,
                edit_tlppic:edit_tlppic,
                id_mcu:id_mcu,
            }
          }).done((data) => {
            $(".modal-edit-mcu").modal('hide');
            $('#TblMcu').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
        });
    });
}
function Gen_RowDataMCU(data){
    for (let index = 0; index < data.length; index++) {
        baris_mcu+=1;
        
        var html  = "<tr id='baris"+baris_mcu+"' class='detailEdit-mcu'>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-notlp[]' value='"+data[index].noTlp+"'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-nofax[]' value='"+data[index].noFax+"'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-email[]' value='"+data[index].email+"'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-namapic[]' value='"+data[index].namaPIC+"'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-tlppic[]' value='"+data[index].noTlpPIC+"'>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_mcu+"' id='btnDelRow-mcu'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"

        $('#TblEditMcu').append(html);
    }
    // console.log(data[0].email);
}

//----PSIKOTEST----
function loadTbl_PSIKOTEST(){
    $('#TblPsikotest').DataTable({
        "scrollY":        "400px",
        "scrollX": true,
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/psikotest",
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
                    return '<input type="checkbox" class="cek-psikotest" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkPsikotest(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkPsikotest(this)" value="'+row.id+'">'+
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
                data: 'namaVendor',
                defaultContent: ''
            },
            {
                data: 'alamat',
                defaultContent: ''
            },
            {
                data: 'noTlp',
                defaultContent: ''
            },
            {
                data: 'noFax',
                defaultContent: ''
            },
            {
                data: 'email',
                defaultContent: ''
            },
            {
                data: 'NamaPIC',
                defaultContent: ''
            },
            {
                data: 'noTlpPIC',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_psikotest(value)" data-toggle="modal" data-target=".modal-edit-psikotest" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-psikotest').change(function(){
        $("input.cek-psikotest:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_PSIKOTEST(){
    $('#btnDel-psikotest').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_psikotest=[];
        var cek = $('.cek-psikotest')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_psikotest.push(cek[i].value);
            }
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/del/psikotest',
            type: 'post',
            data: {
                arrId_psikotest:arrId_psikotest
            }
          }).done((data) => {
            $('#TblPsikotest').DataTable().ajax.reload();
            // console.log(JSON.stringify(data));
          });
    })
}
function add_PSIKOTEST(){
    $('#btnAdd-psikotest').on('click', function() {
        var new_namavendor = $('#new-namavendor-psikotest').val();
        var new_alamat = $('#new-alamat-psikotest').val();
        var new_notlp = $("input[name='new-notlp-psikotest[]']").map(function(){return $(this).val();}).get();
        var new_nofax = $("input[name='new-nofax-psikotest[]']").map(function(){return $(this).val();}).get();
        var new_email = $("input[name='new-email-psikotest[]']").map(function(){return $(this).val();}).get();
        var new_namapic = $("input[name='new-namapic-psikotest[]']").map(function(){return $(this).val();}).get();
        var new_tlppic = $("input[name='new-tlppic-psikotest[]']").map(function(){return $(this).val();}).get();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/psikotest',
            type: 'post',
            data: {
                new_namavendor:new_namavendor,
                new_alamat:new_alamat,
                new_notlp:new_notlp,
                new_nofax:new_nofax,
                new_email:new_email,
                new_namapic:new_namapic,
                new_tlppic:new_tlppic
            }
          }).done((data) => {
            $(".modal-tambah-psikotest").modal('hide');
            $('#TblPsikotest').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
          });
    })
}
function Modal_psikotest(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/psikotest/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-psikotest').val(id);
        $('#edit-namavendor-psikotest').val(data[0][0].namaVendor);
        $('#edit-alamat-psikotest').val(data[0][0].alamat);
        Gen_RowDataPSIKOTEST(data[1]);
        // console.log(JSON.stringify(data[1]));
      });
}
function checkPsikotest(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_psikotest= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/psikotest',
        type: 'post',
        data: {
            active:active,
            id_psikotest:id_psikotest
        }
      }).done((data) => {
        $('#TblPsikotest').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_Psikotest(){
    $('#btnEdit-psikotest').on('click', function() {
        var edit_namavendor = $('#edit-namavendor-psikotest').val();
        var edit_alamat = $('#edit-alamat-psikotest').val();
        var edit_notlp = $("input[name='edit-notlp-psikotest[]']").map(function(){return $(this).val();}).get();
        var edit_nofax = $("input[name='edit-nofax-psikotest[]']").map(function(){return $(this).val();}).get();
        var edit_email = $("input[name='edit-email-psikotest[]']").map(function(){return $(this).val();}).get();
        var edit_namapic = $("input[name='edit-namapic-psikotest[]']").map(function(){return $(this).val();}).get();
        var edit_tlppic = $("input[name='edit-tlppic-psikotest[]']").map(function(){return $(this).val();}).get();
        var id_psikotest=$('#btnEdit-psikotest').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/psikotest',
            type: 'post',
            data: {
                edit_namavendor:edit_namavendor,
                edit_alamat:edit_alamat,
                edit_notlp:edit_notlp,
                edit_nofax:edit_nofax,
                edit_email:edit_email,
                edit_namapic:edit_namapic,
                edit_tlppic:edit_tlppic,
                id_psikotest:id_psikotest,
            }
          }).done((data) => {
            $(".modal-edit-psikotest").modal('hide');
            $('#TblPsikotest').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
        });
    });
}
function Gen_RowDataPSIKOTEST(data){
    for (let index = 0; index < data.length; index++) {
        baris_psikotest+=1;
        
        var html  = "<tr id='baris"+baris_psikotest+"' class='detailEdit-psikotest'>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-notlp-psikotest[]' value='"+data[index].noTlp+"'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control'  type='text' name='edit-nofax-psikotest[]' value='"+data[index].noFax+"'>"
            html +=   "</td>" 
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-email-psikotest[]' value='"+data[index].email+"'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-namapic-psikotest[]' value='"+data[index].namaPIC+"'>"
            html +=   "</td>"
            html +=   "<td style='width: 19%;'>"
            html +=     "<input class='form-control' type='text' name='edit-tlppic-psikotest[]' value='"+data[index].noTlpPIC+"'>"
            html +=   "</td>"   
            html +=   "<td style='width: 5%;'>"
            html +=     "<button type='button' class='btn btn-danger' data-row='baris"+baris_psikotest+"' id='btnDelRow-psikotest'>"
            html +=       "<span class='material-symbols-outlined' style='font-size: 15px;'>delete</span>" 
            html +=     "</button>"
            html +=   "</td>"   
            html +="</tr>"

        $('#TblEditPsikotest').append(html);
    }
    // console.log(data[0].email);
}