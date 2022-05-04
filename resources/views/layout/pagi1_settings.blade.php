<div style="float: left; width: auto;">
  <table class="table_hover2_pagi gridAlternada w_680">
    <tbody>
      <tr>
        <td class="" style="padding-left:0px!important;">
          <div class="pagi">
            <div class="nav_mview">
              <nav aria-label="Page navigation example ">
                <ul class="pagination">
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Previous" onclick="gotoBack();" style="padding-top: 7px;">
                      <span aria-hidden="true">«</span>
                      <span class="sr-only">Previous</span>
                    </a>
                  </li>
                  <li class="w_50 ">
                    <input type="text" name="page" maxlength="9" id="paginate" onkeypress="return (event.charCode !=8 &amp;&amp; event.charCode ==0 || (event.charCode >= 48 &amp;&amp; event.charCode <= 57))" class="form-control intLimitTextBox text-center input_pagi" value="{{$current_page}}" style="margin-top: 0px;border-left: 0px!important;height:27px!important;">
                  </li>
                  <input type="hidden" id="paginationhelper" name="page" value="" disabled="disabled">
                  <li class="page-item">
                    <a class="page-link" href="#" onclick="goToPage();" style="padding-top: 7px;">=</a>
                  </li>
                  <li class="page-item">
                    <a class="page-link" href="#" aria-label="Next" onclick="goForward()" style="padding-top:7px;">
                      <span aria-hidden="true">»</span>
                      <span class="sr-only">Next</span>
                    </a>
                  </li>
                </ul>
              </nav>
            </div>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</div>