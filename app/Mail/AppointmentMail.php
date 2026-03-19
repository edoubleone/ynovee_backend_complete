<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $appointment;

    /**
     * Create a new message instance.
     */
    public function __construct($appointment)
    {
        $this->appointment = $appointment;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('New Appointment Booking')
                    ->view('emails.appointment')
                    ->with([
                        'first_name' => $this->appointment->first_name,
                        'last_name' => $this->appointment->last_name,
                        'email' => $this->appointment->email,
                        'phone' => $this->appointment->phone,
                        'appointment_date' => $this->appointment->appointment_date,
                        'appointment_time' => $this->appointment->appointment_time,
                    ]);
    }
}
