<DOCTYPE html>
    <html>
        <head>
            <meta name="csrf-token" content="{{ csrf_token() }}" />
            <title>Dynamic Table</title>
            
            <style>
                body  {
                    margin:0px 20px 0px 20px; padding:0px 20px 0px 20px;
                }
                input {                   
                    background: transparent;
                    text-align: center;
                }
            </style>
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
            <!-- <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css"> -->
            <script src="https://code.jquery.com/jquery-3.5.1.js" type="text/javascript"></script>
            <!--<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" type="text/javascript"></script> -->
            <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js" type="text/javascript"></script>
            
        </head>
        <body>
            <h1>Welcome To Data Loader</h1>
            
            <form id="main_form" class="form-group" action="{{ route('query.show') }}" method="" >
                @csrf 
                <div class="row"> 
                    <div class="col-md-2"> 
                        <input type="hidden" id="string_edit" name="edit_string" value="">
                        <input type="hidden" id="buttonName" name="Uniquetype" value="">
                        <select class="form-control" name="table_name">
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
                        <!-- <button class="btn btn-block btm-primary d-none" id="insertAllBtn">Insert</button>
                        <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">Delete</button> -->
                        <button class="btn btn-sm btn-info d-none" id="editAllBtn">Edit</button>
                    </div>
                </div>
            @if (isset($column))
                @if (isset($error))
                    <h3 style="color: red">{{$error}}</h3>
                @endif
                
                <div style="overflow-x:auto;">
                    <!-- <h2>{{$selected_table}} Table</h2> -->
                <table id="table-1" class="display" >
                    <thead>
                        <tr>
                            <th style="text-align:center;"></th>
                            @foreach ($column as $key => $value)
                                <th style="text-align:center;">{{$value}}</th>                               
                            @endforeach 
                        </tr>
                    </thead>
                    <tbody>
                            <!-- <tr>   
                                <td style="text-align:center;"></td>
                                    @foreach ($column as $key => $value)
                                        <td style="text-align:center;">
                                            <input type="text" name="{{$value}}" placeholder="Enter Value">
                                        </td>
                                    @endforeach   
                            </tr> -->
                            <tr>
                            <input type="hidden" name="old_data" value="{{json_encode($tabledata,TRUE)}}">
                            </tr>
                            @php
                            $i=0;
                            @endphp

                            @foreach($tabledata as $key => $value) 

                                @php
                                $j=0;
                                @endphp
                                <tr>
                                    <td>
                                    </td>
                                    @foreach($value as $k=> $data)
                                        <td style="text-align:center;"><input type="text" name="{{$column[$j]}}%%{{$data}}%%{{$i}}" value="{{$data}}"></td>
                                        @php
                                            $j++;
                                        @endphp
                                    @endforeach                           
                                </tr>
                                @php
                                    $i++;
                                @endphp
                            @endforeach   
                    </tbody>
                </table>
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
                    fixedColumns:   {
                        heightMatch: 'none'
                    }
                } );
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
            
            document.getElementById('buttonName').value= "delete";
            document.getElementById('string_edit').value= editString;
            document.getElementById("main_form").method = "post";
            document.getElementById("main_form").submit();           
           });
           $(document).on('click','#editAllBtn', function(){          
            document.getElementById('buttonName').value= "update";
            document.getElementById("main_form").method = "post";
            document.getElementById("main_form").submit();
           });
        </script>
        
    </html>