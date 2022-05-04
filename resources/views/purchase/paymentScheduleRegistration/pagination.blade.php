@php
    if(isset($payment_schedule_reg_data_table)){
        $current_page=$payment_schedule_reg_data_table->currentPage();
        $per_page=$payment_schedule_reg_data_table->perPage();
        $first_data= ($current_page - 1)*$per_page+1;
        $last_data=($current_page - 1)*$per_page+ sizeof($payment_schedule_reg_data_table->items());
        $total=$payment_schedule_reg_data_table->total();
        $lastPage=$payment_schedule_reg_data_table->lastPage();
    }else{
        $current_page = 1;
        $per_page = 20;
        $first_data = 1;
        $last_data = 0;
        $total = 0;
        $lastPage = 1;
    }
@endphp

<div class="row">
    <div class="col-7">
        <div class="pagi-content mt-3">
            <table>
                <tbody>
                <tr>
                    @if(isset($payment_schedule_reg_data_table) && $payment_schedule_reg_data_table->lastPage() > 1)
                        @include('purchase.paymentScheduleRegistration.pagination_new.pagination_new1')
                    @endif

                    @include('purchase.paymentScheduleRegistration.pagination_new.pagination_new2')

                    @if(isset($payment_schedule_reg_data_table) && $payment_schedule_reg_data_table->total() > 0)
                        @include('purchase.paymentScheduleRegistration.pagination_new.pagination_new3')
                    @endif

                    @include('purchase.paymentScheduleRegistration.pagination_new.pagination_new4')
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-5">
        <div class="right-pagi mt-3 mb-3 float-lg-right float-sm-left">
            <table>
                <tbody>
                <tr>
                    @include('purchase.paymentScheduleRegistration.pagination_new.pagination_new5')
                </tr>
                </tbody>
                
            </table>
        </div>
    </div>
</div>
