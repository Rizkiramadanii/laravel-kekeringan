// Toggle the side navigation
document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const body = document.body;

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault();
            body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', body.classList.contains('sb-sidenav-toggled'));
        });
    }

    // Persist sidebar toggle state
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        body.classList.toggle('sb-sidenav-toggled');
    }
});
