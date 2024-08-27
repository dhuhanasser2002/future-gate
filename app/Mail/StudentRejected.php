<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentRejected extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }

    public function build()
    {   /* $user = User::where('is_student', true)->last();
        $name = $user->username; */
        $content = "<h1>Sorry Unfortunately , you are not qualified</h1>
        
        
        <h3>your request rejected</h3>
        <p>The documents you submitted do not meet the requirements for admission, therefore you are not eligible.</p>
        
        <p>Best regards,</p>
        <p>Your Application Team</p>";
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Regected')
                    ->html($content); 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student Rejected',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
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
