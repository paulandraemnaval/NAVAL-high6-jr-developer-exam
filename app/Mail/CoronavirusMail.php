<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Patient;

class CoronavirusMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(private Patient $patient)
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Coronavirus Positive Notification',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.coronavirus_mail',
            with: [
                'patient' => $this->patient,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
