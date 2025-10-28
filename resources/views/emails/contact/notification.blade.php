@component('mail::message')
# New contact enquiry received

You have received a new contact enquiry from **{{ $data['name'] }}**. Reply directly to the sender or reach out using the details below.

@component('mail::panel')
**Email:** {{ $data['email'] }}

@if(!empty($data['phone']))
**Phone:** {{ $data['phone'] }}

@endif
@if(!empty($data['organisation']))
**Organisation:** {{ $data['organisation'] }}

@endif
@if(!empty($data['subject']))
**Subject:** {{ $data['subject'] }}

@endif
**Message:**

{{ $data['message'] }}
@endcomponent

Please follow up within two business days to keep our support SLA on track.

@endcomponent
