<!-- preloader start here -->
<div class="preloader">
    <div class="loading" style="display:none"></div>
</div>
<!-- preloader end here -->
<div class="content-head-section1">
    <div class="container" style="position: relative;">

        {{-- Success Message Starts Here --}}
        <div class="row success-msg-box" id="msg_div" style="position: relative; width: 100%; max-width: 1452px; z-index: 1;">
            <div class="col-12 pl-0 pr-0 ml-3">
                <div class="alert alert-primary alert-dismissable sucmsg" id="sucmsg" style="display: none; width: 100%;">
                    <button type="button" class="close dismissAlertMessage" style="position: absolute; top: 2px; right: 2px; background: white; padding: 8px 15px; box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); outline: 0;" autofocus>&times;</button>
                    <strong class="main_msg" id="main_msg"></strong>
                </div>
            </div>
        </div>
        {{-- Success Message Ends Here --}}

        <script>
            $(".dismissAlertMessage").click(function (){
                    $('#sucmsg').hide();
                    $('#categorykanri').focus();
                });
                $(".dismissAlertMessage").keydown(function (e){
                    if (e.shiftKey && e.which == 13) {
                        $('#sucmsg').hide();
                        $('#categorykanri').focus();
                        e.preventDefault();
                        $('#categorykanri').click();
                    }
                });
        </script>

        {{-- Error Message Starts Here --}}
        <div class="row">
            <div class="col-12">
                <div id="error_message" class="common_error"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="error_data" class="common_error"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div id="hikiate_flag" class="common_error"></div>
            </div>
        </div>
        {{-- Error Message Ends Here --}}



        <div class="row inner-top-content">

            <div class="col-12">
                <form method="POST" id='searchForm'>
                    @csrf
                    <input type="hidden" name="bango" id='userId' value="{{$tantousya->bango}}">
                    <input id='page_name' value='billingDeadline' type='hidden'/>
                    <div class="row " style="padding-top: 0px;">
                        <div class="col-4">
                            <table class="table custom-form"
                                style="border: none!important;width: auto;margin-bottom:4px !important;">
                                <tbody>
                                    <tr>
                                        <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                            <div class="line-icon-box"></div>
                                        </td>
                                        <td style=" border: none!important;width: 88px!important;">締め日</td>
                                        <td style=" border: none!important;width: 178px;">
                                            <div class="custom-arrow">
                                                <select class="form-control" name="categorykanri" id="categorykanri"
                                                    autofocus="">
                                                    <option value="">-</option>
                                                    @foreach($categorykanri as $val)
                                                    <option value="{{$val->category1.$val->category2}}">
                                                        {{substr($val->category2,-2,2).' '.$val->category4}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="ml-3 mr-3">
                            <table class="table custom-form" style="margin-bottom:4px !important; width: auto; min-width: 1222px;">
                                <tbody>
                                    <tr>
                                        <td
                                            style="width: 23px!important;border:0!important;padding-left: 0px !important;">
                                            <div class="line-icon-box" style="background: #353A81;"></div>
                                        </td>
                                        <td
                                            style="width: 86px!important;border: none!important;text-align: left;color: black;">
                                            売上請求先
                                        </td>
                                        <td style=" border: none!important;">
                                            <div style="width: 100%;">
                                                <div class="input-group input-group-sm">
                                                    <input type="text" tabindex="0" id="billingDeadlineSupplier"
                                                        name="billingDeadlineSupplier" readonly="" class="form-control custom_modal_input"
                                                        placeholder="売上請求先" style="padding: 0!important;" value="売上請求先">
                                                    <input type="hidden" id="billingDeadlineSupplier_db"
                                                        name="billingDeadlineSupplier_db" value="">
                                                    <div class="input-group-append">
                                                        <a class="input-group-text btn" tabindex="0"
                                                            onclick="supplierSelectionModalOpener_2('billingDeadlineSupplier','billingDeadlineSupplier_db','1','nullable','r16cd',event.preventDefault())"
                                                            style="cursor: pointer;"><i class="fas fa-arrow-left"
                                                                style="color: #fff"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 30px!important;border:0!important;text-align: center;">
                                            ～
                                        </td>
                                        <td style=" border: none!important;">
                                            <div style="width: 100%;">
                                                <div class="input-group input-group-sm">

                                                    <input type="text" tabindex="0" id="billingDeadlineSupplier1"
                                                        name="billingDeadlineSupplier1" readonly="" class="form-control custom_modal_input"
                                                        placeholder="売上請求先" style="padding: 0!important;"
                                                        value="{{isset($fsReqData['billingDeadlineSupplier1'])? $fsReqData['billingDeadlineSupplier1'] : "売上請求先"}}">
                                                    <input type="hidden" id="billingDeadlineSupplier1_db"
                                                        name="billingDeadlineSupplier1_db"
                                                        value="{{isset($fsReqData['billingDeadlineSupplier1_db'])? $fsReqData['billingDeadlineSupplier1_db'] : null}}">
                                                    <div class="input-group-append">
                                                        <a class="input-group-text btn" tabindex="0"
                                                            onclick="supplierSelectionModalOpener_2('billingDeadlineSupplier1','billingDeadlineSupplier1_db','1','nullable','r16cd',event.preventDefault())"
                                                            style="cursor: pointer;"><i class="fas fa-arrow-left"
                                                                style="color: #fff"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                                <tbody>
                                    <tr>
                                        <td
                                            style="padding-left: 0px !important;border: none!important;text-align: left;color: black;width: 112px !important;">
                                            <div class="line-icon-box float-left mr-3"></div>
                                            請求範囲
                                        </td>
                                        <td style="border: none!important;width: 151px;">
                                            <div class="input-group">
                                                <input id="1st_date" readonly
                                                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                    maxlength="8" name="date" autocomplete="off" type="text"
                                                    class="form-control input_field" value="" placeholder="年/月/日"
                                                    style="width: 96px!important;">
                                                <input type="hidden" class="datePickerHidden">
                                            </div>
                                        </td>
                                        <td style="border: none!important;width: 38px!important;text-align: center;">～
                                        </td>
                                        <td style="border: none!important;width: 151px;">

                                            <div class="input-group">
                                                <input id="datepicker2_oen"
                                                    oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                    onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                    maxlength="8" name="date" autocomplete="off" type="text"
                                                    class="form-control input_field" value="" placeholder="年/月/日"
                                                    style="width: 96px!important;">
                                                <input type="hidden" class="datePickerHidden">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <table class="table" style="width: auto;margin-bottom: 0px!important;float: right;">
                                <tbody>
                                    <tr>
                                        <td style=" border: none!important;padding: 0px!important;"><a type="button"
                                            id="customprogress" onclick="searchOrder()" href="#"
                                                class="btn btn-info uskc-button">実 行
                                            </a>
                                        </td>
                                        <td style="border: none !important;">
                                            <div class="progress" style="width: 348px; float: right;position: absolute;right: 15px;bottom: -21px;display: none;">
                                                <div id="progress-bar" class="progress-bar progress-bar-striped bg-primary" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                              </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- container-fluid div end -->
</div>
<style>
    /* CSS Loader */
    .preloader {
        position: absolute;
        left: 0;
        right: 0;
        text-align: center;
        margin: 0 auto;
        z-index: 9999;
    }

    .loading {
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        background-color: #fff;
    }

    .loading:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: #000;
        opacity: .5;

    }

    .disable {
        pointer-events: none;
        cursor: default;
    }

    .loading:not(:required) {

        font: 0/0 a;
        color: transparent;
        text-shadow: none;
        background-color: transparent;
        border: 0;
    }

    .loading:not(:required):after {
        content: '';
        display: block;
        font-size: 10px;
        width: 5.0em;
        height: 5.0em;
        margin-top: -0.5em;
        -webkit-animation: spinner 1500ms infinite linear;
        -moz-animation: spinner 1500ms infinite linear;
        -ms-animation: spinner 1500ms infinite linear;
        -o-animation: spinner 1500ms infinite linear;
        animation: spinner 1500ms infinite linear;
        border-left: 4px solid rgba(237, 237, 237, 0.7);
        border-right: 4px solid rgba(237, 237, 237, 0.7);
        border-bottom: 4px solid rgba(237, 237, 237, 0.7);
        border-top: 4px solid #408eee;
        border-radius: 100%;
    }


    @-webkit-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-moz-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @-o-keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    @keyframes spinner {
        0% {
            -webkit-transform: rotate(0deg);
            -moz-transform: rotate(0deg);
            -ms-transform: rotate(0deg);
            -o-transform: rotate(0deg);
            transform: rotate(0deg);
        }

        100% {
            -webkit-transform: rotate(360deg);
            -moz-transform: rotate(360deg);
            -ms-transform: rotate(360deg);
            -o-transform: rotate(360deg);
            transform: rotate(360deg);
        }
    }

    .loading.show {
        display: block !important;
    }

    .uskc-button {
        width: 150px !important;
        height: 30px;
        line-height: 30px;
    }

    .table {
        margin-bottom: 12px !important;
    }
</style>