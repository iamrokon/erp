<div class="scrollbararea productModalScroll " style="height: 146px; overflow-y: scroll; cursor: pointer;">
    <table class="table modal-inner modal-table-white text-dark bg-white" style="margin-bottom: 0px !important;">
        <thead class="header text-center" id="myHeader">
        </thead>
        <tbody class="add_table_data">
        @foreach($syouhin1s as $syohin)
            <tr class="show_personal_master_info enableSelectProduct trfocus" tabindex="0" id="syohin-{{$syohin->kokyakusyouhinbango }}">
                <td>{{ $syohin->kokyakusyouhinbango   ?? null }}</td>
                <td>{{ $syohin->name   ?? null }}</td>
                <input value="{{ $syohin->set_product_data ?? null }}" type="hidden" id="set-{{$syohin->kokyakusyouhinbango }}" class="set_product_data"/>
                <input type="hidden" class="shoyin_data_100" value="{{$syohin->data100  ?? null }}">
                <input type="hidden" class="shoyin_child_count" value="{{$syohin->countChild  ?? null }}">
                <input type="hidden" class="shoyin_kongouritsu" value="{{ $syohin->mdjouhou ?? null }}">
                <input type="hidden" class="shoyin_mdjouhou" value="{{ $syohin->kongouritsu   ?? null }}">
                <input type="hidden" class="shoyin_url" value="{{$syohin->url  ?? null }}">
                <input type="hidden" class="shoyin_color" value="{{$syohin->newcolor4  ?? null }}">
                <input type="hidden" class="shoyin_tokuchou" value="{{$syohin->tokuchou  ?? null }}">
                <input type="hidden" class="shoyin_data22" value="{{$syohin->data22  ?? null }}">
                <input type="hidden" class="shoyin_data51" value="{{$syohin->data51  ?? null }}">
                <input type="hidden" class="syohin_product_status" id="product_id" value="{{$syohin->status}}">
            </tr>
        @endforeach
        </tbody>
    </table>
</div>







