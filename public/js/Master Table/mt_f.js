$( document ).ready(function() {
    clearModal();

    loadTbl_SIM();
    delete_SIM();
    add_SIM();
    Edit_SIM();

    loadTbl_DOMISILI();
    delete_DOMISILI();
    add_DOMISILI();
    Edit_DOMISILI()

    loadTbl_JURUSAN();
    delete_JURUSAN();
    add_JURUSAN();
    Edit_JURUSAN();

    loadTbl_PERKAWINAN();
    delete_PERKAWINAN();
    add_PERKAWINAN();
    Edit_PERKAWINAN();

    loadTbl_SFPTK();
    delete_SFPTK();
    add_SFPTK();
    Edit_SFPTK();

    loadTbl_SMCU();
    delete_SMCU();
    add_SMCU();
    Edit_SMCU();

    loadTbl_STEST();
    delete_STEST();
    add_STEST();
    Edit_STEST();

    loadTbl_SREK();
    delete_SREK();
    add_SREK();
    Edit_SREK();
});

function clearModal(){
    $('.modal-tambah-sim').on('hide.bs.modal', function() {
        $('#new-sim').val('');
    })
    $('.modal-edit-sim').on('hide.bs.modal', function() {
        $('#edit-sim').val('');
        $('#btnEdit-sim').val('');
    })

    $('.modal-tambah-domisili').on('hide.bs.modal', function() {
        $('#new-provinsi').val('');
        $('#new-kabupaten').val('');
        $('#new-kodepos').val('');
    })
    $('.modal-edit-domisili').on('hide.bs.modal', function() {
        $('#edit-provinsi').val('');
        $('#edit-kabupaten').val('');
        $('#edit-kodepos').val('');
        $('#btnEdit-domisili').val('');
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

    $('.modal-tambah-sfptk').on('hide.bs.modal', function() {
        $('#new-sfptk').val('');
    })
    $('.modal-edit-sfptk').on('hide.bs.modal', function() {
        $('#edit-sfptk').val('');
        $('#btnEdit-sfptk').val('');
    })

    $('.modal-tambah-smcu').on('hide.bs.modal', function() {
        $('#new-smcu').val('');
    })
    $('.modal-edit-smcu').on('hide.bs.modal', function() {
        $('#edit-smcu').val('');
        $('#btnEdit-smcu').val('');
    })

    $('.modal-tambah-stest').on('hide.bs.modal', function() {
        $('#new-stest').val('');
    })
    $('.modal-edit-stest').on('hide.bs.modal', function() {
        $('#edit-stest').val('');
        $('#btnEdit-stest').val('');
    })

    $('.modal-tambah-srek').on('hide.bs.modal', function() {
        $('#new-srek').val('');
    })
    $('.modal-edit-srek').on('hide.bs.modal', function() {
        $('#edit-srek').val('');
        $('#btnEdit-srek').val('');
    })
}

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

function confirm(){
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
        alert()
    }
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
        if(arrId_sim.length>0){
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
                        url: '/hrdats/mt/del/sim',
                        type: 'post',
                        data: {
                            arrId_sim:arrId_sim
                        }
                    }).done((data) => {
                        $('#TblSim').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert();
                }
            })
        }
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
            // console.log(JSON.stringify(data));
            alert();
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
            alert();
            // console.log(JSON.stringify(data));
        });
    });
}

//----DOMISILI----
function loadTbl_DOMISILI(){
    $('#TblDomisili').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/domisili",
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
                    return '<input type="checkbox" class="cek-domisili" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkDomisili(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkDomisili(this)" value="'+row.id+'">'+
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
                data: 'provinsi',
                defaultContent: ''
            },
            {
                data: 'kabupaten',
                defaultContent: ''
            },
            {
                data: 'kodepos',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_domisili(value)" data-toggle="modal" data-target=".modal-edit-domisili" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-domisili').change(function(){
        $("input.cek-domisili:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_DOMISILI(){
    $('#btnDel-domisili').on('click', function() {
         //ini buat ambil ID-nya
         var arrId_domisili=[];
         var cek = $('.cek-domisili')
         for(var i=0; cek[i]; ++i){
             if(cek[i].checked){
                 arrId_domisili.push(cek[i].value);
             }
         }

         if (arrId_domisili.length>0) {
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
                        url: '/hrdats/mt/del/domisili',
                        type: 'post',
                        data: {
                            arrId_domisili:arrId_domisili
                        }
                    }).done((data) => {
                        $('#TblDomisili').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
         }
    })
}
function add_DOMISILI(){
    $('#btnAdd-domisili').on('click', function() {
        var new_provinsi = $('#new-provinsi').val();
        var new_kabupaten = $('#new-kabupaten').val();
        var new_kodepos = $('#new-kodepos').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/domisili',
            type: 'post',
            data: {
                new_provinsi:new_provinsi,
                new_kabupaten:new_kabupaten,
                new_kodepos:new_kodepos
            }
          }).done((data) => {
            $(".modal-tambah-domisili").modal('hide');
            $('#TblDomisili').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_domisili(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/domisili/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-domisili').val(id);
        $('#edit-provinsi').val(data[0].provinsi);
        $('#edit-kabupaten').val(data[0].kabupaten);
        $('#edit-kodepos').val(data[0].kodepos);
        console.log(JSON.stringify(data));
      });
}
function checkDomisili(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_domisili= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/domisili',
        type: 'post',
        data: {
            active:active,
            id_domisili:id_domisili
        }
      }).done((data) => {
        $('#TblDomisili').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_DOMISILI(){
    $('#btnEdit-domisili').on('click', function() {
        var Edit_provinsi = $('#edit-provinsi').val();
        var Edit_kabupaten = $('#edit-kabupaten').val();
        var Edit_kodepos = $('#edit-kodepos').val();
        var id_domisili=$('#btnEdit-domisili').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/domisili',
            type: 'post',
            data: {
                Edit_provinsi:Edit_provinsi,
                Edit_kabupaten:Edit_kabupaten,
                Edit_kodepos:Edit_kodepos,
                id_domisili:id_domisili
            }
          }).done((data) => {
            $(".modal-edit-domisili").modal('hide');
            $('#TblDomisili').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
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

        if (arrId_jurusan>0) {
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
                        url: '/hrdats/mt/del/jurusan',
                        type: 'post',
                        data: {
                            arrId_jurusan:arrId_jurusan
                        }
                    }).done((data) => {
                        $('#TblJurusan').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
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
            alert()
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
            alert()
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

        if (arrId_perkawinan.length>0) {
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
                        url: '/hrdats/mt/del/perkawinan',
                        type: 'post',
                        data: {
                            arrId_perkawinan:arrId_perkawinan
                        }
                    }).done((data) => {
                        $('#TblPerkawinan').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
        
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
            alert()
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
            alert()
        });
    });
}

//----STATUS FPTK----
function loadTbl_SFPTK(){
    $('#TblSfptk').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/sfptk",
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
                    return '<input type="checkbox" class="cek-sfptk" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSfptk(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSfptk(this)" value="'+row.id+'">'+
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
                data: 'keterangan',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_sfptk(value)" data-toggle="modal" data-target=".modal-edit-sfptk" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-sfptk').change(function(){
        $("input.cek-sfptk:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_SFPTK(){
    $('#btnDel-sfptk').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_sfptk=[];
        var cek = $('.cek-sfptk')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_sfptk.push(cek[i].value);
            }
        }

        if (arrId_sfptk.length>0) {
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
                        url: '/hrdats/mt/del/sfptk',
                        type: 'post',
                        data: {
                            arrId_sfptk:arrId_sfptk
                        }
                    }).done((data) => {
                        $('#TblSfptk').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
        
    })
}
function add_SFPTK(){
    $('#btnAdd-sfptk').on('click', function() {
        var new_sfptk = $('#new-sfptk').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/sfptk',
            type: 'post',
            data: {
                new_sfptk:new_sfptk
            }
          }).done((data) => {
            $(".modal-tambah-sfptk").modal('hide');
            $('#TblSfptk').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_sfptk(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/sfptk/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-sfptk').val(id);
        $('#edit-sfptk').val(data[0].keterangan);
        console.log(JSON.stringify(data));
      });
}
function checkSfptk(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_sfptk= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/sfptk',
        type: 'post',
        data: {
            active:active,
            id_sfptk:id_sfptk
        }
      }).done((data) => {
        $('#TblSfptk').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_SFPTK(){
    $('#btnEdit-sfptk').on('click', function() {
        var Edit_keterangan = $('#edit-sfptk').val();
        var id_sfptk = $('#btnEdit-sfptk').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/sfptk',
            type: 'post',
            data: {
                Edit_keterangan:Edit_keterangan,
                id_sfptk:id_sfptk
            }
          }).done((data) => {
            $(".modal-edit-sfptk").modal('hide');
            $('#TblSfptk').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
        });
    });
}

//----STATUS MCU----
function loadTbl_SMCU(){
    $('#TblSmcu').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/smcu",
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
                    return '<input type="checkbox" class="cek-smcu" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSmcu(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSmcu(this)" value="'+row.id+'">'+
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
                data: 'keterangan',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_smcu(value)" data-toggle="modal" data-target=".modal-edit-smcu" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-smcu').change(function(){
        $("input.cek-smcu:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_SMCU(){
    $('#btnDel-smcu').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_smcu=[];
        var cek = $('.cek-smcu')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_smcu.push(cek[i].value);
            }
        }

        if (arrId_smcu.length>0) {
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
                        url: '/hrdats/mt/del/smcu',
                        type: 'post',
                        data: {
                            arrId_smcu:arrId_smcu
                        }
                    }).done((data) => {
                        $('#TblSmcu').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
    })
}
function add_SMCU(){
    $('#btnAdd-smcu').on('click', function() {
        var new_smcu = $('#new-smcu').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/smcu',
            type: 'post',
            data: {
                new_smcu:new_smcu
            }
          }).done((data) => {
            $(".modal-tambah-smcu").modal('hide');
            $('#TblSmcu').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_smcu(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/smcu/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-smcu').val(id);
        $('#edit-smcu').val(data[0].keterangan);
        console.log(JSON.stringify(data));
      });
}
function checkSmcu(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_smcu= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/smcu',
        type: 'post',
        data: {
            active:active,
            id_smcu:id_smcu
        }
      }).done((data) => {
        $('#TblSmcu').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_SMCU(){
    $('#btnEdit-smcu').on('click', function() {
        var Edit_keterangan = $('#edit-smcu').val();
        var id_smcu = $('#btnEdit-smcu').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/smcu',
            type: 'post',
            data: {
                Edit_keterangan:Edit_keterangan,
                id_smcu:id_smcu
            }
          }).done((data) => {
            $(".modal-edit-smcu").modal('hide');
            $('#TblSmcu').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
        });
    });
}

//----STATUS MCU----
function loadTbl_STEST(){
    $('#TblStest').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/stest",
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
                    return '<input type="checkbox" class="cek-stest" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkStest(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkStest(this)" value="'+row.id+'">'+
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
                data: 'keterangan',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_stest(value)" data-toggle="modal" data-target=".modal-edit-stest" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-stest').change(function(){
        $("input.cek-stest:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_STEST(){
    $('#btnDel-stest').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_stest=[];
        var cek = $('.cek-stest')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_stest.push(cek[i].value);
            }
        }
        
        if (arrId_stest.length>0) {
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
                        url: '/hrdats/mt/del/stest',
                        type: 'post',
                        data: {
                            arrId_stest:arrId_stest
                        }
                    }).done((data) => {
                        $('#TblStest').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
    })
}
function add_STEST(){
    $('#btnAdd-stest').on('click', function() {
        var new_stest = $('#new-stest').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/stest',
            type: 'post',
            data: {
                new_stest:new_stest
            }
          }).done((data) => {
            $(".modal-tambah-stest").modal('hide');
            $('#TblStest').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_stest(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/stest/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-stest').val(id);
        $('#edit-stest').val(data[0].keterangan);
        console.log(JSON.stringify(data));
      });
}
function checkStest(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_stest= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/stest',
        type: 'post',
        data: {
            active:active,
            id_stest:id_stest
        }
      }).done((data) => {
        $('#TblStest').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_STEST(){
    $('#btnEdit-stest').on('click', function() {
        var Edit_keterangan = $('#edit-stest').val();
        var id_stest = $('#btnEdit-stest').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/stest',
            type: 'post',
            data: {
                Edit_keterangan:Edit_keterangan,
                id_stest:id_stest
            }
          }).done((data) => {
            $(".modal-edit-stest").modal('hide');
            $('#TblStest').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
        });
    });
}

//----STATUS REKRUTMEN----
function loadTbl_SREK(){
    $('#TblSrek').DataTable({
        "scrollY":        "400px",
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/srek",
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
                    return '<input type="checkbox" class="cek-srek" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSrek(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkSrek(this)" value="'+row.id+'">'+
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
                data: 'proses',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_srek(value)" data-toggle="modal" data-target=".modal-edit-srek" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-srek').change(function(){
        $("input.cek-srek:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_SREK(){
    $('#btnDel-srek').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_srek=[];
        var cek = $('.cek-srek')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_srek.push(cek[i].value);
            }
        }

        if (arrId_srek.length>0) {
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
                        url: '/hrdats/mt/del/srek',
                        type: 'post',
                        data: {
                            arrId_srek:arrId_srek
                        }
                    }).done((data) => {
                        $('#TblSrek').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
    })
}
function add_SREK(){
    $('#btnAdd-srek').on('click', function() {
        var new_srek = $('#new-srek').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/srek',
            type: 'post',
            data: {
                new_srek:new_srek
            }
          }).done((data) => {
            $(".modal-tambah-srek").modal('hide');
            $('#TblSrek').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_srek(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/srek/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-srek').val(id);
        $('#edit-srek').val(data[0].proses);
        console.log(JSON.stringify(data));
      });
}
function checkSrek(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_srek= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/srek',
        type: 'post',
        data: {
            active:active,
            id_srek:id_srek
        }
      }).done((data) => {
        $('#TblSrek').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_SREK(){
    $('#btnEdit-srek').on('click', function() {
        var Edit_keterangan = $('#edit-srek').val();
        var id_srek = $('#btnEdit-srek').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/srek',
            type: 'post',
            data: {
                Edit_keterangan:Edit_keterangan,
                id_srek:id_srek
            }
          }).done((data) => {
            $(".modal-edit-srek").modal('hide');
            $('#TblSrek').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
        });
    });
}