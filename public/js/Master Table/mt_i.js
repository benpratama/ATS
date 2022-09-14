$( document ).ready(function() {
    clearModal();

    loadTbl_JOB();
    delete_JOB();
    add_JOB();
    Edit_JOB();

    loadTbl_ORGANISASI();

    loadTbl_DEPARMENT();

    loadTbl_USER();
    // add_USER();
    Edit_USER();
});

function clearModal(){
    $('.modal-tambah-job').on('hide.bs.modal', function() {
        $('#new-job').val('');
        $('#new-golongan').val('');
    })
    $('.modal-edit-job').on('hide.bs.modal', function() {
        $('#edit-job').val('');
        $('#edit-golongan').val('');
        $('#btnEdit-job').val('');
    })
    $('.modal-tambah-user').on('hide.bs.modal', function() {
        $('#new-user').val('');
    })
    $('.modal-edit-user').on('hide.bs.modal', function() {
        $('#edit-email').val('');
        $('#edit-wa').val('');
        $('#btnEdit-user').val('');
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

//----MCU----
function loadTbl_JOB(){
    $('#TblJob').DataTable({
        "scrollY":        "400px",
        "scrollX": true,
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/job",
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
                    return '<input type="checkbox" class="cek-job" value="'+row.id+'">'
                }
            },
            {
                data: 'active',
                defaultContent: '',
                render: (data, type, row, meta)=> {
  
                    switch(data){
                        case'1':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkJob(this)" checked value="'+row.id+'">'+
                                    '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
                                '</label>'
                        break;
                        case'0':
                        return'<label class="custom-toggle">'+
                                    '<input type="checkbox" onclick="checkJob(this)" value="'+row.id+'">'+
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
                data: 'golongan',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_job(value)" data-toggle="modal" data-target=".modal-edit-job" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    //buat check
    $('#cekAll-job').change(function(){
        $("input.cek-job:checkbox").prop("checked",$(this).prop("checked"));
    })
}
function delete_JOB(){
    $('#btnDel-job').on('click', function() {
        //ini buat ambil ID-nya
        var arrId_job=[];
        var cek = $('.cek-job')
        for(var i=0; cek[i]; ++i){
            if(cek[i].checked){
                arrId_job.push(cek[i].value);
            }
        }

        if (arrId_job.length>0) {
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
                        url: '/hrdats/mt/del/job',
                        type: 'post',
                        data: {
                            arrId_job:arrId_job
                        }
                    }).done((data) => {
                        $('#TblJob').DataTable().ajax.reload();
                        // console.log(JSON.stringify(data));
                    });
                    alert()
                }
            })
        }
    })
}
function add_JOB(){
    $('#btnAdd-job').on('click', function() {
        var new_job = $('#new-job').val();
        var new_golongan = $('#new-golongan').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/job',
            type: 'post',
            data: {
                new_job:new_job,
                new_golongan:new_golongan
            }
          }).done((data) => {
            $(".modal-tambah-job").modal('hide');
            $('#TblJob').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_job(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/job/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-job').val(id);
        $('#edit-job').val(data[0].nama);
        $('#edit-golongan').val(data[0].golongan);
        // console.log(JSON.stringify(data[1]));
      });
}
function checkJob(obj){
    if (obj.checked==false) {
        console.log('nonactive')
        var active=0;
    } else {
        console.log('active')
        var active=1;
    }
    
    var id_job= obj.value;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/active/job',
        type: 'post',
        data: {
            active:active,
            id_job:id_job
        }
      }).done((data) => {
        $('#TblJob').DataTable().ajax.reload();
        console.log(JSON.stringify(data));
    });

}
function Edit_JOB(){
    $('#btnEdit-job').on('click', function() {
        var edit_job = $('#edit-job').val();
        var edit_golongan= $('#edit-golongan').val();
        var id_job=$('#btnEdit-job').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/job',
            type: 'post',
            data: {
                edit_job:edit_job,
                edit_golongan:edit_golongan,
                id_job:id_job
            }
          }).done((data) => {
            $(".modal-edit-job").modal('hide');
            $('#TblJob').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
        });
    });
}

//----ORGANISASI----
function loadTbl_ORGANISASI(){
    $('#TblOrganisasi').DataTable({
        "scrollY":        "400px",
        "scrollX": true,
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/organisasi",
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
            // {
            //     render: (data, type, row, meta)=> {
            //         return '<input type="checkbox" class="cek-job" value="'+row.id+'">'
            //     }
            // },
            // {
            //     data: 'active',
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
  
            //         switch(data){
            //             case'1':
            //             return'<label class="custom-toggle">'+
            //                         '<input type="checkbox" onclick="checkJob(this)" checked value="'+row.id+'">'+
            //                         '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
            //                     '</label>'
            //             break;
            //             case'0':
            //             return'<label class="custom-toggle">'+
            //                         '<input type="checkbox" onclick="checkJob(this)" value="'+row.id+'">'+
            //                         '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
            //                     '</label>'
            //             break;
            //             default:
            //                 return data;
            //                 break;
            //         }
                    
            //     }
            // },
            {
                data: 'nama',
                defaultContent: ''
            }
            // {
            //     data: 'golongan',
            //     defaultContent: ''
            // },
            // {
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
            //         return '<button type="button" class="btn btn-info" onclick="Modal_job(value)" data-toggle="modal" data-target=".modal-edit-job" value="'+row.id+'">Edit</button>'
            //     }
            // }
        ] 
    });

    //buat check
    // $('#cekAll-job').change(function(){
    //     $("input.cek-job:checkbox").prop("checked",$(this).prop("checked"));
    // })
}

//----DEPARMENT----
function loadTbl_DEPARMENT(){
    $('#TblDept').DataTable({
        "scrollY":        "400px",
        "scrollX": true,
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/dept",
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
            // {
            //     render: (data, type, row, meta)=> {
            //         return '<input type="checkbox" class="cek-job" value="'+row.id+'">'
            //     }
            // },
            // {
            //     data: 'active',
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
  
            //         switch(data){
            //             case'1':
            //             return'<label class="custom-toggle">'+
            //                         '<input type="checkbox" onclick="checkJob(this)" checked value="'+row.id+'">'+
            //                         '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
            //                     '</label>'
            //             break;
            //             case'0':
            //             return'<label class="custom-toggle">'+
            //                         '<input type="checkbox" onclick="checkJob(this)" value="'+row.id+'">'+
            //                         '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
            //                     '</label>'
            //             break;
            //             default:
            //                 return data;
            //                 break;
            //         }
                    
            //     }
            // },
            {
                data: 'nama',
                defaultContent: ''
            }
            // {
            //     data: 'golongan',
            //     defaultContent: ''
            // },
            // {
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
            //         return '<button type="button" class="btn btn-info" onclick="Modal_job(value)" data-toggle="modal" data-target=".modal-edit-job" value="'+row.id+'">Edit</button>'
            //     }
            // }
        ] 
    });

    //buat check
    // $('#cekAll-job').change(function(){
    //     $("input.cek-job:checkbox").prop("checked",$(this).prop("checked"));
    // })
}

//----USER----
function loadTbl_USER(){
    $('#TblUser').DataTable({
        "scrollY":        "400px",
        "scrollX": true,
        "scrollCollapse": true,
        pageLength : 5,
        ajax: {
        url: "/hrdats/mt/show/user",
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
            // {
            //     render: (data, type, row, meta)=> {
            //         return '<input type="checkbox" class="cek-job" value="'+row.id+'">'
            //     }
            // },
            // {
            //     data: 'active',
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
  
            //         switch(data){
            //             case'1':
            //             return'<label class="custom-toggle">'+
            //                         '<input type="checkbox" onclick="checkJob(this)" checked value="'+row.id+'">'+
            //                         '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
            //                     '</label>'
            //             break;
            //             case'0':
            //             return'<label class="custom-toggle">'+
            //                         '<input type="checkbox" onclick="checkJob(this)" value="'+row.id+'">'+
            //                         '<span class="custom-toggle-slider rounded-circle" data-label-off="No" data-label-on="Yes"></span>'+
            //                     '</label>'
            //             break;
            //             default:
            //                 return data;
            //                 break;
            //         }
                    
            //     }
            // },
            {
                data: 'NIK',
                defaultContent: ''
            },
            {
                data: 'nama',
                defaultContent: ''
            },
            {
                data: 'extensionName',
                defaultContent: ''
            },
            {
                data: 'location',
                defaultContent: ''
            },
            {
                data: 'namaManager',
                defaultContent: ''
            },
            {
                defaultContent: '',
                render: (data, type, row, meta)=> {
                    return '<button type="button" class="btn btn-info" onclick="Modal_user(value)" data-toggle="modal" data-target=".modal-edit-user" value="'+row.id+'">Edit</button>'
                }
            }
        ] 
    });

    // //buat check
    // $('#cekAll-job').change(function(){
    //     $("input.cek-job:checkbox").prop("checked",$(this).prop("checked"));
    // })
}
function add_USER(){
    $('#btnAdd-user').on('click', function() {
        var new_user = $('#new-user').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/add/user',
            type: 'post',
            data: {
                new_user:new_user
            }
          }).done((data) => {
            // $(".modal-tambah-user").modal('hide');
            $('#TblUser').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
          });
    })
}
function Modal_user(id){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/mt/modal/user/'+id,
        type: 'get'
      }).done((data) => {
        $('#btnEdit-user').val(id);
        $('#edit-email').val(data[0].email);
        $('#edit-wa').val(data[0].mobilePhone);
        // console.log(JSON.stringify(data[1]));
      });
}
function Edit_USER(){
    $('#btnEdit-user').on('click', function() {
        var edit_wa = $('#edit-wa').val();
        var id_user=$('#btnEdit-user').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            _token: '{{ csrf_token() }}',
            url: '/hrdats/mt/edit/user',
            type: 'post',
            data: {
                edit_wa:edit_wa,
                id_user:id_user
            }
          }).done((data) => {
            $(".modal-edit-user").modal('hide');
            $('#TblUser').DataTable().ajax.reload();
            console.log(JSON.stringify(data));
            alert()
        });
    });
}