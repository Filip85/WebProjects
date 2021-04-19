var btnOne = document.getElementById("buttonOne");

function functionOne() {
  var carOne = document.getElementById("carouselOne");

  carOne.classList.toggle('hidden');
}

btnOne.addEventListener("click", functionOne);