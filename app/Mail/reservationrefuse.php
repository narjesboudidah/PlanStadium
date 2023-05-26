<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class reservationrefuse extends Mailable
{
    use Queueable, SerializesModels;
    public $reservation;

     /**
     * Create a new message instance.
     *
     * @param  \App\reservations  $reservation
     * @return void
     */
    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }
    public function build()
    {
        return $this ->subject('Annulation de réservation')
                     ->view('emails.annulation_reservation')
                     ->with([
                        'reservation' => $this->reservation,
                    ]);
                    
                    
    }
}
