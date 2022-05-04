@php

$old = [];
if (session()->has('oldInput' . $bango)) {
    $old = session()->get('oldInput' . $bango);
}
$current_page = $numberSearches->currentPage();
$per_page = $numberSearches->perPage();
$first_data = ($current_page - 1) * $per_page + 1;
$last_data = ($current_page - 1) * $per_page + sizeof($numberSearches->items());
$total = $numberSearches->total();
$lastPage = $numberSearches->lastPage();

@endphp
<form id="numberForm" class="number_search_partial_html">
    <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token">
    <input type="hidden" name="Button" id="Button" value="{{ isset($old['Button']) ? $old['Button'] : null }}">
    <input type="hidden" id="targetId">
    <input type="hidden" id="sortField" name="sortField"
        value="{{ isset($old['sortField']) ? $old['sortField'] : null }}">
    <input type="hidden" id="sortType" name="sortType"
        value="{{ isset($old['sortType']) ? $old['sortType'] : null }}">
    <input type="hidden" id="userId" name="userId" value="{{ $bango }}">
    <input type="hidden" id="category_kanri_def" name="category_kanri_def"
        value="{{ isset($old['category_kanri_def']) ? $old['category_kanri_def'] : null }}">
    <input type="hidden" id="request_def" name="request_def"
        value="{{ isset($old['request_def']) ? $old['request_def'] : null }}">
    <input type="hidden" id="syouhinbango_jouhou" name="syouhinbango_jouhou"
        value="{{ isset($syouhinbango_jouhou) ? $syouhinbango_jouhou : null }}">

    <div class="" style="margin-top: 37px;margin-bottom: 27px;">
        <div class=" row row_data delete_data_contain"></div>
        <div class=" row row_data mb-1">
            <div class="col-7">
                <div class="radio-rounded d-inline-block">
                    <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;pointer-events: none;">
                        <input type="radio" class="custom-control-input" id="customRadio_creation_category_1" name="rd1" value="">
                        <label class="custom-control-label text-white" for="customRadio_creation_category_1"
                            style="font-size: 12px!important;cursor:pointer;">受注</label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline" style="padding-left:11px!important;">
                        <input type="radio" class="custom-control-input" id="customRadio_creation_category_2_3" name="rd1" value="" checked>
                        <label class="custom-control-label text-white" for="customRadio_creation_category_2_3"
                            style="font-size: 12px!important;cursor:pointer;"> 発注 </label>
                    </div>

                </div>
            </div>
        </div>
        <style type="text/css">
            .radio-rounded .custom-radio .custom-control-input:checked~.custom-control-label:before,
            .radio-rounded .custom-radio .custom-control-input:checked~.custom-control-label:after {
                background: #3F8CED !important;
                box-shadow: none;
                content: "\f00c";
                font-family: 'FontAwesome';
                color: #fff;
                font-size: 10px;
                font-weight: normal !important;
                top: 2px;
                text-align: center;
                border: 1px solid #3F8CED !important;
            }

            .radio-rounded .custom-radio .custom-control-label:before {
                background: #EFEFEF !important;
                border: 1px solid #CDCDCD !important;
                top: 2px
            }

        </style>
    </div>
    <div class="" style="margin-top: 16px;">
        <div style="border-top: 1px solid #141855;padding-bottom: 3px;">
            <div class="row mt-2">
                <div class="col-lg-8">
                    <div class=""
                        style="overflow-x:auto; overflow-y:auto; height: auto; margin-top:14px;margin-bottom:4px;">
                        <table class="custom-table-pagination table_hover2_pagi table-nohover  gridAlternada w_680">
                            <tbody>
                                <tr>
                                    <td class="" style="padding-left:0px!important;">
                                        <div class="pagi">
                                            <div class="nav_mview">
                                                <nav aria-label="Page navigation example ">
                                                    <ul class="pagination">
                                                        <li class="page-item">
                                                            <a class="page-link backPageLink" aria-label="Previous" onclick="goPreviouPage()"
                                                                style="margin-right: 2px;border-top-right-radius: 4px;border-bottom-right-radius: 4px;color: black !important;height: 30px;">
                                                                <span aria-hidden="true">
                                                                    <i class="fa fa-angle-left"
                                                                        style="line-height: 17px;font-size: 24px;"></i></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                        </li>
                                                        <li class="w_50 " style="width:42px!important;">
                                                            <input type="text" autofocus name="page" id="paginate"
                                                                onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"
                                                                class="form-control intLimitTextBox text-center input_pagi"
                                                                value="{{ $current_page }}"
                                                                style=" margin-top: 0px;border-left: 0px!important;height: 27px!important;width: 40px;margin-right: 2px;border-radius: 4px !important;text-align: center !important;padding-left: 2px !important;height: 30px !important;">
                                                        </li>
                                                        <input type="hidden" id="paginationhelper" name="page" value=""
                                                            disabled="disabled">
                                                        <li class="page-item">
                                                            <a class="page-link pageLink" href="#" onclick="goCustomPage()"
                                                                style="line-height: 18px !important;color: black !important;border-radius: 4px;margin-right: 2px; width: 35px;font-weight: 600;font-size:13px;">=</a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link forwardPageLink" href="#" onclick="goNextPage()"
                                                                aria-label="Next"
                                                                style="line-height: 12px;color: black !important;border-top-left-radius: 4px;border-bottom-left-radius: 4px;height: 30px;">
                                                                <span aria-hidden="true">
                                                                    <i class="fa fa-angle-right"
                                                                        style="line-height: 17px;font-size: 24px;"></i></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </nav>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="pagi_border-_none_text_wrap text-white">
                                            <table class="ml-3">
                                                <tbody>
                                                    <tr class="table_hover2_pagi  grid">
                                                        <td class="p-2 pl-2 pr-2"
                                                            style="border:none!important;color: white!important;">
                                                            情報総数
                                                        </td>
                                                        <td class="p-2 pl-2 pr-2"
                                                            style="border:none!important;color: white!important;">
                                                            {{ $total }}
                                                        </td>
                                                        <td class="p-2 pl-2 pr-2"
                                                            style="border:none!important;color: white!important;">
                                                            表示範囲
                                                        </td>
                                                        <td class="p-2 pl-2 pr-2"
                                                            style="border:none!important;color: white!important;">
                                                            {{ $first_data }}～{{ $last_data }}
                                                        </td>
                                                        <td class="p-2 pl-2 pr-2"
                                                            style="border:none!important;color: white!important;">
                                                            ページ総数
                                                        </td>
                                                        <td class="p-2 pl-2 pr-2"
                                                            style="border:none!important;color: white!important;">
                                                            {{ $lastPage }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- new pagination row ends here -->
                <style type="text/css">
                    @media only screen and (min-width: 768px) and (max-width: 992px) {
                        #tbl_border_none {
                            width: 100%;
                            margin-bottom: 10px;
                            float: right;
                        }
                    }

                    #tbl_border_none {
                        float: right;
                    }

                    @media only screen and (max-width: 767px) {
                        #tbl_border_none {
                            margin-left: 0px;
                            float: none !important;
                        }
                    }

                </style>
                <div class="col-lg-4">
                    <div class="ml-auto text-right" style="padding-top: 19px;">
                        <button onclick="searchData()" type="button" id="choice_button" class="btn bg-teal uskc-button text-white searchBtn"
                            style="width: 145px;">検&nbsp;&nbsp;索
                        </button>
                        <button onclick="refreshData()" type="button" id="" class="btn text-white bg-default uskc-button refreshBtn" style="">
                            <i class="" aria-hidden="true" style="margin-right: 5px;"></i> 一&nbsp;&nbsp;覧
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-scroll-area table-responsive">
            <div class="reference-table" style="margin-top: 14px;">
                {{-- <table class="table border-none modal-inner modal-table-white text-dark bg-white"
                    style="margin-bottom: 0px !important;cursor: pointer;margin-bottom:22px !important;border-bottom:0px important;">
                    <thead>
                        <tr>
                            <th class="text-white columnSort" id="order_number" onclick="sortingData('order_number');"
                                style="border-bottom:none !important;background: #363A81 !important;width:112px !important;padding-left:0px !important;padding-right:0px !important;">
                                番号
                            </th>
                            <th class="text-white columnSort" id="person_name" onclick="sortingData('person_name');"
                                style="border-bottom:none !important;background: #363A81 !important;width:158px !important;padding-left:0px !important;padding-right:0px !important;">
                                担当
                            </th>
                            <th class="text-white columnSort" id="sold_to" onclick="sortingData('sold_to');"
                                style="border-bottom:none !important;background: #363A81 !important;width:201px !important;padding-left:0px !important;padding-right:0px !important;">
                                受注先
                            </th>
                            <th class="text-white columnSort" id="end_customer" onclick="sortingData('end_customer');"
                                style="border-bottom:none !important;background: #363A81 !important;width:200px !important;padding-left:0px !important;padding-right:0px !important;">
                                最終顧客
                            </th>
                            <th class="text-white columnSort" id="orders" onclick="sortingData('orders');"
                                style="border-bottom:none !important;background: #363A81 !important;width:128px !important;padding-left:0px !important;padding-right:0px !important;">
                                金額
                            </th>
                            <th class="text-white columnSort" id="orders_subject" onclick="sortingData('orders_subject');"
                                style="border-bottom:none !important;background: #363A81 !important;width:351px !important;padding-left:0px !important;padding-right:0px !important;">
                                受注件名・発注件名
                            </th>
                            <th class="text-white columnSort" id="estimate_date" onclick="sortingData('estimate_date');"
                                style="border-bottom:none !important;background: #363A81 !important;width:140px !important;padding-left:0px !important;padding-right:0px !important;">
                                売上・発注日
                            </th>
                        </tr>
                    </thead>
                </table> --}}
                <div class="">
                    <table id="order_show_table" class="table modal-inner modal-table-white text-dark bg-white"
                        style="margin-bottom: 0px !important;cursor: pointer;">
                        <thead>
                            <tr>
                                <th class="text-white columnSort" id="order_number" onclick="sortingData('order_number');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:112px !important;padding-left:0px !important;padding-right:0px !important;">
                                    番号
                                </th>
                                <th class="text-white columnSort" id="person_name" onclick="sortingData('person_name');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:158px !important;padding-left:0px !important;padding-right:0px !important;">
                                    担当
                                </th>
                                <th class="text-white columnSort" id="sold_to" onclick="sortingData('sold_to');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:201px !important;padding-left:0px !important;padding-right:0px !important;">
                                    受注先
                                </th>
                                <th class="text-white columnSort" id="end_customer" onclick="sortingData('end_customer');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:200px !important;padding-left:0px !important;padding-right:0px !important;">
                                    最終顧客
                                </th>
                                <th class="text-white columnSort" id="orders" onclick="sortingData('orders');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:128px !important;padding-left:0px !important;padding-right:0px !important;">
                                    金額
                                </th>
                                <th class="text-white columnSort" id="orders_subject" onclick="sortingData('orders_subject');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:351px !important;padding-left:0px !important;padding-right:0px !important;">
                                    受注件名・発注件名
                                </th>
                                <th class="text-white columnSort" id="estimate_date" onclick="sortingData('estimate_date');"
                                    style="border-bottom:none !important;background: #363A81 !important;width:140px !important;padding-left:0px !important;padding-right:0px !important;">
                                    売上・発注日
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="line-title" style="height: 30px;background: white;margin-right: 1px;width:112px!important;">
                                    <input type="text" name="order_number" class="form-control"
                                        value="{{ isset($old['order_number']) ? $old['order_number'] : null }}"
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                                <td class="line-title" style="height: 30px;background: white;margin-right: 1px;width:158px;">
                                    <input type="text" class="form-control" name="person_name"
                                        value="{{ isset($old['person_name']) ? $old['person_name'] : '' }}" {{-- $tantousya->name ?? '' --}}
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                                <td class="line-title" style="height: 30px;background: white;margin-right: 1px;width:201px;">
                                    <input type="text" class="form-control" name="sold_to"
                                        value="{{ isset($old['sold_to']) ? $old['sold_to'] : null }}"
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                                <td class="line-title" style="height: 30px;background: white;margin-right: 1px;width:200px;">
                                    <input type="text" class="form-control" name="end_customer"
                                        value="{{ isset($old['end_customer']) ? $old['end_customer'] : null }}"
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                                <td class="line-title" style="height: 30px;background: white;margin-right: 1px;width:128px;">
                                    <input type="text" class="form-control" name="orders"
                                        value="{{ isset($old['orders']) ? $old['orders'] : null }}"
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                                <td class="line-title" style="height: 30px;background: white;margin-right: 1px;width:351px;">
                                    <input type="text" class="form-control" name="orders_subject"
                                        value="{{ isset($old['orders_subject']) ? $old['orders_subject'] : null }}"
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                                <td class="line-title" style="height: 30px;background: white;width:140px; ">
                                    <input type="text" class="form-control" name="estimate_date"
                                        value="{{ isset($old['estimate_date']) ? $old['estimate_date'] : null }}"
                                        style="border: 1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </td>
                            </tr>

                            @foreach ($numberSearches as $key => $val)
                                <tr id="{{ $val->order_number }}" data-codename = "{{$val->codename_null_count}}"
                                    class="show_personal_master_info number_search_show">
                                    <input type="hidden" class="contain_deleted_item"
                                        value="{{ $val->contain_deleted_item ?? null }}">
                                    <td  style="width:112px;">{{ $val->order_number }}</td>
                                    <td style="width:158px;">{{ $val->person_name }}</td>
                                    <td style="width:201px;">{{ $val->sold_to }}</td>
                                    <td style="width:200px;">{{ $val->end_customer }}</td>
                                    <td style="width:128px;" class="text-right">
                                        {{ gettype($val->orders) == 'double ' ? number_format($val->orders, 2) : number_format($val->orders) }}
                                    </td>
                                    <td style="width:351px;">{{ mb_substr($val->orders_subject, 0, 20) }}</td>
                                    <td  style="width:140px;">{{ $val->estimate_date ? $val->estimate_date : null }}</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</form>
