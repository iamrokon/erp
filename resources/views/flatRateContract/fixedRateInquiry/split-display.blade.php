<div class="content-bottom-section">
    <div class="content-bottom-top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="bottom-top-title" style="">
                        分割表示
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <div class="data-wrapper-content" style="width: 100%;">
                        <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                            <div style="padding: 23px;">
                                行
                            </div>
                        </div>
                        <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                            <div style="width: 100%;float: left;">
                                <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0" style="padding: 5px;width: 15%;text-align: center;">
                                    対象月度
                                </div>
                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px;width: 10%;text-align: center;">
                                    売上金額
                                </div>
                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px;width: 10%;text-align: center;">
                                    営業
                                </div>
                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px;width: 15%;text-align: center;">
                                    SE
                                </div>
                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px;width: 10%;text-align: center;">
                                    研究所
                                </div>
                                <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px;width: 10%;text-align: center;">
                                    コール
                                </div>
                                <div class="data-box float-left border border-bottom-0" style="padding: 5px;width: 30%;text-align: left;">
                                    仕入金額
                                </div>
                            </div>
                        </div>
                        <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;text-align: center;">
                            <div style="width: 100%;float: left;">
                                <div class="data-box float-left border" style="padding: 5px;width: 15%;border-right: 0 !important;border-left: 0 !important;text-align: center;">
                                    売上日
                                </div>
                                <div class="data-box float-left border" style="padding: 5px;width: 10%;border-right: 0 !important;text-align: center;">
                                    消費税
                                </div>
                                <div class="data-box float-left border" style="padding: 5px;width: 10%;border-right: 0 !important;text-align: center;">
                                    受注番号
                                </div>
                                <div class="data-box float-left border" style="padding: 5px;width: 7%;border-right: 0 !important;text-align: center;">
                                    受注
                                </div>
                                <div class="data-box float-left border" style="padding: 5px;width: 8%;border-right: 0 !important;text-align: center;">
                                    売上
                                </div>
                                <div class="data-box float-left border" style="padding: 5px;width: 10%;border-right: 0 !important;text-align: center;">
                                    入金
                                </div>
                                <div class="data-box border  border-right-0" style="padding: 5px;float: left;width: 40%;text-align: left;">
                                    明細備考
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-bottom-bottom">
        <div class="container">
            @if(isset($all_soukosukkos))
                @foreach($all_soukosukkos as $soukosukko)
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="data-wrapper-content" style="width: 100%;">
                            <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">
                                <div style="padding: 27px;">
                                    {{$soukosukko->line}} - {{$soukosukko->branch}}
                                </div>
                            </div>
                            <div class="data-box-content2 custom-form text-center orderentry-databox" style="width: 90%;float: left;">
                                <div style="width: 100%;float: left;">
                                    <div class="data-box float-left" style="padding: 5px;width: 15%;">
                                        <input type="text" readonly class="form-control" value="{{mb_convert_kana($soukosukko->target_month,"rnaskc")}}">
                                    </div>
                                    <div class="data-box float-left" style="padding: 10px 0px;width: 9.5%;text-align: right;">
                                        {{number_format($soukosukko->sales_amount)}}
                                    </div>
                                    <div class="data-box float-left vertical-line" style="padding: 10px 0px;width: 10%;text-align: right;">
                                        {{number_format($soukosukko->gross_operating_profit)}}
                                    </div>
                                    <div class="data-box float-left vertical-line " style="padding: 10px 0px;width: 15%;text-align: right;">
                                        {{number_format($soukosukko->se)}}
                                    </div>
                                    <div class="data-box float-left vertical-line" style="padding: 10px 0px;width: 10%;text-align: right;">
                                        {{number_format($soukosukko->laboratory)}}
                                    </div>
                                    <div class="data-box float-left vertical-line" style="padding: 10px 0px;width: 10.1%;text-align: right;">
                                        {{number_format($soukosukko->call_1)}}
                                    </div>
                                    <div class="data-box float-left vertical-line" style="padding: 10px 0px;width: 15%;text-align: right;">
                                        {{number_format($soukosukko->purchase_amount)}}
                                    </div>
                                    <div class="data-box float-left " style="padding: 10px;width: 15.4%;text-align: right;color:#fff;">&nbsp;</div>
                                </div>
                            </div>
                            <div class="data-box-content2 text-center custom-form orderentry-databox" style="width: 90%;float: left;">
                                <div style="width: 100%;float: left;">
                                    <div class="data-box float-left" style="padding: 5px;width: 15%;">
                                        <input type="text" readonly="" class="form-control" value="{{mb_convert_kana($soukosukko->sales_date,"rnaskc")}}">
                                    </div>
                                    <div class="data-box float-left vertical-line-custom" style="padding: 10px 0px;width:9.8%;text-align: right;">
                                        {{number_format($soukosukko->consumption_tax)}}
                                    </div>
                                    <div class="data-box float-left" style="padding: 5px;width: 10.3%;">
                                        <input readonly="" type="text" class="form-control" value="{{$soukosukko->order_number}}">
                                    </div>
                                    <div class="data-box float-left" style="padding: 5px 3px;width: 6.9%;border-right: 0 !important;">
                                        <input readonly="" type="text" class="form-control" placeholder="" value="{{$soukosukko->orders_received}}" style="text-align:center;">
                                    </div>
                                    <div class="data-box float-left" style="padding: 5px 3px;width: 8%;">
                                        <input readonly="" type="text" class="form-control" placeholder="" value="{{$soukosukko->earnings}}" style="text-align:center;">
                                    </div>
                                    <div class="data-box float-left" style="padding: 5px 3px;width: 10%;border-right: 0 !important;">
                                        <input readonly="" type="text" class="form-control" placeholder="" value="{{$soukosukko->payment}}" style="text-align:center;">
                                    </div>
                                    <div class="data-box float-left" style="padding: 5px;width: 40%;border-right: 0 !important;border-left: 0 !important;">
                                        <input type="text" class="form-control" readonly="" value="{{mb_convert_kana($soukosukko->details_remark,"rnaskc")}}" style="width:100%!important;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
