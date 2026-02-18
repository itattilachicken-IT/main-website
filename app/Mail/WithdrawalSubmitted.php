<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\WithdrawalRequest;
use App\Mail\WithdrawalSubmitted;
use Mail;
use PDF;


class WithdrawalSubmitted extends Mailable
{
    use Queueable, SerializesModels;

    public $withdrawal;
    public $pdf;

    /**
     * Create a new message instance.
     */
    public function __construct(WithdrawalRequest $withdrawal, $pdf)
    {
        $this->withdrawal = $withdrawal;
        $this->pdf = $pdf;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Your Withdrawal Request')
                    ->view('emails.withdrawal_submitted')
                    ->attachData($this->pdf->output(), 'withdrawal_request_'.$this->withdrawal->id.'.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}

