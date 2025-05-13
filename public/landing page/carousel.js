document.addEventListener('DOMContentLoaded', () => {
  const wrapper = document.querySelector('.carousel-wrapper');
  const items = document.querySelectorAll('.carousel-item');
  const prevBtn = document.querySelector('.carousel-control.prev');
  const nextBtn = document.querySelector('.carousel-control.next');

  let index = 0;
  const total = items.length;

  function updateCarousel() {
    wrapper.style.width = `${items.length * 100}%`;
    items.forEach(item => item.style.width = `${100 / items.length}%`);
    
  }

  function nextSlide() {
      index = (index + 1) % total;
      updateCarousel();
  }

  function prevSlide() {
      index = (index - 1 + total) % total;
      updateCarousel();
  }

  nextBtn.addEventListener('click', nextSlide);
  prevBtn.addEventListener('click', prevSlide);

  setInterval(nextSlide, 7000);
});

/* 
const wrapper = document.querySelector('.carousel-wrapper');
const items = document.querySelectorAll('.carousel-item');
const prevBtn = document.querySelector('.carousel-control.prev');
const nextBtn = document.querySelector('.carousel-control.next');

let index = 0;
const total = items.length;

function updateCarousel() {
  // Movemos el wrapper para mostrar solo el slide actual
  wrapper.style.transform = `translateX(-${index * 100}%)`;
}

function nextSlide() {
  index = (index + 1) % total; // Avanza al siguiente slide, vuelve a 0 si es el último
  updateCarousel();
}

function prevSlide() {
  index = (index - 1 + total) % total; // Retrocede al slide anterior, vuelve al último si está en 0
  updateCarousel();
}

// Detecta clics en las flechas
nextBtn.addEventListener('click', nextSlide);
prevBtn.addEventListener('click', prevSlide);

// Cambia automáticamente cada 7 segundos
setInterval(nextSlide, 7000);
 */