<?php

namespace App\Http\Controllers\sales;

use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\sales\balanceUpdate\allData;
use App\AllClass\sales\balanceUpdate\allActions;
use App\Http\Controllers\Controller;


class BalanceUpdateController extends Controller
{
    public function index()
    {
        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        return view('sales.balanceUpdate.index',compact('tantousya','bango'));
    }
    public function update()
    {
        $date = QueryHelper::fetchSingleResult(
            "select orderbango 
            from review 
            where kokyakusyouhinbango = 'D7503'
            "
        )->orderbango;

        $first_date = date('Ymd', strtotime("+1 day", strtotime($date)));
        $last_date = date('Ymt', strtotime("first day of +1 month",strtotime($date)));
        $sales_updated_flag = false;
        $deposit_updated_flag = false;
        $note_updated_flag = false;

    	$query = allData::sales_data($first_date,$last_date);
        $query_results = QueryHelper::fetchResult($query);
        // foreach($query_results as $result)
        // {
        //     $last_month_start = date('Y-m-01 H:i:s', strtotime("-1 week",strtotime($result->intorder03)));
        //     dd($result->intorder03, $last_month_start);
        // }
        $sales_updated_flag = allActions::sales_action($query_results);

        $query = allData::deposit_data1($first_date,$last_date);
        $query_results = QueryHelper::fetchResult($query);
        //dd($query_results);
        // foreach($query_results as $result)
        // {
        //     $last_month_start = date('Y-m-01 H:i:s', strtotime("-1 week",strtotime($result->torikomidate)));
        //     dd($result->torikomidate, $last_month_start);
        // }
        $deposit_updated_flag1 = allActions::deposit_action1($query_results);

        $query = allData::deposit_data2($first_date,$last_date);
        $query_results = QueryHelper::fetchResult($query);
        $deposit_updated_flag2 = allActions::deposit_action2($query_results);

        $query = allData::note_data($first_date,$last_date);
        $query_results = QueryHelper::fetchResult($query);
        $note_updated_flag = allActions::note_action($query_results);

        if(!$sales_updated_flag && !$deposit_updated_flag1 && !$deposit_updated_flag2 && !$note_updated_flag ) return 'nd';

    	return 'ok';
    }
}
