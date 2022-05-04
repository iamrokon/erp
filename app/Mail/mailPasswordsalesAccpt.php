<?php

namespace App\Mail;

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
    public function __construct($password,$kokyaku,$haisou,$etsuransya,$toMial,$ccMail,$zipPack,$fromMail)
    {
        $this->kokyaku = $kokyaku;
        $this->password = $password;
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
        $password=$this->password;
        $etsuransya=$this->etsuransya;
        $toMial=$this->toMial;
        $ccMail=$this->ccMail;
        $zipPack=$this->zipPack;
        $fromMail=$this->fromMail;
        

        /*foreach ($ccMail as $key => $value) {
            if (array_key_last()) {
                # code...
            }
            $cc .=$value.',';
        }*/

        return $this->view('Mail.salesAcceptancePswd',compact('kokyaku','haisou','etsuransya','password'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->subject('パスワードをお知らせします　「検収確認書」送付の件');         
    }
}
