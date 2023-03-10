@component('mail::message')
# You got an New Appointment



@component('mail::button', ['url' => ''])
Visit Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
