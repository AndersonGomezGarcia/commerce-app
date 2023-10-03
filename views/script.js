
// Get the modal
var modal_add_product = document.getElementById("modal_add_product");//busca el div modeal con la id modal_add_product



// Get the button that opens the modal
var btn_add_product= document.getElementById("btn_add_product");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
/*btn_add_product.onclick = function() {
  modal_add_product.style.display = "block";//pone existente el display del modal que tengamos en la variable
}*/
function openModal(action,item,id) {

  var modal_update = document.getElementById("modal_"+action+"_"+item+"#"+id);
  modal_update.style.display = "block";
  document.getElementById('todayDate71').valueAsDate = new Date();
}


// When the user clicks on <span> (x), close the modal

function closeModal(action,item,id) {
  var modal = document.getElementById("modal_"+action+"_"+item+"#"+id);
  modal.style.display = "none";
}

span.onclick = function() {
  modal_add_product.style.display = "none";
  
}

window.onclick = function(event) {
  modal = document.getElementsByClassName("modal");
  if(event.target == modal) {
    modal.style.display = "none";
  }

}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_add_product) {
    modal_add_product.style.display = "none";
  }
}




/*window.addEventListener('DOMContentLoaded', (event) => {
  document.getElementById("todayDate").valueAsDate = new Date();
})*/
function date(){
  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth() + 1;
  var year = date.getFullYear();
  
  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;
  
  var today = year + "-" + month + "-" + day;
  
    document.getElementById("todayDate").value = today;
}

function prueba(){
  return "hola";
}
window.onclick = function(event) {
document.getElementById('todayDate71').valueAsDate = new Date();}
window.onload = function loadDate() {
  let date = new Date(),
      day = date.getDate(),
      month = date.getMonth() + 1,
      year = date.getFullYear();

  if (month < 10) month = "0" + month;
  if (day < 10) day = "0" + day;

  const todayDate = `${year}-${month}-${day}`;

  try{
    document.getElementById("todayDate71").defaultValue = todayDate;
  }catch(e){

  }
};

