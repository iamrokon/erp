$("#msgDiv").empty();

var dyappend='';

$("#topSearchBtn").click(function (){
    $("#msgDiv").empty();
    $("#dateFrom,#dateTo,#customerLedgerSupplier").removeClass("error");
    var datepickerFromVal= $("#dateFrom").val();
    var datepickerToVal= $("#dateTo").val();
    var customerLedgerSupplierDbVal= $("#customerLedgerSupplier_db").val();
    // alert(datepickerFromVal,datepickerToVal,customerLedgerSupplierDbVal);
    console.log(datepickerFromVal,datepickerToVal,customerLedgerSupplierDbVal)

    if (!datepickerFromVal && !datepickerToVal){
        if (!customerLedgerSupplierDbVal){
            dyappend='<p>【年月1】必須項目に入力がありません。</p>' +
                '<p>【年月2】必須項目に入力がありません。</p>' +
                '<p>【売上請求先】必須項目に入力がありません。</p>';
            $("#msgDiv").append(dyappend);
            $("#dateFrom,#dateTo,#customerLedgerSupplier").addClass("error");
        }
        else {
            dyappend='<p>【年月1】必須項目に入力がありません。</p>' +
                '<p>【年月2】必須項目に入力がありません。</p>' ;
            $("#msgDiv").append(dyappend);
            $("#dateFrom,#dateTo").addClass("error");
        }

    }
    else if (!datepickerFromVal && datepickerToVal){
        if (!customerLedgerSupplierDbVal){
            dyappend='<p>【年月1】必須項目に入力がありません。</p>' +
                '<p>【売上請求先】必須項目に入力がありません。</p>';
            $("#msgDiv").append(dyappend);
            $("#dateFrom,#customerLedgerSupplier").addClass("error");
        }
        else {
            dyappend='<p>【年月1】必須項目に入力がありません。</p>' ;
            $("#msgDiv").append(dyappend);
            $("#dateFrom").addClass("error");
        }
    }
    else if (datepickerFromVal && !datepickerToVal) {
        if (!customerLedgerSupplierDbVal){
            dyappend='<p>【年月2】必須項目に入力がありません。</p>' +
                '<p>【売上請求先】必須項目に入力がありません。</p>';
            $("#msgDiv").append(dyappend);
            $("#dateTo,#customerLedgerSupplier").addClass("error");
        }
        else {
            dyappend='<p>【年月2】必須項目に入力がありません。</p>' ;
            $("#msgDiv").append(dyappend);
            $("#dateTo").addClass("error");
        }
    }
    else if (datepickerFromVal && datepickerToVal){
        // console.log("2ta value ase")
        var datepickerFromValWithoutSlash=datepickerFromVal.replace(/\//g, '');
        var datepickerToValWithoutSlash=datepickerToVal.replace(/\//g, '');
        /*console.log(datepickerFromValWithoutSlash > datepickerToValWithoutSlash,
            datepickerFromValWithoutSlash > datepickerToValWithoutSlash ,
            datepickerFromValWithoutSlash <= datepickerToValWithoutSlash ,
            datepickerFromValWithoutSlash <= datepickerToValWithoutSlash )*/
        if ((datepickerFromValWithoutSlash > datepickerToValWithoutSlash) && !customerLedgerSupplierDbVal){
            console.log("date thik nai && company missing")
            dyappend= '<p> 【年月】正しい年月日を入力してください。</p>' +
                      '<p>【売上請求先】必須項目に入力がありません。</p>';
            $("#msgDiv").append(dyappend);
            $("#dateFrom,#dateTo,#customerLedgerSupplier").addClass("error");
        }
        else if ((datepickerFromValWithoutSlash > datepickerToValWithoutSlash) && customerLedgerSupplierDbVal){
            // console.log("date thik nai kintu company ase")
            dyappend='<p> 【年月】正しい年月日を入力してください。</p>';
            $("#msgDiv").append(dyappend);
            $("#dateFrom,#dateTo").addClass("error");
        }
        else if ((datepickerFromValWithoutSlash <= datepickerToValWithoutSlash) && !customerLedgerSupplierDbVal){
            // console.log("date thik ase kintu company missing")
            dyappend='<p>【売上請求先】必須項目に入力がありません。</p>';
            $("#msgDiv").append(dyappend);
            $("#customerLedgerSupplier").addClass("error");
        }
        else if ((datepickerFromValWithoutSlash <= datepickerToValWithoutSlash) && customerLedgerSupplierDbVal){
            // console.log("3ta value thik ase")
            $("#msgDiv").empty();
            $("#dateFrom,#dateTo,#customerLedgerSupplier").removeClass("error");
            document.getElementById('topSearch').submit();
        }
    }
});

function loadCustomerLedgerSupplierData(fillable_id,db_fillable_id,torihikisaki_cd,torihikisaki_details){
    if (torihikisaki_cd){
        $("#customerLedgerSupplierDbHiddenVal").val(torihikisaki_cd);
    }
    else {
        $("#customerLedgerSupplierDbHiddenVal").val();
    }
    // console.log(torihikisaki_cd);
    /*if (dyappend && dyappend == '<p> 【年月】必須項目に入力がありません。</p><p>【売上請求先】必須項目に入力がありません。</p>'){
        $("#msgDiv").empty();
        dyappend='<p> 【年月】必須項目に入力がありません。</p>';
        $("#msgDiv").append(dyappend);
        $("#customerLedgerSupplier").removeClass("error");
    }
    else if(dyappend && dyappend == '<p>【売上請求先】必須項目に入力がありません。</p>'){
        $("#msgDiv").empty();
        dyappend='';
        $("#customerLedgerSupplier").removeClass("error");
    }*/
}
