<div aria-live="polite" aria-atomic="true" style="position: fixed; top: 20px; right: 20px; z-index: 1050;">
    <div class="toast bg-{{ $type }} text-white fade show" role="alert" aria-live="assertive" aria-atomic="true"
        data-delay="3000">
        <div class="toast-body d-flex align-items-center">
            @if ($type == 'success')
                <i class="fas fa-check-circle mr-2"></i>
            @elseif($type == 'danger')
                <i class="fas fa-exclamation-circle mr-2"></i>
            @elseif($type == 'warning')
                <i class="fas fa-exclamation-triangle mr-2"></i>
            @elseif($type == 'info')
                <i class="fas fa-info-circle mr-2"></i>
            @else
                <i class="fas fa-bell mr-2"></i>
            @endif
            <span>{{ $message }}</span>
            <button type="button" class="ml-auto close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
