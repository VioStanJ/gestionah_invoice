@component('mail::message')
# Welcome To GestionaH Invoice

Click to the link below to verify your email Please

@component('mail::button', ['url' => '/verify/your/email/'.$code])
Verify
@endcomponent

Thanks, {{$user->name}}<br>
{{ config('app.name') }}
@endcomponent
