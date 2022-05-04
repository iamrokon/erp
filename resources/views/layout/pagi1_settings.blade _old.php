<!-- new pagination row starts here -->


  <div class="col-lg-3 col-xl-2 col-md-4 col-sm-4">

    <div class="mt-2 mb-2" style="">
                    <table class="table_hover2_pagi  gridAlternada w_680">
                      <tbody><tr>
                        <td class="" style="padding-left:0px!important;">
                          <div class="pagi">
                <div class="nav_mview">

<nav aria-label="Page navigation example ">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous" onclick="gotoBack();">
        <span aria-hidden="true">«</span>
        <span class="sr-only">Previous</span> 
      </a>
    </li>
<li class="w_50 "><input type="text" name="page" id="paginate" class="form-control intLimitTextBox text-center font-weight-bold input_pagi" value="{{$current_page}}" style="padding: 6px;
    height: 35px!important;
    margin-top: 0px;border-left: 0px!important;"></li>

    <li class="page-item"><a class="page-link" href="#" onclick="goToPage();">=</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next" onclick="goForward()">
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
                    </tbody></table>

                  </div>
    </div>



<!-- new pagination row ends here -->
