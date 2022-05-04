
function shippingInstrationDetails(shipping_arr){
    var shippingObj = JSON.parse(shipping_arr);
    console.log(shippingObj);

    if(shippingObj.datachar07 != null){
        $("#detail_datachar07").text(shippingObj.datachar07);
    }else{
        $("#detail_datachar07").text("");
    }

    if(shippingObj.datachar09 != null){
        $("#detail_datachar09").val(shippingObj.datachar09);
    }else{
        $("#detail_datachar09").text("");
    }

    if(shippingObj.datachar15 != null){
        $("#detail_datachar15").val(shippingObj.datachar15);
    }else{
        $("#detail_datachar15").text("");
    }

    if(shippingObj.datachar16 != null){
        $("#detail_datachar16").val(shippingObj.datachar16);
    }else{
        $("#detail_datachar16").text("");
    }

    if(shippingObj.datachar17 != null){
        $("#detail_datachar17").val(shippingObj.datachar17);
    }else{
        $("#detail_datachar17").text("");
    }

    if(shippingObj.datachar08 != null){
        $("#detail_datachar08").text(shippingObj.datachar08);
    }else{
        $("#detail_datachar08").text("");
    }
    
    if(shippingObj.datachar21 != null){
        $("#detail_datachr21").val(shippingObj.datachar21);
    }else{
        $("#detail_datachr21").val("");
    }

    $("#shippingInstrationModal").modal('show');
}


function formatNumber(num) {
    if (num == null || num == '') {
        return null;
    } else {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
}
