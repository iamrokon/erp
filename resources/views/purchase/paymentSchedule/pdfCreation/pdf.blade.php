<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            font-family: "ipag", "ヒラギノ角ゴ Pro W3", "メイリオ", sans-serif;
            font-size: 12px;
            margin: 0px !important;
            /*padding: 0px !important;*/
            background: #fff;
            line-height: normal !important;
            color: #000000;
        }
        .wrapper-content {
            /*width: 895px;*/
            margin: 0 auto;
            background: white;
            padding: 1.5mm 0 1mm 0!important;
            /*padding: 37.79px 37.79px 37.79px 56.69px;*/
            /*padding: 22mm 25mm;*/
        }

        .clearfix{
            display: inline-block;
            content: "";
            clear: both;
        }

        table{
            border-spacing: 0;
            width: 100%;
        }

        /*.main-table{
          border-top: 1px solid #000;
          border-bottom: 1px solid #000;
          margin-bottom: 3px;
        }*/

        .main-table tr td{
            padding-right: 10px;
        }

        .main-table tr td:last-child{
            padding-right: 0;
        }

        @media print {
            * {
                background: transparent !important;
                box-shadow: none !important;
                text-shadow: none !important;
                margin: 0;
                padding: 0;
                line-height: normal !important;
            }

            body {
                padding: 0;
            }
        }

        @page {
            size: landscape;
            margin: 0;
        }

        @media screen, print{
            @page {
                max-width: 100%;
                max-height:100%;
                position:fixed;
            }
        }
    </style>
</head>
<body>
<div class="wrapper-content">
    <div class="main-table">
        <table style="padding-left: 10mm;padding-right: 12mm;">
            @php
                $no_0f_row=0;
                foreach($data as $key=>$pdfData){
                    if($pdfData->payment_method==''){
                        $no_0f_row=(int)$no_0f_row+1;
                    }
                }

                $page_no=1;
                $count_data=$no_0f_row;

                $currentDateTime=date('Y/m/d').' '.date('H:i:s');
                /*dd($currentDateTime,$no_of_page,$count_data);*/

                //footer calculation starts here
                $paymentDateArr=[];
                foreach ($data as $k=>$d){
                    if ($d->payment_method==''){
                        if ($k==0){
                            array_push($paymentDateArr,$d->payment_date);
                        }
                        else{
                            if (!in_array($d->payment_date,$paymentDateArr)){
                        array_push($paymentDateArr,$d->payment_date);
                        }
                        }
                    }
                }
                /*dd($paymentDateArr);*/
                $data104 = App\AllClass\db\QueryHelperFacade::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'D9' ");
                $paymentMethodIdArr=[];
                $paymentMethodNameArr=[];
                foreach ($data104 as $data104_val){
                    array_push($paymentMethodIdArr,$data104_val->category1 . $data104_val->category2);
                    array_push($paymentMethodNameArr,$data104_val->category2 . ' ' . $data104_val->category4);
                }
                /*$finalBladeFinalPMNameArr=array(array());
                $finalBladeFinalPMArrVal=array(array());*/
                $finalBladeFinalPMNameArr=[];
                $finalBladeFinalPMArrVal=[];
                $countEachPD=[];
                $countPage=null;
                foreach ($paymentDateArr as $k=>$pDate){

                    $paymentSchedules=[];
                    $temp_val=0;
                    $temp_page=1;
                    foreach ($data as $d){
                        if (($d->payment_method=='') && ($d->payment_date==$pDate)){
                            array_push($paymentSchedules,$d);
                            $temp_val++;
                        }
                    }
                    array_push($countEachPD,$temp_val);
                    /*dd($countEachPD);*/
                    //page no calculation start
                    if ($temp_val>8){
                        $no_of_page=intval($temp_val/8);
                        /*dd($no_of_page);*/
                        if ($temp_val%8==0){
                                $no_of_page=$no_of_page;
                            }else{
                                $no_of_page=$no_of_page+1;
                            }
                        $countPage=$countPage+$no_of_page;
                    }
                    else{
                        $countPage=$countPage+$temp_page;
                        $temp_page++;
                    }
                    /*if ($pDate=='2022/01/31'){
                        dd($data,$paymentDateArr,$countPage);
                    }*/
                    /*dd($countPage);*/
                    //page no calculation end

                    $initialPresentPMIdArr=[];
                    $initialPresentPMNameArr=[];
                    $finalPresentPMIdArr=[];
                    $finalPresentPMNameArr=[];
                    $singlePaymentMethodSum=null;
                    $singlePaymentMethodName=null;
                    $bladeFinalPMNameArr=[];
                    $bladeFinalPMArrVal=[];
                    foreach ($paymentSchedules as $paymentSchedule){
                        //dd($fsReqData['rd1']);
                        if ($fsReqData['rd1']=='1'){
                            if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                        }
                        if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                        }
                        if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                        }
                        /*if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                        }
                        if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                        }
                        if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                        }*/
                        }
                        elseif ($fsReqData['rd1']=='2'){
                        /*if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                        }
                        if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                        }
                        if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                        }*/
                        if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                        }
                        if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                        }
                        if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                        }
                        }
                        elseif ($fsReqData['rd1']=='3'){
                            if (!in_array($paymentSchedule->sz0025,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0025);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1);
                        }
                        if (!in_array($paymentSchedule->sz0027,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0027);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2);
                        }
                        if (!in_array($paymentSchedule->sz0029,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0029);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3);
                        }
                        if (!in_array($paymentSchedule->sz0031,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0031);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method1_1);
                        }
                        if (!in_array($paymentSchedule->sz0033,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0033);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method2_1);
                        }
                        if (!in_array($paymentSchedule->sz0035,$initialPresentPMIdArr)){
                            array_push($initialPresentPMIdArr,$paymentSchedule->sz0035);
                            array_push($initialPresentPMNameArr,$paymentSchedule->purchase_payment_method3_1);
                        }
                        }
                    }
                    foreach ($paymentMethodIdArr as $key=>$paymentMethodId){
                        array_push($finalPresentPMIdArr,$paymentMethodId);
                        array_push($finalPresentPMNameArr,$paymentMethodNameArr[$key]);
                    }
                    /*dd($finalPresentPMIdArr,$finalPresentPMNameArr);*/

                    $finalPaymentAmountArr=[];
                    /*dd($finalPresentPMIdArr);*/
                    foreach ($finalPresentPMIdArr as $finalPresentPMId){
                        $iniPaymentAmount=null;
                        /*dd($paymentSchedules);*/
                        foreach ($paymentSchedules as $paymentSchedule){

                            if ($fsReqData['rd1']=='1'){
                                if ($paymentSchedule->sz0025!=null){
                                if ($paymentSchedule->sz0025==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0027!=null){
                                if ($paymentSchedule->sz0027==$finalPresentPMId){
                                    /*dd((int)$paymentSchedule->purchase_payment_amount1_sort);*/
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount2_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0029!=null){
                                if ($paymentSchedule->sz0029==$finalPresentPMId){
                                   $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount3_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            /*if ($paymentSchedule->sz0031!=null){
                                if ($paymentSchedule->sz0031==$finalPresentPMId){
                                 $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount1_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0033!=null){
                                if ($paymentSchedule->sz0033==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount2_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0035!=null){
                                if ($paymentSchedule->sz0035==$finalPresentPMId){
                                 $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount3_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }*/
                            }
                            elseif ($fsReqData['rd1']=='2'){
                                /*if ($paymentSchedule->sz0025!=null){
                                if ($paymentSchedule->sz0025==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0027!=null){
                                if ($paymentSchedule->sz0027==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount2_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0029!=null){
                                if ($paymentSchedule->sz0029==$finalPresentPMId){
                                   $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount3_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }*/
                            if ($paymentSchedule->sz0031!=null){
                                if ($paymentSchedule->sz0031==$finalPresentPMId){
                                 $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount1_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0033!=null){
                                if ($paymentSchedule->sz0033==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount2_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0035!=null){
                                if ($paymentSchedule->sz0035==$finalPresentPMId){
                                 $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount3_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            }
                            elseif ($fsReqData['rd1']=='3'){
                                if ($paymentSchedule->sz0025!=null){
                                if ($paymentSchedule->sz0025==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0027!=null){
                                if ($paymentSchedule->sz0027==$finalPresentPMId){
                                    /*dd((int)$paymentSchedule->purchase_payment_amount1_sort);*/
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount2_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0029!=null){
                                if ($paymentSchedule->sz0029==$finalPresentPMId){
                                   $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount3_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0031!=null){
                                if ($paymentSchedule->sz0031==$finalPresentPMId){
                                 $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount1_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0033!=null){
                                if ($paymentSchedule->sz0033==$finalPresentPMId){
                                    $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount2_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            if ($paymentSchedule->sz0035!=null){
                                if ($paymentSchedule->sz0035==$finalPresentPMId){
                                 $iniPaymentAmount=$iniPaymentAmount+(int)$paymentSchedule->purchase_payment_amount3_1_sort;
                                }
                            }
                            else{
                                $iniPaymentAmount=$iniPaymentAmount+0;
                            }
                            }

                        }
                        $iniPaymentAmountNum= number_format($iniPaymentAmount);
                        array_push($finalPaymentAmountArr,$iniPaymentAmountNum);
                        /*dd($finalPaymentAmountArr);*/
                    }
                    /*dd($finalPaymentAmountArr,$paymentSchedules,$pdfData->payment_date);*/
                    //counting sum
                    $total_sum=null;
                    foreach ($finalPaymentAmountArr as $finalPaymentAmount){
                        $total_sum=(int)$total_sum+(int)str_replace(',','',$finalPaymentAmount);
                    }
                    $final_sum=number_format($total_sum);
                    /*dd($finalPresentPMIdArr,$finalPresentPMNameArr,$final_sum,$finalPaymentAmountArr);*/
                    foreach ($finalPresentPMIdArr as $key=>$finalPresentPMId){
                        if ($key==0){
                            //inserting total row
                            array_push($bladeFinalPMNameArr,'総計');
                            array_push($bladeFinalPMArrVal,$final_sum);

                            //inserting each payment method's sum row
                            array_push($bladeFinalPMNameArr,$finalPresentPMNameArr[$key]);
                            array_push($bladeFinalPMArrVal,$finalPaymentAmountArr[$key]);
                        }
                        else{
                            //inserting each payment method's sum row
                            array_push($bladeFinalPMNameArr,$finalPresentPMNameArr[$key]);
                            array_push($bladeFinalPMArrVal,$finalPaymentAmountArr[$key]);
                        }
                    }
                    /*dd($bladeFinalPMNameArr,$bladeFinalPMArrVal);*/
                    array_push($finalBladeFinalPMNameArr,$bladeFinalPMNameArr);
                    array_push($finalBladeFinalPMArrVal,$bladeFinalPMArrVal);
                }
                $footerCounter=0;
                //footer calculation ends here

                /*dd($paymentDateArr,$finalBladeFinalPMNameArr,$finalBladeFinalPMArrVal,$finalPresentPMIdArr,$countPage);*/
                //same page header and footer
                $current_header=0; $current_footer=0;
                //count each page data
                $tem_data_c=0;
                $pre_tem_data_c=0;
                $prePaymentDate='0000/00/00';
            @endphp
            @foreach($data as $key=>$pdfData)
                @php $currentPaymentDate=$pdfData->payment_date; @endphp

                @if($pdfData->payment_method=='')
                    <!--header starts-->
                    @if(($prePaymentDate!=$currentPaymentDate) || ($tem_data_c%8==0))
                        <!--extar space after 8 data print-->
                        @if(($tem_data_c%8==0) && ($prePaymentDate==$currentPaymentDate))
                                <tr>
                                    <td>
                                        <!-- <br><br><br><br><br><br>
                                        <br><br><br><br><br><br><br> -->
                                        <div style="page-break-before: always;"></div>
                                    </td>
                                </tr>
                            @endif
                    @php $tem_data_c=0; @endphp
                    <tbody>
                    <tr>
                        <td colspan="7" style="padding-top: 3mm;">
                            <div style="font-size: 18px;font-weight: bold;padding-left: 30px;">支払予定一覧</div>
                        </td>
                        <td style="text-align:right;padding-top: 3mm;">PAGE {{$page_no++}}/{{$countPage}}</td>
                        <td style="text-align:right;padding-top: 3mm;">{{$currentDateTime}}</td>
                    </tr>
                    <tr>
                        <td colspan="8" style="text-align:right;border-bottom: 1px solid #000;">締切日&nbsp; {{str_replace('-','/',substr($pdfData->sz0001,0,10))}}</td>
                        <td style="text-align:right;border-bottom: 1px solid #000;">支払日&nbsp; {{$pdfData->payment_date}}</td>
                    </tr>
                    <!--HEADER-->
                    <tr>
                        <td colspan="3" style="text-align:center;vertical-align: middle;">仕入先</td>
                        <td style="text-align:center;vertical-align: middle;">仕入支払方法1</td>
                        <td style="text-align:center;vertical-align: middle;">仕入支払金額1</td>
                        <td style="text-align:center;vertical-align: middle;">仕入支払方法2</td>
                        <td style="text-align:center;vertical-align: middle;">仕入支払金額2</td>
                        <td style="text-align:center;vertical-align: middle;">仕入支払方法3</td>
                        <td style="text-align:center;vertical-align: middle;">仕入支払金額3</td>
                    </tr>
                    <tr>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 12%;">当月残高</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 9%;">*</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 13%;">手形期日</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 10%;">購入支払方法1</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 12%;">購入支払金額1</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 10%;">購入支払方法2</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 12%;">購入支払金額2</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 10%;">購入支払方法3</td>
                        <td style="text-align:center;vertical-align: middle;border-bottom: 1px solid #000;width: 12%;">購入支払金額3</td>
                    </tr>
                    @php @endphp
                    @endif
                    <!--header ends-->
                    <!--body starts-->
                    @if ($fsReqData['rd1']=='1')
                    <tr>
                        <td colspan="3">{{$pdfData->vendor}}</td>
                        <td>{{$pdfData->purchase_payment_method1}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount1}}</td>
                        <td>{{$pdfData->purchase_payment_method2}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount2}}</td>
                        <td>{{$pdfData->purchase_payment_method3}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount3}}</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->current_month_balance}}</td>
                        <td style="padding-bottom: 3px;text-align: center;">{{$pdfData->difference}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->bill_due_date}}</td>
<!--                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method1_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount1_1}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method2_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount2_1}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method3_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount3_1}}</td>-->
                    </tr>
                    @elseif ($fsReqData['rd1']=='2')
                    <tr>
                        <td colspan="3">{{$pdfData->vendor}}</td>
<!--                        <td>{{$pdfData->purchase_payment_method1}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount1}}</td>
                        <td>{{$pdfData->purchase_payment_method2}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount2}}</td>
                        <td>{{$pdfData->purchase_payment_method3}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount3}}</td>-->
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->current_month_balance}}</td>
                        <td style="padding-bottom: 3px;text-align: center;">{{$pdfData->difference}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->bill_due_date}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method1_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount1_1}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method2_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount2_1}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method3_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount3_1}}</td>
                    </tr>
                    @elseif ($fsReqData['rd1']=='3')
                    <tr>
                        <td colspan="3">{{$pdfData->vendor}}</td>
                        <td>{{$pdfData->purchase_payment_method1}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount1}}</td>
                        <td>{{$pdfData->purchase_payment_method2}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount2}}</td>
                        <td>{{$pdfData->purchase_payment_method3}}</td>
                        <td style="text-align: right;">{{$pdfData->purchase_payment_amount3}}</td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->current_month_balance}}</td>
                        <td style="padding-bottom: 3px;text-align: center;">{{$pdfData->difference}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->bill_due_date}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method1_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount1_1}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method2_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount2_1}}</td>
                        <td style="padding-bottom: 3px;">{{$pdfData->purchase_payment_method3_1}}</td>
                        <td style="padding-bottom: 3px;text-align: right;">{{$pdfData->purchase_payment_amount3_1}}</td>
                    </tr>
                    @endif

                    <!--counts data-->
                    @php
                        $tem_data_c++;
                        $getkey = array_search ($pdfData->payment_date, $paymentDateArr);
                    @endphp
                    <!--counts data-->
                    <!--if page data == 8-->
                    @if(($tem_data_c%8==0) || ($countEachPD[$getkey]==$tem_data_c))
                    </tbody>
                    @endif
                    <!--footer starts-->
                    @if($pdfData->payment_date!=$data[$key+1]->payment_date)
                        @php $getkey = array_search ($pdfData->payment_date, $paymentDateArr); $i=0; @endphp
                        <tfoot>
                        @if($tem_data_c==1)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        @elseif($tem_data_c==2)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br>
                                </td>
                            </tr>
                        @elseif($tem_data_c==3)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br>
                                </td>
                            </tr>
                        @elseif($tem_data_c==4)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br>
                                </td>
                            </tr>
                        @elseif($tem_data_c==5)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                    <br><br><br><br>
                                </td>
                            </tr>
                        @elseif($tem_data_c==6)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br><br><br><br><br>
                                </td>
                            </tr>
                        @elseif($tem_data_c==7)
                            <tr>
                                <td colspan="9">
                                    <br><br><br><br><br>
                                    <br>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td rowspan="4" colspan="3" style="border-top: 1px solid #000;">
                                <div style="width: 150px;height: 70px;margin-left: 15px;">
                                    <div style="width: 73px;height: 68px;border: 1px solid #000;float: left;"></div>
                                    <div style="width: 73px;height: 68px;border: 1px solid #000;float: left;margin-left: -1px;"></div>
                                    <div class="clearfix"></div>
                                </div>
                            </td>
                            <td style="border-top: 1px solid #000;">{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="border-top: 1px solid #000;text-align:right;">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td style="border-top: 1px solid #000;">{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="border-top: 1px solid #000;text-align:right;">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td style="border-top: 1px solid #000;">{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="border-top: 1px solid #000;text-align:right;">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                        </tr>
                        <tr>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                        </tr>
                        <tr>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                        </tr>
                        <tr>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                            <td>{{$finalBladeFinalPMNameArr[$getkey][$i]}}</td>
                            <td style="text-align:right">{{$finalBladeFinalPMArrVal[$getkey][$i++]}}</td>
                        </tr>
                        <!--dont take extra space when its last footer-->
                        @if($data[$key+1]->payment_date!=null)<tr>
                            <td colspan="9">
                                <!-- <br><br><br><br> -->
                                <div style="page-break-before: always;"></div>
                            </td>
                        </tr>@endif
                        </tfoot>
                    @endif
                    <!--footer ends-->
                    @php  $prePaymentDate=$pdfData->payment_date; @endphp
                    @endif
                <!--$pdfData->payment_method=='' ends here-->
            @endforeach
            <!-- <div style="page-break-before: always;"></div> -->
        </table>
    </div>
</div>
</body>
</html>
