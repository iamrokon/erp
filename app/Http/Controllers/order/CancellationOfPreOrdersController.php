<?php

namespace App\Http\Controllers\order;

use App\Http\Controllers\Controller;
use App\AllClass\ButtonMsg;
use App\AllClass\db\QueryHandler;
use App\kengen;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\tantousya;
use PDF;
use ZipArchive;
use File;
use Exception;
use DateTime;
use Illuminate\Support\Facades\Session;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

class CancellationOfPreOrdersController extends Controller
{
    public function index(Request $request)
    {

        $bango = request('userId');
        $tantousya = tantousya::find($bango);
        session()->put('userId',$bango);

        return view('order.cancellationOfPreOrders.mainCancellationOfPreOrders', compact('bango', 'tantousya'));

    }

    public function cancellationOfPreOrdersInfo(Request $request){
        $userId=$request['userId'];
        $orderNo=$request['orderNo'];
        dd($userId,$orderNo);

    }
}
