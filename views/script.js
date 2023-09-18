
// Get the modal
var modal_add_product = document.getElementById("modal_add_product");//busca el div modeal con la id modal_add_product



// Get the button that opens the modal
var btn_add_product= document.getElementById("btn_add_product");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn_add_product.onclick = function() {
  modal_add_product.style.display = "block";//pone existente el display del modal que tengamos en la variable
}
function openModal(action,item,id) {

  var modal_update = document.getElementById("modal_"+action+"_"+item+"#"+id);
  modal_update.style.display = "block";
}


// When the user clicks on <span> (x), close the modal

function closeModal(action,item,id) {
  var modal = document.getElementById("modal_"+action+"_"+item+"#"+id);
  modal.style.display = "none";
}

span.onclick = function() {
  modal_add_product.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal_add_product) {
    modal_add_product.style.display = "none";
  }
}

for (var i=0; i<=conteo;i+=1){
  console.log("aa");
  console.log(i);
}

 
