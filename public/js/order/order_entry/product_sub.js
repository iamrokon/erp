$(document).ready(function () {
    $(document).on('click', '.product_sub_modal_opener', function (e) {
        e.preventDefault();
        $("#default").val("");
        $("#productSubValue").val("");
        var bango = $("input[id='userId']").val();
        var productCd = $(this).parents(".line-form").find(".productCd").val();
        $("#productCD").val(productCd);

        //reset product sub info
        resetProSubInfo();

        $('#selectProductSub').prop('disabled', true)
        var subCd = $(this).parents('.input-group').find('.productSubCd').attr("id")
        var subName = $(this).parents('.input-group').find('.productSubName').attr("id")

        var prevValue = $("#"+subCd).val();

        $("input[id=targetProductSubField]").val(subCd)
        $("input[id=targetProductSubNameField]").val(subName)
        if(productCd){
            $.ajax({
                url: 'order-entry/product-sub-wise-product-detail/' + bango,
                type: 'POST',
                data: {
                    product_sub_value: $('#productSubValue').val(),
                    productCd: productCd,
                    default: 1
                },
                success: function (response) {
                    console.log({response})
                    if(response.data){
                        if(response.data.length>0){
                           $('#insert_product_sub').html(response.html)
                            $("#initial_content_product_sub").show();

                            $("#insert_product_sub_detail").show();
                            $('#productSubModal').modal("show")

                            if(prevValue != ""){
                                prevValue = prevValue.replace(/\s/,'')
                                $("#"+prevValue).click();
                            }

                        }else{
                            var modal_message = $('#messageModal').find(".modal-message");
                            modal_message.text('')
                            var errorMsg = "この商品にはサブ区分が設定されていません。";
                            modal_message.text(errorMsg)
                            $('#messageModal').show()
                        }

                    }else{
                        var modal_message = $('#messageModal').find(".modal-message");
                        modal_message.text('')
                        var errorMsg = "この商品にはサブ区分が設定されていません。";
                        modal_message.text(errorMsg)
                        $('#messageModal').show()
                    }

                }
            });
        }else {
            var modal_message = $('#messageModal').find(".modal-message");
            modal_message.text('')
            var errorMsg = "この商品にはサブ区分が設定されていません。";
            modal_message.text(errorMsg)
            $('#messageModal').show()
        }


    })

    $(document).on('click', '#product_sub_search', function (e) {
        //$("#insert_product_sub_detail").hide();
        var bango = $("input[id='userId']").val();
        var productCd = $("#productCD").val();
        e.preventDefault();

        //reset product sub info
        resetProSubInfo();

        var defaultVal = $("#default").val();
        if (defaultVal == 'yes') {
            defaultVal = 1;
            $("#default").val("")
        } else {
            defaultVal = 2
        }

        $.ajax({
            url: 'order-entry/product-sub-wise-product-detail/' + bango,
            type: 'POST',
            data: {
                product_sub_value: $('#productSubValue').val(),
                productCd: productCd,
                default: defaultVal
            },
            success: function (response) {
                $('#insert_product_sub').html(response.html)
                $("#initial_content_product_sub").show();
            }
        });

    });

    $("#closeProductSub").on('click', function () {
        $("#default").val('yes');
        $("#productSubValue").val("");
        $("#product_sub_search").click();
        $("#productSubModal").modal('hide');
    });

//    $("#productSubModal").on('hide.bs.modal', function () {
//        $("#initial_content_product_sub").hide();
//        $("#product_sub_content2").hide();
//        $("#personal_master_content_div").hide();
//        $("#office_content_div_last").hide();
//
//        if ($(".product_sub_name").hasClass("add_border")) {
//            $(".product_sub_name").removeClass('add_border');
//        }
//    })

    $(document).on('click', '.product_sub_name', function (e) {
        var bango = $("input[id='userId']").val();
        e.preventDefault();
        var order_id = $(this).find("td").eq(0).html();
        var order_name = $(this).find("td").eq(1).html();
        $("#productSubModal").find('.product_sub_name').each(function () {
            $(this).hasClass('add_border') ? $(this).removeClass('add_border') : ''
        })
        $(this).addClass("add_border");
        console.log(order_id, order_name);
        $('#selectProductSub').prop('disabled', false)
        $.ajax({
            url: 'order-entry/product-sub-wise-product-detail/' + bango,
            type: 'POST',
            data: {
                order_id: order_id,
                order_name: order_name,
                type: true
            },
            success: function (response) {
                console.log(response);
                $("#product_sub_cd").html(response.product_sub_cd);
                $("#product_sub_name").html(response.product_sub_name);
                $("#suppliers").html(response.suppliers);
                $("#data_type").html(response.data_type);
                $("#version").html(response.version);
                $("#other_create_date").val(response.create_date);
                $("#other_update_date").val(response.update_date);
                //$('#insert_product_sub_detail').html(response.html)
                //$("#insert_product_sub_detail").show();
            }
        });
    })

    function resetProSubInfo() {
        $("#product_sub_cd").html("");
        $("#product_sub_name").html("");
        $("#suppliers").html("");
        $("#data_type").html("");
        $("#version").html("");
        $("#other_create_date").val("");
        $("#other_update_date").val("");
    }

    $(document).on("click", "#selectProductSub", function (e) {
        e.preventDefault();
        var targetProductSub = $(this).parents('.modal-body').find('.add_border ');
        var product_sub_cd = targetProductSub.find("td:first").text()
        var product_sub_name = targetProductSub.find("td").eq(1).text()
        var targetElm1 = $("input[id=targetProductSubField]").val();
        var targetElm2 = $("input[id=targetProductSubNameField]").val();
        var product_sub_detail = product_sub_cd + " " + product_sub_name
        //$('#' + targetElm1).val(product_sub_cd);
        $('#' + targetElm1).val(product_sub_detail);
        $('#' + targetElm2).val(product_sub_name);
        $('.productSubViewOpener').prop("disabled", false);
        $("#productSubModal").modal("hide")
    })
     $(document).on("click", "#clearProductSub", function (e) {
        e.preventDefault();
        var targetElm1 = $("input[id=targetProductSubField]").val();
        var targetElm2 = $("input[id=targetProductSubNameField]").val();
        $('#' + targetElm1).val('');
        $('#' + targetElm2).val('');
        $('.productSubViewOpener').prop("disabled", false);
        $("#productSubModal").modal("hide")
    })


})
$('#productSubViewModal').on('show.bs.modal', function (e) {
    $('body').addClass('overflow_cls');
    $("#productSubViewModal").css('overflow', 'hidden');

})
