<form id="userEditForm" action="{{ route('postEditEmployeeMaster',[$bango]) }}" method="post" data-editmethod="editUserDetail" onsubmit="editUserDetail('{{route("postEditEmployeeMaster",[$bango])}}');event.preventDefault();" enctype='multipart/form-data'>
  <!--==============================Modal 3 starts here ====================== -->
  <div class="modal" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      @csrf
      <input type="hidden" name="type" value="edit">
      <input type="hidden" id="hiddenBango" name="bango" value="">
      <input type="hidden" name="validate_only" value="1">
      <input type="hidden" id="def_datatxt004_e"/>
      <input type="hidden" id="def_datatxt005_e"/>
      <div class="modal-dialog custom-form" style="max-width: 900px !important;" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h6 class="modal-title" id="exampleModalLabel"></h6>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <div class="modal-body" data-bind="nextFieldOnEnter:true">

              </div>
              <div class="modal-footer"></div>
          </div>
      </div>
  </div>
</form>
