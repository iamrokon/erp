<?php

namespace App\AllClass;

use App\AllClass\db\QueryHandler;
use App\AllClass\db\QueryHelperFacade as QueryHelper;
use DB;
use App\kengen;
use Illuminate\Http\Request;

class TableSetting
{
    /***
     * @param $headers
     * @param $id
     * @param $pageNo
     * @return array
     */
    public static function setting($headers, $id, $pageNo, $unsetKeys = [])
    {
        $originalTableSettings = static::getTableSetting($pageNo, $id, $headers, $unsetKeys);
        $originalTableSettings = static::removeUnusedDelimiter($originalTableSettings);
        $expectedTableSettings = [];
        foreach ($originalTableSettings as $key => $value) {
            $key = explode("=", $value)[0] ?? null;
            $val = explode("=", $value)[1] ?? null;
            $expectedTableSettings[$headers[$key]] = $val;
        }
        return $expectedTableSettings;
    }

    /**
     * @param Request $request
     * @param $id
     * @param $pageNo
     * @param $headers
     * @param $pageName
     * @param $resetToUserDefaultSetting
     * @return string
     */
    public static function settingSave($request, $id, $pageNo, $headers, $pageName, $resetToUserDefaultSetting)
    {
        $request = $request->except('_token');
        $headers = static::getHeaders($id, $pageNo, $headers, 'all_headers');
        $table_setting = static::getFormattedTableSetting($headers, $request);

        if ($resetToUserDefaultSetting) {
            static::getSettingsFromDB($request['id'], $request['page_no'])->delete();
            return true;
        }

        $hasTableSettings = static::getSettingsFromDB($id, $pageNo)->get()->toArray();
        $condition = ['kengenchar01' => 'col', 'kengenchar05' => $pageNo, 'kengenchar03' => $id];
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### $pageName start\n";
        QueryHandler::logger($id, $log_data);
        if (empty($hasTableSettings)) {
            $insertData = [
                'kengenchar01' => 'col',
                'kengenchar02' => null,
                'kengenchar05' => $pageNo,
                'kengenchar04' => $table_setting,
                'kengenchar03' => $id
            ];
            QueryHelper::insertData('kengensettei', $insertData, 'kengenchar01', true, $id, __CLASS__, __FUNCTION__, __LINE__);
//            $kengen = new Kengen;
//            $kengen->kengenchar01 = 'col';
//            $kengen->kengenchar02 = null;
//            $kengen->kengenchar05 = $pageNo;//... page number with dash
//            $kengen->kengenchar04 = $table_setting;//... json table setting data
//            $kengen->kengenchar03 = $id;//... user id,from url
//            $kengen->save();
            $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### $pageName end\n";
            QueryHandler::logger($id, $log_data);
            return true;
        }

//        static::getSettingsFromDB($id, $pageNo)->update([
//            'kengenchar04' => $table_setting
//        ]);
        $updateData = ['kengenchar04' => $table_setting, 'kengenchar01' => 'col', 'kengenchar05' => $pageNo, 'kengenchar03' => $id];
        QueryHelper::updateData('kengensettei', $updateData, $condition, $id, __CLASS__, __FUNCTION__, __LINE__);
        $log_data = date('Y-m-d H:i:s') . " " . __CLASS__ . " " . __FUNCTION__ . "### $pageName end\n";
        QueryHandler::logger($id, $log_data);
        return true;

    }

    /**
     * @param $tableSetting
     * @param $headers
     * @param $tableHeader
     * @return array
     */
    public static function getExpectedHeaders($tableSetting, $headers, $tableHeader)
    {
        $tableSettings = static::removeUnusedDelimiter($tableSetting);
        $settings = [];
        foreach ($tableSettings as $key => $value) {
            $settings[explode("=", $value)[0]] = isset(explode("=", $value)[1]) ? explode("=", $value)[1] : null;
        }

        $headersWithoutNullValue = collect($settings)->filter(function ($item) {
            return $item != null;
        });
        $headersWithNullValue = collect($settings)->filter(function ($item) {
            return $item == null;
        });

        // check if it is call for table headers
        if ($tableHeader) {
            $all_keys = $headersWithoutNullValue->merge($headersWithNullValue)->keys();
            return static::expectedHeader($all_keys, $headers, 'table_headers');
        }
        // call for all headers with sort
        $sortSettings = $headersWithoutNullValue->toArray();
        $sortKeys = static::sortHeaderKeys($sortSettings);
        return static::expectedHeader($sortKeys, $headers);
    }

    /**
     * @param $bango
     * @param $pageNo
     * @param $headers
     * @param null $type
     * @return array
     */
    public static function getHeaders($bango, $pageNo, $headers, $type = null)
    {

        $table_setting = static::getTableSetting($pageNo, $bango, $headers);
        return static::getExpectedHeaders($table_setting, $headers, $type);
    }

    /**
     * @param $pageNo
     * @param $bango
     * @param $headers
     * @return string|null
     */
    public static function getTableSetting($pageNo, $bango, $headers, $unsetKeys = [])
    {
        $default_settings = static::getFormattedTableSetting($headers);
        $settings = static::getSettingsFromDB($bango, $pageNo)->first();
        $user_def_settings = static::getSettingsFromDB('user_def', $pageNo)->first();
        if ($settings) {
            if ($unsetKeys) {
                return static::unsetColumns($settings->kengenchar04, $unsetKeys);
            }
            return $settings->kengenchar04;
        }

        if ($user_def_settings) {
            if ($unsetKeys) {
                return static::unsetColumns($user_def_settings->kengenchar04, $unsetKeys);
            }
            $user_def_settings = $user_def_settings->kengenchar04;
            //  //if user only want to see user_def setting the uncomment below portion
//            if ($bango != 'user_def') {
//                return static::removeNullColumn($user_def_settings);
//            }
            return $user_def_settings;
        }
        if ($unsetKeys) {
            return static::unsetColumns($default_settings, $unsetKeys);
        }

        return $default_settings;

    }

    public static function sortHeaderKeys($arr)
    {
        $multi_arr = [];
        foreach ($arr as $k => $val) {
            $multi_arr["$val"][] = array($k => $val);
        }
        uksort($multi_arr, function ($a, $b) {
            return $b < $a ? 1 : -1;
        });
        $s_arr = [];
        foreach ($multi_arr as $k => $val) {
            foreach ($val as $p_id) {
                $p_arr = array_keys($p_id);
                $s_arr[] = $p_arr[0];
            }
        }
        return $s_arr;
    }

    public static function expectedHeader($keys, $originalHeaders, $tableHeader = null)
    {
        if ($tableHeader) {
            return collect($originalHeaders)->only($keys)->all();
        }
        $expectedHeaders = [];
        foreach ($keys as $value) {
            $expectedHeaders[$value] = $originalHeaders[$value];
        }
        return $expectedHeaders;
    }

    public static function getFormattedTableSetting($headers, $input = null)
    {
        $tableSettings = null;
        $firstIteration = 0;
        foreach ($headers as $key => $value) {
            if ($input && isset($input['check_' . $value])) {
                if ($input[$value] != null) {
                    $tableSettings .= $key . '=' . $input[$value] . '¶';
                } else {
                    $tableSettings .= $key . '=' . '200' . '¶';
                }
            } else {
                if (!$input) {
                    if ($firstIteration == 0) {
                        $tableSettings .= $key . '=' . '0' . '¶';
                    } else {
                        $tableSettings .= $key . '=' . '200' . '¶';
                    }
                } else {
                    $tableSettings .= $key . '=' . '¶';
                }

            }
            $firstIteration++;
        }

        return $tableSettings;
    }

    public static function removeUnusedDelimiter($data, $delimiter = "¶")
    {
        $data = explode($delimiter, $data);
        unset($data[count($data) - 1]);
        return $data;
    }

    public static function getSettingsFromDB($user, $pageNo)
    {
        return kengen::where('kengenchar01', 'col')
            ->where('kengenchar03', $user)
            ->where('kengenchar05', $pageNo);
    }

    public static function removeNullColumn($kengenChar04)
    {
        $kengenChar04 = explode('¶', $kengenChar04);
        $kengenChar04 = collect($kengenChar04)->filter(function ($item) {
            return isset(explode('=', $item)[1]) && explode('=', $item)[1] != null;
        })->toArray();
        $kengenChar04 = implode('¶', $kengenChar04);
        $kengenChar04 = $kengenChar04 . '¶';
        return $kengenChar04;
    }

    public static function unsetColumns($kengenChar04, $unsetKey)
    {
        $kengenChar04 = explode('¶', $kengenChar04);
        $kengenChar04 = collect($kengenChar04)->filter(function ($item) use ($unsetKey) {
            return $item != '' && isset(explode('=', $item)[0]) && !in_array(explode('=', $item)[0], $unsetKey);
        })->toArray();
        $kengenChar04 = implode('¶', $kengenChar04);
        $kengenChar04 = $kengenChar04 . '¶';
        return $kengenChar04;
    }

    public static function removeTableHeaders($table_headers, $unsetKeys)
    {
        foreach ($unsetKeys as $key) {
            unset($table_headers[$key]);
        }
        return $table_headers;

    }


}
