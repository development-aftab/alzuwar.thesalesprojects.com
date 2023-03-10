@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Visit Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
