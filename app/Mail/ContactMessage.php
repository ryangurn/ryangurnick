<?php

namespace App\Mail;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use Queueable, SerializesModels;

    public $from_addr;

    public $subject;

    public $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Email $email)
    {
        $this->from_addr = Setting::where('key', '=', 'contact.from')->first()->value;
        $this->subject = Setting::where('key', '=', 'contact.subject')->first()->value;
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->from_addr)
            ->subject($this->subject)
            ->text('mail.contact-message-text')
            ->view('mail.contact-message');
    }
}
