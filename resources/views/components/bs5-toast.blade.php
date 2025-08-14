<div aria-live="polite" aria-atomic="true" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
    <div id="liveToast" class="toast bg-{{ $type }} text-white fade" role="alert" aria-live="assertive"
        aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-body d-flex align-items-center">
            @php
                $icons = [
                    'success' => 'fas fa-check-circle',
                    'danger' => 'fas fa-exclamation-circle',
                    'warning' => 'fas fa-exclamation-triangle',
                    'info' => 'fas fa-info-circle',
                    'default' => 'fas fa-bell',
                ];
                $icon = $icons[$type] ?? $icons['default'];
            @endphp
            <i class="{{ $icon }} me-2"></i>
            <span>{{ $message }}</span>
            <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>
