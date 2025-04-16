@component('mail::message')
    Welcome to our website



    Name: {{ $mailData['name'] }}<br />

    Email: {{ $mailData['email'] }}



    Thanks,<br />

    {{ config('app.name') }}
@endcomponent
