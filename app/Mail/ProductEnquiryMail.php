<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\ProductEnquiry;
use Illuminate\Support\Facades\Storage;

class ProductEnquiryMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The ProductEnquiry instance.
     *
     * @var \App\Models\ProductEnquiry
     */
    public $enquiry;

    /**
     * Create a new message instance.
     */
    public function __construct(ProductEnquiry $enquiry)
    {
        $this->enquiry = $enquiry;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Product Enquiry Mail From Forbsign',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.product_enquiry',  // Use the correct view name
            with: [
                'enquiry' => $this->enquiry, // Pass data to the view
            ]
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
