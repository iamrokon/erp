<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tantousya;
use Illuminate\Support\Facades\Redirect;
use App\AllClass\other\dashboardComment\allDashboardComment;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;

class DashboardController extends Controller
{
    public function noticeDetail($id,$notice_id,$bango)
    {

        if($notice_id == 1){
          $title = "インフォメーション（LAMUシステムに関するお知らせ）";
        }else {
          $title = "インフォメーション（その他のお知らせ）";
        }
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $ecsyouhinjyouhou = QueryHelper::select(['*'])->from('ecsyouhinjyouhou')->where("syouhinbango = '$id' ")->get()->first();
        $query = allDashboardComment::data($bango, '*', $id);
        $dashboardDetailInfo = QueryHelper::fetchSingleResult($query);
        $order_by_date = 1;
        $get_lower_data = (int) $ecsyouhinjyouhou->kinsyousu;
        $query2 = allDashboardComment::data('', '*', '', '', $notice_id, '', '', $get_lower_data);
        $dashboardCommentLowerData = QueryHelper::fetchResult($query2);
        return view('dashboard.notice_details',compact('dashboardDetailInfo','bango','tantousya','id','dashboardCommentLowerData','title','notice_id'));
    }

    public function notice($notice_id,$bango)
    {
        if($notice_id == 1){
          $title = "インフォメーション（LAMUシステムに関するお知らせ一覧）";
        }else {
          $title = "インフォメーション（その他のお知らせ一覧）";
        }
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $get_year = "1";
        $years = allDashboardComment::data('', '*', '', '', $notice_id, $get_year);
        $order_by_date = 1;
        $query = allDashboardComment::data('', '*', '', '',$notice_id, '', $order_by_date);
        $dashboardCommentNotice = QueryHelper::fetchResult($query);
        return view('dashboard.notice',compact('dashboardCommentNotice','years','bango','tantousya','title','notice_id'));
    }
}
