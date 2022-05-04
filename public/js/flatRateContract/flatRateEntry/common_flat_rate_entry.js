function loadPJData(bango,req_val){
    $.ajax({
        url : 'order-entry/sold-wise-pj-value/'+bango,
        data : {catchsm : req_val},
        success : function (res){
           $("#reg_datatxt0129").html(res)
        }
    })
}