@php
    $alertTypes = [
        'success' => 'alert-success',
        'danger' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info',
        'primary' => 'alert-primary',
        'secondary' => 'alert-secondary',
        'light' => 'alert-light',
        'dark' => 'alert-dark',
    ];
@endphp

<div class="alert {{ $alertTypes[$type] ?? 'alert-info' }}" role="alert">
    {{ $message }}
</div>
