<div class="content-bottom-bottom">
    <div class="container">

    {{-- Table Starts Here --}}
       <div class="row">
         <div class="col-lg-12">
            <div class="wrapper-large-table" style="background-color:#fff;padding: 10px 10px 0 10px;">
               <div style="overflow: hidden;">
                <div class="table-responsive largeTable">
                  <table id="userTable" class="table table-bordered table-fill table-striped"
                style="margin-bottom: 20px!important;">
                <thead class="thead-dark header text-center" id="myHeader">
                  <tr>
                  @foreach($headers as $header=>$field)
                    <!-- <th scope="col" class="signbtn" style="width: 50px;"><span onclick="AscDsc('{{$field}}');" style="cursor:pointer;border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th> -->
                    <th scope="col" class="signbtn" style="width: 50px;"><span style="border:2px solid #3e6ec1;padding: 3px;text-align: center;display: block;min-width: 50px;margin: auto;background-color:#3e6ec1;  color: #fff;">{{$header}}</span></th>
                  @endforeach
                  </tr>
                </thead>
               
                 <tbody id="pay_schedule_registration_id">
                    <!-- 2nd row -->
                    
                    @if(isset($payment_schedule_reg_data_table))
                      @foreach($payment_schedule_reg_data_table as $key=>$val)
                        <tr>
                          @foreach($headers as $header=>$field)
                              <td <?php if($field=='number' || $field=='unit_price' || $field=='amount' || $field=='consumption_tax'||$field=='tax_included_amount') echo "class='text-right'"; ?>>{{$val->$field}}</td>
                          @endforeach
                        </tr>
                      @endforeach
                    @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- Table Ends Here --}}
  </div>
</div>