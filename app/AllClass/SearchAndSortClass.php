<?php


namespace App\AllClass;

use DB;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;
use Exception;

class SearchAndSortClass
{

    private static $headers = ['kokyakuorderbango', 'office_shikibetsucode', 'office_torihikisakibango', 'office_tel', 'office_torihikisakirank2', 'office_bango', 'office_ztanka', 'office_mail2', 'office_yobi12', 'office_fax', 'office_yetoiawsestart', 'office_mail_soushin', 'office_mail_jyushin', 'office_mail_nouhin_mb', 'office_mallsoukobango3', 'office_bunrui6', 'office_syukeinen', 'office_syukeitukikijun', 'office_bunrui10', 'office_datatxt0056', 'office_datatxt0055', 'office_datatxt0054', 'office_shikibetsucode', 'office_yubinbango', 'office_tel', 'office_torihikisakirank2', 'office_yobi1', 'office_other9', 'office_other15', 'office_other25', 'office_other26', 'office_other27', 'office_other36', 'office_other40', 'personal_company_cd', 'personal_office_cd', 'personal_datatxt0049', 'personal_datatxt0016', 'personal_datatxt0017', 'product_kokyakusyouhinbango','syouhinbango', 'product_season', 'product_data20', 'product_chardata4', 'product_kongouritsu', 'product_data104', 'employee_bango', 'employee_syounin', 'employee_mail4', 'employee_mail2', 'product_des_urlsm', 'lbook_datachar05', 'project_url', 'order_history_datachar03', 'order_history_datachar04', 'order_history_datachar08', 'order_history_datachar09', 'sales_slip_juchukubun2', 'information6', 'invoice_deadline_datatxt0142', 'invoice_deadline_text3', 'invoice_deadline_datachar12', 'invoice_deadline_mail_jyushin_mb', 'sales_history_datachar03', 'sales_history_juchukubun2', 'sales_history_youbou', 'deposit_history_shinkurokokyakuname', 'deposit_history_shinkurokokyakugroup', 'deposit_history_nyukingaku','dhl_apply_line_number', 'dhl_deposit_application','s1_s2kaiinid_s3shinkurokokyakuname','s1_s2syouhinid_s3syouhinid','unpaidlist_sales_amount','unpaidlist_sum_of_nyukingaku','unpaidlist_deposit_balance','money10','moneymax','numeric3','sum_of_dataint05','sum_of_dataint06','sum_of_dataint07','before_modified_money10','before_modified_moneymax','before_modified_s1','before_modified_s2','before_modified_s3','purchase_consumption_tax','support_amount','total_order_amount','purchase_history_amount_sort', 'purchase_consumption_tax_amount_sort','consumption_tax_paid_sort','invoice_date_sort','inventory_purchase_amount','inventory_purchase_quantity','inventory_purchase_unit_price','inventory_tax_amount',
                                'ledger_number', 'ledger_unit_price', 'ledger_price', 'ledger_paymet_amount', 'ledger_accounts_payable','purchase_details1_quantity_sort','purchase_details1_unit_price_sort','purchase_details1_amount_sort','purchase_details2_quantity2_sort','purchase_details2_unit_price2_sort','purchase_details2_amount2_sort','purchase_inquiry_quantity','purchase_inquiry_unit_price','purchase_inquiry_amount','purchase_result_list_schedule','purchase_result_list_amount','purchase_result_list_results','purchase_result_list_difference','money10_search','scheduled_to_work_search','sum_of_syouhizeiritu_search','sum_of_syukkasu_dataint08_search','scheduled_work_result_search','purchase_sum_search','purchase_difference_search','data203','data204','data205','data206','data207','data208','data209','data210','data211','data212','data252','data253','data254','data255','data256','data257','data258','data259','data260'];


    private static $headers_int = ['yetoiawsestart', 'mail_jyushin', 'bunrui10', 'office_other10', 'office_other6', 'office_other38', 'payment_amount_sort'];
    public function __construct()
    {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $dbname = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $this->connection = pg_connect(sprintf("host=%s port=%s  dbname=%s user=%s password=%s", $host, $port, $dbname, $user, $password));
    }

    public function fetchResult($sql)
    {
        $result = [];
        $query_result = pg_query($this->connection, $sql);;
        while ($row = pg_fetch_assoc($query_result)) {
            $result[] = $row;
            //$result[] = mb_convert_encoding($row, 'utf-8', 'CP51932');
        }
        $result = json_decode(json_encode($result), FALSE);
        return $result;
    }

    public static function search($sqlQuery, $request, $bango, $temp_table)
    {


        if (strpos($sqlQuery, 'where') !== false) {
        } else {
            $sqlQuery .= " where";
        }
        foreach ($request as $key => $value) {
            if ($key == "sortField") {
                $field = $request[$key];
                unset($request[$key]);
            }
            if ($key == "sortType") {
                $order = $request[$key];
                unset($request[$key]);
            }
        }

        $datas = (new self())->fetchResult("select column_name, data_type from information_schema.columns where table_name='$temp_table';");
        $columnArray = [];
        foreach ($datas as $key => $value) {
            $columnArray[$value->column_name] = $value->data_type;
        }
        $sql = $sqlQuery;

        foreach ($request as $key => $value) {
            if (strpos($value, '=') === 0) {
                $sql = self::getStartSql($sql);
                $symbol = "=";
                $sql = self::checkWhetherEQorNEQisZero($sql, $value, $key, $symbol, $columnArray);
            } elseif (strpos($value, '<>') === 0) {
                $sql = self::getStartSql($sql);
                $symbol = "<>";
                $sql = self::checkWhetherEQorNEQisZero($sql, $value, $key, $symbol, $columnArray);
            } elseif (strpos($value, '>=') === 0 || strpos($value, '>=') !== false) {
                $sql = self::getStartSql($sql);
                $symbol = ">=";
                $sql = self::checkWeatherComparisonOperatorNEQFalse($sql, $value, $key, $symbol);
            } elseif (strpos($value, '<=') === 0 || strpos($value, '<=') !== false) {
                $sql = self::getStartSql($sql);
                $symbol = "<=";
                $sql = self::checkWeatherComparisonOperatorNEQFalse($sql, $value, $key, $symbol);
            } elseif (strpos($value, '>') !== false) {
                $sql = self::getStartSql($sql);
                $symbol = '>';
                $sql = self::checkWeatherComparisonOperatorNEQFalse($sql, $value, $key, $symbol);
            } elseif (strpos($value, '<') !== false) {
                $sql = self::getStartSql($sql);
                $symbol = '<';
                $sql = self::checkWeatherComparisonOperatorNEQFalse($sql, $value, $key, $symbol);
            } elseif (strpos($value, '>') === 0) {
                $sql = self::getStartSql($sql);
                $symbol = ">";
                $sql = self::checkWeatherValueGTorLTWhenEQZero($sql, $value, $key, $symbol);
            } elseif (strpos($value, '<') === 0) {
                $sql = self::getStartSql($sql);
                $symbol = "<";
                $sql = self::checkWeatherValueGTorLTWhenEQZero($sql, $value, $key, $symbol);
            } elseif (strpos($value, '*') !== false) {
                $sql = self::getStartSql($sql);
                $symbol = "*";
                $sql = self::checkWhetherOperatorWhenPLUSorMULisNEQFalse($sql, $value, $key, $symbol);
            } elseif (strpos($value, '+') !== false) {
                $sql = self::getStartSql($sql);
                $symbol = "+";
                $sql = self::checkWhetherOperatorWhenPLUSorMULisNEQFalse($sql, $value, $key, $symbol);
            } else {

                if ($value != null or $value != '') {
                    $sql = self::getStartSql($sql);
                    if (in_array($key, self::$headers_int)) {
                        //$sql .= '(' . $key . ' = '   .  (int)$value . ')';
                        $sql .= '(' . $key . ' = '   .  $value . ')';
                    } else {
                        $sql .= '(' . $key . '::text LIKE ' . "'%" . $value . "%'" . ')';
                    }

                    $sql .= ' )';
                }
            }
        }
        $sql = self::filterSqlWithRegex($sql);

        if (isset($field) && isset($order)) {

            $sql .= ' ORDER BY ' . $field . ' ' . $order;

        }

        return (new self())->fetchResult($sql);
    }

    /**
     * @param $sql
     * @return string
     */
    private static function getStartSql($sql): string
    {
        if (substr($sql, strrpos($sql, ' ') + 1) == "AND" or substr($sql, strrpos($sql, ' ') + 1) == "OR" or substr($sql, strrpos($sql, ' ') + 1) == "where") {
            $sql .= '(';
        } else {
            $sql .= ' AND (';
        }
        return $sql;
    }

    /**
     * @param $sql
     * @param $value
     * @param $key
     * @param $symbol
     * @return string
     */

    private static function checkWeatherComparisonOperatorNEQFalse($sql, $value, $key, $symbol)
    {
        $oppositeSymbol = [
            '>=' => '<=',
            '<=' => '>=',
            '>' => '<',
            '<' => '>'
        ];
        $oppositeSymbol = $oppositeSymbol[$symbol];
        $values = explode($symbol, $value, 2);

        if (strpos($value, $symbol) === 0) {

            //dd(self::$headers);
            if (in_array($key, self::$headers)) {
                $values[1] = self::convertToAppropriateFormat($values[1]);
                $sql .= '( cast(' . $key . ' AS bigint)' . $symbol . "'" . $values[1] . "'" . ')';
            }else if(in_array($key, self::$headers_int)){
                $sql .= '( ' . $key . ' '.$symbol .' '.  $values[1]  . ')';
            }
             else {
                $sql .= '( ' . $key . '::text ' . $symbol . "'" . $values[1] . "'" . ')';
            }
        } else {


            if (in_array($key, self::$headers)) {
                $values[0] = self::convertToAppropriateFormat($values[0]);
                $values[1] = self::convertToAppropriateFormat(explode('@', preg_replace("/[^0-9.]/", "@", $values[1]))[0]);
                $sql .= '( cast(' . $key . ' AS bigint)' . $oppositeSymbol . "'" . $values[0] . "'" . ')';
                $sql .= 'AND ( cast(' . $key . ' AS bigint)' . $symbol . "'" . $values[1] . "'" . ')';
            }else if(in_array($key, self::$headers_int)){

                $sql .= '( ' . $key . ' '. $oppositeSymbol . ' '. $values[0]  . ')';
                $sql .= 'AND ( ' . $key  .' '. $symbol  .' '. $values[1]  . ')';
            }
             else {
                $sql .= '( ' . $key . '::text ' . $oppositeSymbol . "'" . $values[0] . "'" . ')';
                $sql .= 'AND ( ' . $key . '::text ' . $symbol . "'" . $values[1] . "'" . ')';
            }
        }
        $sql .= ' )';

        return $sql;
    }

    /**
     * @param $sql
     * @param $value
     * @param $key
     * @param $symbol
     * @return string
     */

    private static function checkWeatherValueGTorLTWhenEQZero($sql, $value, $key, $symbol)
    {
        if (strpos($value, $symbol) === 0) {
            $values = explode($symbol, $value, 2);
            $values[1] = !empty($values[1]) ? $values[1] : '0';
            $sql .= '(' . $key . $symbol . "'" . $values[1] . "'" . ')';
        }
        $sql .= ' )';
        return $sql;
    }


    /**
     * @param string $sql
     * @return string|string[]|null
     */
    private static function filterSqlWithRegex(string $sql)
    {
        if (substr($sql, strrpos($sql, ' ') + 1) == "AND" or substr($sql, strrpos($sql, ' ') + 1) == "OR" or substr($sql, strrpos($sql, ' ') + 1) == "where") {
            $sql = preg_replace('/\W\w+\s*(\W*)$/', '$1', $sql);
        }
        return $sql;
    }

    /**
     * @param string $sql
     * @return false|string
     */
    private static function filterSqlWithInvalidChar(string $sql)
    {
        if (substr($sql, -7) == "AND ( )") {
            $sql = substr($sql, 0, -7);
        } elseif (substr($sql, -3) == "( )") {
            $sql = substr($sql, 0, -3);
        }

        return $sql;
    }

    /**
     * @param $sql
     * @param $value
     * @param $key
     * @param $symbol
     * @return string|string[]|null
     */

    private static function checkWhetherOperatorWhenPLUSorMULisNEQFalse($sql, $value, $key, $symbol)
    {
        $operator = ["+" => "AND", "*" => "OR"];
        $operator = $operator[$symbol];
        $values = explode($symbol, $value);
        foreach ($values as $k => $val) {

            if ($val != null) {
                if (key(array_slice($values, -1, 1, true)) == $k) {
                    if (in_array($key, self::$headers_int) AND $symbol=='*') {
                        $sql .= '(' . $key . ' = ' . $val  . ')';
                    }else{
                        $sql .= '(' . $key . '::text LIKE ' . "'%" . $val . "%'" . ')';
                    }

                } else {
                    if (in_array($key, self::$headers_int) AND $symbol=='*') {
                        $sql .= '(' . $key . ' = ' .  $val  . ') ' . $operator;
                    }else{
                        $sql .= '(' . $key . '::text LIKE ' . "'%" . $val . "%'" . ') ' . $operator;
                    }

                }
            } else
                $sql = self::filterSqlWithRegex($sql);
        }
        $sql .= ' )';
        $sql = self::filterSqlWithInvalidChar($sql);

        return $sql;
    }

    private static function checkWhetherEQorNEQisZero($sql, $value, $key, $symbol, $columnArray)
    {
        $operator = ["<>" => "AND", "=" => "OR"];
        $condition = ["<>" => "NOT", "=" => ""];
        $operator = $operator[$symbol];
        $condition = $condition[$symbol];

        $value = str_replace($symbol, "", $value);
        $values = explode("*", $value);
        foreach ($values as $k => $val) {
            if (!empty($val) || $val === '0') {
                if ($symbol == "=") {
                    $sql .= '(' . $key . $symbol . "'" . $val . "'" . ') ' . $operator;
                } else {
                    if (in_array($key, self::$headers_int)) {
                        $sql .= '(' . $key . " <> "  . $val . ') ' . $operator;
                    }else{
                        $sql .= '(' . $key . "::text NOT LIKE " . "'%" . $val . "%'" . ') ' . $operator;
                    }

                }
            } else {
                if ($columnArray[$key] == "text" && $val != null) {
                    $sql .= '(' . $key . $symbol . "''" . ' ) AND';
                } else
                    $sql .= '(' . $key . ' IS ' . $condition . ' NULL ) ' . $operator;
            }
        }
        $sql = self::filterSqlWithRegex($sql);
        $sql .= ' )';

        return $sql;
    }
    public static function convertToAppropriateFormat($value)
    {
        if (is_numeric($value)) {
            if (is_float($value)) {
                return floatval($value);
            }
            return  (int) $value;
            //return  $value;
        }
        return  $value;
    }
}
