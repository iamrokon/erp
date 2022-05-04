<?php

namespace App\AllClass\master\nameMaster;


use App\AllClass\db\QueryHandler;
use DB;
use App\categorykanri;
use \Carbon\Carbon;
use App\tantousya;
use App\AllClass\master\nameMaster\validateNameMaster;
use App\AllClass\master\csvRecordInsert;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

class createNameMaster
{
    public static function create($request, $bango, $headers, $validate_only = 0)
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

        $validator = validateNameMaster::validate($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1'){
                $mytime = str_replace(":", "", $mytime);
                $mytime = str_replace("-", "", $mytime);
                $mytime = str_replace(" ", "", $mytime);

                $maxId = categorykanri::whereNotNull('bango')->max('bango');
                $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### 名称マスタ start\n";
                QueryHandler::logger($bango, $log_data);
                $category = [
                    'category1' => trim(request('category1')),
                    'category2' => trim(request('category2')),
                    'bango' => $maxId + 1,
                    'category3' => trim(request('category3')),
                    'category4' => trim(request('category4')),
                    'category5' => trim(request('category5')),
                    'groupbango' => trim(request('groupbango')),
                    'osusume' => trim(request('osusume')),
                    'suchi1' => trim(request('suchi1')),
                    'suchi2' => 0,
                    'image1' => $mytime,
                    // 'image3' => Helper::getSystemIP(),
                    'zokusei' => $bango,
                    'image3' => trim(request('changed')),
                    'patternsub1' => trim(request('spare_one')),
                    'patternsub2' =>  trim(request('spare_two')),
                    'text' =>  trim(request('spare_three'))
                ];

                QueryHelper::insertData('categorykanri', $category, 'bango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);

//            $kanris= new categorykanri;
//            $kanris->category1 =trim(request('category1'));
//            $kanris->category2 =trim(request('category2'));
//            $kanris->bango =$maxId+1;
//            $kanris->category3 =trim(request('category3'));
//            $kanris->category4 =trim(request('category4'));
//            $kanris->category5 =trim(request('category5'));
//            $kanris->groupbango =trim(request('groupbango'));
//            $kanris->osusume =request('osusume');
//            $kanris->suchi1 =request('suchi1');
//            $kanris->suchi2 =0;
//            $kanris->image1 =$mytime;
//            $kanris->image3 =!empty($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:null;
//            $kanris->zokusei =$bango;
//            $kanris->save();


                $result['change_id'] = $maxId + 1;
                $max1 = $maxId + 1;
                $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### 名称マスタ end\n";
                QueryHandler::logger($bango,$log_data);
                $data = allCategorykanri::data($max1)->whereRaw("bango = '" . $max1 . "'")->toSql();
                $data = (object)collect(QueryHelper::fetchSingleResult($data))->toArray();
                $headers['データ有効区分'] = 'suchi2';
                csvRecordInsert::putData('nameMaster.csv', 'categorykanri', $data, $bangoName, $headers);


            }
            $result['status'] = "ok";
            return $result;


        }
    }
}
