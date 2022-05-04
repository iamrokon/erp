<form id="registrationForm" action="{{ route('postEditSeqNumberingMaster',[$bango]) }}" method="post"
  data-regmethod="registerSeqNumbering"
  onsubmit="registerSeqNumbering('{{route("postEditSeqNumberingMaster",[$bango])}}');event.preventDefault();">
  @csrf
  <input type="hidden" name="type" value="create">

  <div class="modal" data-keyboard="false" data-backdrop="static" id="registrationModal" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 700px !important;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body pt-0" data-bind="nextFieldOnEnter:true">
          <div class="development_page_top_table heading_mt" style="margin:11px;">

            {{-- Error Message Starts Here --}}
            <div class="row">
              <div id="error_data" style="margin-left: -12px !important;"></div>
            </div>
            {{-- Error Message Ends Here --}}

            <!-- #SI - code starts here -->
            <!-- Title with buttons start here -->
            <div class="row titlebr" style="margin-bottom: 15px;">
              <div class="col-6 pl-1">
                <table class="dev_tble_button" style="float: left;">
                  <tbody>
                    <tr class="marge_in">
                      <td class="" style="padding-left: 0px!important;width: 70px!important;">
                        <h5>SEQ番号付番マスタ(登録)</h5>
                        <div class="mt-3">変更(処理状況)</div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>

              <div class="col-6 pr-2">
                <div style="float: right;">
                  <button type="submit" class="btn btn-info" name="insert" id="regButton" autofocus="">
                    <i class="fas fa-save" style="margin-right: 5px;"></i>保存
                  </button>
                </div>
              </div>
            </div>
            <!-- Title with buttons ends here -->
            <!-- #SI - code ends here -->
          </div>


          <!--======================= modal 1 table start ======================-->
          <div id="input_boxwrap_seq1" class="input_boxwrap_seq1 custom-form ">
            <div class="row mt-1 mb-3">
              <div class="col-lg-12">
                <div class="tbl_name">
                  <div class="w-100">
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t ">
                          <span>番号区分<span style="color: red;">※</span></span>
                        </div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            <select name="kokyakusyouhinbango" id="reg_kokyakusyouhinbango" class="form-control" style="width: 100%;">
                              @foreach($cat1D7 as $ct1D7)
                              <option value="{{$ct1D7->category1}}{{$ct1D7->category2}}">
                                {{$ct1D7->category1}}{{$ct1D7->category2.' '}}{{$ct1D7->category4}}
                              </option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>番号<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            {{-- <input type="text" name="orderbango" id="reg_orderbango" class="form-control" value=""> --}}
                            <input name="orderbango" id="reg_orderbango" value="0" type="text" class="form-control">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class=" row row_data">
                      <div class="col-lg-3">
                        <div class="margin_t "><span>番号総桁数<span style="color: red;">※</span></span></div>
                      </div>
                      <div class="col-lg-9">
                        <div class="outer row">
                          <div class="col-lg-12 ">
                            {{-- <input type="text" name="mobile_flag" id="reg_mobile_flag" class="form-control" value=""> --}}
                            <input name="mobile_flag" id="reg_mobile_flag" type="text" class="form-control">
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
        <div class="modal-footer">

        </div>
      </div>
    </div>
  </div>
</form>