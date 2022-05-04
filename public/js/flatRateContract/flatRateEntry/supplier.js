function loadFlatRateDependantData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    $("#transaction_initial_val_status").val("");
    var information1_call_status = 'no';
    if (fillable_id == 'reg_information2') {
        var information1 = $("#reg_information1").val();
        var information3 = $("#reg_information3").val();
        var information6 = $("#reg_information6").val();
        if(information1 == ""){
            information1_call_status = 'yes'
            document.getElementById('reg_db_information1').value = torihikisaki_cd;
            document.getElementById('reg_information1').value = torihikisaki_details;
        }
        if(information3 == ""){
            document.getElementById('reg_db_information3').value = torihikisaki_cd;
            document.getElementById('reg_information3').value = torihikisaki_details;
        }
        if(information6 == ""){
            document.getElementById('reg_db_information6').value = torihikisaki_cd;
            document.getElementById('reg_information6').value = torihikisaki_details;
        }
    }
    
    if (fillable_id == 'reg_information1' || information1_call_status == 'yes') {
        var db_information1 = $("#reg_db_information1").val();
        db_information1 = db_information1 ?  db_information1.substr(0,6) : 0;
        if(db_information1){
          var bango = $("input[id='userId']").val();
          //load PJ pulldown data
          loadPJData(bango,db_information1);                
        }

        //not set initial value again if already set the initial value
        var initial_status = $("#initial_info2_status").val();
        if(initial_status == ""){
            $("#initial_info2_status").val(1);
            
            //set this value to maintenance_window
            var prevVal = $("#reg_maintenance_window").val();
            if(prevVal == ""){
                document.getElementById('reg_maintenance_window').value = torihikisaki_details;
                document.getElementById('db_reg_maintenance_window').value = torihikisaki_cd;
            }

            //set this value to delivery_destination
            var prevVal_2 = $("#reg_delivery_destination").val();
            if(prevVal_2 == ""){
                document.getElementById('reg_delivery_destination').value = torihikisaki_details;
                document.getElementById('db_reg_delivery_destination').value = torihikisaki_cd;
            }
        }

        //enable product selection button
        $('#productButton').prop("disabled", false);
        $('#splitButton').prop("disabled", false);
    }


    if (fillable_id == 'reg_information2') {
        //set initial value in transaction terms modal
        transactionTermsModalOpener(1,2);
    }
}






