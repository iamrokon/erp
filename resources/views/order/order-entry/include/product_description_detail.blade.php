<div class="modal" data-keyboard="false" data-backdrop="static" id="detailsModal" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" data-bind="nextFieldOnEnter:true">
                    <div class="development_page_top_table heading_mt" style="margin:11px;">
                        <div class="row titlebr" style="margin-bottom: 15px;">
                            <div class="col-lg-6 pl-1" style="padding-top: 9px;">
                                <h5 class="">商品説明マスタ(詳細)</h5>
                            </div>
                            <div class="col-lg-6 pr-1" style="">
                                <table class="dev_tble_button" style="float: right;">
                                    <tbody>
                                    <tr class="marge_in"></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-1 mb-3">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="tbl_name">
                                <div class="w-100">
                                    <div class=" row row_data">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="margin_t "><span>商品説明CD区分</span></div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9">
                                            <div class="outer row">
                                                <div class="col-lg-3 col-md-3 col-sm-3 ">
                                                    <div class="m_t" id="url" style="font-size:12px;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class=" row row_data">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <div class="margin_t ">
                                                <span>商品説明CD </span> <span style="color: red;">※</span> </div>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-9">
                                            <div class="outer row">
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <div style="position:relative;">
                                                        <div class="m_t" id="urlsm" style="white-space: normal; word-break: break-all;"></div>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-lg-8 col-md-8 col-sm-8 ">
                                                    <div class="m_t">Autoメール名人 導入先支援運用打合せ</div>
                                                  </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>見積明細備考</span> </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div class="m_t" id="mbcatch"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>サービス内容</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div class="m_t" id="setumei" style="white-space: pre-wrap; word-break: break-all !important;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>工数目安</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="m_t" style="white-space: pre-wrap; word-break: break-all;" id="catch"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>成果物</span> </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div class="m_t" id="caption" style="white-space: pre-wrap; word-break: break-all;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>社内備考</span> </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-3 col-sm-3 ">
                                                <div class="m_t" id="catchsm" style="white-space: pre-wrap; word-break: break-all;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>販売時留意点</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div class="m_t" id="mbcatchsm" style="white-space: normal; word-break: break-all;"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>商品説明PDF</span> </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div style="position:relative;">
                                                    <div class="m_t" id="mbcaption"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>補足説明</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">
                                                <div class="m_t" id="supplementary_explanation"
                                                     style="white-space: normal;word-break: break-all;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t "><span>入力区分</span> <span style="color: red;">※</span></div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">
                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div id="datatxt0096" class="m_t"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

