<x-mail::message>
# New Contact Submission

You have received a new message from your portfolio contact form.

**Name:** {{ $submission->name }}<br>
**Email:** {{ $submission->email }}<br>
**Message:**
<div style="background-color: #f3f4f6; padding: 10px; border-radius: 5px;">
{{ $submission->message }}
</div>

@if(!empty($submission->payload))
## Additional Details
@foreach($submission->payload as $key => $value)
**{{ ucfirst(str_replace('_', ' ', $key)) }}:** {{ $value }}<br>
@endforeach
@endif

---

**IP Address:** {{ $submission->ip_address }}<br>
**User Agent:** {{ $submission->user_agent }}

<x-mail::button :url="route('admin.contact-submissions.show', $submission)">
View in Admin Panel
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
