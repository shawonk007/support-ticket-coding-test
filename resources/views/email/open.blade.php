<x-layouts.email>
<p>Dear Admin,</p>

<p>A new ticket has been opened by {{ $ticket->customer->name }}.</p>

<p>Ticket Details:</p>
<ul>
    <li>Title: {{ $ticket->title }}</li>
    <li>Description: {{ $ticket->description }}</li>
    <li>Status: {{ $ticket->status }}</li>
    <li>Ticket Code: {{ $ticket->code }}</li>
</ul>

<p>Thank you,</p>
<p>Your Support Team</p>
</x-layouts.email>
