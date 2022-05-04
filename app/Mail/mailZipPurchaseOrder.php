<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Auth;
use DB;
class mailZipPurchaseOrder extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ccMail,$vendorName,$address,$departmentName,$departmentNameFlag,$vendorPersonalName,$orderNumber,$toMial,$zipPack,$fromMail)
    {
//        dd('dsd');
        $this->ccMail = $ccMail;
        $this->vendorName = $vendorName;
        $this->address = $address;
        $this->departmentName = $departmentName;
        $this->departmentNameFlag = $departmentNameFlag;
        $this->vendorPersonalName = $vendorPersonalName;
        $this->orderNumber = $orderNumber;
        $this->toMial = $toMial;
        $this->zipPack = $zipPack;
        $this->fromMail = $fromMail;
//        dd('dsd');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        dd('sd');
        $ccMail=$this->ccMail;
        $vendorName=$this->vendorName;
        $address=$this->address;
        $departmentName=$this->departmentName;
        $departmentNameFlag=$this->departmentNameFlag;
        $vendorPersonalName=$this->vendorPersonalName;
        $orderNumber=$this->orderNumber;
        $toMial=$this->toMial;
        $zipPack=$this->zipPack;
        $fromMail=$this->fromMail;

//dd('hlw');
        return $this->view('purchase.purchaseOrder.Mail.purchaseOrder',compact('vendorName','address','departmentName','departmentNameFlag','vendorPersonalName','orderNumber'))->to($toMial)->from($fromMail,'ユーザックシステム（SYS）')->cc($ccMail)->attach($zipPack)->subject('「発注書」送付の件');

    }
}
