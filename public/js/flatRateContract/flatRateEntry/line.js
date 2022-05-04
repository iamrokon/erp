function addProductLine(){
    //reset line div
    $("#line-main-div").empty();
    
    var temp_datatxt0111 = $("#reg_datatxt0111").val();
    var temp_datatxt0110 = $("#reg_datatxt0110").val();
    if((temp_datatxt0111 == 2 || temp_datatxt0111 == 3) && temp_datatxt0110 == ""){
        $('#contract_number_grp').addClass("error");
        var temp_html = '<p style="color:red;font-size: 12px;margin-bottom: 8px;">定期定額契約番号を入力してください。</p>';
        $('#error_data').html(temp_html);
        return false;
    }else{
        $('#reg_datatxt0110').removeClass("error");
    }
    
    validateBeforeSubmit();
    var first_validation = $("#first_validation").val();
    if(first_validation == 'ng'){
        $('#regButton').prop("disabled", true);
        return false;
    }
    $('#regButton').prop("disabled", false);
    
    var date0004 = $("#datepicker2_oen").val();
    var date0005 = $("#datepicker3_oen").val();
    
    var temp_numeric8 = $("#reg_numeric8").val();
    var temp_numeric9 = $("#reg_numeric9").val();
    
    //count month from given date range
    var startMonth = date0004.substr(5,2);
    var endMonth = date0005.substr(5,2);
    //var no_of_line =  moment(date0005, "YYYY/MM").diff(moment(date0004, "YYYY/MM"), 'months')+1;
    var no_of_line =  parseInt(temp_numeric8) - parseInt(temp_numeric9);
    
    //billing month
    var numeric1 = $("#reg_numeric1").val();
    var datatxt0121 = $("#reg_datatxt0121").val();
    var billing_month = (datatxt0121/10)-1;
    
    var information1 = $("#reg_db_information1").val();
    var contract_number = $("#temp_datatxt0110").val();
    var product_code = $("#reg_kawasename").val();
    var modified_date0004 = date0004+"分";
    var quanty = $("#reg_syukkasu").val();
    var temp_money2 = $("#reg_money2").val();
    var temp_money4 = $("#reg_money4").val();
    var temp_money5 = $("#reg_money5").val();
    var temp_money6 = $("#reg_money6").val();
    var temp_money7 = $("#reg_money7").val();
    var temp_money8 = $("#reg_money8").val();
    var split_line = $("#reg_numeric10 :selected").val();
    var sub_split_line = no_of_line/split_line;
    var i;
    var j;
    var k = 1;
    var html = "";
    
    //====== get percentage & format status(round or floor or ceil) for tax calculation starts here =======//
    var bango = $("input[id='userId']").val();
    var soukobango = "";
    var nested_soukobango = "";
    var percentage = "";
    var format_status = "";
    var billing_tax_classification = $("#hiddenOtodoketime").val();
    $.ajax({
         type: 'post',
         headers: {'X-CSRF-TOKEN': $('#csrf').val()},
         url: "flat-rate-entry/calculateTaxRate/" + bango,
         async: false,
         data: "information1="+information1+"&billing_tax_classification="+billing_tax_classification,
         success:function(result){
            console.log(result);
            percentage = result.percentage;
            format_status = result.format_status;
         }
     });
    //====== get percentage & format status(round or floor or ceil) for tax calculation ends here =======//
    
    //calculate money3
    var money3 = (commaReplace(temp_money2)*percentage)/100;
    money3 = checkRoundFloorCeil(money3,format_status);
    $("#reg_money3").val(money3);
    
    if(split_line>1){
        //================= part1 starts here, when cycle>1 =================//
        //calculate money2
        var temp_no_of_line = no_of_line/split_line;
        var money2 = commaReplace(temp_money2)/temp_no_of_line;
        console.log(no_of_line);
        if(isFloat(money2)){
            money2 = checkRoundFloorCeil(money2,'round');
            money2 = money2/quanty;
            money2 = checkRoundFloorCeil(money2,'round');
            money2 = money2*quanty;
        }
        soukobango = (commaReplace(money2)*percentage)/100;
        soukobango = checkRoundFloorCeil(soukobango,format_status);

        //calculate money4
        var money4 = commaReplace(temp_money4)/temp_no_of_line;
        if(isFloat(money4)){
            money4 = checkRoundFloorCeil(money4,'round');
            money4 = money4/quanty;
            money4 = checkRoundFloorCeil(money4,'round');
            money4 = money4*quanty;
        }

        //calculate money5
        var money5 = commaReplace(temp_money5)/temp_no_of_line;
        if(isFloat(money5)){
            money5 = checkRoundFloorCeil(money5,'round');
            money5 = money5/quanty;
            money5 = checkRoundFloorCeil(money5,'round');
            money5 = money5*quanty;
        }

        //calculate money6
        var money6 = commaReplace(temp_money6)/temp_no_of_line;
        if(isFloat(money6)){
            money6 = checkRoundFloorCeil(money6,'round');
            money6 = money6/quanty;
            money6 = checkRoundFloorCeil(money6,'round');
            money6 = money6*quanty;
        }

        //calculate money7
        var money7 = commaReplace(temp_money7)/temp_no_of_line;
        if(isFloat(money7)){
            money7 = checkRoundFloorCeil(money7,'round');
            money7 = money7/quanty;
            money7 = checkRoundFloorCeil(money7,'round');
            money7 = money7*quanty;
        }

        //calculate money8
        var money8 = commaReplace(temp_money8)/temp_no_of_line;
        if(isFloat(money8)){
            money8 = checkRoundFloorCeil(money8,'round');
            money8 = money8/quanty;
            money8 = checkRoundFloorCeil(money8,'round');
            money8 = money8*quanty;
        }
        //================= part1 ends here =================//
    }else{
        //================= part1 starts here when cycle=1 =================//
        //calculate money2
        var money2 = commaReplace(temp_money2)/no_of_line;
        console.log(no_of_line);
        if(isFloat(money2)){
            money2 = checkRoundFloorCeil(money2,'round');
            money2 = money2/quanty;
            money2 = checkRoundFloorCeil(money2,'round');
            money2 = money2*quanty;
        }
        soukobango = (money2*percentage)/100;
        soukobango = checkRoundFloorCeil(soukobango,format_status);

        //calculate money4
        var money4 = commaReplace(temp_money4)/no_of_line;
        if(isFloat(money4)){
            money4 = checkRoundFloorCeil(money4,'round');
            money4 = money4/quanty;
            money4 = checkRoundFloorCeil(money4,'round');
            money4 = money4*quanty;
        }

        //calculate money5
        var money5 = commaReplace(temp_money5)/no_of_line;
        if(isFloat(money5)){
            money5 = checkRoundFloorCeil(money5,'round');
            money5 = money5/quanty;
            money5 = checkRoundFloorCeil(money5,'round');
            money5 = money5*quanty;
        }

        //calculate money6
        var money6 = commaReplace(temp_money6)/no_of_line;
        if(isFloat(money6)){
            money6 = checkRoundFloorCeil(money6,'round');
            money6 = money6/quanty;
            money6 = checkRoundFloorCeil(money6,'round');
            money6 = money6*quanty;
        }

        //calculate money7
        var money7 = commaReplace(temp_money7)/no_of_line;
        if(isFloat(money7)){
            money7 = checkRoundFloorCeil(money7,'round');
            money7 = money7/quanty;
            money7 = checkRoundFloorCeil(money7,'round');
            money7 = money7*quanty;
        }

        //calculate money8
        var money8 = commaReplace(temp_money8)/no_of_line;
        if(isFloat(money8)){
            money8 = checkRoundFloorCeil(money8,'round');
            money8 = money8/quanty;
            money8 = checkRoundFloorCeil(money8,'round');
            money8 = money8*quanty;
        }
        //================= part1 ends here =================//
    }
    
    if(split_line>1){
        var sales_date = date0004;
        //billing month
        //if(billing_month != 0){
            var initial_year = sales_date.substr(0,4);
            var initial_month = parseInt(sales_date.substr(5,2))+billing_month;
            var initial_day = numeric1;
            sales_date = initial_year+'/'+leftPad(initial_month,2)+'/'+leftPad(initial_day,2);
            sales_date = filterDate(sales_date);
        //}
            
        var date0004_ym_start = date0004.substr(0,7);
        var tem_date0004_month = date0004.substr(5,2);
        tem_date0004_month = parseInt(tem_date0004_month)+(split_line-1);
        var date0004_ym_end = date0004.substr(0,4) + "/" + leftPad(tem_date0004_month,2);
        date0004_ym_end = filterDateConsiderYearMonth(date0004_ym_end);
        
        for(i=1;i<=sub_split_line;i++){
            if(i == sub_split_line){
               //money2
               money2 = commaReplace(temp_money2) - (commaReplace(money2)*(sub_split_line-1));
               money2 = checkRoundFloorCeil(money2,'round');
               soukobango = (money2*percentage)/100;
               soukobango = checkRoundFloorCeil(soukobango,format_status);
               
               //money4
               money4 = commaReplace(temp_money4) - (commaReplace(money4)*(sub_split_line-1));
               money4 = checkRoundFloorCeil(money4,'round');
               
               //money5
               money5 = commaReplace(temp_money5) - (commaReplace(money5)*(sub_split_line-1));
               money5 = checkRoundFloorCeil(money5,'round');
               
               //money6
               money6 = commaReplace(temp_money6) - (commaReplace(money6)*(sub_split_line-1));
               money6 = checkRoundFloorCeil(money6,'round');
               
               //money7
               money7 = commaReplace(temp_money7) - (commaReplace(money7)*(sub_split_line-1));
               money7 = checkRoundFloorCeil(money7,'round');
               
               //money8
               money8 = commaReplace(temp_money8) - (commaReplace(money8)*(sub_split_line-1));
               money8 = checkRoundFloorCeil(money8,'round');
               
            }
            
            html += '<div class="row mt-2">'+
            '<div class="col-12">'+
             '<div class="data-wrapper-content" style="width: 100%;">'+
              '<div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">'+
                '<div style="padding: 27px;">'+
                '<input name="syouhinbango[]" type="hidden" value="'+i+'" >'+
                '<input name="yoteisu[]" type="hidden" value="0" >'+
                '  '+i+'-0'+
                '</div>'+
              '</div>'+
              '<div class="data-box-content2 custom-form text-center orderentry-databox" style="width: 90%;float: left;">'+
                '<div style="width: 100%;float: left;">'+
                  '<div class="data-box float-left" style="padding: 5px;width: 15%;">'+
                    '<input name="datachar29[]" type="text" readonly="" class="form-control" value="'+date0004_ym_start+'～'+date0004_ym_end+'">'+
                  '</div>'+
                  '<div class="data-box float-left custom-vline" style="padding:10px 3px 10px 0px; width:10%;text-align: right;">'+
                    '<input name="syouhizeiritu[]" type="hidden" value="'+money2+'" >'+
                    ' '+formatNumber(money2)+' '+
                  '</div>'+
                  '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                    '<input name="syukkomotobango[]" type="hidden" value="'+money4+'" >'+
                    ' '+formatNumber(money4)+' '+
                  '</div>'+
                  '<div class="data-box float-left custom-vline " style="padding: 10px 3px 10px 0px; width: 15%;text-align: right;">'+
                    '<input name="syukkameter[]" type="hidden" value="'+money5+'" >'+
                    ' '+formatNumber(money5)+' '+
                  '</div>'+
                  '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                    '<input name="zaikometer[]" type="hidden" value="'+money6+'" >'+
                    ' '+formatNumber(money6)+' '+
                  '</div>'+
                  '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                    '<input name="seikyubango[]" type="hidden" value="'+money7+'" >'+
                    ' '+formatNumber(money7)+' '+
                  '</div>'+
                  '<div class="data-box float-left" style="padding: 10px 10px 10px 0px; width: 30%; text-align: right;">'+
                    '<input name="denpyobango[]" type="hidden" value="'+money8+'" >'+
                    ' '+formatNumber(money8)+' '+
                  '</div>'+
                //   '<div class="data-box float-left " style="padding: 10px;width: 289px;text-align: right;color:#fff;">'+
                //   '4444'+
                //   '</div>'+

                '</div>'+
             ' </div>'+
              '<div class="data-box-content2 text-center custom-form orderentry-databox" style="width: 90%;float: left;">'+
                '<div style="width: 100%;float: left;">'+
                  '<div class="data-box float-left" style="padding: 5px;width: 15%;">'+
                  '<div class="input-group">'+
                                    '<input name="kanryoubi[]" type="text" value="'+sales_date+'" readonly class="form-control" id="datepicker4_oen_'+i+'" oninput="this.value = this.value.replace(/[^\d^\/]/g, \'\').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, \'$1$2$3\').replace(/([\d]{8})([\d]{1,2})?/g, \'$1\');"'+
                                       'onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"'+
                                        '   maxlength="10"'+
                                        '   autocomplete="off" placeholder="年/月/日"'+
                                        '   style="width: 96px!important;" value="">'+
                                    '<input type="hidden" class="datePickerHidden">'+
                                '</div>'+
                  '</div>'+
                  '<div class="data-box float-left custom-vline" style="padding: 12px 3px 10px 0px; width:10%;text-align: right">'+
                    '<input name="soukobango[]" type="hidden" value="'+soukobango+'" >'+
                    ' '+formatNumber(soukobango)+' '+
                  '</div>'+
                  '<div class="data-box float-left" style="padding: 5px;width: 12%;">'+

                   ' <input name="syouhinid[]" readonly="" type="text" class="form-control" value=""> '+
                  '</div>'+
                  '<div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">'+
                    '<input name="juchusyukko_datachar24[]" value="2" type="hidden">'+
                    '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar24+'" style="text-align:center;">'+
                 ' </div>'+
                  '<div class="data-box float-left" style="padding: 5px 3px;width: 8%;">'+
                    '<input name="juchusyukko_datachar25[]" value="2" type="hidden">'+
                    '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar25+'" style="background-color:#efefef !important;color: #000;text-align: center;">'+ 
                  '</div>'+
                  '<div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">'+
                    '<input name="juchusyukko_datachar26[]" value="2" type="hidden">'+
                    '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar26+'" style="text-align:center;">'+
                  '</div>'+
                  '<div class="data-box float-left" style="padding: 5px;width: 41%;border-right: 0 !important;border-left: 0 !important;">'+
                    '<input name="datachar08[]" type="text" class="form-control remarks" value="'+date0004_ym_start+'～'+date0004_ym_end+'分'+'" style="width:99%!important;">'+
                 ' </div>'+
                '</div>'+
             ' </div>'+
           ' </div>'+
         ' </div>'+
        ' </div>';
        
        //if(billing_month != 0){
            var nested_date0004 = sales_date.substr(0,4) + "/" + sales_date.substr(5,2) + "/" + leftPad(initial_day,2); 
            nested_date0004 = filterDate(nested_date0004);
        //}else{
        //    var nested_date0004 = sales_date;
        //    nested_date0004 = filterDate(nested_date0004);
        //}
        var nested_date0004_ym_start = date0004_ym_start;
        var nested_date0004_ym_end = date0004_ym_end;
        
        //================= part2 start here =================//
            //calculate money2
            var nested_money2 = commaReplace(money2)/split_line;
            if(isFloat(nested_money2)){
                nested_money2 = checkRoundFloorCeil(nested_money2,'round');
                nested_money2 = nested_money2/quanty;
                nested_money2 = checkRoundFloorCeil(nested_money2,'round');
                nested_money2 = nested_money2*quanty;
            }
            nested_soukobango = (commaReplace(nested_money2)*percentage)/100;
            nested_soukobango = checkRoundFloorCeil(nested_soukobango,format_status);

            //calculate money4
            var nested_money4 = commaReplace(money4)/split_line;
            if(isFloat(nested_money4)){
                nested_money4 = checkRoundFloorCeil(nested_money4,'round');
                nested_money4 = nested_money4/quanty;
                nested_money4 = checkRoundFloorCeil(nested_money4,'round');
                nested_money4 = nested_money4*quanty;
            }

            //calculate money5
            var nested_money5 = commaReplace(money5)/split_line;
            if(isFloat(nested_money5)){
                nested_money5 = checkRoundFloorCeil(nested_money5,'round');
                nested_money5 = nested_money5/quanty;
                nested_money5 = checkRoundFloorCeil(nested_money5,'round');
                nested_money5 = nested_money5*quanty;
            }

            //calculate money6
            var nested_money6 = commaReplace(money6)/split_line;
            if(isFloat(nested_money6)){
                nested_money6 = checkRoundFloorCeil(nested_money6,'round');
                nested_money6 = nested_money6/quanty;
                nested_money6 = checkRoundFloorCeil(nested_money6,'round');
                nested_money6 = nested_money6*quanty;
            }

            //calculate money7
            var nested_money7 = commaReplace(money7)/split_line;
            if(isFloat(nested_money7)){
                nested_money7 = checkRoundFloorCeil(nested_money7,'round');
                nested_money7 = nested_money7/quanty;
                nested_money7 = checkRoundFloorCeil(nested_money7,'round');
                nested_money7 = nested_money7*quanty;
            }

            //calculate money8
            var nested_money8 = commaReplace(money8)/split_line;
            if(isFloat(nested_money8)){
                nested_money8 = checkRoundFloorCeil(nested_money8,'round');
                nested_money8 = nested_money8/quanty;
                nested_money8 = checkRoundFloorCeil(nested_money8,'round');
                nested_money8 = nested_money8*quanty;
            }
        //================= part2 start here =================//
        
        for(j=1;j<=split_line;j++){
            
            if(j == split_line){
               //money2
               nested_money2 = commaReplace(money2) - (commaReplace(nested_money2)*(split_line-1));
               nested_money2 = checkRoundFloorCeil(nested_money2,'round');
               nested_soukobango = (nested_money2*percentage)/100;
               nested_soukobango = checkRoundFloorCeil(nested_soukobango,format_status);
               nested_soukobango = commaReplace(soukobango) - (commaReplace(nested_soukobango)*(split_line-1));
               
               //money4
               nested_money4 = commaReplace(money4) - (commaReplace(nested_money4)*(split_line-1));
               nested_money4 = checkRoundFloorCeil(nested_money4,'round');
               
               //money5
               nested_money5 = commaReplace(money5) - (commaReplace(nested_money5)*(split_line-1));
               nested_money5 = checkRoundFloorCeil(nested_money5,'round');
               
               //money6
               nested_money6 = commaReplace(money6) - (commaReplace(nested_money6)*(split_line-1));
               nested_money6 = checkRoundFloorCeil(nested_money6,'round');
               
               //money7
               nested_money7 = commaReplace(money7) - (commaReplace(nested_money7)*(split_line-1));
               nested_money7 = checkRoundFloorCeil(nested_money7,'round');
               
               //money8
               nested_money8 = commaReplace(money8) - (commaReplace(nested_money8)*(split_line-1));
               nested_money8 = checkRoundFloorCeil(nested_money8,'round');
               
            }
            
            html += '<div class="row mt-2">'+
            '<div class="col-12">'+
               '<div class="data-wrapper-content" style="width: 100%;">'+
                '<div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">'+
                  '<div style="padding: 27px;">'+
                  '<input name="syouhinbango[]" type="hidden" value="'+i+'" >'+
                  '<input name="yoteisu[]" type="hidden" value="'+k+'" >'+
                  '  '+i+'-'+k+''+
                  '</div>'+
                '</div>'+
                '<div class="data-box-content2 custom-form text-center orderentry-databox" style="width: 90%;float: left;">'+
                  '<div style="width: 100%;float: left;">'+
                    '<div class="data-box float-left" style="padding: 5px;width: 15%;">'+
                        '<input name="datachar29[]" type="text" readonly="" class="form-control" value="'+nested_date0004_ym_start+'">'+
                    '</div>'+
                    '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width:10%;text-align: right;">'+
                        '<input name="syouhizeiritu[]" type="hidden" value="'+nested_money2+'" >'+
                         ' '+formatNumber(nested_money2)+' '+
                    '</div>'+
                    '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                        '<input name="syukkomotobango[]" type="hidden" value="'+nested_money4+'" >'+
                        ' '+formatNumber(nested_money4)+' '+
                    '</div>'+
                    '<div class="data-box float-left custom-vline " style="padding: 10px 3px 10px 0px; width: 15%;text-align: right;">'+
                        '<input name="syukkameter[]" type="hidden" value="'+nested_money5+'" >'+
                        ' '+formatNumber(nested_money5)+' '+
                    '</div>'+
                    '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                        '<input name="zaikometer[]" type="hidden" value="'+nested_money6+'" >'+
                        ' '+formatNumber(nested_money6)+' '+
                    '</div>'+
                    '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                        '<input name="seikyubango[]" type="hidden" value="'+nested_money7+'" >'+
                        ' '+formatNumber(nested_money7)+' '+
                    '</div>'+
                    '<div class="data-box float-left" style="padding: 10px 10px 10px 0px; width: 30%; text-align: right;">'+
                        '<input name="denpyobango[]" type="hidden" value="'+nested_money8+'" >'+
                        ' '+formatNumber(nested_money8)+' '+
                    '</div>'+
                    // '<div class="data-box float-left " style="padding: 10px;width: 30%;text-align: right;color:#fff;">'+
                    // '4444'+
                    // '</div>'+

                  '</div>'+
               ' </div>'+
                '<div class="data-box-content2 text-center custom-form orderentry-databox" style="width: 90%;float: left;">'+
                  '<div style="width: 100%;float: left;">'+
                    '<div class="data-box float-left" style="padding: 5px;width: 15%;">'+
                    '<div class="input-group">'+
                                      '<input name="kanryoubi[]" type="text" value="'+nested_date0004+'" readonly class="form-control" id="datepicker4_oen_'+i+'_'+k+'" oninput="this.value = this.value.replace(/[^\d^\/]/g, \'\').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, \'$1$2$3\').replace(/([\d]{8})([\d]{1,2})?/g, \'$1\');"'+
                                         'onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"'+
                                          '   maxlength="10"'+
                                          '   autocomplete="off" placeholder="年/月/日"'+
                                          '   style="width: 96px!important;" value="">'+
                                      '<input type="hidden" class="datePickerHidden">'+
                                  '</div>'+
                    '</div>'+
                    '<div class="data-box float-left custom-vline" style="padding: 12px 3px 10px 0px; width: 10%;text-align: right">'+
                        '<input name="soukobango[]" type="hidden" value="'+nested_soukobango+'" >'+
                        ' '+formatNumber(nested_soukobango)+' '+
                    '</div>'+
                    '<div class="data-box float-left" style="padding: 5px;width: 12%;">'+

                     ' <input name="syouhinid[]" readonly="" type="text" class="form-control" value=""> '+
                    '</div>'+
                    '<div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">'+
                      '<input name="juchusyukko_datachar24[]" value="2" type="hidden">'+
                      '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar24+'" style="text-align:center;">'+
                   ' </div>'+
                    '<div class="data-box float-left" style="padding: 5px 3px;width: 8%;">'+
                      '<input name="juchusyukko_datachar25[]" value="2" type="hidden">'+
                      '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar25+'" style="background-color:#efefef !important;color: #000;text-align: center;">'+ 
                    '</div>'+
                    '<div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">'+
                      '<input name="juchusyukko_datachar26[]" value="2" type="hidden">'+
                      '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar26+'" style="text-align:center;">'+
                    '</div>'+
                    '<div class="data-box float-left" style="padding: 5px;width: 41%;border-right: 0 !important;border-left: 0 !important;">'+
                      '<input name="datachar08[]" type="text" class="form-control remarks" value="'+nested_date0004_ym_start+'分'+'" style="width:99%!important;">'+
                   ' </div>'+
                  '</div>'+
               ' </div>'+
             ' </div>'+
           ' </div>'+
         ' </div>';
         
            if(k == split_line){
                k =1;
            }else{
                k++;
            }
            
            //calculate nested target date (self-reliance)
            var temp_nested_date0004_ym_start = parseInt(nested_date0004_ym_start.substr(5,2))+1;
            var temp_nested_date0004 = parseInt(nested_date0004.substr(5,2))+1;
            var nested_date0004_ym_month = leftPad(temp_nested_date0004_ym_start,2);
            nested_date0004_ym_start = nested_date0004_ym_start.substr(0,4) + "/" + leftPad(temp_nested_date0004_ym_start,2);
            nested_date0004_ym_start = filterDateConsiderYearMonth(nested_date0004_ym_start);
            
            //if(billing_month != 0){
                nested_date0004 = nested_date0004.substr(0,4) + "/" + leftPad(temp_nested_date0004,2) + "/" + leftPad(initial_day,2);
                nested_date0004 = filterDate(nested_date0004);
           // }else{
            //    nested_date0004 = nested_date0004.substr(0,4) + "/" + nested_date0004_ym_month + "/" + date0004.substr(8,2);
            //    nested_date0004 = filterDate(nested_date0004);
            //}
            
        }
        
        //Target date start here
        var date0004_ym_start = date0004_ym_end;
        var tem_date0004_month = parseInt(date0004_ym_start.substr(5,2))+1;
        if(tem_date0004_month > 12){
             var tem_date0004_month_end = 1+(split_line-1);
        }else{
            var tem_date0004_month_end = tem_date0004_month+(split_line-1);
        }
        date0004_ym_start = date0004_ym_start.substr(0,4) + "/" + leftPad(tem_date0004_month,2);
        date0004_ym_start = filterDateConsiderYearMonth(date0004_ym_start);
        var date0004_ym_end = date0004_ym_start.substr(0,4) + "/" + leftPad(tem_date0004_month_end,2);
        date0004_ym_end = filterDateConsiderYearMonth(date0004_ym_end);
        //Target date (self-reliance) end here
        
        //calculate sales date start here
        //if(billing_month != 0){
            sales_date = nested_date0004.substr(0,4) + "/" + nested_date0004.substr(5,2) + "/" + leftPad(initial_day,2); 
            sales_date = filterDate(sales_date);
        //}else{
        //    sales_date = date0004_ym_start + "/" + date0004.substr(8,2); 
        //    sales_date = filterDate(sales_date);
        //}
        //calculate sales date end here
        
        
        }
    } else{
        var date0004_ym = date0004.substr(0,7);
        for(i=1;i<=no_of_line;i++){
            if(i == no_of_line){
               //money2
               money2 = commaReplace(temp_money2) - (commaReplace(money2)*(no_of_line-1));
               money2 = checkRoundFloorCeil(money2,'round');
               soukobango = (money2*percentage)/100;
               soukobango = checkRoundFloorCeil(soukobango,format_status);
               
               //money4
               money4 = commaReplace(temp_money4) - (commaReplace(money4)*(no_of_line-1));
               money4 = checkRoundFloorCeil(money4,'round');
               
               //money5
               money5 = commaReplace(temp_money5) - (commaReplace(money5)*(no_of_line-1));
               money5 = checkRoundFloorCeil(money5,'round');
               
               //money6
               money6 = commaReplace(temp_money6) - (commaReplace(money6)*(no_of_line-1));
               money6 = checkRoundFloorCeil(money6,'round');
               
               //money7
               money7 = commaReplace(temp_money7) - (commaReplace(money7)*(no_of_line-1));
               money7 = checkRoundFloorCeil(money7,'round');
               
               //money8
               money8 = commaReplace(temp_money8) - (commaReplace(money8)*(no_of_line-1));
               money8 = checkRoundFloorCeil(money8,'round');
               
            }
            
            //billing month
            if(i==1){
                var initial_year = date0004.substr(0,4);
                var initial_month = parseInt(date0004.substr(5,2))+billing_month;
                var initial_day = numeric1;
                date0004 = initial_year+'/'+leftPad(initial_month,2)+'/'+leftPad(initial_day,2);
                date0004 = filterDate(date0004);
            }
            
            html += '<div class="row mt-2">'+
             '<div class="col-12">'+
                '<div class="data-wrapper-content" style="width: 100%;">'+
                 '<div class="data-box-content" style="width: 10%; float: left;background-color:#666666;text-align: center;color:#fff;height: 76px;vertical-align: middle;border-radius: 5px 0px 5px;">'+
                   '<div style="padding: 27px;">'+
                   '<input name="syouhinbango[]" type="hidden" value="'+i+'" >'+
                   '<input name="yoteisu[]" type="hidden" value="0" >'+
                   '  '+i+'-0 '+
                   '</div>'+
                 '</div>'+
                 '<div class="data-box-content2 custom-form text-center orderentry-databox" style="width: 90%;float: left;">'+
                   '<div style="width: 100%;float: left;">'+
                     '<div class="data-box float-left" style="padding: 5px;width: 15%;">'+
                        '<input name="datachar29[]" type="text" readonly="" class="form-control" value="'+date0004_ym+'">'+
                     '</div>'+
                     '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width:10%;text-align: right;">'+
                        '<input name="syouhizeiritu[]" type="hidden" value="'+commaReplace(money2)+'" >'+
                        ' '+formatNumber(money2)+' '+
                     '</div>'+
                     '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width:10%;text-align: right;">'+
                        '<input name="syukkomotobango[]" type="hidden" value="'+commaReplace(money4)+'" >'+
                        ' '+formatNumber(money4)+' '+
                     '</div>'+
                     '<div class="data-box float-left custom-vline " style="padding: 10px 3px 10px 0px; width: 15%;text-align: right;">'+
                        '<input name="syukkameter[]" type="hidden" value="'+commaReplace(money5)+'" >'+
                        ' '+formatNumber(money5)+' '+
                     '</div>'+
                     '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                        '<input name="zaikometer[]" type="hidden" value="'+commaReplace(money6)+'" >'+
                        ' '+formatNumber(money6)+' '+
                     '</div>'+
                     '<div class="data-box float-left custom-vline" style="padding: 10px 3px 10px 0px; width: 10%;text-align: right;">'+
                        '<input name="seikyubango[]" type="hidden" value="'+commaReplace(money7)+'" >'+
                        ' '+formatNumber(money7)+' '+
                     '</div>'+
                     '<div class="data-box float-left" style="padding: 10px 10px 10px 0px; width:30%; text-align: right;">'+
                        '<input name="denpyobango[]" type="hidden" value="'+commaReplace(money8)+'" >'+
                        ' '+formatNumber(money8)+' '+
                     '</div>'+
                    //  '<div class="data-box float-left " style="padding: 10px;width: 289px;text-align: right;color:#fff;">'+
                    //  '4444'+
                    //  '</div>'+

                   '</div>'+
                ' </div>'+
                 '<div class="data-box-content2 text-center custom-form orderentry-databox" style="width: 90%;float: left;">'+
                   '<div style="width: 100%;float: left;">'+
                     '<div class="data-box float-left" style="padding: 5px;width: 15%;">'+
                     '<div class="input-group">'+
                                       '<input name="kanryoubi[]" type="text" value="'+date0004+'" readonly class="form-control" id="datepicker4_oen_'+i+'" oninput="this.value = this.value.replace(/[^\d^\/]/g, \'\').replace(/([\d]{4}\/?)([\d]{2}\/?)([\d]{2})/g, \'$1$2$3\').replace(/([\d]{8})([\d]{1,2})?/g, \'$1\');"'+
                                          'onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"'+
                                           '   maxlength="10"'+
                                           '   autocomplete="off" placeholder="年/月/日"'+
                                           '   style="width: 96px!important;" value="">'+
                                       '<input type="hidden" class="datePickerHidden">'+
                                   '</div>'+
                     '</div>'+
                     '<div class="data-box float-left custom-vline" style="padding: 12px 3px 10px 0px; width: 10%;text-align: right">'+
                     '<input name="soukobango[]" type="hidden" value="'+soukobango+'" >'+
                     ' '+formatNumber(soukobango)+' '+
                     '</div>'+
                     '<div class="data-box float-left" style="padding: 5px;width: 12%;">'+
                      ' <input name="syouhinid[]" readonly="" type="text" class="form-control" value=""> '+
                     '</div>'+
                     '<div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">'+
                       '<input name="juchusyukko_datachar24[]" value="2" type="hidden">'+
                       '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar24+'" style="text-align:center;">'+
                    ' </div>'+
                     '<div class="data-box float-left" style="padding: 5px 3px;width: 8%;">'+
                       '<input name="juchusyukko_datachar25[]" value="2" type="hidden">'+
                       '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar25+'" style="background-color:#efefef !important;color: #000;text-align: center;">'+ 
                     '</div>'+
                     '<div class="data-box float-left" style="padding: 5px 3px;width: 7%;border-right: 0 !important;">'+
                       '<input name="juchusyukko_datachar26[]" value="2" type="hidden">'+
                       '<input readonly="" type="text" class="form-control" placeholder="" value="'+datachar26+'" style="text-align:center;">'+
                     '</div>'+
                     '<div class="data-box float-left" style="padding: 5px;width: 41%;border-right: 0 !important;border-left: 0 !important;">'+
                       '<input name="datachar08[]" type="text" class="form-control remarks" value="'+date0004_ym+'分'+'" style="width:99%!important;">'+
                    ' </div>'+
                   '</div>'+
                ' </div>'+
              ' </div>'+
            ' </div>'+
          ' </div>';
  
           //calculate sales date
            var tem_date0004_ym_month = date0004_ym.substr(5,2);
            tem_date0004_ym_month = parseInt(tem_date0004_ym_month)+1;
            date0004_ym = date0004_ym.substr(0,4) + "/" + leftPad(tem_date0004_ym_month,2); 
            date0004_ym = filterDateConsiderYearMonth(date0004_ym);
       
            //calculate target date (self-reliance), sales date
            //var tem_date0004_month = date0004.substr(5,2);
            var tem_date0004_month = date0004_ym.substr(5,2);
            //tem_date0004_month = parseInt(tem_date0004_month)+1;
            tem_date0004_month = parseInt(tem_date0004_month)+billing_month;
            //date0004 = date0004_ym.substr(0,4) + "/" + leftPad(tem_date0004_month,2) + "/" + date0004.substr(8,2);
            date0004 = date0004_ym.substr(0,4) + "/" + leftPad(tem_date0004_month,2) + "/" + leftPad(initial_day,2);
            date0004 = filterDate(date0004);
            
       }
    }  
           
    $("#line-main-div").append(html);
}

//calculate fraction value
function calculateFractionValue(val,quanty){
    var floatValues =  /[+-]?([0-9]*[.])?[0-9]+/;
    if(floatValues.test(val) && !isNaN(val)) {
        //remove float part
        val = ~~val;
        val = val/quanty;
        if(floatValues.test(val) && !isNaN(val)) {
          val = ~~val;
          val = formatNumber(val*quanty);
          return val;
        }else{
           return val; 
        }
    }else{
        return val;
    }
}

//enable disable split button
function enableDisableSplitButton(){
    var product_code = $("#reg_kawasename").val();
    var quanty = $("#reg_syukkasu").val();
    var date0004 = $("#datepicker1_oen").val();
    var no_of_line = $("#reg_numeric8").val();
    if(product_code == "" || quanty == "" || date0004 == "" || no_of_line == ""){
        $("#splitButton").prop('disabled', true);
    }else{
        $("#splitButton").removeAttr("disabled");
    }
}


function getLastDay(year,month){
    var lastDate = new Date(year, month , 0);
    var lastDay = lastDate.getDate();
    return lastDay;
}


function filterDate(date){
    date = date.replace(/\//g,"");
    var year = date.substr(0,4);
    var month = date.substr(4,2);
    var day = date.substr(6,2);
    if(month >= 12){
        if(month == 12){
            month = month;
        }else{
            year = parseInt(year) + 1;
            month = month - 12;
        }
    }
    var last_day = getLastDay(year,month);
    if(day>last_day){
        day = last_day;
    }
    var date = year + "/" + leftPad(month,2) + "/" + leftPad(day,2);
    return date;
}

//filter using year, month
function filterDateConsiderYearMonth(date){
    date = date.replace(/\//g,"");
    var year = date.substr(0,4);
    var month = date.substr(4,2);
    if(month >= 12){
        if(month == 12){
            month = month;
        }else{
            year = parseInt(year) + 1;
            month = month - 12;
        }
    }
    var date = year + "/" + leftPad(month,2);
    return date;
}


//check number format, round floor ceil
function checkRoundFloorCeil(value,format_status){
    var result = "";
    if(format_status == "round"){
        result = Math.round(value);
    }else if(format_status == "floor"){
        result = Math.floor(value);
    }else if(format_status == "ceil"){
        result = Math.ceil(value);
    }
    return result;
}

//check isFloat
function isFloat(num) {
    var status = !!(num % 1);
    return status;
}


function validateBeforeSubmit(){
    var bango = $("input[id='userId']").val();
    var data = new FormData(document.getElementById('insertData'));
    
    $.ajax({
        type: 'POST',
        url: "flat-rate-entry/validateBeforeSubmit/" + bango,
        data: data,
        async:false,
        contentType: false,
        cache: false,
        processData: false,
        success: function (result) {
            if ($.trim(result) == 'ok') {
                $(document).find("#error_data").html("");
                $('#information2_input_group').removeClass("error");
                $('#information1_input_group').removeClass("error");
                $('#information3_input_group').removeClass("error");
                $('#information6_input_group').removeClass("error");
                $('#reg_datachar05').removeClass("error");
                $('#kawasename_input_group').removeClass("error");
                $('#reg_syouhinname').removeClass("error");
                $('#reg_syukkasu').removeClass("error");
                $('#reg_money1').removeClass("error");
                $('#reg_money2').removeClass("error");
                $('#datepicker1_oen').removeClass("error");
                $('#reg_date0003').removeClass("error");
                $('#reg_numeric8').removeClass("error");
                $('#reg_datachar02').removeClass("error");
                $('#reg_numeric9').removeClass("error");
                $('#reg_numeric10').removeClass("error");
                $('#datepicker2_oen').removeClass("error");
                $('#datepicker3_oen').removeClass("error");
                $('#reg_money4').removeClass("error");
                $('#reg_money5').removeClass("error");
                $('#reg_money6').removeClass("error");
                $('#reg_money7').removeClass("error");
                $('#reg_money8').removeClass("error");
                
                $("#first_validation").val('ok');
            } else {
                var inputError = result.err_field;
                console.log(inputError);

                var html = '';
                if (result.err_msg) {
                    html = '<div>';

                    for (var count = 0; count < result.err_msg.length; count++) {
                        html += '<p style="color:red;font-size: 12px;margin-bottom: 8px;">' + result.err_msg[count] + '</p>';
                    }
                    html += '</div>';

                    $('#error_data').html(html);

                    if (true) {
                    }
                    $("#error_data").show();
                }

                if (inputError.information2) {
                    $('#information2_input_group').addClass("error");
                } else {
                    $('#information2_input_group').removeClass("error");
                }
                
                if (inputError.information1) {
                    $('#information1_input_group').addClass("error");
                } else {
                    $('#information1_input_group').removeClass("error");
                }
                
                if (inputError.information3) {
                    $('#information3_input_group').addClass("error");
                } else {
                    $('#information3_input_group').removeClass("error");
                }
                
                if (inputError.information6) {
                    $('#information6_input_group').addClass("error");
                } else {
                    $('#information6_input_group').removeClass("error");
                }
                
                if (inputError.datachar05) {
                    $('#reg_datachar05').addClass("error");
                } else {
                    $('#reg_datachar05').removeClass("error");
                }
                
                if (inputError.kawasename) {
                    $('#kawasename_input_group').addClass("error");
                } else {
                    $('#kawasename_input_group').removeClass("error");
                }
                
                if (inputError.syouhinname) {
                    $('#reg_syouhinname').addClass("error");
                } else {
                    $('#reg_syouhinname').removeClass("error");
                }
                
                if (inputError.syukkasu) {
                    $('#reg_syukkasu').addClass("error");
                } else {
                    $('#reg_syukkasu').removeClass("error");
                }
                
                if (inputError.money1) {
                    $('#reg_money1').addClass("error");
                } else {
                    $('#reg_money1').removeClass("error");
                }
                
                if (inputError.money2) {
                    $('#reg_money2').addClass("error");
                } else {
                    $('#reg_money2').removeClass("error");
                }
                
                if (inputError.date0002) {
                    $('#datepicker1_oen').addClass("error");
                    $('#reg_date0003').addClass("error");
                } else {
                    $('#datepicker1_oen').removeClass("error");
                    $('#reg_date0003').removeClass("error");
                }
                
                if (inputError.numeric8) {
                    $('#reg_numeric8').addClass("error");
                } else {
                    $('#reg_numeric8').removeClass("error");
                }
                
                if (inputError.datatxt0124) {
                    $('#maintenance_window_err').addClass("error");
                } else {
                    $('#maintenance_window_err').removeClass("error");
                }
                
                if (inputError.numericmax) {
                    $('#reg_numericmax').addClass("error");
                } else {
                    $('#reg_numericmax').removeClass("error");
                }
                
                if (inputError.datatxt0123) {
                    $('#maintenance_company_err').addClass("error");
                } else {
                    $('#maintenance_company_err').removeClass("error");
                }
                
                if (inputError.datatxt0120) {
                    $('#reg_datatxt0120').addClass("error");
                } else {
                    $('#reg_datatxt0120').removeClass("error");
                }
                
                if (inputError.datachar02) {
                    $('#reg_datachar02').addClass("error");
                } else {
                    $('#reg_datachar02').removeClass("error");
                }
                
                if (inputError.numeric9) {
                    $('#reg_numeric9').addClass("error");
                    $('#reg_numeric8').addClass("error");
                } else {
                    $('#reg_numeric9').removeClass("error");
                    //$('#reg_numeric8').removeClass("error");
                }
                
                if (inputError.numeric10) {
                    $('#reg_numeric10').addClass("error");
                    $('#datepicker2_oen').addClass("error");
                    $('#datepicker3_oen').addClass("error");
                } else {
                    $('#reg_numeric10').removeClass("error");
                    $('#datepicker2_oen').removeClass("error");
                    $('#datepicker3_oen').removeClass("error");
                }
                
                //order shipping popup field validation starts here
                if (inputError.datachar03) {
                    $('#reg_datachar03').addClass("error");
                } else {
                    $('#reg_datachar03').removeClass("error");
                }
                
                if (inputError.datachar04) {
                    $('#reg_datachar04').addClass("error");
                } else {
                    $('#reg_datachar04').removeClass("error");
                }
                
                if (inputError.supplier) {
                    $('#reg_supplier').addClass("error");
                } else {
                    $('#reg_supplier').removeClass("error");
                }
                
                if (inputError.dataint09) {
                    $('#datepicker7_oen').addClass("error");
                } else {
                    $('#datepicker7_oen').removeClass("error");
                }
                
                if (inputError.dataint10) {
                    $('#datepicker8_oen').addClass("error");
                } else {
                    $('#datepicker8_oen').removeClass("error");
                }
                
                if (inputError.datachar06) {
                    $('#delivery_destination_err').addClass("error");
                } else {
                    $('#delivery_destination_err').removeClass("error");
                }
                
                if (inputError.datachar07) {
                    $('#reg_datachar07').addClass("error");
                } else {
                    $('#reg_datachar07').removeClass("error");
                }
                //order shipping popup field validation ends here
                
                if (inputError.money4) {
                    $('#reg_money4').addClass("error");
                } else {
                    $('#reg_money4').removeClass("error");
                }
                
                if (inputError.money5) {
                    $('#reg_money5').addClass("error");
                } else {
                    $('#reg_money5').removeClass("error");
                }
                
                if (inputError.money6) {
                    $('#reg_money6').addClass("error");
                } else {
                    $('#reg_money6').removeClass("error");
                }
                
                if (inputError.money7) {
                    $('#reg_money7').addClass("error");
                } else {
                    $('#reg_money7').removeClass("error");
                }
                
                if (inputError.money8) {
                    $('#reg_money8').addClass("error");
                } else {
                    $('#reg_money8').removeClass("error");
                }
                
                $("#first_validation").val('ng');

            }
        }
    });
}