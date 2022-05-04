<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use DB;

class mailZip extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail)
    {
        $this->kokyaku = $kokyaku;
        $this->haisou = $haisou;
        $this->etsuransya = $etsuransya;
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
        $kokyaku=$this->kokyaku;
        $haisou=$this->haisou;
        $etsuransya=$this->etsuransya;
        $toMial=$this->toMial;
        $ccMail=$this->ccMail;
        $zipPack=$this->zipPack;
        $fromMail=$this->fromMail;

        
dd($kokyaku);
        $this->view('mail',compact('kokyaku','haisou','etsuransya'))->to($toMial)->from($fromMail,'Usk')->cc($ccMail)->attach($zipPack)->subject('usk san kara');          
    }
}
