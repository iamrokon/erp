<?php


namespace App\Http\Controllers\sales;


use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\sales\DepositInput\AllDepositInput;
use App\AllClass\sales\DepositInput\DepositInputAmount as DepositAmount;
use App\AllClass\sales\DepositInput\DepositInput;
use App\AllClass\sales\DepositInput\searchCompany;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;


class DepositInputController extends Controller
{
    public function index()
    {
        //QueryHelper::runQuery("delete from eczaikorendou");
        //QueryHelper::runQuery("delete from daikinseisan");
        $bango = request('userId');
        $tantousya = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $creationCategories = QueryHelper::select(['syouhinbango', 'jouhou', 'color', 'bango'])->from('request')->where("color = '0410作成区分'")->orderBy('bango asc')->get()->execute();
        $paymentMethods = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'A9' order by suchi1 ASC ");
        $depositBanks = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H2'  order by suchi1 ASC ");
        $depositBranches = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H3' order by suchi1 ASC ");
        return view('sales.depositInput.main', compact('bango', 'tantousya', 'creationCategories', 'paymentMethods', 'depositBanks', 'depositBranches'));
    }

    public function save(Request $request, $bango)
    {
        if ($request->creation_category == '1 新規') {
            return DepositInput::create($request->all(), $bango);
        } else if ($request->creation_category == '2 訂正') {
            return DepositInput::edit($request->all(), $bango);
        }
        $result['status'] = 'not_ok';
        return $result;
    }

    public function getExpectedDepositAmount(Request $request)
    {
        $deposit_amount = $request->billing_address;
        $payment_day = Helper::replaceSpecificString($request->payment_date, '/');
        $result['deposit_amount'] = DepositAmount::calculate($deposit_amount, $payment_day);
        return $result;

    }

    public function getDetails(Request $request)
    {
        $result = [];
        try {

            /***
             * @20220210
             *  Edit possible or not.
             * ------------------------------------------------
             * If daikinseisan.shinkurokokyakuorderbango < review.orderbango then edit possible. Otherwise show
             * the 訂正回数が上限値D7402回に達しました。 error message
             */
            $review_result = QueryHelper::fetchSingleResult("select orderbango from review where kokyakusyouhinbango = 'D7402'");
            $daikinseisan_result = QueryHelper::fetchSingleResult("select max(shinkurokokyakuorderbango) as  shinkurokokyakuorderbango from daikinseisan where shinkurokokyakuname = '$request->deposit_number' limit 1");
            $review_order_bango = $review_result->orderbango;
            $daikinseisan_shinkurokokyakuorderbango = $daikinseisan_result->shinkurokokyakuorderbango;

           // $review_order_bango = 10;
           // $daikinseisan_shinkurokokyakuorderbango = 10;
           // var_dump($review_order_bango);
          //  var_dump($daikinseisan_shinkurokokyakuorderbango);
            if($daikinseisan_shinkurokokyakuorderbango != ''){
                if($daikinseisan_shinkurokokyakuorderbango >= $review_order_bango){
                    $res['status'] = 'review__daikinseisan_D7402_edit_error';
                    $res['err_msg'] = '訂正回数が上限値'.$review_order_bango.'回に達しました。';
                    return  $res;
                }
            }
            // ./ @20220210

            $rendomail_status = DepositInput::checkForRendoMail($request->deposit_number);
            if($request->creation_category == '2 訂正' && $rendomail_status ){
                $res['status'] = 'edit_error';
                $res['err_msg'] = 'すでに確定済のため入金情報の訂正はできません。';
                return  $res;
            }
            list($deposit_input, $deposit_input_details, $has_deposit_input) = AllDepositInput::data($request->deposit_number);
            if (!$has_deposit_input) {
                $result['status'] = 'error';
            } else if ($has_deposit_input) {
                $billing_address = $deposit_input['billing_address_db'];
                $deposit_res = DepositInput::getCategoriesKey($billing_address);
                $bankCategory2 = $deposit_res['deposit_bank'] ?? null;
                $branchCategory2 = $deposit_res['deposit_branch'] ?? null;
                $paymentMethods = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'A9' order by suchi1 ASC ");
                $depositBanks = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H2' order by suchi1 ASC ");
                $depositBranches = QueryHelper::fetchResult("select category1,category2,category4,bango,suchi2 from categorykanri where category1 = 'H3' order by suchi1 ASC ");
                $lineItemView = view('sales.depositInput.line-item', compact('deposit_input_details', 'paymentMethods', 'depositBanks', 'depositBranches', 'bankCategory2', 'branchCategory2'))->render();
                $result['deposit_input'] = $deposit_input;
                $result['lineItemView'] = $lineItemView;
                $result['deposit_input_details'] = $deposit_input_details;
                $result['status'] = 'ok';
            }
        } catch (\Exception $e) {
            dd($e);
            $result['status'] = 'ng';
        }
        return $result;
    }

    public function deleteLine(Request $request, $bango)
    {
        $payment_number = $request->depositNumber;
        $serial = $request->serial;
        $daikinseisanExists = QueryHelper::fetchSingleResult("select count(shinkurokokyakuname) from daikinseisan where shinkurokokyakuname = '$payment_number' and shinkurokokyakugroup = '$serial' and dataint01 = 0 ")->count ?? null;
        if ($daikinseisanExists) {
            $data = [
                'shinkurokokyakuname' => $payment_number,
                'shinkurokokyakugroup' => $serial,
                'dataint01' => 2,
                'shinkurokokyakuorderbango' => DepositInput::getshinkurokokyakuorderbango($payment_number, $serial),
                'henpinbi' => now()->format('Y-m-d H:i:s')
            ];
            $condition = [
                'shinkurokokyakuname' => $payment_number,
                'shinkurokokyakugroup' => $serial,
                'dataint01' => 0
            ];
            $isUpdate = QueryHelper::updateData('daikinseisan', $data, $condition, $bango, __CLASS__, __FUNCTION__, __LINE__);
            $result['daikinseisan'] = true;
            $result['status'] = $isUpdate ? 'ok' : 'not_ok';
        } else {
            $result['status'] = 'ok';
        }
        return $result;

    }

    public function billingAddressWiseCategories(Request $request)
    {

        $billing_address = $request->billing_address;
        return DepositInput::getCategoriesKey($billing_address);

    }
}
