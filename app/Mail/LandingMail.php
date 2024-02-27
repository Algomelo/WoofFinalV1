<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LandingMail extends Mailable
{
    use Queueable, SerializesModels;

    public $service;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($service, $data)
    {
        $this->service = $service;
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
      /*public function build()
    {
        $subject = 'Se ha generado contacto por medio de landing' . $this->service;

        return $this->subject($subject)
            ->view('emails.landingcorreo');
    }
    */
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Se ha generado contacto por medio de Landing Page'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.appointment',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
