@component('mail::message')
# Новая заявка на вакансию

ФИО: {{ $data['fullName'] }}<br>
Позиция: {{ $data['position'] }}<br>
Телефон: {{ $data['phone'] }}<br>
Email: {{ $data['email'] }}<br>

[https://iqhsb.kz]  (https://iqhsb.kz)

С уважением, {{ config('app.name') }}.kz
@endcomponent
