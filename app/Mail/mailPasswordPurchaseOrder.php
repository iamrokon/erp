<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use DB;
class mailPasswordPurchaseOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password,$passDate,$toMial,$ccMail,$zipPack,$fromMail)
    {
        $this->password = $password;
        $this->passDate = $passDate;
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
        $password=$this->password;
        $passDate=$this->passDate;
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
//        dd('hlw');
        return $this->view('purchase.purchaseOrder.Mail.purchaseOrderPassword',compact('password','passDate'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->subject('[パスワードをお知らせします] 「発注書」送付の件');
    }
}
