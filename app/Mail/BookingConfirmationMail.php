<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Booking;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Konfirmasi Booking - ' . ($this->booking->room->roomType->name ?? 'Hotel'),
        );
    }

    public function content()
    {
        return new Content(
            view: 'emails.booking-confirmation',
        );
    }

    public function attachments()
    {
        return [];
    }
}