<?php

// app/Mail/OtpMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    /**
     * Create a new message instance.
     *
     * @param string $otp
     * @return void
     */
    public function __construct($lead_details)
    {
        $this->lead_details = $lead_details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
   
    
    public function build()
        {
            return $this->view('emails.lead_details') // specify the view for the email
                ->subject('Loan Request') // set the email subject
                ->with('lead_details', $this->lead_details) // pass data to the view
                ->from($this->lead_details['email'], 'Loanswala') // Updated name
                ->to('kspsmartindia@gmail.com', 'Loanswala'); // Updated recipient
        }

}
