<div class="content-bottom-section" style="padding-bottom:46px!important;">
    <form id="mainForm" action="{{ route('depositHistory') }}" method="post">
      <input type="hidden" name="Button" id="Button" value="{{isset($old['Button'])?$old['Button']:null}}">
      <input type="hidden" id="sortField" name="sortField" value="{{isset($old['sortField'])?$old['sortField']:null}}">
      <input type="hidden" id="sortType" name="sortType" value="{{isset($old['sortType'])?$old['sortType']:null}}">
      <input type="hidden" id="userId" name="userId" value="{{$bango}}">
      <input type="hidden" id="csrf" value="{{csrf_token()}}" name="_token" disabled>
      @csrf
      @if(isset($fsReqData))
        @foreach($fsReqData as $k=>$v)
          <input type="hidden" value="{{$v}}" name="{{$k}}ReqVal">
        @endforeach
      @endif
        <div class="content-bottom-top" style="margin-top: 6px;">
          <div class="container">
            <div class="row">
              <div class="col">
                <div class="bottom-top-title">
                  入金履歴一覧
                </div>
              </div>
            </div>
          </div>
          <div class="content-bottom-pagination" >
            <div class="container">
              <div class="row">
                <div class="col">
                 <div class="wrapper-pagination" style="background-color:#fff;height:116px;padding: 10px;">
                   @include('sales.depositHistory.pagination')

                      <div class="row" style="margin-bottom: 30px;">
                        <div class="col-6">
                            <div class="row">
                                <div class="col">
                                    <table class="table custom-form" style="border: none!important;width: auto;">
                                        <tbody>
                                          <tr style="">
                                            <td style="width: 23px!important;padding: 0!important;border:0!important;">
                                              <div class="line-icon-box"></div>
                                            </td>
                                            <td style=" border: none!important;width: 60px!important;color: #000;font-weight: bold;    font-size: 0.9em;">入金金額計</td>
                                            <td style=" border: none!important;width: 15px!important;"></td>
                                            <td style=" border: none!important;width: 50%;color: #000;font-weight: bold;    font-size: 0.9em;">¥{{ number_format($total_deposit) }}</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <table class="table custom-form" style="border: none!important;width: auto;float:right;">
                                <tbody>
                                  <tr style="height: 28px;">
                                    <td style=" border: none!important;">
                                      <button type="button" onclick="Thesearch();" message="検索欄に入力した内容を検索します。"
                                        class="btn bg-teal uskc-button text-white" data-dismiss="modal"> 検　索
                                      </button>
                                    </td>
                                    <td style=" border: none!important;">
                                      <button type="button" onclick="refresh()" message="データを一覧表示します。"
                                        class="btn text-white bg-default uskc-button" data-dismiss="modal">
                                        <!-- <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> 一　覧
                                      </button>
                                    </td>
                                    @if($depositHistoryInfo->isEmpty())
                                    <td style=" border: none!important;">
                                      <button disabled type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button"
                                        data-dismiss="modal" style="background: #009640;">
                                        <!--  <i class="" aria-hidden="true" style="margin-right: 5px;"></i> --> Excelエクスポート
                                      </button>
                                    </td>
                                    @else
                                    <td style=" border: none!important;">
                                      <button type="button" id="excelDwld" onclick="excelDownload()" class="btn text-white uskc-button"
                                        data-dismiss="modal" style="background: #009640;"> Excelエクスポート
                                      </button>
                                    </td>
                                    @endif
                                  </tr>
                                </tbody>
                              </table>

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
            <div class="row mt-3" style="">
                <div class="col-lg-12">
                    <div class="wrapper-large-table" style="background-color:#fff;padding: 10px;">
                    <div>
                      <div class="table-responsive largeTable">
                        <table id="userTable" class="table table-bordered table-fill table-striped" style="margin-bottom: 20px!important;">
                          <thead class="thead-dark header text-center" id="myHeader">
                            <tr>
                              @foreach($headers as $header=>$field)
                              @if($field == "changer")
                              <th scope="col" class="signbtn"><span onclick="AscDsc('changer_short');"
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                              </th>
                              @elseif($field == "changer_2")
                              <th scope="col" class="signbtn"><span onclick="AscDsc('changer_2_short');"
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                              </th>
                              @else
                              <th scope="col" class="signbtn"><span onclick="AscDsc('{{$field}}');"
                                style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span>
                              </th>
                              @endif
                              @endforeach
                          </tr>
                          </thead>
                          <tbody>
                            <tr>
                              @foreach($headers as $header=>$field)
                              @if($field == "deposit_history_shinkurokokyakuname")
                              <td>
                                <input type="text" name="{{$field}}" class="form-control" value="{{isset($default_req_data[$field])?$default_req_data[$field]:null}}">
                              </td>
                              @elseif($field == "changer")
                              <td>
                                <input type="text" name="changer_short" class="form-control" value="{{isset($default_req_data['changer_short'])?$default_req_data['changer_short']:null}}">
                              </td>
                              @elseif($field == "changer_2")
                              <td>
                                <input type="text" name="changer_2_short" class="form-control" value="{{isset($default_req_data['changer_2_short'])?$default_req_data['changer_2_short']:null}}">
                              </td>
                              @else
                              <td>
                                <input type="text" name="{{$field}}" class="form-control" value="{{isset($default_req_data[$field])?$default_req_data[$field]:null}}">
                              </td>
                              @endif
                              @endforeach
                            </tr>
                          <!-- <tr>
                            <td><input type="text" class="form-control"></td>
                            <td><input type="text" class="form-control"></td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>
                            <td>
                              <input type="text" class="form-control">
                            </td>

                          </tr> -->
                          <!--      2nd row -->

                          @foreach($depositHistoryInfo as $key=>$val)
                          <tr>
                            @foreach($headers as $header=>$field)
                            @if($field=='deposit_history_nyukingaku' || $field=='deposit_history_shinkurokokyakugroup' || $field=='shinkurokokyakuorderbango')
                            <td class="text-right">{{ number_format($val->$field) }}</td>
                            @elseif($field=='information1_detail_show')
                            <td><?php echo mb_substr($val->$field,0,11); ?><?php if(mb_substr($val->$field,12)){echo "...";}?></td>
                            @elseif($field=='num_of_cor')
                            <td class="text-right">{{$val->$field}}</td>
                            @elseif($field=='changer')
                            <td>{{$val->changer_short}}</td>
                            @elseif($field=='changer_2')
                            <td>{{$val->changer_2_short}}</td>
                            @else
                            <td>{{$val->$field}}</td>
                            @endif
                            @endforeach
                          </tr>
                          @endforeach

                          <!-- <tr>

                              <td class="">YYYY/MM/DD
                              </td>
                              <td class="">1850999999
                              </td>
                              <td class="">1
                              </td>
                              <td>0</td>
                              <td>02 振込</td>
                              <td>ジョイアスフーズ本社システム</td>
                              <td class="text-right">1,319,120</td>
                              <td>YYYY/MM/DD</td>
                              <td>三井住友銀行</td>
                              <td>御堂筋支店</td>
                              <td>2020年7月売上分</td>
                              <td></td>
                              <td></td>
                              </tr> -->



                          </tbody>
                          </table>
                          </div>
                          </div>
                          </div>
                          </div>

                        </div>



          </div>
        </div>
      </form>
      </div>
