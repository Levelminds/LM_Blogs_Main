@component('mail::message')
# Thank you for applying

Hi {{ $data['fullname'] }},

We have received your application for the LevelMinds campus ambassador program. Our team reviews submissions weekly and will get in touch with next steps soon. Here is a snapshot of the details we captured:

@component('mail::panel')
**Email:** {{ $data['email'] }}

@if(!empty($data['phone']))
**Phone / WhatsApp:** {{ $data['phone'] }}

@endif
**College / University:** {{ $data['college'] }}

@if(!empty($data['linkedin']))
**LinkedIn:** {{ $data['linkedin'] }}

@endif
@if(!empty($data['plan']))
**Plan / Experience:**

{{ $data['plan'] }}

@endif
@endcomponent

If you have additional details to share, reply to this email or contact us at [support@levelminds.in](mailto:support@levelminds.in).

Warm regards,

**Team LevelMinds**
@endcomponent
