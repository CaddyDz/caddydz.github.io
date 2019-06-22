@component('mail::message')
# Introduction
From: {{ $details->fullname }} <br>
{{ $details->message }}

@component('mail::button', ['url' => 'mailto:'.$details->email])
Reply
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
