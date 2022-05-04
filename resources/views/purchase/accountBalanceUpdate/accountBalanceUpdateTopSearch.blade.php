<form id="mainForm" action="{{ route('accountBalanceUpdate') }}" method="post">
    <input type="hidden" name="Button" id="Button" value="register">
    <input type="hidden" id="userId" name="userId" value="{{$bango}}">
    <input id='submit_confirmation' value='' type='hidden'/>
    @csrf
    <div class="row account_balance_update_top">
      <div class="col custom-form">
        <div class="input-group input-group-sm">
          <div style="color: #000;width: 250px;line-height: 28px;">買掛残高更新</div>
          <div style="display: inline-flex; position: relative;">
            <button onclick="registerAccountBalance('{{route('accountBalanceUpdate')}}',event.preventDefault())" type="submit" id="contenthide" class="btn text-white  uskc-button" autofocus
              style="border-top-right-radius: 4px !important;border-bottom-right-radius: 4px !important;background:#2B66B1;">実行</button>
            <div class="loading-icon" style="display: none;">
              <span style="font-size: 30px;"><i class="fa fa-spinner" aria-hidden="true"></i></span>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>