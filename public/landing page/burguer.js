const hamburger = document.querySelector('.hamburger');
  const menu = document.getElementById('menu');
  const icon = hamburger.querySelector('i');

  hamburger.addEventListener('click', () => {
    menu.classList.toggle('active');

    if (menu.classList.contains('active')) {
      icon.classList.remove('fa-bars');
      icon.classList.add('fa-times');
    } else {
      icon.classList.remove('fa-times');
      icon.classList.add('fa-bars');
    }
  });