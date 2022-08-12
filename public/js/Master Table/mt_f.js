$( document ).ready(function() {
    loadTblSIM();
});

function loadTblSIM(){
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
                    return '<input type="checkbox" id="cek-sim" value="'+row.id+'">'
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
                    return '<a href="/admin/detail/'+row.id+'" type="button" class="btn btn-outline-info btn-fw" >Edit</a>'
                }
            }
            // {
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
            //         return '<button type="button" class="btn btn-outline-danger" value="'+row.id+'" onClick="delApp(this.value)">Delete</button>'
  
            //     }
            // }
        ] 
    });
}