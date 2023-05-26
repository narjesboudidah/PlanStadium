<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class reservationaccepter extends Mailable
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
        return $this ->subject('Confirmation de réservation')
                     ->view('emails.confirmation_reservation')
                     ->with([
                        'reservation' => $this->reservation,
                    ]);
                    
                    
    }
    
}
