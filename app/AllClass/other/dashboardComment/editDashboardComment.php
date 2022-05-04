<?php

namespace App\AllClass\other\dashboardComment;

use App\AllClass\db\QueryHandler;
use App\AllClass\master\CSVLogger;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use DB;
Use App\AllClass\master\csvRecordEdit;
use App\tantousya;
Use \Carbon\Carbon;
Use App\AllClass\other\dashboardComment\validateDashboardEditComment;
use App\AllClass\other\dashboardComment\allDashboardComment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Helpers\Helper;

Class editDashboardComment
{
    public static function edit($request, $bango, $file, $headers)
    {
        $mytime = Carbon::now()->toDateTimeString();
        $tantousha =  QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
        $bangoName=tantousya::find($bango)->name;

        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type') {
                unset($request[$key]);
            }
            if ($value == "") {
                $request[$key] = null;
            }

        }


        $validator = validateDashboardEditComment::validate($request, $bango);

        $errors = $validator->errors();
//        dd($errors->any(),Input::has('field'),request('submit_confirmation'));
        if ($errors->any() || Input::has('field')) {
            return $errors;
        }elseif(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation";
        }else {

            $result = array();
            $hanbaimode = "";
            $old_hanbaimode = "";
            $new_hanbaimode = "";
            setlocale(LC_ALL,'en_US.UTF-8');
            if(request('hanbaimode')){
              $name_of_file = pathinfo(request('hanbaimode'));
              $new_hanbaimode = $name_of_file['filename']."_dc".request('syouhinbango').".".$name_of_file['extension'];
            }
            $old_hanbaimode = request('old_hanbaimode');
            if ($old_hanbaimode == request('hanbaimode')) {
                $hanbaimode = request('hanbaimode');
            } else {
                $hanbaimode = $new_hanbaimode;
            }
            $query = allDashboardComment::data($bango, 0, request('syouhinbango'));
            $updateBefore = QueryHelper::fetchSingleResult($query);
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### インフォメーション start\n";
            QueryHandler::logger($bango, $log_data);

            $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
            pg_query($conn,"BEGIN");

          try{
            $data = [
              'syouhinbango' => request('syouhinbango'),
              'sitesyubetsu' => request('sitesyubetsu'),
              'sitehinban' => request('sitehinban'),
              'yukouflag' => (int) request('yukouflag'),
              'bunpaipercent' => $bango,
              'kinsyousu' => str_replace('/','',request('kinsyousu')),
              'kinsyousetteisu' => str_replace('/','',request('kinsyousetteisu')),
              'saisinjikoku' => $mytime,
              'kousinzaikosu' => NULL,
              'status' => request('status'),
              'check01' => NULL,
              'kakuhosu' => NULL,
              'leadtime' => NULL,
              'jidoujuchuflag' => 0,
              'yoyakuflag' => NULL,
              'yoyakusaidaisu' => NULL,
              'yoyakuhanbaisu' => NULL,
              'hanbaimode' => $hanbaimode,
              'syouhinzokusei' => NULL,

            ];
            $dataUpdate = QueryHelper::updateData('ecsyouhinjyouhou',$data,'syouhinbango',$bango,__CLASS__,__FUNCTION__,__LINE__);
            //dd($old_hanbaimode, $new_hanbaimode);
            //return($hanbaimode);
            if ($dataUpdate) {
              if($file != ""){
                if ($old_hanbaimode != $new_hanbaimode) {
                  if($old_hanbaimode){
                    $file_path = public_path() . '/uploads/other/dashboard/' . $old_hanbaimode;
                    \File::delete($file_path);
                  }
                  //if ($file != "") {
                    $file->move(public_path('uploads/other/dashboard'), $hanbaimode);
                  //}
                }
              }
            }
            $query = allDashboardComment::data($bango, 0, request('syouhinbango'));
            $updateAfter = QueryHelper::fetchSingleResult($query);
            $syouhinbango = request('syouhinbango');
            $result['status'] = "ok";
            $result['change_id'] = $syouhinbango;
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### インフォメーション end\n";
            QueryHandler::logger($bango,$log_data);
            $headers['データ有効区分'] = 'jidoujuchuflag';
            CSVLogger::putData('dashboardComment.csv', 'ecsyouhinjyouhou', $updateBefore, $updateAfter, $bangoName, $headers, 2);
            pg_query($conn,"COMMIT");
            return $result;
          } catch (\Exception $e) {
              $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . " " . $e . "\n";
              QueryHandler::logger($bango, $log_data);

              pg_query($conn,"ROLLBACK");
              $result['status'] = "ng";
              $result['change_id'] = "";
              return $result;
          }
        }
    }
}
