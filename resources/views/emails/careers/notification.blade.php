@component('mail::message')
# New campus ambassador application received

A new campus ambassador application has been submitted. Please acknowledge the applicant within two business days.

@component('mail::panel')
**Name:** {{ $data['fullname'] }}

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

Log the outreach in the CRM once a follow-up has been scheduled.
@endcomponent
