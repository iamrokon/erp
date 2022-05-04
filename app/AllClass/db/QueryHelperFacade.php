<?php

namespace App\AllClass\db;

use Illuminate\Support\Facades\Facade;

/**
 *
 * @method static string runQuery(string $sql)
 * @method static mixed fetchResult(string $sql)
 * @method static mixed fetchSingleResult(string $sql)
 * @method static mixed insertData(string $tableName, array $data, string | array $primaryKey, bool $autoincrement = false,$user_name = null , string $className = null, string $functionName = null, $lineNo = null)
 * @method static mixed updateData(string $tableName, array $data, string | array $primaryKey, $user_name = null, string $className = null, string $functionName = null, $lineNo = null)
 * @method static bool deleteData(string $tableName, array $data, string | array $primaryKey, $user_name = null, string $className = null, string $functionName = null, $lineNo = null)
 * @method static mixed disconnect()
 * @method static select(array $fields): QueryHelper
 * @method  from(string $table, string $alias = null): QueryHelper
 * @method  where(string $condition): QueryHelper
 * @method  get(): QueryHelper
 * @method first()
 * @method execute()
 *
 *
 */
class QueryHelperFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return new QueryHelper();
    }
}
