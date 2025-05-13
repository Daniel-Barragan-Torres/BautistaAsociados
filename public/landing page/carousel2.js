
  document.addEventListener("DOMContentLoaded", function () {
    const wrapper = document.querySelector(".carousel-wrapper");
    const items = document.querySelectorAll(".carousel-item");
    const prevBtn = document.querySelector(".carousel-control.prev");
    const nextBtn = document.querySelector(".carousel-control.next");

    let index = 0;
    const total = items.length;

    // ✅ Función para actualizar la posición del carrusel
    function updateCarousel() {
      wrapper.style.transform = `translateX(-${index * 100}%)`;
      items.forEach(item => item.style.width = `${100 / items.length}%`);
    }

    // ✅ Botón siguiente
    function nextSlide() {
      index = (index + 1) % total;
      updateCarousel();
    }

    // ✅ Botón anterior
    function prevSlide() {
      index = (index - 1 + total) % total;
      updateCarousel();
    }

    // ✅ Eventos de los botones
    nextBtn.addEventListener("click", nextSlide);
    prevBtn.addEventListener("click", prevSlide);

    // ✅ Cambio automático cada 7 segundos
    setInterval(nextSlide, 7000);
  });

