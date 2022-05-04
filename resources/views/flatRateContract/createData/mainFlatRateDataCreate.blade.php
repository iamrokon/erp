@section('title', ' 受注→定期定額契約データ作成')
@section('menu-test1', 'ホーム >')
@section('menu-test3', ' 定期定額契約  >')
@section('menu-test5', ' 定期定額→受注データ作成')
@section('tag-test', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test1', 'ここには、ガイドの文章が入ります。ここには、ガイドの文章が入ります。')
@section('tag-test2', 'ここには、ガイドの文章が…')
@section('tag-test3', 'つづきを読む')

<!DOCTYPE html>
<html lang="ja">

<head>
    {{-- Including Common Header Links Start Here --}}
    @include('layouts.header')
    {{-- Including Common Header Links End Here--}}
</head>

@include('flatRateContract.createData.styles')

<body style="overflow-x:visible;">
<section>
    {{-- Navbar Starts Here --}}
    @include('layout.nav_fixed')
    {{-- Navbar Ends Here --}}
    <div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
        <div class="content-head-section">
            <div class="container">

                <div class="row order_entry_topcontent" style="margin-top: 20px;">
                    <div class="col">
                        <div class="content-head-top">
                            <div class="row">
                                <div class="col-8">
                                    <table class="table custom-form" style="width:auto;">
                                        <tbody>
                                        <tr>
                                            <td style="border: none!important;text-align: left;color: black;width:102px !important;">
                                                <div class="line-icon-box float-left mr-3"></div> 事業部
                                            </td>
                                            <td style="border: none!important;width:350px;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="" id="" autofocus>

                                                        <option value="">03 東日本ソリューション事業部</option>
                                                        <option value="">03 東日本ソリューション事業部</option>
                                                        <option value="">03 東日本ソリューション事業部</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                                                ～
                                            </td>
                                            <td style="border: none!important;width:350px;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="" id="">
                                                        <option value="">選択してください</option>
                                                        <option value="">選択してください</option>
                                                    </select>
                                                </div>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none!important;text-align: left;color: black;"><div class="line-icon-box float-left mr-3"></div>部
                                            </td>
                                            <td style="border: none!important;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="" id="">
                                                        <option value="">1 東日本ソリューション営業部</option>
                                                        <option value="">1 東日本ソリューション営業部</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                                                ～
                                            </td>
                                            <td style="border: none!important;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="" id="">
                                                        <option value="">選択してください</option>
                                                        <option value="">選択してください</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="border: none!important;text-align: left;color: black;">
                                                <div class="line-icon-box float-left mr-3"></div>グループ
                                            </td>
                                            <td style="border: none!important;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="" id="">
                                                        <option value="">1 第1グループ</option>
                                                        <option value="">1 第1グループ</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td style="border: none!important;text-align: center;color: black;width: 40px!important; max-width: 40px!important; font-size: 20px!important;">
                                                ～
                                            </td>
                                            <td style="border: none!important;">
                                                <div class="custom-arrow">
                                                    <select class="form-control" name="" id="">
                                                        <option value="">選択してください</option>
                                                        <option value="">選択してください</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                            <div class="row mb-2" style="padding-top: 0px;">
                                <div class="col-5">
                                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                                        <tbody>
                                        <tr>
                                            <td style="border: none!important;text-align: left;color: black;width: 94px !important;">
                                                <div class="line-icon-box float-left mr-3"></div>売上日
                                            </td>
                                            <td style="border: none!important;width: 110px;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="datepicker1_oen"
                                                           oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                           maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                                           value="">
                                                    <input type="hidden" class="datePickerHidden">
                                                </div>
                                            </td>
                                            <style>
                                                span#calInfo {
                                                    position: absolute;
                                                    left: 0;
                                                    right: 0;
                                                    height: 27px;
                                                    width: 105px;
                                                    background: transparent;
                                                    display: block;
                                                    border-radius: 4px;
                                                }
                                            </style>
                                            <td style="width: 30px!important;border:0!important;text-align: center;">
                                                ～
                                            </td>
                                            <td style="border: none!important;width: 110px;">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="datepicker2_oen"
                                                           oninput="this.value = this.value.replace(/[^\d^\/]/g, '').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, '$1$2$3').replace(/([\d]{8})([\d]{1,2})?/g, '$1');"
                                                           onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                           maxlength="10" autocomplete="off" placeholder="年/月/日" style="width: 96px!important;"
                                                           value="">
                                                    <input type="hidden" class="datePickerHidden">
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-6">
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <table class="table custom-form" style="width: auto;margin-bottom: 2px!important;">
                                        <tbody>
                                        <tr>
                                            <td style="border: none!important;text-align: left;color: black;width:94px !important;">
                                                <div class="line-icon-box float-left mr-3"></div>売上請求先
                                            </td>
                                            <td style="border: none!important;width: 350px;">
                                                <div class="input-group input-group-sm position-relative">
                                                    <input type="text" class="form-control"  placeholder="売上請求先" style="width: 94px!important;padding-left: 0px !important;">
                                                    <div class="input-group-append" id="modalarea" data-toggle="modal" data-target="#search_modal4">
                                                        <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="width: 30px!important;border:0!important;text-align: center;">
                                                ～
                                            </td>
                                            <td style="border: none!important;width: 354px;">
                                                <div class="input-group input-group-sm position-relative">
                                                    <input type="text" name="" class="form-control" placeholder="売上請求先" style="padding-left: 0px !important;width: 80px;">
                                                    <div class="input-group-append" id="modalarea" data-toggle="modal" data-target="#search_modal4">
                                                        <button class="input-group-text btn"><i class="fas fa-arrow-left"></i></button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-9">
                                    <button class="bg-teal btn-info btn float-right">データ作成</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Footer Starts Here --}}
    @include('layout.footer_new')
    {{-- Footer Ends Here --}}
</section>


<!-- Statr search modal -->
<div class="modal custom-modal" data-backdrop="static" id="search_modal4" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 1106px!important;">
        <div class="modal-content" data-bind="nextFieldOnEnter:true">

            <div class="modal-header">
                <h5 class="modal-title">取引先</h5>
                <span type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </span>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div style="margin-bottom: 5px;">
                            <table class="table" style="border: none!important;width: auto;">
                                <tbody>
                                <tr>
                                    <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                        <div class="line-box-icon mr-3"></div>
                                    </td>
                                    <td style=" border: none!important;width: 40px!important;color: #fff;">検索（絞込）</td>
                                    <td style=" width: 100%; border: none!important;"><input type="text" class="form-control" autofocus="" id="lastname"
                                                                                             placeholder="検索ワード" style="border-top-left-radius: 4px !important;border-bottom-left-radius: 4px !important;"></td>
                                    <td style=" border: none!important;"><button type="button" class="btn bg-teal text-white btn_search"
                                                                                 id="searchButton" style="border-radius: 0px;margin-left: -6px;"><i class="fas fa-search"></i>
                                        </button></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <script type="text/javascript">
                            $(function () {
                                $('.show_office_master_info').click(function (event) {
                                    $('.show_office_master_info').not(this).removeClass('add_border');
                                    $(this).addClass('add_border');
                                    $("#office_master_content_div").show();
                                });
                            });

                        </script>
                        <div class="table_wrap" >
                            <div class=" page4_table_design mt-2  table_hover  table-head-only">

                                <div id="initial_content">
                                    <div class="border-line"></div>
                                    <h4 style="margin-bottom: 15px;margin-top: 10px;"><span class="ml-2">会社マスタ　（会社CD/会社名）</span></h4>

                                    <div class="modal-table-white" style="height: 160px;width: 100%;cursor: pointer;">
                                        <div class="first-table">
                                            <table class="table" id="table-basic">
                                                <tbody class="">
                                                <tr tabindex="0" class=" show_office_master_info table_hover2 grid trfocus">
                                                    <td>999999</td>
                                                    <td>株式会社サンプル</td>
                                                </tr>
                                                <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus">
                                                    <td style="width: 50px;">999999</td>
                                                    <td> 株式会社サンプル </td>
                                                </tr>
                                                <tr tabindex="0" class=" show_office_master_info table_hover2 grid trfocus">
                                                    <td style="width: 50px;">999999 </td>
                                                    <td> 株式会社サンプル
                                                    </td>
                                                </tr>
                                                <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus">

                                                    <td style="width: 50px;">999999</td>
                                                    <td>株式会社サンプル
                                                    </td>

                                                </tr>
                                                <tr tabindex="0" class=" show_office_master_info table_hover2 gridAlternada trfocus">

                                                    <td style="width: 50px;">999999</td>
                                                    <td>株式会社サンプル
                                                    </td>

                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <script type="text/javascript">

                                    $(function () {
                                        $('#searchButton').click(function (event) {
                                            $("#initial_content").show();
                                        });
                                    });

                                </script>

                                <div id="office_master_content_div">

                                    <!-- 2nd modal content -->
                                    <h4 style="margin-bottom: 15px;margin-top: 15px;">事業所マスタ　（事業所CD/事業所名）</h4>

                                    <div class="modal-table-white" style="height: 112px;width: 100%;cursor: pointer;">
                                        <div class="second-table">
                                            <table class="table ">
                                                <thead class="header text-center" id="myHeader">

                                                </thead>
                                                <tbody>
                                                <tr tabindex="0" class="show_personal_master_info trfocus">
                                                    <td>01</td>
                                                    <td>北海道支社</td>
                                                    <td>北海道札幌市中央区北1…</td>
                                                </tr>
                                                <tr tabindex="0" class="show_personal_master_info trfocus">

                                                    <td style="width:50px;">02</td>

                                                    <td>東北支社</td>

                                                    <td>宮城県仙台市青葉区…</td>


                                                </tr>
                                                <tr tabindex="0" class="show_personal_master_info trfocus">

                                                    <td style="width:50px;">03</td>

                                                    <td>東京本社
                                                    </td>

                                                    <td>東京都中央区銀座…</td>

                                                </tr>
                                                <tr tabindex="0" class="show_personal_master_info trfocus">

                                                    <td style="width:50px;">04</td>


                                                    <td>大阪支社
                                                    </td>

                                                    <td>大阪府高槻市…</td>


                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div id="personal_master_content_div">

                                    <h4 style="margin-bottom: 15px; margin-top: 10px;">個人マスタ　（個人CD/名称）</h4>

                                    <div class=" modal-table-white" style="width: 100%; height: 84px;cursor: pointer;">
                                        <div class="third-table">
                                            <table class="table">
                                                <tbody>
                                                <tr tabindex="0" class="show_content_last trfocus">
                                                    <td>001</td>
                                                    <td>鈴木　一郎</td>
                                                    <td>経営企画部</td>
                                                </tr>
                                                <tr tabindex="0" class="show_content_last trfocus">
                                                    <td style="width:50px;">002</td>
                                                    <td>田中　二郎</td>
                                                    <td>営業部</td>
                                                </tr>
                                                <tr tabindex="0" class="show_content_last trfocus">
                                                    <td style="width:50px;">003</td>
                                                    <td>山田　三郎</td>
                                                    <td>総務部</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6">
                        <div id="office_content_div_last" style="margin-top: 57px;">
                            <div style="width: 99%;">
                                <div class="heading">

                                </div>
                                <h4 class="b-color" style="margin-bottom: 15px;margin-top: 10px;"> 取引先情報</h4>
                                <table class="table modal-table-blue" id="table-basic">
                                    <tbody>
                                    <tr>
                                        <td style="width: 112px;">番号</td>
                                        <td style="width: 300px;"> 99999999999</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">会社名</td>
                                        <td style="width: 300px;">株式会社サンプル </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">事業所名</td>
                                        <td style="width: 300px;">東京本社</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">部署</td>
                                        <td style="width: 300px;">営業部 </td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">役職
                                        </td>
                                        <td style="width: 300px;">部長</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">氏名</td>
                                        <td style="width: 300px;"> 田中　二郎</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">メールアドレス</td>
                                        <td style="width: 300px;">sample@xxxx.co.jp</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">電話番号</td>
                                        <td style="width: 300px;"> 00-0000-0000</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">案内停止フラグ</td>
                                        <td style="width: 300px;">停止</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">キーマンフラグ</td>
                                        <td style="width: 300px;"> A 責任者</td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">役員改選案内先</td>
                                        <td style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">年賀状</td>
                                        <td style="width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="width: 112px;">ユーザー感謝会案内</td>
                                        <td style="width: 300px;"></td>
                                    </tr>
                                    <tr style="border:none;">
                                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                        <td style="border-bottom:none !important;width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                        <td style="border-bottom:none !important;width: 300px;"></td>
                                    </tr>
                                    <tr>
                                        <td class="line-title" style="border-bottom:none !important;width: 112px;height: 30px;"></td>
                                        <td style="border-bottom:none !important;width: 300px;"></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- 2nd modal content end -->

                <!-- 3rd modal content  -->
                <script type="text/javascript">
                    $(function () {
                        $('.show_personal_master_info').click(function (event) {
                            $('.show_personal_master_info').not(this).removeClass('add_border');
                            $(this).addClass('add_border');
                            $("#personal_master_content_div").show();
                        });
                    });

                </script>


                <div class="row">
                    <div class="col-lg-6">



                    </div>
                    <!-- 3rd modal content end  -->

                    <!-- 4th modal content end  -->

                    <script type="text/javascript">
                        $(function () {
                            $('.show_content_last').click(function (event) {
                                $('.show_content_last').not(this).removeClass('add_border');
                                $(this).addClass('add_border');
                                $("#office_content_div_last").show();
                            });
                        });

                    </script>
                </div>


                <!-- 4th modal content end  -->
                <!-- modal content enddd   -->

            </div>
            <div class="modal-footer pl-4 pr-4">
                <button type="button" id="" class="btn text-white w-145 bg-default" data-dismiss="modal"> <i class="" aria-hidden="true"
                                                                                                             style="margin-right: 5px;"></i>キャンセル
                </button>
                <button type="button" id="choice_button" class="btn w-145 bg-teal2 text-white ml-2" data-dismiss="modal"> <!-- <i
              class="fa fa-hand-paper-o" aria-hidden="true" style="margin-right: 5px;"></i> -->入力する
                </button>
            </div>
        </div>
    </div>
</div>
<!-- end search modal -->

<!-- Including Common Footer Links Start Here -->
@include('layouts.footer')
<!-- Including Common Footer Links End Here -->

{{-- Knockout - Enter to New Input Starts Here --}}
{{-- @include('master.common.knockout') --}}
<script src="https://ajax.aspnetcdn.com/ajax/knockout/knockout-2.2.1.js" type="text/javascript"></script>

<script>
    ko.bindingHandlers.nextFieldOnEnter = {
        init: function (element, valueAccessor, allBindingsAccessor) {
            // $(element).on('keydown', 'input, textarea, select, button, a.btn, .btn, tr.trFocus', function (e) {
            $(element).on('keydown', 'input, textarea, select, button, a.btn, tr.trFocus', function (e) {
                var self = $(this),
                    form = $(element),
                    focusable, next;
                if (e.keyCode == 13 && !e.shiftKey) {
                    // focusable = form.find('input:not([ignore]), select, textarea, button, a.btn, .btn, tr.trFocus').filter(':visible');
                    focusable = form.find('input:not([ignore]), select, textarea, button:not([disabled]), a.btn, tr.trFocus').filter(':visible');
                    var nextIndex = focusable.index(this) == focusable.length - 1 ? 0 : focusable.index(this) + 1;
                    next = focusable.eq(nextIndex);
                    next.focus();
                    return false;
                }
                if (e.keyCode == 9) {
                    e.preventDefault();
                }
            });
        }
    };
    ko.applyBindings({});
</script>
{{-- Knockout - Enter to New Input Ends Here --}}

<script type="text/javascript">
    $(document).ready(function(){
        $("#closetopcontent").click(function(){
            $(".order_entry_topcontent").toggle();
        });
    });
    function contentHideShow() {
        var hideShow = document.getElementById("closetopcontent");
        if (hideShow.innerHTML === "閉じる") {
            hideShow.innerHTML = "開く";
        } else {
            hideShow.innerHTML = "閉じる";
        }
    }
</script>
<script>
    $(document).ready(function(){
        $(".first-table").hide();
        $("button#searchButton").click(function(){
            $(".first-table").show();
        });
    });
    $(document).ready(function(){
        $(".second-table").hide();
        $(".first-table").click(function(){
            $(".second-table").show();
        });
    });
    $(document).ready(function(){
        $(".third-table").hide();
        $(".second-table").click(function(){
            $(".third-table").show();
        });
    });
</script>
<script type="text/javascript">
    $("#modalarea").on('click', function(){
        $(".modal-backdrop").addClass("overflow_cls");
        // $('.modal-backdrop').remove();
    });

    $("#modalarea").on("click", function(){
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
<!-- chalender js -->
<script type="text/javascript">
    // Date Picker Initialization
    $('#datepicker1_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker1_oen'
    });

    $('#datepicker1_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');

            if($(this).val().replaceAll('/', '') > $('#datepicker2_oen').val().replaceAll('/', '')){
                $('#datepicker2_oen').val(datevalue);
                $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
                $('#datepicker2_oen').datepicker('update');
                $('#datepicker2_oen').val('');
            }
            else{
                $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
                $('#datepicker2_oen').datepicker('update');
            }
        }
    });

    $('#datepicker1_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
            $('#datepicker2_oen').datepicker('setStartDate', $('#datepicker1_oen').datepicker('getDate'));
            $('#datepicker2_oen').datepicker('update');
        }
    });
    // Update date value with slash on blur
    $('#datepicker1_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

</script>
<script type="text/javascript">
    $('#datepicker2_oen').datepicker({
        language: 'ja-JP',
        format: 'yyyy/mm/dd',
        autoHide: true,
        zIndex: 2048,
        offset: 4,
        trigger: '#datepicker2_oen',
        startDate: $('#datepicker1_oen').datepicker('getDate')
    });

    $('#datepicker2_oen').on('change focus', function () {
        if ($(this).val().length == 10) {
            $(this).siblings('.datePickerHidden').val($(this).val());
            let datevalue = $(this).siblings('.datePickerHidden').val();  //getting date value from calendar
            let formatted_date = datevalue.replaceAll('/', '')
            $(this).val(formatted_date);
            $(this).focus(); //focusing current input on select
            $(this).datepicker('hide');
        }
    });

    $('#datepicker2_oen').on('keyup', function (e) {
        let inputDateValue = $(this).val();  //getting date value from input
        if (inputDateValue.length == 8) {
            let slicedYear = inputDateValue.slice(0, 4);
            let slicedMonth = inputDateValue.slice(4, 6);
            let slicedDay = inputDateValue.slice(6, 8);
            let formatted_sliced_date = slicedYear + "/" + slicedMonth + "/" + slicedDay;
            $(this).siblings('.datePickerHidden').val(formatted_sliced_date);
            $(this).datepicker('setDate', new Date(slicedYear, slicedMonth - 1, slicedDay));
        }
    });
    // Update date value with slash on blur
    $('#datepicker2_oen').on('blur', function () {
        if ($(this).val() != '') {
            $(this).val($(this).siblings('.datePickerHidden').val());
        }
        else if ($(this).val() == '') {
            $(this).val('');
            $(this).siblings('.datePickerHidden').val('');
        }
    });

    //Enter press hide dropdown...
    $("#datepicker1_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker1_oen").datepicker('hide');
        }
    });
    $("#datepicker2_oen").keydown(function (e) {
        if (e.keyCode == 13) {
            $("#datepicker2_oen").datepicker('hide');
        }
    });

</script>
</body>

</html>
