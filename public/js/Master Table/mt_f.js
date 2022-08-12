$( document ).ready(function() {
    loadTblSIM();
});

function loadTblSIM(){
    $('#TblSim').DataTable({
        "scrollY":        "350px",
        "scrollCollapse": true,
        ajax: {
        url: "/hrdats/mt/show/sim",
                data:{},
                dataSrc:""
            },
        "paging": false,
        "bInfo" : false,
        columns: [
            {
                render: (data, type, row, meta)=> {
                    return '<input class="form-check-input" type="checkbox" id="test" value="'+row.id+'">'
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
            }
            // {
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
            //         return '<a href="/admin/detail/'+row.id+'" type="button" class="btn btn-outline-info btn-fw" >Details</a>'
            //     }
            // },
            // {
            //     defaultContent: '',
            //     render: (data, type, row, meta)=> {
            //         return '<button type="button" class="btn btn-outline-danger" value="'+row.id+'" onClick="delApp(this.value)">Delete</button>'
  
            //     }
            // }
        ]
        
    });
}