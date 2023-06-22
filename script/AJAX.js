function industry(co){
  fetch('sherchind.php?value='+co)
  .catch((err) => console.log(err));
}
function clasy(co){
  fetch('sherchclass.php?value='+co)
  .catch((err) => console.log(err));
}