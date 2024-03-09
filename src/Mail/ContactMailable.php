<?php

namespace Tech\Contact\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $message;

    public function __construct($message)
    {
        $this->message = $message;
    }

   

    /**
     * Get the message content definition.
     */
    public function build()
    {
        return $this->markdown('contact::contact.email')
                    ->with('message', $this->message);
    }

   
}
