<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvestorWelcomeMail extends Mailable
{
    public $name;
    public $email;
    public $password;
    public $loginUrl;

    public function __construct($name, $email, $password, $loginUrl)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->loginUrl = $loginUrl;
    }

    public function build()
    {
        return $this->subject('Your Investor Portal Login Details')
            ->view('investors.login');
    }
}