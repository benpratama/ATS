$( document ).ready(function() {
    insertMDevice();
})

function insertMDevice(){
    $('#btnEmail').on('click',function(){
        var iframe = document.getElementById("frame_WA");
        console.log(iframe)
    });
}