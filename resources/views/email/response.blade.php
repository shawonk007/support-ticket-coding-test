<x-layouts.email>
    <p>Dear {{ $ticket->customer->name }},</p>

    <p>Your ticket (Code: {{ $ticket->code }}) has been reviewed by our support team, and one of our admins has responded or accepted your request.</p>

    <p>Ticket Details:</p>
    <ul>
        <li>Title: {{ $ticket->title }}</li>
        <li>Description: {{ $ticket->description }}</li>
        <li>Status: {{ ucfirst($ticket->status) }}</li>
        <li>Admin Response: {{ $ticket->admin->name }}</li>
    </ul>

    <p>Our team is actively working on your request. If you need any further clarification or additional information, feel free to reach out to us.</p>

    <p>Thank you for your patience!</p>

    <p>Best regards,</p>
    <p>Your Support Team</p>
</x-layouts.email>
