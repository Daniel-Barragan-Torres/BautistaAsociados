const form = document.querySelector('.contacto-form');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const btn = form.querySelector('button');
        const originalText = btn.innerHTML;

        // Mostrar spinner
        btn.innerHTML = 'Enviando...';
        btn.disabled = true;

        // Simular envío
        setTimeout(() => {
            alert('¡Mensaje enviado con éxito!');
            btn.innerHTML = originalText;
            btn.disabled = false;
            form.reset();
        }, 2000);
    });