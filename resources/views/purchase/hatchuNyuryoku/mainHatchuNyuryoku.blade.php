@section('title', '発注入力')
@section('menu-test1', 'ホーム >')
@section('menu-test3', '発注 >')
@section('menu-test5', '発注入力')
@section('tag-test', 'ここには、ガイドの文章が入ります。')
@section('alert-message', 'You have click one time.')

<!DOCTYPE html>
<html lang="ja">
    <head>
        {{-- Including Common Header Starts Here --}}
        @include('layouts.header')
        {{-- Including Common Header Ends Here--}}

        {{-- Including CSS Style  Starts Here --}}
        @include('purchase.hatchuNyuryoku.styles')
        {{-- Including CSS Style  Ends Here --}}
    </head>
    <body class="common-nav" style="overflow-x:visible;">
        <!-- preloader start here -->
        <div class="preloader">
            <div class="loading" style="display: none"></div>
        </div>
        <!-- preloader end here -->
        <section>
            {{-- Navbar Starts Here --}}
            @include('layout.nav_fixed')
            {{-- Navbar Ends Here --}}
            @include('layout.custom_checkbox')

            <form id="insertData" enctype="multipart/form-data">
            <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
                <input type="hidden" id="formSubmitButton" name="type" />
                <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
                <input type="hidden" name="bango" id="userId" value="{{ $bango }}">
                <input type="hidden" id="confirm_status" name="confirm_status" value="0">
                <input type="hidden" name="datachar08" id="datachar08">
                <input type="hidden" name="date0016" id="date0016">
                <input type="hidden" name="datatxt0150" id="datatxt0150">
                <input type="hidden" name="intOrder01" id="intOrder01">
                <input type="hidden" name="order_user_bango" id="order_user_bango">
                <input id='page_name' value='orderEntry' type='hidden' />
                <input id='_hikitasukko_val' type='hidden' />
                <!-- ============================= Top Search start here ===================== -->
                @include('purchase.hatchuNyuryoku.hatchuNyuryokuTopSearch')
                <!-- ============================= Top Search end here ======================= -->
                <!-- ============================= Main Content start here ===================== -->
                <div class="content-bottom-section" style="padding-bottom: 22px;">
                    <div class="content-bottom-top">
                        <div class="container">
                            <div class="row">
                            <div class="col">
                                <div class="bottom-top-title">
                                発注明細
                                </div>
                            </div>
                            </div>
                            <div class="row mt-2">
                            <div class="col-12">
                                <div class="data-wrapper-content" style="width: 100%;">
                                <div class="data-box-content"
                                    style="width: 7%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                                    <div style="padding: 23px;">
                                    行
                                    </div>
                                </div>
                                <div class="data-box-content2 text-center orderentry-databox" style="width: 93%;float: left;">
                                    <div style="width: 100%;float: left;">
                                    <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0"
                                        style="padding: 5px; width: 10%;">
                                        品番
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 15%;">
                                        メーカー品番
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 30%;">
                                        品名
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 10%;">
                                        数量
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 10%;">
                                        単価
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 5%;">
                                        率
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 10%;">
                                        仕切単価
                                    </div>
                                    <div class="data-box float-left border border-bottom-0 border-right-0"
                                        style="padding: 5px; width: 10%;">
                                        発注金額
                                    </div>
                                    </div>
                                </div>
                                <div class="data-box-content2 text-center orderentry-databox" style="width: 93%;float: left;">
                                    <div style="width: 100%;float: left;">
                                    <div class="data-box float-left border"
                                        style="padding: 5px; width: 11%;border-right: 0 !important; border-left: 0 !important;">
                                        個別納期
                                    </div>
                                    <div class="data-box float-left border"
                                        style="padding: 5px; width: 5%;border-right: 0 !important;">
                                        最短
                                    </div> 
                                    <div class="data-box float-left border"
                                        style="padding: 5px; width: 11%;border-right: 0 !important;">
                                        現調日
                                    </div>
                                    <div class="data-box float-left border"
                                        style="padding: 5px; width: 5%;border-right: 0 !important;">
                                    現調時間
                                    </div>
                                    <div class="data-box float-left border"
                                        style="padding: 5px; width: 25%;border-right: 0 !important;">
                                        納品先
                                    </div>
                                    <div class="data-box float-left border"
                                        style="padding: 5px; width: 14%;border-right: 0 !important;">
                                        受注番号行枝
                                    </div>
                                    <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 8%;">
                                        支払課税区分
                                    </div>
                                    <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 11%;">
                                        支払税端数区分
                                    </div>
                                    <div class="data-box border  border-right-0" style="padding: 5px;float: left; width: 10%;">
                                        消費税
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
                    <!-- Line Item start here -->
                    @include('purchase.hatchuNyuryoku.hatchuNyuryokuMainContent')
                    <!-- Line Item End here -->
                    </div>
                    <div class="container" id="products_button">
                        <div class="row">
                            <div class="ml-3 w-100" style="margin-right: 15px;">
                                <div class=" d-flex justify-content-end mb-3" style="margin-top:12px;">
                                <div class="form-button">
                                    <button type="button" id="orderEntrySubmitBtn" class="btn btn-sm btn-primary orderEntrySubmitBtn uskc-button" name="touroku-button">登&nbsp;&nbsp;録</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- ============================= Main Content end here ======================= -->    
            </div>          
            {{-- Footer Starts Here --}}
            @include('layout.footer_new')
            {{-- Footer end Here --}}
        </section>
        <!-- Number Search Modal start here -->
        @include('purchase.hatchuNyuryoku.include.number_search.main')
        <!-- Number Search Modal end here -->
        @include('purchase.hatchuNyuryoku.include.supportNumberSearch.main')
        <!-- Supplier Modal start here -->
        @include('common.supplierModal')
        <!-- Supplier Modal end here -->
        

        <!-- Transaction Term (#ExampleModal) Modal start here -->
        @include('purchase.hatchuNyuryoku.include.transactionTermMain')
        <!-- Transaction Term (#ExampleModal) Modal end here -->
        <!-- product Modal start here -->
        @include('purchase.hatchuNyuryoku.include.product.main')
        <!-- product Modal start here -->
        <!-- delivery destination Modal start here -->
        @include('purchase.hatchuNyuryoku.include.deliveryDestination.main')
        <!-- delivery destination  Modal start here -->
        </form>
        <script type="text/javascript">
        $(function () {
        $('.show_personal_master_info').click(function () {
            // e.preventDefault();
            $(".tabledataModal6").addClass('intro');
            //$(this).css('border', "solid 2px red");
            $("#product_sub_content2").show();
            // $(this).closest('td').find("#office_master_content_div").toggle();
        });
        });

    </script>
    <script type="text/javascript">
        $("#pr_sub_choice_button").click(function () {


        $("#initial_content_product_sub").hide();
        $("#product_sub_content2").hide();
        $("#personal_master_content_div").hide();
        $("#office_content_div_last").hide();
        if ($(".show_office_master_info").hasClass("add_border")) {
            $(".show_office_master_info").removeClass('add_border');
        }

        if ($(".show_personal_master_info").hasClass("add_border")) {
            $(".show_personal_master_info").removeClass('add_border');
        }
        if ($(".show_content_last").hasClass("add_border")) {
            $(".show_content_last").removeClass('add_border');
        }
        });

    </script>

    <!-- Including Common Footer Links Starts Here -->
    @include('layouts.footer')
    <!-- Including Common Footer Links Ends Here -->

    {{-- Knockout - Enter to New Input Starts Here --}}
    <script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>
    <script>
        // Knockout
        ko.bindingHandlers.nextFieldOnEnter = {
            init: function (element, valueAccessor, allBindingsAccessor) {
                $(element).on('keydown', 'input, textarea, select, button, tr.trfocus, a.btn', function (e) {
                    var self = $(this),
                        form = $(element),
                        focusable, next;
                    if (e.keyCode == 13 && !e.shiftKey) {
                        focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), tr.trfocus, a.btn').filter(':visible');
                        // focusable = form.find('input:not([ignore]), select, textarea, button:not([ignore]), a.btn').filter(':visible');
                        var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                        next = focusable.eq(nextIndex);
                        next.focus();
                        return false;
                    }
                    if (e.keyCode == 9) {
                        e.preventDefault();
                    }

                    // Shift+Enter to select table row
                    if (e.keyCode == 13 && e.shiftKey) {
                    var rowSelect2 = $('.rowSelect');
                    $(this).trigger('click');
                    }
                });
            }
        };
        ko.applyBindings({});

    </script>
    <script>
        function ignoreDisabledButton(event) {
            if (event.keyCode == 13) {
                // $("#pj").focus();
                event.preventDefault();
            }
            // New added for prevent
            event.preventDefault();
            }  
    </script>
    <!-- <script type="text/javascript">
    $(document).ready(function(){
    $("#igroup1").click(function(){
        $("#tradingConditionModal").modal();
    });
    });
    </script> -->
    {{-- Knockout - Enter to New Input ends Here --}}
    
    <script type="text/javascript">
        // Date Picker Initialization

        // 発注日
        $(".datePicker1").removeData('datePicker1').unbind().datepicker({
            language: 'ja-JP',
            format: 'yyyy/mm/dd',
            autoHide: true,
            zIndex: 10,
            offset: 6,
            trigger: '.datePicker1'
        });

        $(document).on('change focus', '.datePicker1', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
        });

        $(document).on('click', '.datePicker1', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
        });

        $(document).on('keyup', '.datePicker1', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $(this).datepicker('update');
            $(this).datepicker('show');
        }
        });

        // Update date value with slash on blur
        $(document).on('blur', '.datePicker1', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
        });

        //Enter press hide dropdown
        // $(".datePicker1").keydown(function (e) {
        // if (e.keyCode == 13) {
        //     $(".datePicker1").datepicker('hide');
        // }
        // });
         //Enter press hide dropdown
         $(".datePicker1").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker1").datepicker('hide');
        }
        });


        // Datepicker 2
        $(".datePicker2").removeData('datePicker2').unbind().datepicker({
            language: 'ja-JP',
            format: 'yyyy/mm/dd',
            autoHide: true,
            zIndex: 10,
            offset: 6,
            trigger: '.datePicker2'
        });

        $(document).on('change focus', '.datePicker2', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
        });

        $(document).on('click', '.datePicker2', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
        });

        $(document).on('keyup', '.datePicker2', function (e) {
            $(this).datepicker('show');
            let inputDateValue = $(this).val();  //getting date value from input
            if (inputDateValue.length == 8) {
                let slicedYear = inputDateValue.slice(0, 4);
                let slicedMonth = inputDateValue.slice(4, 6);
                let slicedDay = inputDateValue.slice(6, 8);
                let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
                $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
                $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
                $(this).datepicker('update');
            }
            
            
        });

        // Update date value with slash on blur
        $(document).on('blur', '.datePicker2', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
        });

        //Enter press hide dropdown
       
        $(".datePicker2").keydown(function (e) {
            if (e.keyCode == 13) {
                $(".datePicker2").datepicker('hide');
            }
        });
       
      


        // Datepicker 3
        $(".datePicker3").removeData('datePicker3').unbind().datepicker({
            language: 'ja-JP',
            format: 'yyyy/mm/dd',
            autoHide: true,
            zIndex: 10,
            offset: 6,
            trigger: '.datePicker3'
        });

        $(document).on('change focus', '.datePicker3', function () {
        if ($(this).val().length == 10) {
            $(this).datepicker('update');
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus();
            $(this).datepicker('hide');
        }
        });

        $(document).on('click', '.datePicker3', function () {
        if ($(this).val().length == 0) {
            $(this).datepicker('show');
        }
        else if ($(this).val().length <= 7 ) {
            $(this).datepicker('hide');
        }
        });

        $(document).on('keyup', '.datePicker3', function (e) {
            $(this).datepicker('show');
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $(this).datepicker('update');
        }
        });

        // Update date value with slash on blur
        $(document).on('blur', '.datePicker3', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        } else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
        });

        //Enter press hide dropdown
        $(".datePicker3").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".datePicker3").datepicker('hide');
        }
        });

        // Datepicker Ends Here
    </script>

    <script>
        $("#add_icon").click(function () {
        $(".datePicker1").datepicker('hide');
        $(".datePicker2").datepicker('hide');
        $(".datePicker3").datepicker('hide');
        });
    </script>

    <script>
        $(document).on('shown.bs.modal', function (e) {
            $('[autofocus]', e.target).focus();
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
        $("#closetopcontent").click(function () {
            $(".order_entry_topcontent").toggle();
            $('.content-bottom-section').css('margin-top', 38);
        });
        });
        // function contentHideShow() {
        //   var hideShow = document.getElementById("closetopcontent");
        //   if (hideShow.innerHTML === "閉じる") {
        //     hideShow.innerHTML = "開く";
        //   } else {
        //     hideShow.innerHTML = "閉じる";
        //   }
        // }



    </script>
    <script>
        // $(document).ready(function () {
        //   $(".first-table").hide();
        //   $("button#searchButton").click(function () {
        //     $(".first-table").show();
        //   });
        // });
        $(document).ready(function () {
        $(".second-table").hide();
        $(".first-table").click(function () {
            $(".second-table").show();
        });
        });
        $(document).ready(function () {
        $(".third-table").hide();
        $(".second-table").click(function () {
            $(".third-table").show();
        });
        });
    </script>
    <script type="text/javascript">
        $("#modalarea").on('click', function () {
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
        });

        $("#modalarea").on("click", function () {
        $('.modal-backdrop').remove();
        $('#modalarea').on('show.bs.modal', function (e) {
            $('body').addClass('overflow_cls');

        })
        $('#modalarea').on('hide.bs.modal', function (e) {
            $('body').removeClass('overflow_cls');
        })
        $("#modalarea").modal("hide");
        });
    </script>

    <!-- file name show in input area... -->
    <script>
        $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

        //Enter press hide dropdown...
        $(".input_field").keydown(function (e) {
        if (e.keyCode == 13) {
            $(".input_field").datepicker('hide');
        }
        });

        // btn-delete-box
        $(".btn-delete-box").click(function(){
        $(".add-delete-box").addClass("change-delete-box");

        });

    </script>
    <script type="text/javascript">
        var filepro = document.createElement("script");
        filepro.type = "text/javascript";
        filepro.src = "{{ asset('js/purchase/hatchuNyuryoku/product.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filepro);

    </script>
    <script type="text/javascript">
        var filenumsearch = document.createElement("script");
        filenumsearch.type = "text/javascript";
        filenumsearch.src = "{{ asset('js/purchase/hatchuNyuryoku/numberSearch.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filenumsearch);
    </script>
    <script type="text/javascript">
        var filesnumsearch = document.createElement("script");
        filesnumsearch.type = "text/javascript";
        filesnumsearch.src = "{{ asset('js/purchase/hatchuNyuryoku/supportNumberSearch.js') }}?v=" + Math.floor((Math.random() *
            500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filesnumsearch);
    </script>
    <script type="text/javascript">
        var filesupplier = document.createElement("script");
        filesupplier.type = "text/javascript";
        filesupplier.src = "{{ asset('js/purchase/hatchuNyuryoku/supplier.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(filesupplier);
    </script>
    
    <script type="text/javascript">
        var fileorderdetail = document.createElement("script");
        fileorderdetail.type = "text/javascript";
        fileorderdetail.src = "{{ asset('js/purchase/hatchuNyuryoku/orderDetails.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(fileorderdetail);
    </script>
    <!-- <script type="text/javascript">
        var filesupplier = document.createElement("script");
        filesupplier.type = "text/javascript";
        filesupplier.src = "{{ asset('js/purchase/purchase.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(filesupplier);
    </script> -->
    <script type="text/javascript">
        var filedeliverydest = document.createElement("script");
        filedeliverydest.type = "text/javascript";
        filedeliverydest.src = "{{ asset('js/purchase/hatchuNyuryoku/deliveryDestination.js') }}?v=" + Math.floor((Math.random() * 500) +
            1);
        document.getElementsByTagName("head")[0].appendChild(filedeliverydest);
    </script>
    <script type="text/javascript">
        var filecomm = document.createElement("script");
        filecomm.type = "text/javascript";
        filecomm.src = "{{ asset('js/common.js') }}?v=" + Math.floor((Math.random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filecomm);
    </script>
    <script type="text/javascript">
        var filetradcorp = document.createElement("script");
        filetradcorp.type = "text/javascript";
        filetradcorp.src = "{{ asset('js/purchase/hatchuNyuryoku/transactionTerm.js') }}?v=" + Math.floor((Math
            .random() * 500) + 1);
        document.getElementsByTagName("head")[0].appendChild(filetradcorp);
    </script>
    <!-- <script src="{{asset('js/purchase/purchase.js')}}"></script>  -->
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
    </body>
</html>