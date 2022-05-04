<div class="scrollbararea productModalScroll " style="height: 184px; overflow-y: scroll; cursor: pointer;">
    <table id="productTable" class="table modal-inner modal-table-white text-dark bg-white"
        style="margin-bottom: 0px !important;">
        <thead class="header text-center" id="productTableHeader">
        </thead>
        <tbody class="add_table_data" id="productTableBoday">
            @foreach($syouhin1s as $syohin)
                <tr class="show_personal_master_info enableSelectProduct trfocus productRow" tabindex="0" style="height: 41px;" id="syohin-{{$syohin->kokyakusyouhinbango }}">
                    <td>{{ $syohin->kokyakusyouhinbango   ?? null }}</td>
                    <td>{{ $syohin->name   ?? null }}</td>
                </tr>
                
            @endforeach
        </tbody>
    </table>
</div>