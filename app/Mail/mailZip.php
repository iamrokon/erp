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
    public function __construct($tuhanorder,$tantousya,$misyukko,$kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail)
    {
        $this->kokyaku = $kokyaku;
        $this->tuhanorder = $tuhanorder;
        $this->tantousya = $tantousya;
        $this->haisou = $haisou;
        $this->etsuransya = $etsuransya;
        $this->toMial = $toMial;
        $this->ccMail = $ccMail;
        $this->zipPack = $zipPack;
        $this->fromMail = $fromMail;
        $this->misyukko = $misyukko;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $tuhanorder=$this->tuhanorder;
        $tantousya=$this->tantousya;
        $kokyaku=$this->kokyaku;
        $haisou=$this->haisou;
        $etsuransya=$this->etsuransya;
        $toMial=$this->toMial;
        $ccMail=$this->ccMail;
        $zipPack=$this->zipPack;
        $fromMail=$this->fromMail;
        $misyukko=$this->misyukko;
        

        return $this->view('Mail.salesAcceptance',compact('kokyaku','haisou','etsuransya','tantousya','tuhanorder','misyukko'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->attach($zipPack)->subject('「検収確認書」送付の件');   
      
    }
}
