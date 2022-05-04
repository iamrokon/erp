$(document).ready(function () {
    $('#delicustomRadio2').prop('checked',true);
    $('#deliveryDesitanationModalName').val("");
    $('#deliveryDesitanationModalName').prop('disabled',true);
})
$(document).on('click', '#deliveryDestinationModal', function (e) {
    e.preventDefault();
    // $('#destinationSelect').prop('disabled', true)
    
    $('input:radio[name=delrd]').change(function() {
        if (this.value == 'Yes') {
            var charge = $('#houseEntryCharge').val();
            console.log(charge);
            $('#deliveryDesitanationModalName').val(charge);
            $('#deliveryDesitanationModalName').prop('disabled',false);
        }
        else if (this.value == 'No') {
            $('#deliveryDesitanationModalName').val("");
            $('#deliveryDesitanationModalName').prop('disabled',true);
        }
    });
    $("#id_of_delivery").remove();
    var id = $(this).parents(".line-form").attr("id");
    var houseEntry = $("#" + id).find('.houseEntry').val() ?? null;
    var comment = $("#" + id).find('.comment').val() ?? null;
    $("#delivery_destination_Modal").append('<input name="id_of_delivery" type="hidden" id="id_of_delivery" value="' + id + '">')
    // console.log(id);
    // console.log(comment);
    var db = $("#" + id).find('.deliveryDestination').val();
    if(db){
        var db_1 = $("#" + id).find('.deliveryDestination_db').val();
        $('#deliveryDest').val(db);
        $('#deliveryDest_db').val(db_1);
    }
    if(houseEntry){
        $('#deliveryDesitanationModalName').val(houseEntry);
    }
    if(comment){
        console.log(comment);
        $('#comment2').text('');
        $('#comment2').html(comment);
    }
    $('#delivery_destination_Modal').modal("show");
    if($('#deliveryDest').val()){
        $('#destinationSelect').prop('disabled', false)
    }
})

$(document).on('click', '#destinationSelect', function(e){
    e.preventDefault();
    var deliveryDest_db = $('#deliveryDest_db').val();
    var deliveryDest= $('#deliveryDest').val();
    var houseEntry = $('#deliveryDesitanationModalName').val() ?? null;
    var comment = $('#comment2').val() ?? "";
    var LineBranchParent = $("#id_of_delivery").val()
    // $('body').find('.line-form').each(function (index) {
    //     $(this).find('.deliveryDestination').val(deliveryDest);
    // })
    console.log($("#" + LineBranchParent).find('.deliveryDestination').attr('id'));
    $("#" + LineBranchParent).find('.deliveryDestination').val(deliveryDest);
    $("#" + LineBranchParent).find('.deliveryDestination_db').val(deliveryDest_db);
    $("#" + LineBranchParent).find('.houseEntry').val(houseEntry);
    $("#" + LineBranchParent).find('.comment').text(comment);
    // When Tax Rate calculate from delivery destination DB
    // setRateField(deliveryDest_db, LineBranchParent);
    $('#delivery_destination_Modal').modal('hide');
})

function setRateField(contractorId = '', ref=''){
    var contractorId = $('#deliveryDestination_db').val() ? $('#deliveryDestination_db').val() : contractorId;
    var bango = $("input[id='userId']").val();
    console.log({contractorId})
    if (contractorId) {
        $.ajax({
            url: '/hatchu-nyuryoku/contact-wise-trading-condition-value/' + bango,
            data: {contractorId: contractorId},
            success: function (response) {
                console.log(response);
                // console.log(from);
                const {siharaikazeikubun, siharaizeihasuukubun} = response;
                var siharaikazeikubunValue = siharaikazeikubun ? siharaikazeikubun[0].category1 + siharaikazeikubun[0].category2 : '';
                var siharaizeihasuukubunValue = siharaizeihasuukubun ? siharaizeihasuukubun[0].category2 + ' ' + siharaizeihasuukubun[0].category4 : '';
                if(ref){
                    $("#" + ref).find('.siharaikazeikubun').val(siharaikazeikubunValue).change();
                    $("#" + ref).find('.siharaizeihasuukubun').val(siharaizeihasuukubunValue);
                    calculatePriceInLine(ref);
                }else{
                    taxRateFieldSet(siharaikazeikubunValue, siharaizeihasuukubunValue);
                }
            }
        })
    }
}