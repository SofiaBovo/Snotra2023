@component('mail::message')

{{-- Intro Lines --}}
@if (! empty($line))
{{ $line }}
@else
@lang('Estás recibiendo este correo porque hiciste una solicitud de recuperación de contraseña para tu cuenta.')
@endif

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset
@endcomponent
