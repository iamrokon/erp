<div class="row">
    <div class="col-7">
        <div class="pagi-content mt-3">
            <table>
                <tbody>
                <tr>
                    @if(isset($data) && $data->lastPage() > 1)
                        @include('layout.pagination_new.pagination_new1')
                    @endif

                    @include('layout.pagination_new.pagination_new2')

                    @if(isset($data) && $data->total() > 0)
                        @include('layout.pagination_new.pagination_new3')
                    @endif

                    @include('layout.pagination_new.pagination_new4')
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-5">
        <div class="right-pagi mt-3 mb-3 float-lg-right float-sm-left">
            <table>
                <tbody>
                <tr>
                    {{--@if(isset($old['pagination']))
                        <input value="old{{$old['pagination']}}">
                    @elseif(isset($pagi))
                        <input value="pagi{{$pagi}}">
                        @endif--}}
                    @include('layout.pagination_new.pagination_new5')
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Pagination Starts Here -->
{{-- <div class="row">
                    <div class="col-7">
                      <div class="pagi-content mt-3">
                        <table>
                          <tbody>
                            <tr>
                              @if($orderHistory2Info->lastPage() > 1)
                                @include('layout.pagination_new.pagination_new1')
                              @endif
                              @include('layout.pagination_new.pagination_new2')
                              @if($orderHistory2Info->total() > 0)
                                @include('layout.pagination_new.pagination_new3')
                              @endif
                              @include('layout.pagination_new.pagination_new4')
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <div class="col-5">
                      <div class="right-pagi mt-3 mb-3 float-lg-right float-sm-left">
                        <table>
                          <tbody>
                            <tr>
                              @include('layout.pagination_new.pagination_new5')
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> --}}

{{-- <div class="row">
                    <div class="col-7">
                      <div class="pagi-content mt-3">
                       <table>
                         <tbody>
                           <tr>
                            @if($orderHistory2Info->lastPage() > 1)
                              @include('layout.pagination_new.pagination_new1')
                            @endif

                            @include('layout.pagination_new.pagination_new2')
                            @if($orderHistory2Info->total() > 0)
                            @include('layout.pagination_new.pagination_new3')
                            @endif
                            @include('layout.pagination_new.pagination_new4')
                           </tr>
                         </tbody>
                       </table>
                       </div>
                    </div>
                    <div class="col-5">
                      <div class="right-pagi mt-3 mb-3 float-lg-right float-sm-left">
                        <table>
                          <tbody>
                              <tr>
                                @include('layout.pagination_new.pagination_new5')
                              </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div> --}}


{{-- <div class="col-7">
                      <div class="pagi_main_wrap">
                        <div class="pagi_inner_wrap">
                          @if($orderHistory2Info->lastPage() > 1)
                          <div class="pagi_left_div">
                            @include('layout.pagination_new.pagination_new1')
                          </div>
                          @endif
                          <div class="pagi_midd_div">
                            @include('layout.pagination_new.pagination_new2')
                            @if($orderHistory2Info->total() > 0)
                            @include('layout.pagination_new.pagination_new3')
                            @endif
                            @include('layout.pagination_new.pagination_new4')
                          </div>
                          <div class="right_colset">
                            @include('layout.pagination_new.pagination_new5')
                          </div>
                        </div>
                      </div>
                    </div> --}}

<!-- </div> -->
<!-- Pagination Ends Here -->
