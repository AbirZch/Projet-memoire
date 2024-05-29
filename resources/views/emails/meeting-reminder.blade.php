@component('mail::message')
# Meeting Reminder

Dear {{ $attendeeName }},

This is a reminder that you have a meeting scheduled with {{ $meetingOrganizer }} on {{ $meetingDate }} at {{ $meetingTime }}.

Please confirm your attendance by replying to this email or clicking the link below:

{{-- @component('mail::button', ['url' => $confirmationLink])
Confirm Attendance
@endcomponent --}}

If you have any questions or need to reschedule, please contact {{ $meetingOrganizer }} directly.

Thank you,

{{ config('app.name') }}
@endcomponent