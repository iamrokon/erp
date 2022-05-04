<?php

namespace App\AllClass\sales\invoiceDeadline\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use DB;

class mailPasswordsalesAccpt extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$toMial,$ccMail,$zipPack,$fromMail)
    {
        $this->data = $data;
        $this->toMial = $toMial;
        $this->ccMail = $ccMail;
        $this->zipPack = $zipPack;
        $this->fromMail = $fromMail;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data=$this->data;
        $toMial=$this->toMial;
        $ccMail=$this->ccMail;
        $zipPack=$this->zipPack;
        $fromMail=$this->fromMail;
        
        $this->view('sales.invoiceDeadline.Mail.invoiceDeadlinePassword',compact('data'))->to($toMial)->from($fromMail,'Usk')->cc($ccMail)->subject('パスワードをお知らせします 「請求書」送付の件'); 
       
            
    }
}
