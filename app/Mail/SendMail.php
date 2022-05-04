<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email_subject,$toMail,$fromMail,$sender_name,$html,$bcc_name = null,$bccMail = [])
    {
        $this->email_subject = $email_subject;
        $this->toMail = $toMail;
        $this->fromMail = $fromMail;
        $this->sender_name = $sender_name;
        $this->html = $html;
        $this->bcc_name = $bcc_name;
        $this->bccMail = $bccMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email_subject = $this->email_subject;
        $toMail = $this->toMail;
        $fromMail = $this->fromMail;
        $sender_name = $this->sender_name;
        $html = $this->html;
        $bcc_name = $this->bcc_name;
        $bccMail = $this->bccMail;
        
        Mail::raw($html, function ($message) use($toMail,$sender_name,$fromMail,$bcc_name,$bccMail,$email_subject) {
          $message->to($toMail)->from($fromMail,$sender_name)->subject($email_subject)->bcc($bccMail,$bcc_name);
        });
    }
}
