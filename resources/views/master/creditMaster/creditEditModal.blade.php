<style>
    .error {
        border: 1px solid red !important;
    }
</style>
<form id="editCreditForm" action="{{ route('creditMaster') }}" method="post" >
    <input type="hidden" name="type" value="edit">
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input type="hidden" id="hiddenBango" name="bango" value="">
<!--======================= modal 1 table start here ======================-->
<div class="modal"  id="credit_modal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;z-index: 1055;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">売上請求先別与信管理マスタ (変更)</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="development_page_top_table heading_mt" style="margin:11px;">
                    <div class="col-lg-6">
                        <div id="error_dataEdit">

                        </div>
                    </div>
                    <div class="row mt-1 mb-3"></div>
                    <!--======================= button start ======================-->

                    <div class="row titlebr" style="margin-bottom: 15px;">
                        <div class="col-lg-12">
                            <table class="dev_tble_button" style="float: right;margin-right: -18px; margin-bottom: 15px;">
                                <tbody>
                                <tr>
                                    <td class="" style="padding-left: 0px!important;width: 100px!important;border:none!important;">
                                        新規(処理状況)</td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>

                    <!--======================= button  end ======================-->
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="tbl_name">
                        <div class="w-100">

                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>会社CD</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12  col-md-12 col-sm-12">

                                                <div id="editCreditBango"></div>
                                                <input type="hidden" class="form-control" name="editCreditBango1" id="editCreditBango1">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>年月</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 ">

                                                <input type="text" class="form-control" name="editCreditKounyusu" id="editCreditKounyusu">


                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>与信限度額</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <div id="editCreditDenpyostart"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>前月与信残高金額</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <div id="editCreditSyukei1"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>当月受注金額</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <div id="editCreditSyukei2"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>当月売上金額</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <div id="editCreditSyukei3"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>当月入金金額</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <input type="text" class="form-control" name="editCreditSyukei4" id="editCreditSyukei4">


                                            </div>

                                        </div>

                                    </div>

                                </div>
                                <div class=" row row_data">
                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                        <div class="margin_t ">
                                            <span>当月与信残高金額</span>    </div>


                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9">

                                        <div class="outer row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <div id="editCreditSyukei5"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">

                <a id="editButton" type="button" class="btn btn-info scroll" onclick="editCredit5('{{route("creditMaster",[$bango])}}');" style="float: right;"><i class="fa fa-save" aria-hidden="true" style="margin-right: 5px;"></i>保存</a>
                <a class="btn btn-info scroll" href="#" id="btnPrintEdit" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
            </div>
        </div>
    </div>
</div>
</form>
