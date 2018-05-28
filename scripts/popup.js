var buttons = document.getElementsByTagName('button');
for (var i = 0; i < buttons.length; i++){
  if (i%2 == 0){
    buttons[i].onclick = function() {
      var modal = document.getElementById(this.id + "Modal");
      modal.style.display = "block";
    }
  }
  else{
    buttons[i].onclick = function() {
      var name = this.id.substring(5, this.id.length);
      var modal = document.getElementById(name + "Modal");
      modal.style.display = "none";
    }
  }
}
