<div class="fullpage_width1" data-bind="nextFieldOnEnter:true">
    <div class="content-head-section">

        @php
            $old = [];
            if (session()->has('oldProductSub' . $bango)) {
                $old = session()->get('oldProductSub' . $bango);
            }
            $current_page = $others->currentPage();
            $per_page = $others->perPage();
            $first_data = ($current_page - 1) * $per_page + 1;
            $last_data = ($current_page - 1) * $per_page + sizeof($others->items());
            $total = $others->total();
            $lastPage = $others->lastPage();
        @endphp

        <div class="container">

            <form id="mainForm" action="{{ route('ProductSubMaster') }}" method="post">
                <input type="hidden" id="csrf" value="{{ csrf_token() }}" name="_token" disabled>
                @csrf
                <input type="hidden" name="Button" id="Button"
                    value="{{ isset($old['Button']) ? $old['Button'] : null }}">
                <input type="hidden" id="sortField" name="sortField"
                    value="{{ isset($old['sortField']) ? $old['sortField'] : null }}">
                <input type="hidden" id="sortType" name="sortType"
                    value="{{ isset($old['sortType']) ? $old['sortType'] : null }}">
                <input type="hidden" id="userId" name="userId" value="{{ $bango }}">
                <input id='innerlevel' value='{{ $tantousya->innerlevel }}' type='hidden' />
                <div class="row" style="margin-top: -22px;">
                    <div class="col-lg-12">
                        <div style="">
                            <div class="wrap-100"
                                style="background-color: #fff;box-sizing: border-box; overflow: hidden;height: auto;">

                                @if (Session::has('success_msg'))
                                    <div class="row" id="session_msg">
                                        <div class="col-12">
                                            <div class="alert alert-primary alert-dismissible mt-4 mb-0">
                                                <button type="button" class="close dismissMe" data-dismiss="alert"
                                                    autofocus style="background-color: white;"
                                                    onclick="$('.alert_focus').focus();">
                                                    &times;
                                                </button>
                                                <strong>{{ session()->get('success_msg') }}</strong>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (isset($exceedUser))
                                    <p style="color: red;">{{ $exceedUser }}</p>
                                @endif

                                {{-- Common Button Starts Here --}}
                                @include('layout.commonButton')
                                {{-- Common Button Ends Here --}}

                                {{-- Pagination Starts Here --}}
                                @include('master.productSub.pagination')
                                {{-- Pagination Ends Here --}}


                                <div class="row">
                                    <div class="col-lg-12">
                                        <div style="overflow: hidden;">
                                            <div id="userTable" class="table-responsive largeTable"
                                                style="padding-bottom: 10px;">
                                                <table class="table table-fill table-bordered table-striped">

                                                    <thead class="thead-dark header text-center" id="myHeader">
                                                        <tr>
                                                            <th scope="col"></th>
                                                            @foreach ($headers as $header => $field)
                                                                <th class="signbtn" scope="col">
                                                                    <span onclick="AscDsc('{{ $field }}');"
                                                                        style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 80px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{ $header }}</span>
                                                                </th>
                                                            @endforeach
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr>
                                                            <td></td>
                                                            @foreach ($headers as $header => $field)
                                                                <td>
                                                                    <input type="text" name="{{ $field }}"
                                                                        class="form-control"
                                                                        value="{{ isset($old[$field]) ? $old[$field] : null }}">
                                                                </td>
                                                            @endforeach
                                                        </tr>

                                                        @foreach ($others as $key => $val)
                                                            <tr>
                                                                <td style="width:50px;">
                                                                    <a href="#" id="empButton1"
                                                                        class="btn btn-info btn-m-view "
                                                                        style="width: 100%;"
                                                                        onclick="viewDetail('{{ route('ProductSubMasterDetail', [$bango]) }}','{{ $val->other25 }}');">
                                                                        <i class="fa fa-folder-open" aria-hidden="true"
                                                                            style="margin-right: 5px;"></i>詳細
                                                                    </a>
                                                                </td>
                                                                @foreach ($headers as $header => $field)
                                                                    @if (gettype($val->$field) == 'integer')
                                                                        <td style="text-align: right;">
                                                                            {{ $val->$field }}</td>
                                                                    @else
                                                                        <td>{{ $val->$field }}</td>
                                                                    @endif
                                                                @endforeach
                                                            </tr>
                                                        @endforeach

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content row ends here -->
                </div>
                <!-- row div ends -->
            </form>
        </div>
        <!-- container div end -->
    </div>
</div>

<script>
    // Focus on Alert Closing
    $(".dismissMe").keydown(function(e) {
        if (e.keyCode == 13) {
            $('.close').alert('close');
        }
        $('.alert_focus').focus();
    });

</script>
