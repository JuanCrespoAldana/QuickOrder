document.addEventListener('DOMContentLoaded', () => {
    // SLIDER
    const slides = document.querySelectorAll('.slide');
    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');

    let currentIndex = 0;
    let slideInterval = setInterval(nextSlide, 8000);

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % slides.length;
        showSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + slides.length) % slides.length;
        showSlide(currentIndex);
    }

    function resetInterval() {
        clearInterval(slideInterval);
        slideInterval = setInterval(nextSlide, 5000);
    }

    if (nextBtn && prevBtn) {
        nextBtn.addEventListener('click', () => {
            nextSlide();
            resetInterval();
        });

        prevBtn.addEventListener('click', () => {
            prevSlide();
            resetInterval();
        });
    }

    showSlide(currentIndex);

    // INACTIVIDAD
    let tiempoInactividad = 0;
    const tiempoMaximo = 300;

    function reiniciarContador() {
        tiempoInactividad = 0;
    }

    window.onload = reiniciarContador;
    document.onmousemove = reiniciarContador;
    document.onkeypress = reiniciarContador;
    document.onclick = reiniciarContador;
    document.onscroll = reiniciarContador;

    setInterval(() => {
        tiempoInactividad++;
        const divContador = document.getElementById("contador-inactividad");
        if (divContador) {
            divContador.textContent = `Inactividad: ${tiempoInactividad}s`;
        }

        if (tiempoInactividad >= tiempoMaximo) {
            alert('Has estado inactivo por 5 minutos. Serás redirigido al login.');
            window.location.href = '../controlador/logout.php';
        }
    }, 1000);

    // BUSCADOR SOLO PARA SCROLL A LA SECCIÓN DE PLATILLOS
    const searchBox = document.getElementById('search-box');
    const searchIcon = document.getElementById('search-icon');
    const seccionPlatillos = document.querySelector('#platillos');

    function scrollAPlatillos() {
        if (seccionPlatillos) {
            seccionPlatillos.scrollIntoView({ behavior: 'smooth' });

            setTimeout(() => {
                searchBox.value = '';
                searchBox.style.display = 'none';
            }, 500);
        }
    }

    // Ctrl + B para abrir/cerrar búsqueda
    document.addEventListener('keydown', function (event) {
        if (event.ctrlKey && event.key.toLowerCase() === 'b') {
            event.preventDefault();
            toggleSearchBox();
        }
    });

    // Clic en la lupa
    if (searchIcon) {
        searchIcon.addEventListener('click', () => {
            if (searchBox.style.display === 'none' || searchBox.style.display === '') {
                searchBox.style.display = 'block';
                searchBox.focus();
            } else {
                scrollAPlatillos();
            }
        });
    }

    // Enter en el campo de búsqueda
    if (searchBox) {
        searchBox.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                scrollAPlatillos();
            }
        });
    }

    // Función reutilizable si quieres abrir/cerrar el campo
    function toggleSearchBox() {
        if (searchBox.style.display === 'none' || searchBox.style.display === '') {
            searchBox.style.display = 'block';
            searchBox.focus();
        } else {
            searchBox.style.display = 'none';
            searchBox.value = '';
        }
    }

    // Función para cambiar el modo oscuro
    function setupDarkModeToggle() {
        const toggleDarkModeCheckbox = document.getElementById('toggle-dark-mode');
        if (!toggleDarkModeCheckbox) return; // Si no existe el checkbox, salir

        // Aplicar modo oscuro si está guardado en localStorage
        const darkModeEnabled = localStorage.getItem('darkMode') === 'true';
        if (darkModeEnabled) {
            document.body.classList.add('dark-mode');
            toggleDarkModeCheckbox.checked = true;
        }

        toggleDarkModeCheckbox.addEventListener('change', () => {
            if (toggleDarkModeCheckbox.checked) {
                document.body.classList.add('dark-mode');
                localStorage.setItem('darkMode', 'true');
            } else {
                document.body.classList.remove('dark-mode');
                localStorage.setItem('darkMode', 'false');
            }
        });
    }

    setupDarkModeToggle();

});
