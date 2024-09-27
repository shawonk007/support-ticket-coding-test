<x-layouts.email>
<p>Dear {{ $ticket->customer->name }},</p>

<p>Your ticket (Code: {{ $ticket->code }}) has been successfully closed by our support team.</p>

<p>Ticket Details:</p>
<ul>
    <li>Title: {{ $ticket->title }}</li>
    <li>Description: {{ $ticket->description }}</li>
    <li>Status: {{ ucfirst($ticket->status) }}</li>
</ul>

<p>If you have any further questions or require additional support, please feel free to reach out to us.</p>

<p>Thank you for choosing our service!</p>

<p>Best regards,</p>
<p>Your Support Team</p>
</x-layouts>
