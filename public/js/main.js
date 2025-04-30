  const toggleBtn = document.getElementById('toggle-theme');
  const icon = toggleBtn.querySelector('i');

  toggleBtn.addEventListener('click', () => {
    document.body.classList.toggle('light-mode');

    // Ganti ikon
    if (document.body.classList.contains('light-mode')) {
      icon.classList.remove('fa-sun');
      icon.classList.add('fa-moon');
    } else {
      icon.classList.remove('fa-moon');
      icon.classList.add('fa-sun');
    }
  });