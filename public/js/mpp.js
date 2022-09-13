$( document ).ready(function() {
  // loadTbl_FPTK()
  // Row_kandidat()
  // update_Fptk()
  // detailKandidat()
  // Update_modal()
  clearModal();
  loadtablempp();
  // filter()

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
        
      
        var html=''
        for (let index = 0; index < data[0].length; index++) {
          html+='<tr class="datampp">'
          html+=  '<td>'+data[0][index]+'</td>'
          if (data[1].length<=0) {
            html+=  '<td>'+'data belum ada'+'</td>'
          } else {
            html+=  '<td>'+be[index]+'</td>'
          }
          html+=  '<td>'+actual[index]+'</td>'
          if (data[1].length<=0) {
            html+=  '<td>'+'data belum ada'+'</td>'
          } else {
            html+=  '<td>'+(be[index]-actual[index])+'</td>'
          }
          
          html+='</tr>'
        }
        $('#detail').append(html);
        // console.log(JSON.stringify(data[1].length));
      });
  });
}