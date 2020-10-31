@component('mail::message')

Your password has been reset. Please click here to reset.

@component('mail::button', ['url' => $content])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
