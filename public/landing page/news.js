fetch('noticias.json')
  .then(res => res.json())
  .then(data => {
    const wrapper = document.querySelector(".carousel-wrapper");
    wrapper.innerHTML = "";
    data.forEach(noticia => {
      wrapper.innerHTML += `
        <div class="carousel-item">
          <img src="${noticia.imagen_url}" alt="${noticia.titulo}">
          <div class="carousel-caption">
            <h3>${noticia.titulo}</h3>
            <a href="${noticia.enlace_externo}" class="btn-leer-mas" target="_blank">Leer más</a>
          </div>
        </div>
      `;
    });
  });
