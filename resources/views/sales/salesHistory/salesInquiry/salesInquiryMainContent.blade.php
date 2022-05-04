        <!-- Content bottom section start -->
        <div class="content-bottom-section">
          <div class="content-bottom-top">
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="bottom-top-title" style="letter-spacing: 0px;">
                    売　上　明　細
                  </div>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="data-wrapper-content" style="width: 100%;">
                    <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                      <div style="padding: 23px;">
                        行
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0" style="padding: 5px; width: 12%;">
                          商品CD
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 42%;">
                          商品名
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 13%;">
                          数
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 10%;">
                          単位
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0" style="padding: 5px; width: 10%;">
                          販売単価
                        </div>
                        <div class="data-box float-left border border-bottom-0" style="padding: 5px; width: 13%;">
                          販売金額
                        </div>
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border" style="padding: 5px; width: 54%;border-right: 0 !important; border-left: 0 !important;">
                          明細備考
                        </div>
                        <div class="data-box float-left border" style="padding: 5px; width: 23%;border-right: 0 !important;">
                          製品区分
                        </div>
                        <div class="data-box float-left border" style="padding: 5px; width: 23%;border-right: 0 !important;">
                          事業分類
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
              @foreach($salesInquiryInfo as $salesInquiryDetailInfo)
              <div class="row mt-2">
                <div class="col-12">
                  <div class="data-wrapper-content" style="width: 100%;">
                    <div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 59px;vertical-align: middle;border-radius: 5px 0px 5px;">
                      <div style="padding: 23px;">
                        {{ $salesInquiryDetailInfo->syouhinsyu }}-{{ $salesInquiryDetailInfo->hantei }}
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border border-bottom-0 border-right-0 border-left-0 text-left" style="padding: 5px; width: 12%;background: #e9ecef; min-height: 29px;">
                          {{ $salesInquiryDetailInfo->kawasename }}
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-left" style="padding: 5px; width: 42%;background: #e9ecef; min-height: 29px;">
                          {{ $salesInquiryDetailInfo->syouhinname }}
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-right" style="padding: 5px; width: 13%;background: #e9ecef; min-height: 29px;">
                          {{ $salesInquiryDetailInfo->syukkasu }}
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-left" style="padding: 5px; width: 10%;background: #e9ecef; min-height: 29px;">
                          {{ $salesInquiryDetailInfo->codename }}
                        </div>
                        <div class="data-box float-left border border-bottom-0 border-right-0 text-right" style="padding: 5px; width: 10%;background: #e9ecef; min-height: 29px;">
                          {{ number_format($salesInquiryDetailInfo->s_dataint04) }}
                        </div>
                        <div class="data-box float-left border text-right border-bottom-0" style="padding: 5px; width: 13%;background: #e9ecef; min-height: 29px;">
                          {{-- number_format($salesInquiryDetailInfo->dataint11) --}}
                          {{ number_format($salesInquiryDetailInfo->dataint04 * $salesInquiryDetailInfo->syukkasu) }}
                        </div>
                      </div>
                    </div>
                    <div class="data-box-content2 text-center orderentry-databox" style="width: 90%;float: left;">
                      <div style="width: 100%;float: left;">
                        <div class="data-box float-left border text-left" style="padding: 5px; width: 54%;border-right: 0 !important; border-left: 0 !important;background: #e9ecef; min-height: 30px;">
                          {{ $salesInquiryDetailInfo->datachar08 }}
                        </div>
                        <div class="data-box float-left border text-left" style="padding: 5px; width: 23%;border-right: 0 !important;background: #e9ecef; min-height: 30px;">
                          {{ $salesInquiryDetailInfo->category_detail1 }}
                        </div>
                        <div class="data-box float-left border text-left" style="padding: 5px; width: 23%;border-right: 0 !important;background: #e9ecef; min-height: 30px;">
                          {{ $salesInquiryDetailInfo->category_detail2 }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
              <div class="row">
                  <div class="col-12">
                      <div class="buttom-btn text-right mt-4">
                        @if($privileged_user)
                          <button onclick="updateSelectedSalesInquiryBango('{{route('updateSelectedSalesInquiry')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button">
                          登録</button>
                        @else
                        <button disabled onclick="updateSelectedSalesInquiryBango('{{route('updateSelectedSalesInquiry')}}',event.preventDefault())" type="submit" class="btn btn-info uskc-button">
                        登録</button>
                        @endif
                      </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Content bottom section end -->
