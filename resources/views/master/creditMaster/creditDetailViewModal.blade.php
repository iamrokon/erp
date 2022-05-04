<!-- ============================= moda1 1 start here ========================-->

<div class="modal"  id="credit_modal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="exampleModalLabel">売上請求先別与信管理マスタ　　(詳細)</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="development_page_top_table heading_mt" style="margin:11px;">

                    <!--======================= button start ======================-->

                    <div class="row titlebr" style="margin-bottom: 15px;">

                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                            <table class="dev_tble_button" style="float: right;">
                                <tbody>
                                <tr class="marge_in">
                                    <td class="" style="padding-right: 5px!important;">
                                        <a class="btn btn-info scroll" id="deleteThis" style="background-color: #3e6ec1!important;" data-toggle="modal" data-target="#" onclick="deleteCreditMaster('{{route('clearCreditSetting',[$bango])}}')"><i class="fa fa-trash" style="margin-right: 7px;"></i>削除</a>
                                    </td>
                                    <td class="">
                                        <a class="btn btn-info scroll" href="#" id="creditButton3" data-toggle="modal" data-target="#credit_modal3" style="width: 100%;">変更画面へ</a>
                                    </td>
                                    {{-- <td class="">
                                        <a class="btn btn-info scroll" href="#" id="btnPrint" style=""><i class="fa fa-print" aria-hidden="true" style="margin-right: 5px;"></i>印刷</a>
                                    </td> --}}
                                </tr>
                                </tbody>
                            </table>

                        </div>

                    </div>

                    <!--======================= button  end ======================-->
                </div>
                <!--======================= modal 1 table start here ======================-->


                <div class="row mt-1 mb-3">

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
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div id="creditDetailBango"></div>
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
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <div id="creditDetailKounyusu"></div>


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

                                                <div id="creditDetailDenpyostart"></div>


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
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <div id="creditDetailSyukei1"></div>


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
                                            <div class="col-lg-12 col-md-12 col-sm-12">

                                                <div id="creditDetailSyukei2"></div>


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
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <div id="creditDetailSyukei3"></div>


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

                                                <div id="creditDetailSyukei4"></div>


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
                                            <div class="col-lg-12 col-md-12 col-sm-12 ">

                                                <div id="creditDetailSyukei5"></div>


                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!--======================= modal 1 table end here ======================-->
            </div>



        </div>
    </div>
</div>
<!-- ============================moda1 1 finish here ======================= -->
