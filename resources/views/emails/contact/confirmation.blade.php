@component('mail::message')
# We have your message

Hi {{ $data['name'] }},

Thank you for contacting LevelMinds. Our support team has received your request and will respond within two business days. Here’s a quick summary of what you shared:

@component('mail::panel')
@if(!empty($data['subject']))
**Subject:** {{ $data['subject'] }}

@endif
**Message:**

{{ $data['message'] }}

@if(!empty($data['organisation']))
**Organisation:** {{ $data['organisation'] }}

@endif
@if(!empty($data['phone']))
**Phone:** {{ $data['phone'] }}

@endif
@endcomponent

If anything changes or you have more context to add, simply reply to this email or reach us at [support@levelminds.in](mailto:support@levelminds.in).

Warm regards,

**Team LevelMinds**
@endcomponent
