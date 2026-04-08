
function showToast(message, type = 'success') {
    const toastEl = document.getElementById('liveToast');
    if (!toastEl) return;

    const toastMessage = document.getElementById('toastMessage');
    const toastIcon = document.getElementById('toastIcon');

    toastEl.classList.remove('bg-success', 'bg-danger');
    if (type === 'success') {
        toastEl.classList.add('bg-success');
        toastIcon.innerHTML = '<i class="bi bi-check-circle-fill me-2"></i>';
    } else {
        toastEl.classList.add('bg-danger');
        toastIcon.innerHTML = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
    }

    toastMessage.textContent = message;
    const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
    toast.show();
}
