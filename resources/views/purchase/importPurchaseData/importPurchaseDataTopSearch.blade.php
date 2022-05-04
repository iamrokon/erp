<form method="post" action="{{route('importCSV')}}" id="import_csv" enctype='multipart/form-data'>
    <input type="hidden" id="fs_userId" name="userId" value="{{$bango}}">
    <input id='submit_confirmation' value='' type='hidden' />
    @csrf
    <div class="row import-purchase-purchase-data">
        <div class="col-12">
            <div class="row row_data" style="padding-top: 0px;">
                <div class="col-1">
                        <div style="margin-top: 5px;">
                          <span style="font-size: 0.8rem;"><div class="line-icon-box float-left mr-3" style="margin-top: 4px;"></div>ファイル</span>
                        </div>
                </div>
                <div class="col-6">
                        <div class="outer row">
                          <div class="col-12">
                                <div style="float: left;width: 70%;">
                                  <input name="yobi13" placeholder="（フォルダー名＋ファイル名）" id="order_data_input" type="text" class="input_field form-control" autofocus style="border:1px solid #E1E1E1 !important;border-radius: 4px !important;">
                                </div>
                                <div style="float: left;width: 26%;margin-left: 2%;">
                                  <div class="custom-file mb-3">
                                        <input type="file" class="custom-file-input" id="customFileOrder" name="filename">
                                        <a style="height: 30px;" class="btn btn-info" href="#"> <label for="customFileOrder"><i class="fa fa-search" aria-hidden="true" style="margin-right: 5px;"></i>参照</label></a>
                                  </div>
                                </div>
                          </div>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="ml-3 mr-3 d-flex mt-2 w-100 justify-content-end">
                  <div>
                        <button onclick="importCSV('{{route('importCSV')}}',event.preventDefault())" type="submit" id="contenthide" href="#" class="btn btn-info uskc-button">CSVインポート
                        </button>
                  </div>
                  <div class="loading-icon" style="">
                        <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
                  </div>
                </div>
            </div>
        </div>
    </div>
</form>