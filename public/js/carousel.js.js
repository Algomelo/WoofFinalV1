// Obtener referencias a los elementos de los botones de desplazamiento
var prevButton = document.getElementById('prewButton'); // Corrige el ID del botón previo
var nextButton = document.getElementById('nextButton');

// Agregar eventos mouseover y mouseout a los botones de desplazamiento
prevButton.addEventListener('mouseover', function() {
  // Cambiar el borde y relleno del botón previo al pasar el cursor
  prevButton.style.borderColor = 'green';
  prevButton.style.backgroundColor = 'white';
});

prevButton.addEventListener('mouseout', function() {
  // Restaurar el borde y relleno del botón previo al quitar el cursor
  prevButton.style.borderColor = 'yellow';
  prevButton.style.backgroundColor = '';
});

nextButton.addEventListener('mouseover', function() {
  // Cambiar el borde y relleno del botón siguiente al pasar el cursor
  nextButton.style.borderColor = 'green';
  nextButton.style.backgroundColor = 'white';
});

nextButton.addEventListener('mouseout', function() {
  // Restaurar el borde y relleno del botón siguiente al quitar el cursor
  nextButton.style.borderColor = 'yellow';
  nextButton.style.backgroundColor = '';
});