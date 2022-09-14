$( document ).ready(function() {
  clearModal();
  loadtablempp();
  updatempp();

  $('#filter_lob').select2();
});

function clearModal(){
  $('#modal-upload-mpp').on('hide.bs.modal', function() {
      $('#tahunBE').val('');
      $('#upload_MPP').val('');
  })
}

function loadtablempp(){
  $('#filtermpp').on('click', function() {
    $('.datampp').remove();
    var key_be=['gol 7-8','gol 6','gol 5','gol 4','gol 3','gol 1-2','ttlPermanen','ttlTemporary']
    var be =[];
    var val_actual = []
    var key_actual = [8,7,6,5,4,3,2,1]
    var actual=[]
    var val
    var val2
    var permanen=0

    var filter_thn = $('#filter_tahunBE').val();
    var filter_lob = $('#filter_lob').val();

    $('#inf_thn').text(filter_thn);
    $('#inf_lob').text(filter_lob);

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/hrd/show/mpp',
        type: 'post',
        data: {
            thn:filter_thn,
            lob:filter_lob
        }
      }).done((data) => {
        if (data[2].length>0) {
          for (let index = 0; index < key_actual.length; index++) {
            if (data[2][0][key_actual[index]]==null) {
              val = 0;
            }else{
              val = parseInt(data[2][0][key_actual[index]]);
            }
            permanen = permanen + val;
            val_actual.push(val)
          }
          actual.push(val_actual[0]+val_actual[1],val_actual[2],val_actual[3],val_actual[4],val_actual[5],val_actual[6]+val_actual[7],permanen,0)
        }else{
          actual.push(0,0,0,0,0,0,0,0)
        }
        
        if (data[1].length>0) {
          for (let index = 0; index < key_be.length; index++) {
            if (data[1][0][key_be[index]]==null) {
              val2 = 0;
            } else {
              val2 = data[1][0][key_be[index]];
            }
            be.push(val2)
          }
        }
        //START BTN UPDATE
          if (data[1].length<=0) {
            $('#btnUpdate_mpp').attr('disabled',true)
          }else{
            $('#btnUpdate_mpp').attr('disabled',false)
          }
        //END BTN UPDATE

        // START Table
        var html=''
        for (let index = 0; index < data[0].length; index++) {
          html+='<tr class="datampp">'
          html+=  '<td>'+data[0][index]+'</td>'
          if (data[1].length<=0) {
            // ini kalo gak ada data BE
            html+=  '<td>'+'data belum ada'+'</td>'
          } else {
            html+=  '<td><input type="number" name=UpdateBE[] value='+be[index]+' min="0"></input></td>'
          }
          html+=  '<td>'+actual[index]+'</td>'
          if (data[1].length<=0) {
            // ini kalo gak ada data BE
            html+=  '<td>'+'data belum ada'+'</td>'
          } else {
            html+=  '<td>'+(be[index]-actual[index])+'</td>'
          }
          
          html+='</tr>'
        }
        $('#detail').append(html);
        // END TABLE

        // console.log(JSON.stringify(data[1].length));
      });
  });
}

function updatempp(){
  $('#btnUpdate_mpp').on('click', function() {
    var thn = $('#inf_thn').text()
    var lob = $('#inf_lob').text()
    var updateBE = $("input[name='UpdateBE[]']")
              .map(function(){
                if ($(this).val()>=0) {
                  return parseInt($(this).val());
                } else {
                  return 0
                }
                }).get();
  
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
        _token: '{{ csrf_token() }}',
        url: '/hrdats/hrd/update/mpp',
        type: 'post',
        data: {
            thn:thn,
            lob:lob,
            updateBE:updateBE
        }
      }).done((data) => {
        // $(".modal-edit-domisili").modal('hide');
        // $('#TblDomisili').DataTable().ajax.reload();
        $('#filtermpp').click();
        // console.log(JSON.stringify(data));
    });     
  });
}