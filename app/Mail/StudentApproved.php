<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StudentApproved extends Mailable
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
        $user = User::where('is_student', true)
        ->orderBy('updated_at', 'desc')
        ->first();;
        $name = $user->username;
        $content = "<h1>Welcome $name to Our Application as a student</h1>
        
        
        <h3>Your Request as IT Student is Approved</h3>
        
        <p>Best regards,</p>
        <p>Your Application Team</p>";
        return $this->from(config('mail.from.address'), config('mail.from.name'))
                    ->subject('Congrates!')
                    ->html($content); 
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Student Approved',
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
