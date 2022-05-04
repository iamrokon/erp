<?php

namespace App\AllClass\other\dashboardComment;


use App\AllClass\db\QueryHandler;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use DB;
use App\tantousya;
Use \Carbon\Carbon;
Use App\AllClass\master\csvRecordInsert;
Use App\AllClass\other\dashboardComment\validateDashboardComment;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Schema;
use App\Helpers\Helper;
use App\AllClass\other\dashboardComment\allDashboardComment;

Class createDashboardComment
{

    public static function create($request, $bango, $file, $headers)
    {
        $mytime = Carbon::now()->toDateTimeString();
        $date = Carbon::now()->format('Y-m-d');
        $tantousha =  QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();

        $ecsyouhinjyouhou = QueryHelper::select(['*'])->from('ecsyouhinjyouhou')->orderBy("syouhinbango desc")->get()->first();
        $new_bango = 1;
        if($ecsyouhinjyouhou){
          $new_bango = $ecsyouhinjyouhou->syouhinbango + 1;
        }
        //return $new_bango;
        $reviewbango = QueryHelper::select(['orderbango'])->from('review')->where("kokyakusyouhinbango = 'D7302' ")->get()->first();
        $review=[
            'kokyakusyouhinbango'=>'D7302',
            'orderbango'=> ((int) $reviewbango->orderbango)+1
        ];
        $sitehinban = ((int) $reviewbango->orderbango)+1;

        $bangoName=tantousya::find($bango)->name;

        foreach ($request as $key => $value)
        {
            if ($key=='_token'||$key=='type')
            {
              unset($request[$key]);
            }
        }

        $validator=validateDashboardComment::validate($request,$bango);
        $errors = $validator->errors();
//        dd($errors);

        if ($errors->any() || Input::has('field')) {
            return $errors;
        }elseif(!$errors->any() && request('submit_confirmation') == ""){
            return "confirmation";
        }else {
            $new_name_of_file = "";
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### インフォメーション start\n";
            QueryHandler::logger($bango,$log_data);
            setlocale(LC_ALL,'en_US.UTF-8');
            if(request('hanbaimode')){
              $name_of_file = pathinfo(request('hanbaimode'));
              $new_name_of_file = $name_of_file['filename']."_dc".$new_bango.".".$name_of_file['extension'];
            }

            $conn = pg_connect("host=".env("DB_HOST")." port=".env("DB_PORT")."  dbname=".env("DB_DATABASE")." user=".env("DB_USERNAME")." password=".env("DB_PASSWORD"));
            pg_query($conn,"BEGIN");

          try{
            $result = [
                'syouhinbango' => $new_bango,
                'sitesyubetsu' => request('sitesyubetsu'),
                'sitehinban' => trim(sprintf("%08d", $sitehinban)),
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
                'hanbaimode' => $new_name_of_file,
                'syouhinzokusei' => NULL,
            ];
            $dashboardComment = QueryHelper::insertData('ecsyouhinjyouhou',$result,'syouhinbango',false,$bango,__CLASS__,__FUNCTION__,__LINE__);

            if ($dashboardComment) {
                QueryHelper::updateData('review', $review, 'kokyakusyouhinbango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                if ($file != "") {
                    $file->move(public_path('uploads/other/dashboard'), $new_name_of_file);
                }
                $syouhinbango = $new_bango;
            }

            $result['status'] = "ok";
            $result['change_id'] = $syouhinbango;
            $log_data = date('Y-m-d H:i:s')." ".__CLASS__." ".__FUNCTION__."### インフォメーション end\n";
            QueryHandler::logger($bango,$log_data);
            $query = allDashboardComment::data($bango, 0, $syouhinbango);
            $data = QueryHelper::fetchSingleResult($query);
            //return $syouhinbango;
            $headers['データ有効区分'] = 'jidoujuchuflag';
            CSVLogger::putData('dashboardComment.csv', 'ecsyouhinjyouhou', $data, $data, $bangoName, $headers, 1);
            pg_query($conn,"COMMIT");
            //pg_query($conn,mb_convert_encoding("COMMIT", "CP51932"));
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
