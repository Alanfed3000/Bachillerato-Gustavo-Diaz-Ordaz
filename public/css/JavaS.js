document.addEventListener('DOMContentLoaded', function() {
    // ----------------------------------------------------
    // REFERENCIAS DE ELEMENTOS
    // ----------------------------------------------------
    const menuToggle = document.querySelector('.menu-toggle');
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('content-wrapper');
    const navLinks = document.querySelectorAll('.nav-link-item');
    const contentSections = document.querySelectorAll('.content-section');

    // Referencias Modal de Perfil (Existente)
    const openProfileModalBtn = document.getElementById('open-profile-modal');
    const closeProfileModalBtn = document.getElementById('close-profile-modal');
    const profileModal = document.getElementById('profile-modal');

    // Referencias Modal Crear Docente (NUEVO)
    const openCreateDocenteBtn = document.getElementById('open-create-docente-modal');
    const closeCreateDocenteBtn = document.getElementById('close-create-docente-modal');
    const createDocenteModal = document.getElementById('create-docente-modal');


    // ----------------------------------------------------
    // A. LÓGICA DE MENÚ LATERAL (SIDEBAR) Y EFECTO PUSH
    // ----------------------------------------------------
    function toggleMenu() {
        sidebar.classList.toggle('active');

        // Aplicar 'pushed' solo en escritorio
        if (window.innerWidth > 768) {
            contentWrapper.classList.toggle('pushed');
        }
    }

    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }

    // Cierra el menú al hacer clic fuera
    document.addEventListener('click', function(e) {
        const isClickInsideSidebar = sidebar.contains(e.target);
        const isClickOnToggle = menuToggle.contains(e.target);

        if (sidebar.classList.contains('active') && !isClickInsideSidebar && !isClickOnToggle) {
            sidebar.classList.remove('active');
            if (window.innerWidth > 768) {
                contentWrapper.classList.remove('pushed');
            }
        }
    });

    // ----------------------------------------------------
    // B. LÓGICA PARA CAMBIAR DE SECCIÓN DE CONTENIDO
    // ----------------------------------------------------
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Si el enlace tiene una ruta de Blade definida, Laravel gestionará la navegación,
            // pero si quieres que cambie de pestaña sin recargar (single page app behavior)
            // se mantiene esta lógica. Aquí asumimos que usas la navegación de Laravel.

            // Si quieres un comportamiento de SPA, descomenta las siguientes líneas:
            /*
            e.preventDefault();
            contentSections.forEach(section => { section.classList.remove('active'); });
            navLinks.forEach(nav => { nav.classList.remove('active'); });

            const targetId = this.getAttribute('data-target');
            const targetSection = document.getElementById(targetId);

            if (targetSection) {
                targetSection.classList.add('active');
                this.classList.add('active');
            }
            */

            // Cerrar el sidebar después de seleccionar (en cualquier resolución)
            sidebar.classList.remove('active');
            if (window.innerWidth > 768) {
                contentWrapper.classList.remove('pushed');
            }
        });
    });

    // ----------------------------------------------------
    // C. LÓGICA PARA MODAL DE PERFIL
    // ----------------------------------------------------
    if (openProfileModalBtn && profileModal) {
        openProfileModalBtn.addEventListener('click', () => {
            profileModal.style.display = 'block';
        });
    }

    if (closeProfileModalBtn && profileModal) {
        closeProfileModalBtn.addEventListener('click', () => {
            profileModal.style.display = 'none';
        });
    }

    // Cerrar si se hace clic fuera del modal de Perfil
    window.addEventListener('click', (e) => {
        if (e.target === profileModal) {
            profileModal.style.display = 'none';
        }
    });

    // ----------------------------------------------------
    // D. LÓGICA PARA MODAL CREAR DOCENTE (NUEVO)
    // ----------------------------------------------------
    if (openCreateDocenteBtn && createDocenteModal) {
        openCreateDocenteBtn.addEventListener('click', () => {
            createDocenteModal.style.display = 'block';
        });
    }

    if (closeCreateDocenteBtn && createDocenteModal) {
        closeCreateDocenteBtn.addEventListener('click', () => {
            createDocenteModal.style.display = 'none';
        });
    }

    // Cerrar si se hace clic fuera del modal de Docente
    window.addEventListener('click', (e) => {
        if (e.target === createDocenteModal) {
            createDocenteModal.style.display = 'none';
        }
    });
});
