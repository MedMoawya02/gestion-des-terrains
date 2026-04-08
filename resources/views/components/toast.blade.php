<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
    <div id="liveToast" class="toast align-items-center border-0 rounded-4 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body d-flex align-items-center">
                <div id="toastIcon" class="me-2 fs-5"></div>
                <div id="toastMessage" class="fw-semibold"></div>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<style>
    .toast.bg-success { background: linear-gradient(45.64deg, #2ecc71 0%, #27ae60 100%) !important; color: white; }
    .toast.bg-danger { background: linear-gradient(45.64deg, #e74c3c 0%, #c0392b 100%) !important; color: white; }
    .toast { transition: all 0.3s ease-in-out; }
</style>