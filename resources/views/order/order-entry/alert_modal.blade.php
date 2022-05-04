<!--============message modal =======-->
<div class="modal" data-keyboard="false" data-backdrop="static" id="messageModal" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 480px !important;" role="document">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: none;">
                <!-- <h6 class="modal-title" id="exampleModalLabel">商品説明マスタ(詳細)</h6> -->
                <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="tbl_name">
                            <div class="w-100">
                                <div class=" row row_data">
                                    <div class="col-lg-12 col-md-3 col-sm-3">
                                        <div><span class="modal-message"></span></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none;padding-top: 0px;">
                <button style="background: #2C66B0" type="button" class="btn btn-primary closeModal" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>
<!--============message modal End =======-->
<script>
    $(document).ready(function (){
        $(".closeModal").on("click",function (e){
            e.preventDefault();
            $("#messageModal").hide()
        })
    })
</script>
