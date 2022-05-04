<DOCTYPE html>
    <html>
        <head>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <title>Dynamic Table</title>
            
            <style>
                html, body {
                    max-width: 100%;
                    overflow-x: hidden;
                }
                body  {
                    margin:0px 50px 0px 50px; padding:0px 50px 0px 50px;
                }
                input {
                    /* border: none; */
                    background: transparent;
                    text-align: center;
                }
                th, td { white-space: nowrap; }
                div.dataTables_wrapper {
                    width: 100%;
                    margin: 0 auto;
                }
            
                tr { height: 50px; }
                
            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.3.3/css/fixedColumns.dataTables.min.css">
            <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
            <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
            <script src="https://cdn.datatables.net/fixedcolumns/3.3.3/js/dataTables.fixedColumns.min.js"></script>
            
        </head>
        <body>
            <h1>Welcome To Data Loader</h1>
            
            <form id="main_form" class="form-group" action="{{ route('query.show') }}" method="" >
                @csrf 
                <div class="row"> 
                    <div class="col-md-2">
                        <input type="hidden" id="string_edit" name="edit_string" value="">
                        <input type="hidden" id="buttonName" name="Uniquetype" value="">
                        <input type="hidden" id="sortField" name="sortField" value="{{isset($sortField)?$sortField:null}}">
                        <input type="hidden" id="sortType" name="sortType" value="{{isset($sortType)?$sortType:null}}">
                        <select class="form-control" name="table_name" >
                        <option value="">Select Table</option>
                        @foreach ($tables as $table)
                            <option value="{{ $table->table_name }}" {{ ( $table->table_name == $selected_table) ? 'selected' : '' }}> 
                                {{ $table->table_name }} 
                            </option>
                        @endforeach    
                        </select>
                    </div>
                    <div class="col-md-8">
                        <button class="btn btn-sm btn-primary d-none" id="showAllBtn">Show</button>
                        <button class="btn btn-sm btn-success d-none" id="insertAllBtn">Insert</button>
                        <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete</button>
                        <button class="btn btn-sm btn-info d-none" id="editAllBtn">Edit</button>
                        <button class="btn btn-sm btn-secondary d-none" id="searchAllBtn">Search</button>
                    </div>
                </div>
                @if (isset($column))
                    @php
                    $current_page=$data->currentPage();                       
                        $per_page=$data->perPage();
                        $first_data= ($current_page - 1)*$per_page+1;
                        $last_data=($current_page - 1)*$per_page+ sizeof($data->items());
                    @endphp
                    @if (!empty($error))
                        <h3 style="color: red">{{$error}}</h3>
                    @endif
                    <!--========== pagination start ==========-->
                    @if($data->lastPage() > 1)
                    <div class ="container" style="margin:0;padding:0;">
                    <div class="row">
                        <div class="col-md-2" style="">
                            <div class="container" style="margin:0px;padding:0px; width:100px">
                                <div class="input-group pagination">
                                    <div class="input-group-btn">
                                        <button class="btn btn-default" type="button" tabindex="-1" onclick="gotoBack('{{url()->full()}}','{{$data->lastPage()}}');">&lt;&lt;</button>
                                        <!-- <button class="btn btn-default" type="button">&lt;</button> -->
                                    </div>
                                    <div class="input-group-btn">        
                                        <input class="form-control" type="text" style="width: 50px;" id="paginate" name="page" value="{{$data->currentPage()}}">
                                    </div>
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary" type="button" onclick="goToPage('{{url()->full()}}','{{$data->lastPage()}}');">Go</button>
                                        <!-- <button class="btn btn-default" type="button">&gt;</button> -->
                                        <button class="btn btn-default" type="button" onclick="goForward('{{url()->full()}}','{{$data->lastPage()}}');">&gt;&gt;</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" style="">
                            <div class="container" style="margin-top:19px;">
                                <table class="table-bordered " style="table-layout: fixed;height: 25px; width: 500px;">
                                    <tr class="table_hover2 grid" style="height: 34px;">
                                        <td class="padi_1" style="width: 75px; text-align:center;">Total</td>
                                        <td class=""style="width: 50px;text-align:center;">{{$data->total()}}</td>
                                        <td class="" style="width: 75px;text-align:center;">Range</td>
                                        <td class="" style="width: 50px;text-align:center;">{{$first_data}}</td>
                                        <td class="" style="width: 50px;text-align:center;">~</td>
                                        <td style="width: 50px;text-align:center;">{{$last_data}}</td>
                                        <td style="width: 100px;text-align:center;">Total Pages</td>
                                        <td style="width: 50px;text-align:center;">{{ $data->lastPage() }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        @php
                            if(isset($pagination)){
                                $numberOfData=$pagination;
                            }
                            else{
                                $numberOfData=20;
                            }
                        @endphp
                        <div class="col-md-4" style="">
                            <div class="container" style="margin-top:19px;padding:0px;">
                                <table class="" style="table-layout: fixed;height: 25px; width: 175px;">
                                    <tr class="table_hover2 grid" style="height: 34px;">
                                        <td class="padi_1" style="width: 80px; text-align:center;">Pagination</td>
                                        <td class="padi_1" style="width: 95px; text-align:center;">
                                            <select name="pagination" class="form-control left_select " style="width: 95px!important; border:1px solid #e1e1e1 !important;border-radius: 0.25rem!important;" onchange="changeByDataAmount();">
                                                <option value="20" @if(isset($numberOfData)&&($numberOfData==20)) selected="selected" @endif>20</option>
                                                <option value="50" @if(isset($numberOfData)&&($numberOfData==50)) selected="selected" @endif>50</option>
                                                <option value="100" @if(isset($numberOfData)&&($numberOfData==100)) selected="selected" @endif>100</option>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                        </div>
                    @endif
                    <!--========== pagination end ==========-->
                    <div style="overflow-x:auto;">
                        <!-- <h2>{{$selected_table}} Table</h2> -->
                        <table id="table-1" class="stripe row-border order-column" style="width:100%" >
                            <thead>
                                <tr>
                                    <th style="text-align:center;"><input type="checkbox" name="main_checkbox"/></th>
                                    @foreach ($column as $key => $value)
                                        <th style="text-align:center;"><a onclick="AscDsc('{{$value}}');" id="asc_dsc_{{$value}}" href="#">{{$value}}</a></th>                               
                                    @endforeach 
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>   
                                        <td style="text-align:center;"><input type="checkbox"/></td>
                                            <!-- <input type="hidden" name="table_name" value="{{$selected_table}}"> -->
                                            @foreach ($column as $colum)
                                                <td style="text-align:center;">
                                                    <input type="text" id="{{$colum}}" name="{{$colum}}"  value="{{isset($old_data[$colum])?$old_data[$colum]: null}}">
                                                </td>
                                            @endforeach 
                                    
                                    </tr>
                                    @foreach ($data as $row)
                                        @php 
                                            $j=$column[0];
                                            $check=null;
                                            foreach($row as $d)
                                            {
                                                $check= $check.'%%'.$d;
                                            }
                                        @endphp
                                        <tr id="{{$row->$j}}">
                                            <td scope="row" style="text-align:center;">
                                                <div class="custom-control custom-checkbox custom-control-inline">
                                                    <input type="checkbox" size="1" name="child_checkbox" id="check{{$check}}" class="custom-control-input" value="{{$check}}" autocomplete="on">
                                                    <label class="custom-control-label ml-2" for="check{{$check}}"></label>
                                                    <span class="mb-4 "></span>
                                                </div>
                                            </td>
                                            @foreach ($row as $key => $value)
                                                <td style="text-align:center;">
                                                {{$value}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                        <!-- {{$data->appends(request()->input())->links('pagination::bootstrap-4')}} -->
                    </div>
                @endif
            </form>
        </body>
        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).ready(function() {
                var table = $('#table-1').DataTable( {
                    scrollY:        false,
                    scrollX:        true,
                    scrollCollapse: true,
                    searching:      false,
                    paging:         false,
                    info:           false,
                    bSort :         false,
                    fixedColumns:   {
                        heightMatch: 'none'
                    }
                } );
            });
            $(document).on('click','input[name="main_checkbox"]', function(){
                  if(this.checked){
                    $('input[name="child_checkbox"]').each(function(){
                        this.checked = true;
                    });
                  }else{
                     $('input[name="child_checkbox"]').each(function(){
                         this.checked = false;
                     });
                  }
                  toggledeleteAllBtn() 
           });
           $(document).on('change','input[name="child_checkbox"]', function(){
               if( $('input[name="child_checkbox"]').length == $('input[name="child_checkbox"]:checked').length ){
                   $('input[name="main_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="main_checkbox"]').prop('checked', false);
               }
               toggledeleteAllBtn()
           });
            $(document).on('click','#showAllBtn', function(){
                document.getElementById('buttonName').value = "show";
                document.getElementById("main_form").method = "post";
                document.getElementById("main_form").submit();
            });
            $(document).on('click','#insertAllBtn', function(){
                document.getElementById('buttonName').value= "insert";
                document.getElementById("main_form").method = "post";
                document.getElementById("main_form").submit();
            });
           $(document).on('click','#deleteAllBtn', function(){
            var checkboxes = document.querySelectorAll('input[name="child_checkbox"]:checked'), values = [];
            Array.prototype.forEach.call(checkboxes, function(el) {
                values.push(el.value);
            });
            var kisu= values;
            var editString =kisu.join("##");
            console.log(editString);
            document.getElementById('buttonName').value= "delete";
            document.getElementById('string_edit').value= editString;
            document.getElementById("main_form").method = "post";
            document.getElementById("main_form").submit();           
           });
           $(document).on('click','#editAllBtn', function(){
            var checkboxes = document.querySelectorAll('input[name="child_checkbox"]:checked'), values = [];
            Array.prototype.forEach.call(checkboxes, function(el) {
                values.push(el.value);
            });
            var kisu= values;
            var editString =kisu.join("##");
            document.getElementById('buttonName').value= "doEdit";
            document.getElementById('string_edit').value= editString;
            document.getElementById("main_form").method = "post";
            document.getElementById("main_form").submit();
           });

           $(document).on('click','#searchAllBtn', function(){
            var pagination=document.getElementById("paginate");
            // alert(pagination);
            if(pagination){
                document.getElementById("paginate").value=1;    
            }

            document.getElementById('buttonName').value= "khojThesearch";
            document.getElementById("main_form").method = "post";
            document.getElementById("main_form").submit();
            });

            function goToPage(url, lastpage)
            {
                // alert(url);
                // alert(typeof(lastpage));
                var myString = url.substr(url.indexOf("&type=") + 1); 
                    if (myString.split("=")[1]) 
                    {
                        var buttontype=(myString.split("=")[1]).split("&")[0];
                    }
                    else
                    {
                        var buttontype=null;
                    } 
                // alert(buttontype);
                if (buttontype == 'sort') {
                    document.getElementById('buttonName').value='sort';
                }
                else{
                    document.getElementById('buttonName').value='khojThesearch';
                }
                var i= document.getElementById("paginate").value;
                // alert(typeof(i));
                if (+i >= +lastpage) {    
                document.getElementById("paginate").value= lastpage;
                }

                else if (i < 1) {    
                document.getElementById("paginate").value=1;
                }  
                else{
                document.getElementById("paginate").value=i;
                }
                
                document.getElementById("main_form").method = "post";
                document.getElementById("main_form").submit();
                
            }

            function gotoBack(url, lastpage)
            {
                var myString = url.substr(url.indexOf("&type=") + 1); 
                    if (myString.split("=")[1]) 
                    {
                        var buttontype=(myString.split("=")[1]).split("&")[0];
                    }
                    else
                    {
                        var buttontype=null;
                    }
                if (buttontype == 'sort') {
                    document.getElementById('buttonName').value='sort';
                }
                else{
                    document.getElementById('buttonName').value='khojThesearch';
                }
                var i= document.getElementById("paginate").value;
                if (i <= 1) {    
                document.getElementById("paginate").value=1;
                }
                else{
                document.getElementById("paginate").value=--i;
                }
                document.getElementById("main_form").method = "post";
                document.getElementById("main_form").submit();
            }


           function goForward(url, lastpage)
            {   //alert(lastpage);
                //lastpage = parseInt(lastpage);
                var myString = url.substr(url.indexOf("&type=") + 1); 
                if (myString.split("=")[1]) 
                {
                    var buttontype=(myString.split("=")[1]).split("&")[0];
                }
                else
                {
                    var buttontype=null;
                }
                if (buttontype == 'sort') {
                    document.getElementById('buttonName').value='sort';
                }
                else{
                    document.getElementById('buttonName').value='khojThesearch';
                }
                var i= document.getElementById("paginate").value;
                //alert(i);
                if (+i >= +lastpage) {    
                document.getElementById("paginate").value=lastpage;
                }
                else if(i < 1){
                document.getElementById("paginate").value=1;
                }
                else{
                document.getElementById("paginate").value=++i;
                }
                //alert(i);
                document.getElementById("main_form").method = "post";
                document.getElementById("main_form").submit();
            }
            function AscDsc(field)
            {
                var pagination=document.getElementById("paginate");
                if(pagination){
                    document.getElementById("paginate").value=1;    
                } 
                var previousSort = document.getElementById('sortType').value;
                var previousField = document.getElementById('sortField').value;

                if (previousField && previousSort) {
                    if (previousField == field) {
                        if (previousSort == 'ASC') {
                            sortOrder = 'DESC';
                        } else {
                            sortOrder = 'ASC';
                        }
                    } else {
                        sortOrder = 'ASC';
                    }
                } else {
                    sortOrder = 'ASC';
                } 
                // alert(sortOrder);              
                var url='{{url()->full()}}';
                document.getElementById('buttonName').value= 'sort';
                document.getElementById('sortField').value= field;
                document.getElementById("sortType").value=sortOrder;
                document.getElementById("main_form").method = "post";
                document.getElementById("main_form").submit();
            }
            function changeByDataAmount(){
                // alert("hello");
                var pagination=document.getElementById("paginate");
                if(pagination){
                    document.getElementById("paginate").value=1;    
                } 
                //document.getElementById('csrf').disabled=false;
                document.getElementById('buttonName').value = 'show';
                document.getElementById('main_form').method = "post";
                document.getElementById('main_form').submit();
            }
        </script>
        
    </html>