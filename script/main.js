document.addEventListener('DOMContentLoaded', function () {
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });

    const botaoSairConfirm = document.getElementById('botaoSair');
    if (botaoSairConfirm) {
        botaoSairConfirm.addEventListener('click', function () {
            window.location.href = '/public/login.php';
        });
    }
});

function abrirModalSair() {
    const modalSairEl = document.getElementById('modalSair');
    if (!modalSairEl || typeof bootstrap === 'undefined') return;
    bootstrap.Modal.getOrCreateInstance(modalSairEl).show();
}

window.abrirModalSair = abrirModalSair;
