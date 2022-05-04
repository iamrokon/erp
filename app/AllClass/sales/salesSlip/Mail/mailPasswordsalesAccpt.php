<?php

namespace App\AllClass\sales\salesSlip\Mail;

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
    public function __construct($password,$max_uriage_data,$toMial,$ccMail,$zipPack,$fromMail,$housoukubun)
    {
        $this->max_uriage_data = $max_uriage_data;
        $this->password = $password;
        $this->toMial = $toMial;
        $this->ccMail = $ccMail;
        $this->zipPack = $zipPack;
        $this->fromMail = $fromMail;
        $this->housoukubun = $housoukubun;
    }
 
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $max_uriage_data=$this->max_uriage_data;
        $password=$this->password;
        $toMial=$this->toMial;
        $ccMail=$this->ccMail;
        $zipPack=$this->zipPack;
        $fromMail=$this->fromMail;
        $housoukubun=$this->housoukubun;
        

        /*foreach ($ccMail as $key => $value) {
            if (array_key_last()) {
                # code...
            }
            $cc .=$value.',';
        }*/
       if(in_array('2', $housoukubun) && in_array('1', $housoukubun)){
           $this->view('sales.salesSlip.Mail.salesSlipPassword',compact('password','max_uriage_data','housoukubun'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->subject('パスワードをお知らせします　「売上伝票」 「売上伝票兼請求書」送付の件'); 
       }else if(in_array('1', $housoukubun)){
           $this->view('sales.salesSlip.Mail.salesSlipPassword',compact('password','max_uriage_data','housoukubun'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->subject('パスワードをお知らせします「売上伝票兼請求書」送付の件'); 
       }else {
           $this->view('sales.salesSlip.Mail.salesSlipPassword',compact('password','max_uriage_data','housoukubun'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->subject('パスワードをお知らせします「売上伝票」送付の件'); 
       }
            
    }
}