<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\HtmlString;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class resetPasswordInstructions extends Mailable
{
    use Queueable, SerializesModels;

    public $actionLink;
    public $user;
    public $time;

    /**
     * Create a new message instance.
     */
    public function __construct(array $data)
    {
        $this->actionLink = $data['action_link'];
        $this->user = $data['user'];
        $this->time = $data['time'];
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $name = ucfirst($this->user->name);
        $subject = 'Password Reset Instruction For - ' . $name . '';

        return new Envelope(
            subject: new HtmlString($subject),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.passwordResetInstructions',
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
