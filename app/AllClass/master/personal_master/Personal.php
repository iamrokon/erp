<?php

namespace App\AllClass\master\personal_master;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use App\AllClass\master\CSVLogger;
use App\AllClass\specialCharValidation;
use App\AllClass\TableSetting;
use App\AllClass\zenkaku;
use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class Personal
{
    public static $page_no = '08-03';

    public static function headers($bango, $type = null)
    {
        $headers = [
            '会社CＤ' => 'personal_company_cd',
            '会社名' => 'company_name',
            '事業所CＤ' => 'personal_office_cd',
            '事業所名' => 'office_name',
            '個人CＤ' => 'personal_datatxt0049',
            '部署' => 'mail2',
            '役職' => 'mail3',
            '個人名' => 'tantousya',
            '個人名略称' => 'mail4',
            '入力区分' => 'mail5',
            'メールアドレス' => 'mail1',
            'TEL' => 'personal_datatxt0016',
            'FAX' => 'personal_datatxt0017',
            '備考' => 'datatxt0018',
            '案内フラグ' => 'datatxt0040',
            'キーマンフラグ' => 'datatxt0041',
            '役員改選案内' => 'datatxt0042',
            '年賀状' => 'datatxt0043',
            'ユーザー様感謝会案内' => 'datatxt0044',
            '送付物フラグ４' => 'datatxt0045',
            '登録年月日' => 'created_date',
            '登録時刻' => 'created_time',
            '更新年月日' => 'edited_date',
            '更新時刻' => 'edited_time',
            //'更新時端末IP' => 'datatxt0048',
            '更新者' => 'created_by',
        ];
        $pageNo = static::$page_no;
        if ($type) {
            return TableSetting::getHeaders($bango, $pageNo, $headers, $type);
        }

        return TableSetting::getHeaders($bango, $pageNo, $headers);
    }

    public static function create($request, $bango, $headers, $validate_only = 0)
    {
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type' || $key == 'url' || $key == 'chkboxinp') {
                unset($request[$key]);
            }
            if ($value == '') {
                $request[$key] = null;
            }
        }
        $validator = self::validation($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $bangoName = $tantousha->name ?? null;
                $torihikisakibango = explode('-', $request['office_cd'])[0] ?? null;
                $haisoBango = explode('-', $request['office_cd'])[1] ?? null;
                $yobi12 = trim(explode('-', $request['company_cd'])[0]) ?? null;
                $kokyakubango = trim(explode('-', $request['company_cd'])[1]) ?? null;
                $log_data = date('Y-m-d H:i:s') . ' ' . __CLASS__ . ' ' . __FUNCTION__ . "### 個人マスタ start\n";
                QueryHandler::logger($bango, $log_data);

                //find missing number in sorted order or find max_yobi12 starts here
                $temp_etsuransya = QueryHelper::fetchSingleResult("
                select datatxt0049
                from (
                     select generate_series (1, (select max(datatxt0049::int) from etsuransya  where datatxt0014::int = $yobi12 and  datatxt0015::int = $torihikisakibango)) as datatxt0049
                     except select datatxt0049::int from etsuransya
                       where datatxt0014::int = $yobi12 and  datatxt0015::int = $torihikisakibango
                    ) temp_etsuransya order by datatxt0049 limit 1");
                if (count((array) $temp_etsuransya) > 0) {
                    $datatxt0049 = sprintf('%03d', $temp_etsuransya->datatxt0049);
                } else {
                    $etsuransyaData = DB::select(DB::raw("SELECT max(CAST(datatxt0049 as integer)) as max_datatxt0049 FROM etsuransya  where datatxt0014::int = $yobi12 and  datatxt0015::int = $torihikisakibango"));
                    if ($etsuransyaData) {
                        $datatxt0049 = $etsuransyaData[0]->max_datatxt0049 + 1;
                        $datatxt0049 = sprintf('%03d', $datatxt0049);
                    } else {
                        $datatxt0049 = '001';
                    }
                }

                $insert = [
                    'datatxt0014' => $yobi12,
                    'kokyakubango' => $kokyakubango,
                    'datatxt0015' => $torihikisakibango,
                    'datanum0018' => $haisoBango,
                    'datatxt0049' => $datatxt0049,
                    'mail2' => trim($request['deploy']),
                    'mail3' => trim($request['position']),
                    'tantousya' => trim($request['personal_name']),
                    'mail4' => trim($request['department_charge_abbreviation']),
                    'mail5' => trim($request['input_classification']) ?? null,
                    'mail1' => trim($request['mail_address']),
                    'datatxt0016' => trim($request['tel']),
                    'datatxt0017' => trim($request['fax']),
                    'datatxt0018' => trim($request['internal_notes']),
                    'datatxt0040' => $request['information_stop_flag'] ?? null,
                    'datatxt0041' => $request['keyaman_flag'] ?? null,
                    'datatxt0042' => $request['officer_election_information'] ?? null,
                    'datatxt0043' => $request['new_years_card'] ?? null,
                    'datatxt0044' => $request['user_meeting_information'] ?? null,
                    'datatxt0045' => $request['shipment_flag'] ?? null,
                    'deleteflag' => 0,
                    'datatxt0046' => trim(self::getCurrentTime()),
                    //  'datatxt0048' => Helper::getSystemIP(),
                    'datatxt0090' => $bango,
                ];
                $etsuransya = QueryHelper::insertData('etsuransya', $insert, 'bango', true, $bango, __CLASS__, __FUNCTION__, __LINE__);
                \session()->flash('success_msg', '個人CD　' . $datatxt0049 . ' 登録完了しました。');
                $result['id'] = $etsuransya->bango;
                $log_data = date('Y-m-d H:i:s') . ' ' . __CLASS__ . ' ' . __FUNCTION__ . "### 個人マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                $query = AllPersonal::data($bango);
                $query .= " where bango = $etsuransya->bango";
                $data = QueryHelper::fetchSingleResult($query);
                $headers['データ有効区分'] = 'deleteflag';
                CSVLogger::putData('personalMaster.csv', 'etsuransya', $data, $data, $bangoName, $headers, 1);
            }
            $result['status'] = 'ok';

            return $result;
        }
    }

    public static function edit($request, $bango, $headers, $validate_only = 0)
    {
        foreach ($request as $key => $value) {
            if ($key == '_token' || $key == 'type' || $key == 'url' || $key == 'chkboxinp') {
                unset($request[$key]);
            }
            if ($value == '') {
                $request[$key] = null;
            }
        }

        $validator = self::validation($request, $bango);

        $errors = $validator->errors();

        if ($errors->any() || Input::has('field')) {
            return $errors;
        } else {
            if ($validate_only != '1') {
                $tantousha = QueryHelper::select(['*'])->from('tantousya')->where("bango = '$bango' ")->get()->first();
                $bangoName = $tantousha->name ?? null;
                $personalbango = $request['personalBango'];
                $query = AllPersonal::data($bango);
                $query .= " where bango =  $personalbango";

                $updateBefore = QueryHelper::fetchSingleResult($query);
                $log_data = date('Y-m-d H:i:s') . ' ' . __CLASS__ . ' ' . __FUNCTION__ . "### 個人マスタ start\n";
                QueryHandler::logger($bango, $log_data);
                $update = [
                    'bango' => trim($request['personalBango']),
                    'mail2' => trim($request['deploy']),
                    'mail3' => trim($request['position']),
                    'tantousya' => trim($request['personal_name']),
                    'mail4' => trim($request['department_charge_abbreviation']),
                    'mail5' => trim($request['input_classification']) ?? null,
                    'mail1' => trim($request['mail_address']),
                    'datatxt0016' => trim($request['tel']),
                    'datatxt0017' => trim($request['fax']),
                    'datatxt0018' => trim($request['internal_notes']),
                    'datatxt0040' => $request['information_stop_flag'] ?? null,
                    'datatxt0041' => $request['keyaman_flag'] ?? null,
                    'datatxt0042' => $request['officer_election_information'] ?? null,
                    'datatxt0043' => $request['new_years_card'] ?? null,
                    'datatxt0044' => $request['user_meeting_information'] ?? null,
                    'datatxt0045' => $request['shipment_flag'] ?? null,
                    'deleteflag' => 0,
                    'datatxt0047' => trim(self::getCurrentTime()),
                    //   'datatxt0048' => Helper::getSystemIP(),
                    'datatxt0090' => $bango,
                ];
                QueryHelper::updateData('etsuransya', $update, 'bango', $bango, __CLASS__, __FUNCTION__, __LINE__);
                \session()->flash('success_msg', '個人CD　' . $request['personal_cd'] . ' 変更完了しました。');
                $updateAfter = QueryHelper::fetchSingleResult($query);
                $log_data = date('Y-m-d H:i:s') . ' ' . __CLASS__ . ' ' . __FUNCTION__ . "### 個人マスタ end\n";
                QueryHandler::logger($bango, $log_data);
                $headers['データ有効区分'] = 'deleteflag';
                CSVLogger::putData('personalMaster.csv', 'etsuransya', $updateBefore, $updateAfter, $bangoName, $headers, 2);
                $result['id'] = $request['personalBango'];
            }
            $result['status'] = 'ok';

            return $result;
        }
    }

    public static function validation($request, $bango)
    {
        $rules = [];
        if (Input::has('field')) {
            $rules['company_cd'] = ['required'];
            $rules['office_cd'] = ['required'];
            $rules['deploy'] = ['nullable', 'max:30', new zenkaku];
            $rules['position'] = ['nullable', 'max:15', new zenkaku];
            $rules['personal_name'] = ['required', 'max:15', new zenkaku];
            $rules['department_charge_abbreviation'] = ['required', 'max:15', new zenkaku];
            // $rules['mail_address'] = ['max:100', 'nullable', 'regex:/^[a-zA-z0-9-._@]+$/'];
            // $rules['mail_address_confirmation'] = ['max:100', 'nullable', 'regex:/^[a-zA-z0-9-._@]+$/'];
            $rules['mail_address'] = ['max:100', 'nullable', 'confirmed'];
            $rules['mail_address_confirmation'] = ['max:100', 'nullable'];
            $rules['tel'] = ['nullable', 'max:11', 'regex:/^[0-9]+$/'];
            $rules['fax'] = ['nullable', 'max:11', 'regex:/^[0-9]+$/'];
            $rules['internal_notes'] = ['max:50', 'nullable', new zenkaku];
        } else {
            $rules['company_cd'] = ['required'];
            $rules['office_cd'] = ['required'];
            $rules['deploy'] = ['nullable', 'max:30', new specialCharValidation, new zenkaku];
            $rules['position'] = ['nullable', 'max:15', new specialCharValidation, new zenkaku];
            $rules['personal_name'] = ['required', 'max:15', new specialCharValidation, new zenkaku];
            $rules['department_charge_abbreviation'] = ['required', 'max:15', new specialCharValidation, new zenkaku];
            // $rules['mail_address'] = ['max:100', 'nullable', 'email', new specialCharValidation, 'confirmed', 'regex:/^[a-zA-z0-9-._@]+$/'];
            // $rules['mail_address_confirmation'] = ['max:100', 'nullable', new specialCharValidation, 'regex:/^[a-zA-z0-9-._@]+$/'];
            $rules['mail_address'] = ['max:100', 'nullable', 'confirmed', new CustomEmailValidator];
            $rules['mail_address_confirmation'] = ['max:100', 'nullable'];
            $rules['tel'] = ['nullable', 'max:11', 'regex:/^[0-9]+$/'];
            $rules['fax'] = ['nullable', 'max:11', 'regex:/^[0-9]+$/'];
            $rules['internal_notes'] = ['max:50', 'nullable', new specialCharValidation, new zenkaku];
        }

        $messages = [];
        $messages['required'] = '【:attribute】必須項目に入力がありません。';
        $messages['mail_address.confirmed'] = '【:attribute (確認用) 】とメールアドレスが一致しません。';
        $messages['max'] = '【:attribute】:max 桁以下で入力してください。';
        $messages['email'] = '【:attribute】入力されたメールアドレスの形式はご登録いただけません。';
        $messages['regex'] = '【:attribute】半角英数字以外は使用できません。';
        $messages['tel.regex'] = '【:attribute】半角数字以外は使用できません。';
        $messages['fax.regex'] = '【:attribute】半角数字以外は使用できません。';

        $attributes = [
            'company_cd' => '会社CＤ',
            'office_cd' => '事業所CＤ',
            'deploy' => '部署',
            'position' => '役職',
            'personal_name' => '個人名',
            'department_charge_abbreviation' => '個人名略称',
            'mail_address' => 'メールアドレス',
            'mail_address_confirmation' => 'メールアドレス (確認用)',
            'tel' => 'TEL',
            'fax' => 'FAX',
            'internal_notes' => '備考',
        ];
        if (Input::has('field')) {
            $front_field = explode(',', request('field'));
            foreach ($rules as $key => $val) {
                if (!in_array($key, $front_field)) {
                    unset($rules[$key]);
                }
            }
        }

        return Validator::make($request, $rules, $messages, $attributes);
    }

    public static function getCurrentTime()
    {
        $mytime = Carbon::now()->toDateTimeString();
        $mytime = str_replace(':', '', $mytime);
        $mytime = str_replace('-', '', $mytime);
        $mytime = str_replace(' ', '', $mytime);

        return $mytime;
    }
}
