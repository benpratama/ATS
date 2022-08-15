$( document ).ready(function() {
    clearModal();

    loadTbl_SIM();
    delete_SIM();
    add_SIM();
    Edit_SIM();

    loadTbl_JURUSAN();
    delete_JURUSAN();
    add_JURUSAN();
    Edit_JURUSAN();

    loadTbl_PERKAWINAN();
    delete_PERKAWINAN();
    add_PERKAWINAN();
    Edit_PERKAWINAN()
});

function clearModal(){
    $('.modal-tambah-sim').on('hide.bs.modal', function() {
        $('#new-sim').val('');
    })
    $('.modal-edit-sim').on('hide.bs.modal', function() {
        $('#edit-sim').val('');
        $('#btnEdit-sim').val('');
    })

    $('.modal-tambah-jurusan').on('hide.bs.modal', function() {
        $('#new-jurusan').val('');
        $('#new-jenis').val('');
    })
    $('.modal-edit-jurusan').on('hide.bs.modal', function() {
        $('#edit-jurusan').val('');
        $('#edit-jenis').val('');
        $('#btnEdit-jurusan').val('');
    })

    $('.modal-tambah-perkawinan').on('hide.bs.modal', function() {
        $('#new-perkawinan').val('');
        $('#new-keterangan').val('');
    })
    $('.modal-edit-perkawinan').on('hide.bs.modal', function() {
        $('#edit-perkawinan').val('');
        $('#edit-keterangan').val('');
        $('#btnEdit-perkawinan').val('');
    })
}


//----SIM----
function loadTbl_SIM(){
    $('#TblSim').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/sim",
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
                    return '<input type="checkbox" class="cek-sim" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSIM(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSIM(this)" value="'+row.id+'">'+
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
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_sim(value)" data-toggle="modal" data-target=".modal-edit-sim" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-sim').change(function(){
        $("input.cek-sim:checkbox").prop("checked",$(this).prop("checked"));
    })
}

function delete_SIM(){
    $('#btnDel-sim').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_sim=[];
        var cek = $('.cek-sim')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_sim.push(cek[i].value);
            }
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/del/sim',
            type: 'post',
            data: {
                arrId_sim:arrId_sim
            }
          }).done((data) => {
            $('#TblSim').DataTable().ajax.reload();
            // console.log(JSON.stringify(data));
          });
    })
}

function add_SIM(){
    $('#btnAdd-sim').on('click', function() {
        var new_sim = $('#new-sim').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/sim',
            type: 'post',
            data: {
                new_sim:new_sim
            }
          }).done((data) => {
            $(".modal-tambah-sim").modal('hide');
            $('#TblSim').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
          });
    })
}

function Modal_sim(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/sim/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-sim').val(id);
        $('#edit-sim').val(data[0].nama);
        console.log(JSON.stringify(data));
      });
}

function checkSIM(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_sim= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/sim',
        type: 'post',
        data: {
            active:active,
            id_sim:id_sim
        }
      }).done((data) => {
        $('#TblSim').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}

function Edit_SIM(){
    $('#btnEdit-sim').on('click', function() {
        var Edit_sim = $('#edit-sim').val();
        var id_sim=$('#btnEdit-sim').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/sim',
            type: 'post',
            data: {
                Edit_sim:Edit_sim,
                id_sim:id_sim
            }
          }).done((data) => {
            $(".modal-edit-sim").modal('hide');
            $('#TblSim').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
        });
    });
}

//----JURUSAN----
function loadTbl_JURUSAN(){
    $('#TblJurusan').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/jurusan",
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
                    return '<input type="checkbox" class="cek-jurusan" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkJurusan(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkJurusan(this)" value="'+row.id+'">'+
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
                data: 'jenis',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_jurusan(value)" data-toggle="modal" data-target=".modal-edit-jurusan" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-jurusan').change(function(){
        $("input.cek-jurusan:checkbox").prop("checked",$(this).prop("checked"));
    })
}

function delete_JURUSAN(){
    $('#btnDel-jurusan').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_jurusan=[];
        var cek = $('.cek-jurusan')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_jurusan.push(cek[i].value);
            }
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/del/jurusan',
            type: 'post',
            data: {
                arrId_jurusan:arrId_jurusan
            }
          }).done((data) => {
            $('#TblJurusan').DataTable().ajax.reload();
            // console.log(JSON.stringify(data));
          });
    })
}

function add_JURUSAN(){
    $('#btnAdd-jurusan').on('click', function() {
        var new_jurusan = $('#new-jurusan').val();
        var new_jenis = $('#new-jenis').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/jurusan',
            type: 'post',
            data: {
                new_jurusan:new_jurusan,
                new_jenis:new_jenis
            }
          }).done((data) => {
            $(".modal-tambah-jurusan").modal('hide');
            $('#TblJurusan').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
          });
    })
}

function Modal_jurusan(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/jurusan/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-jurusan').val(id);
        $('#edit-jurusan').val(data[0].nama);
        $('#edit-jenis').val(data[0].jenis);
        console.log(JSON.stringify(data));
      });
}

function checkJurusan(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_jurusan= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/jurusan',
        type: 'post',
        data: {
            active:active,
            id_jurusan:id_jurusan
        }
      }).done((data) => {
        $('#TblJurusan').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}

function Edit_JURUSAN(){
    $('#btnEdit-jurusan').on('click', function() {
        var Edit_jurusan = $('#edit-jurusan').val();
        var Edit_jenis = $('#edit-jenis').val();
        var id_jurusan=$('#btnEdit-jurusan').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/jurusan',
            type: 'post',
            data: {
                Edit_jurusan:Edit_jurusan,
                Edit_jenis:Edit_jenis,
                id_jurusan:id_jurusan
            }
          }).done((data) => {
            $(".modal-edit-jurusan").modal('hide');
            $('#TblJurusan').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
        });
    });
}

//----PERKAWINAN----
function loadTbl_PERKAWINAN(){
    $('#TblPerkawinan').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/perkawinan",
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
                    return '<input type="checkbox" class="cek-perkawinan" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkPerkawinan(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkPerkawinan(this)" value="'+row.id+'">'+
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
                data: 'keterangan',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_perkawinan(value)" data-toggle="modal" data-target=".modal-edit-perkawinan" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-perkawinan').change(function(){
        $("input.cek-perkawinan:checkbox").prop("checked",$(this).prop("checked"));
    })
}

function delete_PERKAWINAN(){
    $('#btnDel-perkawinan').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_perkawinan=[];
        var cek = $('.cek-perkawinan')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_perkawinan.push(cek[i].value);
            }
        }
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/del/perkawinan',
            type: 'post',
            data: {
                arrId_perkawinan:arrId_perkawinan
            }
          }).done((data) => {
            $('#TblPerkawinan').DataTable().ajax.reload();
            // console.log(JSON.stringify(data));
          });
    })
}

function add_PERKAWINAN(){
    $('#btnAdd-perkawinan').on('click', function() {
        var new_perkawinan = $('#new-perkawinan').val();
        var new_keterangan = $('#new-keterangan').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/perkawinan',
            type: 'post',
            data: {
                new_perkawinan:new_perkawinan,
                new_keterangan:new_keterangan
            }
          }).done((data) => {
            $(".modal-tambah-perkawinan").modal('hide');
            $('#TblPerkawinan').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
          });
    })
}

function Modal_perkawinan(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/perkawinan/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-perkawinan').val(id);
        $('#edit-perkawinan').val(data[0].nama);
        $('#edit-keterangan').val(data[0].keterangan);
        console.log(JSON.stringify(data));
      });
}

function checkPerkawinan(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_perkawinan= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/perkawinan',
        type: 'post',
        data: {
            active:active,
            id_perkawinan:id_perkawinan
        }
      }).done((data) => {
        $('#TblPerkawinan').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}

function Edit_PERKAWINAN(){
    $('#btnEdit-perkawinan').on('click', function() {
        var Edit_perkawinan = $('#edit-perkawinan').val();
        var Edit_keterangan = $('#edit-keterangan').val();
        var id_perkawinan = $('#btnEdit-perkawinan').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/perkawinan',
            type: 'post',
            data: {
                Edit_perkawinan:Edit_perkawinan,
                Edit_keterangan:Edit_keterangan,
                id_perkawinan:id_perkawinan
            }
          }).done((data) => {
            $(".modal-edit-perkawinan").modal('hide');
            $('#TblPerkawinan').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
        });
    });
}