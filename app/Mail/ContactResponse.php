<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The response message from the admin.
     *
     * @var string
     */
    public $response;
    public $name; // Thêm thuộc tính customerName
    /**
     * Create a new message instance.
     *
     * @param  string  $response
     * @return void
     */
    public function __construct($response,$name)
    {
        $this->response = $response;
        $this->name = $name; // Gán tên của khách hàng
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Contact Response')
            ->view('emails.contact_response');
    }
}
