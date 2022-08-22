// navigator.geolocation.getCurrentPosition(position => {
//   console.log(position)
// }, error => {
//     console.error(error)
// }, {
//   timeout: 10000,
//   maximumAge: 10000,
//   enableHighAccuracy: true
// })
$( document ).ready(function() {

});

const options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  const crd = pos.coords;
  if (crd.latitude!=null && crd.longitude!=null) {
    $('#frm').removeAttr('hidden');
    $('#ntf').attr("hidden",true);
    console.log(`Latitude : ${crd.latitude}`);
    console.log(`Longitude: ${crd.longitude}`);
  }
  // console.log('Your current position is:');
  // console.log(`Latitude : ${crd.latitude}`);
  // console.log(`Longitude: ${crd.longitude}`);
  // console.log(`More or less ${crd.accuracy} meters.`);
}

function error(err) {
  // console.warn(`ERROR(${err.code}): ${err.message}`);
  $('#ntf').removeAttr('hidden');
  $('#frm').attr("hidden",true);
}

navigator.geolocation.getCurrentPosition(success, error, options);

function Add_SIM(){
  
}