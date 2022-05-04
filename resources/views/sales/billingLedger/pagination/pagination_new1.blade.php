<td class="pr-2" style="padding-left:0px!important;border: none !important;" id="billing_ledger_0408_pagination_header_html_pagination_new1">
  <div class="pagi" style="float: left;">
    <div class="nav_mview">
      <nav aria-label="Page navigation example ">
        <ul class="pagination">
          <li class="page-item" style="padding-right: 3px;">
            <a class="page-link" href="#" aria-label="Previous" onclick="gotoBack();" style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color:white !important;">
              <span aria-hidden="true">«</span>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="w_50">
            <input type="text" name="page" id="paginate" maxlength="9" class="form-control intLimitTextBox text-center input_pagi" value="{{$current_page}}" style="margin-top: 0px;height: 27px!important;border-radius: 4px!important;" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))">
          </li>
          <input type="hidden" id="paginationhelper" name="page" value="" disabled="disabled">
          <li class="page-item" style="padding-left: 3px!important;">
            <a class="page-link" href="#" onclick="goToPage();" style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;;border-radius: 4px!important;color: white !important;">=</a>
          </li>
          <li class="page-item" style="padding-left: 3px!important;">
            <a class="page-link" href="#" onclick="goForward()" aria-label="Next" style="padding-top:7px;border: 1px solid #2C66B0!important;background: #2C66B0 !important;border-radius: 4px!important;color: white !important;">
              <span aria-hidden="true">»</span>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</td>
