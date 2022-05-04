<?php

namespace App\AllClass\sales\balanceUpdate;

use DB;
use App\AllClass\db\QueryHelperFacade as QueryHelper;

Class allActions
{
    public static function sales_action($results)
    {
        $update_data_flag = false;
        foreach($results as $result)
        {
            if( in_array($result->text1, ['U510', 'U520' ,'U550']) && $result->datachar13 == '1')
            {
                $update_data_flag = self::base_query( 'sales_action', $result->intorder03, $result->information2, $result->syukkasu_sum, $result->datachar20, 'datanum0022', 'datanum0026');
            }

            else if( in_array($result->text1, ['U510', 'U522' ,'U550']) && $result->datachar13 == '3')
            {
                $update_data_flag = self::base_query( 'sales_action', $result->intorder03, $result->information2, $result->syukkasu_sum, $result->datachar20, 'datanum0037', 'datanum0038');
            }

            else if( in_array($result->text1, ['U523']) && $result->datachar13 == '1' && $result->dataint01 == 2)
            {
                $update_data_flag = self::base_query( 'sales_action', $result->intorder03, $result->information2, $result->syukkasu_sum, $result->datachar20,'datanum0022', 'datanum0026', 'datanum0037', 'datanum0038');
            }

            else if( in_array($result->text1, ['U523']) && $result->datachar13 == '1' && $result->dataint01 == 1)
            {
                $update_data_flag = self::base_query( 'sales_action', $result->intorder03, $result->information2, $result->syukkasu_sum, $result->datachar20, 'datanum0022', 'datanum0026');
                
                QueryHelper::runQuery("
                    UPDATE urikakezandaka 
                        SET datanum0031 = COALESCE (datanum0031,0) + $result->syukkasu_sum + $result->datachar20
                        WHERE  
                            date0008 = '$result->intorder03'
                            AND datatxt0138 = '$result->information2'
                ");
            }
            else continue;

            //datanum0032
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0032 = ( COALESCE (datanum0021,0) + COALESCE (datanum0022,0) + COALESCE (datanum0023,0) + COALESCE (datanum0024,0) + COALESCE (datanum0025,0) + COALESCE (datanum0026,0) - COALESCE (datanum0027,0) - COALESCE (datanum0028,0) - COALESCE (datanum0029,0) - COALESCE (datanum0030,0) - COALESCE (datanum0031,0) )
                    WHERE 
                        date0008 = '$result->intorder03'
                        AND datatxt0138 = '$result->information2'
            ");

            //datanum0044
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0044 = ( COALESCE (datanum0036,0) + COALESCE (datanum0037,0) + COALESCE (datanum0038,0) - COALESCE (datanum0039,0) - COALESCE (datanum0040,0) - COALESCE (datanum0041,0) - COALESCE (datanum0042,0) - COALESCE (datanum0043,0) - COALESCE (datanum0029,0) - COALESCE (datanum0030,0) - COALESCE (datanum0031,0) )
                    WHERE 
                        date0008 = '$result->intorder03'
                        AND datatxt0138 = '$result->information2'
            ");

            QueryHelper::runQuery("
                UPDATE hikiatesyukko 
                    SET dataint04 = 2
                    WHERE  
                        dataint04 = 1
                        AND orderbango = $result->orderhenkan_bango
                        AND syouhinid = '$result->kokyakuorderbango'
            ");
        }
        return $update_data_flag;
    }

    public static function deposit_action1($results)
    {
        $update_data_flag = false;
        foreach ($results as $result) 
        {
            if( in_array($result->text1, ['U510', 'U520', 'U550'] ))
            {
                if( in_array($result->soufusakiname, ['A901', 'A902', 'A903', 'A904'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0027');
                }
                else if( in_array($result->soufusakiname, ['A905'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0028');
                }
                else if( in_array($result->soufusakiname, ['A908'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0029');
                }
                else if( in_array($result->soufusakiname, ['A906', 'A909', 'A910', 'A911'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0031');
                }
            }
            if( in_array($result->text1, ['U523'] ) && $result->unsoudaibikitesuryou==2)
            {
                if( in_array($result->soufusakiname, ['A901', 'A902', 'A903', 'A904'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0039');
                }
                else if( in_array($result->soufusakiname, ['A905'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0040');
                }
                else if( in_array($result->soufusakiname, ['A908'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0041');
                }
                else if( in_array($result->soufusakiname, ['A906', 'A909', 'A910', 'A911'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0043');
                }
            }
            if( in_array($result->text1, ['U523'] ) && $result->unsoudaibikitesuryou==1)
            {
                if( in_array($result->soufusakiname, ['A901', 'A902', 'A903', 'A904'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0027');
                }
                else if( in_array($result->soufusakiname, ['A905'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0028');
                }
                else if( in_array($result->soufusakiname, ['A908'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0029');
                }
                else if( in_array($result->soufusakiname, ['A906', 'A909', 'A910', 'A911'] ))
                {
                    $update_data_flag = self::base_query( 'deposit_action1', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0031');
                }
            }

            //datanum0032
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0032 = ( COALESCE (datanum0021,0) + COALESCE (datanum0022,0) + COALESCE (datanum0023,0) + COALESCE (datanum0024,0) + COALESCE (datanum0025,0) + COALESCE (datanum0026,0) - COALESCE (datanum0027,0) - COALESCE (datanum0028,0) - COALESCE (datanum0029,0) - COALESCE (datanum0030,0) - COALESCE (datanum0031,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            //datanum0035
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0035 = ( COALESCE (datanum0033,0) + COALESCE (datanum0028,0) + COALESCE (datanum0040,0) - COALESCE (datanum0034,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            //datanum0044
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0044 = ( COALESCE (datanum0036,0) + COALESCE (datanum0037,0) + COALESCE (datanum0038,0) - COALESCE (datanum0039,0) - COALESCE (datanum0040,0) - COALESCE (datanum0041,0) - COALESCE (datanum0042,0) - COALESCE (datanum0043,0) - COALESCE (datanum0029,0) - COALESCE (datanum0030,0) - COALESCE (datanum0031,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            QueryHelper::runQuery("
                UPDATE daikinseisanold 
                    SET soufusakiname = '1'
                    WHERE
                        soufusakiname = '2'
                        AND nyukingaku = $result->nyukingaku
                        AND otodoketime = '$result->otodoketime'
            ");
        }
        return $update_data_flag;
    }

    public static function deposit_action2($results)
    {
        $update_data_flag = false;
        foreach ($results as $result) 
        {
            if( in_array($result->soufusakiname, ['A901', 'A902', 'A903', 'A904'] ))
            {
                $update_data_flag = self::base_query( 'deposit_action2', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0027');
            }
            else if( in_array($result->soufusakiname, ['A905'] ))
            {
                $update_data_flag = self::base_query( 'deposit_action2', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0028');
            }
            else if( in_array($result->soufusakiname, ['A908'] ))
            {
                $update_data_flag = self::base_query( 'deposit_action2', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0029');
            }
            else if( in_array($result->soufusakiname, ['A906', 'A909', 'A910', 'A911'] ))
            {
                $update_data_flag = self::base_query( 'deposit_action2', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0031');
            }

            //datanum0032
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0032 = ( COALESCE (datanum0021,0) + COALESCE (datanum0022,0) + COALESCE (datanum0023,0) + COALESCE (datanum0024,0) + COALESCE (datanum0025,0) + COALESCE (datanum0026,0) - COALESCE (datanum0027,0) - COALESCE (datanum0028,0) - COALESCE (datanum0029,0) - COALESCE (datanum0030,0) - COALESCE (datanum0031,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            //datanum0035
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0035 = ( COALESCE (datanum0033,0) + COALESCE (datanum0028,0) + COALESCE (datanum0040,0) - COALESCE (datanum0034,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            //datanum0044
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0044 = ( COALESCE (datanum0036,0) + COALESCE (datanum0037,0) + COALESCE (datanum0038,0) - COALESCE (datanum0039,0) - COALESCE (datanum0040,0) - COALESCE (datanum0041,0) - COALESCE (datanum0042,0) - COALESCE (datanum0043,0) - COALESCE (datanum0029,0) - COALESCE (datanum0030,0) - COALESCE (datanum0031,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            QueryHelper::runQuery("
                UPDATE daikinseisanold 
                    SET soufusakiname = '1'
                    WHERE
                        soufusakiname = '2'
                        AND shinkurokokyakuname = '$result->shinkurokokyakuname'
                        AND otodoketime = '$result->otodoketime'
            ");
        }
        return $update_data_flag;
    }
    
    public static function note_action($results)
    {
        $update_data_flag = false;
        foreach($results as $result)
        {
            $update_data_flag = self::base_query( 'note_action', $result->torikomidate, $result->chumonsyaname, $result->nyukingaku, 0, 'datanum0034');

            //datanum0035
            QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0034 = $result->nyukingaku,datanum0035 = ( COALESCE (datanum0033,0) + COALESCE (datanum0028,0) + COALESCE (datanum0040,0) - COALESCE (datanum0034,0) )
                    WHERE 
                        date0008 = '$result->torikomidate'
                        AND datatxt0138 = '$result->chumonsyaname'
            ");

            QueryHelper::runQuery("
                UPDATE eczaikorendou 
                    SET siterank = 1
                    WHERE  
                        siterank IS NULL
                        AND sitename = '$result->shinkurokokyakuname'
            ");
        }
        return $update_data_flag;
    }

    private static function base_query($search_type, $search1,$search2,$addition1,$addition2,$field1,$field2=NULL,$field3=NULL,$field4=NULL)
    {
        $last_month_start = date('Y-m-01 H:i:s', strtotime("-1 week",strtotime($search1)));

        $insert_array = 
        [
            'datanum0021' => 0,
            'datanum0022' => 0,
            'datanum0023' => 'null',
            'datanum0024' => 'null',
            'datanum0025' => 'null',
            'datanum0026' => 0,
            'datanum0027' => 0,
            'datanum0028' => 0,
            'datanum0029' => 0,
            'datanum0030' => 'null',
            'datanum0031' => 0,
            'datanum0033' => 0,
            'datanum0034' => 0,
            'datanum0036' => 0,
            'datanum0037' => 0,
            'datanum0038' => 0,
            'datanum0039' => 0,
            'datanum0040' => 0,
            'datanum0041' => 0,
            'datanum0042' => 'null',
            'datanum0043' => 0,

        ];
        if(!is_null($field1)) unset($insert_array[$field1]);
        if(!is_null($field2)) unset($insert_array[$field2]);
        if(!is_null($field3)) unset($insert_array[$field3]);
        if(!is_null($field4)) unset($insert_array[$field4]);

        $keys = implode(',', array_keys($insert_array));
        $values = implode(',', array_values($insert_array));

        if( !is_null($field2) && is_null($field3) && is_null($field4))
        {
            QueryHelper::runQuery("
                UPDATE urikakezandaka 
                    SET $field1 = COALESCE ($field1,0) + $addition1,
                        $field2 = COALESCE ($field2,0)  + $addition2
                    WHERE  
                        date0008 = '$search1'
                        AND datatxt0138 = '$search2';

                INSERT INTO urikakezandaka (date0008, datatxt0138, $field1, $field2 , $keys)
                    SELECT '$search1', '$search2', $addition1, $addition2, $values
                    WHERE NOT EXISTS (
                        SELECT 1 FROM urikakezandaka 
                        WHERE 
                            date0008 = '$search1'
                            AND datatxt0138 = '$search2'
                )
            ");
        }
        else if( !is_null($field3) && !is_null($field4))
        { 
            QueryHelper::runQuery("
                UPDATE urikakezandaka 
                    SET $field1 = COALESCE ($field1,0) + $addition1,
                        $field3 = COALESCE ($field3,0) - $addition1,
                        $field2 = COALESCE ($field2,0) + $addition2,
                        $field4 = COALESCE ($field4,0) - $addition2
                    WHERE  
                        date0008 = '$search1'
                        AND datatxt0138 = '$search2';

                INSERT INTO urikakezandaka (date0008, datatxt0138, $field1, $field2, $field3, $field4 , $keys)
                    SELECT '$search1', '$search2', $addition1, $addition2, (-1* $addition1), (-1* $addition2), $values
                    WHERE NOT EXISTS (
                        SELECT 1 FROM urikakezandaka 
                        WHERE 
                            date0008 = '$search1'
                            AND datatxt0138 = '$search2'
                )
            ");
        }
        else QueryHelper::runQuery("
                UPDATE urikakezandaka 
                    SET $field1 = COALESCE ($field1,0) + $addition1
                    WHERE  
                        date0008 = '$search1'
                        AND datatxt0138 = '$search2';

                INSERT INTO urikakezandaka (date0008, datatxt0138, $field1 , $keys)
                    SELECT '$search1', '$search2', $addition1, $values
                    WHERE NOT EXISTS (
                        SELECT 1 FROM urikakezandaka 
                        WHERE 
                            date0008 = '$search1'
                            AND datatxt0138 = '$search2'
                )
            ");

        $old_data = QueryHelper::fetchResult("
            SELECT * from urikakezandaka
                WHERE
                    date0008 = '$last_month_start'
                    AND datatxt0138 = '$search2';
        ");
        if($old_data!=NULL)
        {
            $to_be_updated = 
                [ 
                    $old_data[0]->datanum0032 ?? 'NULL', 
                    $old_data[0]->datanum0035 ?? 'NULL', 
                    $old_data[0]->datanum0044 ?? 'NULL',
                ];
            if($search_type == 'sales_action'){
                QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0033 = COALESCE ($to_be_updated[1],0)
                    WHERE
                        date0008 = '$search1'
                        AND datatxt0138 = '$search2'
            ");
            }elseif($search_type == 'note_action'){
                QueryHelper::runQuery("
                UPDATE urikakezandaka
                    SET datanum0021 = COALESCE ($to_be_updated[0],0),
                        datanum0036 = COALESCE ($to_be_updated[2],0)
                    WHERE
                        date0008 = '$search1'
                        AND datatxt0138 = '$search2'
            ");
            }
        }
        
        return true;
    }
}
 