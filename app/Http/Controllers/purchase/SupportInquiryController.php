<?php

namespace App\Http\Controllers\purchase;
use Illuminate\Http\Request;
use App\tantousya;
use App\kengen;
use App\requestTable;
use DB;
use Session;
use App\Http\Controllers\Controller;
use App\AllClass\purchase\supportInquiry\AllSupportInquiry;
use App\AllClass\ButtonMsg;
use Illuminate\Pagination\Paginator;
use App\AllClass\master\excelDownload;
use App\kokyaku1;
use App\AllClass\TableSetting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use PDF;
use ZipArchive;
use Excel;
use App\AllClass\master\ExcelReportDownload;
use Carbon\Carbon;
use App\AllClass\master\CSVLogger;
use App\AllClass\newExcelExport;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\db\QueryHandler;

class SupportInquiryController extends Controller
{
    
    public function postSupportInquiry(Request $request)
    {
        try {
            $bango = request('userId');
            $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
            $support_number = request('kokyakuorderbango');
            $ordertypebango2 = request('ordertypebango2');
            $query = AllSupportInquiry::data($bango,$support_number,$ordertypebango2)->toSql();
            $supportInquiryData = QueryHelper::fetchSingleResult($query);

            return view('purchase.supportInquiry.mainSupportInquiry', compact('bango','tantousya','supportInquiryData'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

}
