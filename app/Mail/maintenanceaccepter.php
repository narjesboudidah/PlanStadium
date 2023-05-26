<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class maintenanceaccepter extends Mailable
{
    use Queueable, SerializesModels;
    public $maintenance;

     /**
     * Create a new message instance.
     *
     * @param  \App\maintenances  $maintenance
     * @return void
     */
    public function __construct($maintenance)
    {
        $this->maintenance = $maintenance;
    }
    public function build()
    {
        return $this ->subject('Confirmation de maintenance')
                     ->view('emails.confirmation_maintenance')
                     ->with([
                        'maintenance' => $this->maintenance,
                    ]);
                    
                    
    }
}
