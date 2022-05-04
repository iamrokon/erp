<?php

namespace App\AllClass\master\nameMaster;


use App\AllClass\db\QueryHandler;
use App\categorykanri;
use \Carbon\Carbon;
use App\AllClass\master\nameMaster\validateNameEditMaster;
use App\AllClass\master\csvRecordEdit;
use App\tantousya;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

class editNameMaster
{
    public static function edit($request, $bango,$validate_only = 0)
    {
        $bangoName = tantousya::find($bango)->name;
        $mytime = Carbon::now()->toDateTimeString();

        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }
        }

        $validator = validateNameEditMaster::validate($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        }elseif(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation";
        } else {
            if ($validate_only != '1') {
                $mytime = str_replace(":", "", $mytime);
                $mytime = str_replace("-", "", $mytime);
                $mytime = str_replace(" ", "", $mytime);
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 名称マスタ start\n";
                QueryHandler::logger($bango, $log_data);

                $updateBefore = allCategorykanri::data($bango)->whereRaw("bango = " . request('edit_bango'))->toSql();
                $updateBefore = (object)collect(QueryHelper::fetchSingleResult($updateBefore))->toArray();
                $conn = pg_connect("host=" . env("DB_HOST") . " port=" . env("DB_PORT") . "  dbname=" . env("DB_DATABASE") . " user=" . env("DB_USERNAME") . " password=" . env("DB_PASSWORD"));
                pg_query($conn, "BEGIN");
                try {
                    if (request('category1') == 'AA') {
//            categorykanri::where('category1', request('category2'))
//                          ->update([
                        $category = [
                            'category3' => trim(request('category4')),
                            'category5' => trim(request('groupbango')),
                            'category1' => trim(request('category2'))
                        ];
                        QueryHelper::updateData('categorykanri', $category, ['category1' => trim(request('category2'))],$bango,__CLASS__,__FUNCTION__,__LINE__);
                    }
//            categorykanri::where('bango', request('edit_bango'))
//                          ->update([
                    $categor1 = [
                        'category4' => trim(request('category4')),
                        'groupbango' => trim(request('groupbango')),
                        'suchi1' => request('suchi1'),
                        'bango' => request('edit_bango'),
                        'image2' => $mytime,
                        //    'image3' => Helper::getSystemIP(),
                        'zokusei' => $bango,
                        'image3' => trim(request('edit_changed')),
                        'patternsub1' => trim(request('spare_one')),
                        'patternsub2' =>  trim(request('spare_two')),
                        'text' =>  trim(request('spare_three'))
                    ];
                    QueryHelper::updateData('categorykanri', $categor1, 'bango',$bango,__CLASS__,__FUNCTION__,__LINE__);
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 名称マスタ end\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn, "COMMIT");
                } catch (\Exception $e) {
                    $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
                    QueryHandler::logger($bango, $log_data);
                    pg_query($conn, "ROLLBACK");
                    $result['status'] = "ng";
                    $result['change_id'] = '';
                    return $result;
                }

                $result['change_id'] = request('edit_bango');
                $updateAfter = allCategorykanri::data($bango)->whereRaw("bango = " . request('edit_bango'))->toSql();
                $updateAfter = (object)collect(QueryHelper::fetchSingleResult($updateAfter))->toArray();
                $headers['データ有効区分'] = 'suchi2';
                csvRecordEdit::putData('nameMaster.csv', 'categorykanri', $updateBefore, $updateAfter, $bangoName, $headers);

            }
            $result['status'] = "ok";
            return $result;
        }
    }
}
