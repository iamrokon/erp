<?php

namespace App\AllClass\db;

use App\AllClass\db\QueryHandler;
use DateTime;

/**
 * Class QueryHelper
 * @package App\AllClass\db
 */
class QueryHelper_old
{
    /**
     * @var false|resource
     */
    public $connection;
    public $query;
    private $fields = [];
    private $from = [];
    private $where = [];
    private $orderBy = [];
    private $orWhere = [];
    private $sql;

    /**
     * QueryHelper constructor.
     */
    public function __construct()
    {
        $host = env('DB_HOST');
        $port = env('DB_PORT');
        $dbname = env('DB_DATABASE');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $this->connection = pg_connect(sprintf("host=%s port=%s  dbname=%s user=%s password=%s", $host, $port, $dbname, $user, $password));
    }

    /**
     * @param array $fields
     * @return $this
     */
    public function select(array $fields): QueryHelper
    {
        $this->fields = $fields;

        return $this;
    }

    /**
     * @param string $table
     * @param string|null $alias
     * @return $this
     */
    public function from(string $table, string $alias = null): QueryHelper
    {
        $sql = $table;
        if ($alias) {
            $sql .= ' AS ' . $alias;
        }
        $this->from[] = $sql;

        return $this;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function where(string $condition): QueryHelper
    {
        $this->where[] = $condition;

        return $this;
    }

    /**
     * @param string $condition
     * @return $this
     */
    public function orWhere(string $condition): QueryHelper
    {
        $this->orWhere[] = $condition;

        return $this;
    }

    /**
     * @param string $column
     * @return $this
     */
    public function orderBy(string $column): QueryHelper
    {
        $this->orderBy[] = $column;

        return $this;
    }

    /**
     * @return array|mixed
     */
    public function first()
    {
        return $this->fetchSingleResult($this->sql);
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        return $this->fetchResult($this->sql);
    }

    /**
     * @param null $additionalQuery
     * @return $this
     */
    public function get($additionalQuery = null): QueryHelper
    {
        $whereGlue = count($this->where) ? ' AND ' : '';
        $orderGlue = count($this->orderBy) ? ' , ' : '';
        $orWhereGlue = count($this->orWhere) ? ' OR ' : '';
        $whereExists = count($this->where) ? ' WHERE ' . join($whereGlue, $this->where) : '';
        $orderExists = count($this->orderBy) ? ' ORDER BY ' . join($orderGlue, $this->orderBy) : ' ';
        $orWhereExists = count($this->orWhere) ? ' OR ' . join($orWhereGlue, $this->orWhere) : ' ';
        $sql = " SELECT " . join(', ', $this->fields) . " FROM " . join(', ', $this->from) . $whereExists . $orWhereExists . $orderExists . '; ';
        $sql = $additionalQuery . ' ' . $sql;
        $this->sql = $sql;
        return $this;
    }

    /**
     * @param $sql
     * @return false|resource
     */
    public function runQuery($sql)
    {

        if (env('DB_HOST') === 'localhost' || env('DB_HOST') === '127.0.0.1') {
            //            $query = pg_query($this->connection, mb_convert_encoding($sql, 'utf-8', 'CP51932'));
            $query = pg_query($this->connection, mb_convert_encoding($sql, 'utf-8'));
        } else {
            $query = pg_query($this->connection, mb_convert_encoding($sql, 'CP51932', 'utf-8'));
            //   $query = pg_query($this->connection, $sql);
        }

        return $query;
    }

    /**
     * @param $sql
     * @return mixed
     */
    public function fetchResult($sql)
    {
        $result = [];

        $query_result = $this->runQuery($sql);

        while ($row = pg_fetch_assoc($query_result)) {
            $result[] = mb_convert_encoding($row, 'utf-8', 'CP51932');
        }

        $result = json_decode(json_encode($result), FALSE);
        return $result;
    }

    /**
     * @param $sql
     * @return array|mixed
     */
    public function fetchSingleResult($sql)
    {
        return count($this->fetchResult($sql)) ? $this->fetchResult($sql)[0] : [];
    }

    /**
     * @param $tableName
     * @param $data
     * @param $primary_key
     * @param false $autoincrement
     * @param null $bango
     * @param null $className
     * @param null $function
     * @param null $lineNo
     * @return array|false|mixed
     */
    public function insertData($tableName, $data, $primary_key, $autoincrement = false, $bango = null, $className = null, $function = null, $lineNo = null)
    {
        $columnTypes = $this->fetchResult("select column_name, data_type from information_schema.columns where table_name='$tableName';");
        $columnArray = [];
        foreach ($columnTypes as $key => $value) {
            $columnArray[$value->column_name] = strtoupper($value->data_type);
        }
        $integerArray = ['SMALLINT', 'INTEGER', 'BIGINT', 'NUMERIC', 'REAL', 'DOUBLE PRECISION'];
        $data = $this->prepareData($data);
        $insert_query = "insert into " . $tableName . "(" . join(",", array_keys($data)) . ") values(" . join(",", array_values($data)) . ")";
        if ($bango != NULL && $className != NULL && $function != NULL && $lineNo != NULL) {
            $query_log = date('Y-m-d H:i:s') . " " . $className . " " . $function . " " . $lineNo . " " . $insert_query . "\n";
            QueryHandler::logger($bango, $query_log);
        }
        $insert = pg_insert($this->connection, $tableName, $data);
        if ($bango != NULL && $className != NULL && $function != NULL && $lineNo != NULL) {
            $query_log = date('Y-m-d H:i:s') . " " . $className . " " . $function . " " . $lineNo . " " . $tableName . " end\n";
            QueryHandler::logger($bango, $query_log);
        }
        if ($insert) {
            if ($autoincrement) {
                $sql = "select * from $tableName order by $primary_key desc limit 1";
            } else {
                if (is_array($primary_key)) {
                    $sql = " SELECT * FROM $tableName where ";
                    for ($i = 0; $i < count($primary_key); $i++) {
                        $dataType = $columnArray[$primary_key[$i]];
                        $dataValue = $data[$primary_key[$i]];
                        $sql .= " $primary_key[$i] = ";
                        $sql .= in_array($dataType, $integerArray) ? $dataValue : " '$dataValue' ";
                        if ($i < (count($primary_key) - 1)) {
                            $sql .= " and ";
                        }
                    }
                } else {
                    $dataType = $columnArray[$primary_key];
                    $sql = "SELECT * FROM $tableName where $primary_key = ";
                    $sql .= in_array($dataType, $integerArray) ? $data[$primary_key] : " '$data[$primary_key]' ";
                }
            }
            return $this->fetchSingleResult($sql);
        }
        return false;
    }

    /**
     *
     * @param $tableName
     * @param $data
     * @param $primary_key
     * @param null $bango
     * @param null $className
     * @param null $function
     * @param null $lineNo
     * @param null $as
     * @return bool|mixed
     */
    public function updateData($tableName, $data, $primaryKey, $bango = null, $className = null, $function = null, $lineNo = null, $as = null)
    {
        $columnTypes = $this->fetchResult("select column_name, data_type from information_schema.columns where table_name='$tableName';");
        $columnArray = [];
        foreach ($columnTypes as $key => $value) {
            $columnArray[$value->column_name] = strtoupper($value->data_type);
        }
        $integerArray = ['SMALLINT', 'INTEGER', 'BIGINT', 'NUMERIC', 'REAL', 'DOUBLE PRECISION'];
        $data1 = '';
        foreach ($data as $key => $val) {
            if ($val !== NULL) $data1 .= $key . "='" . $val . "',";
            else $data1 .= $key . "=NULL,";
        }
        $data = $this->prepareData($data);
        if (is_array($primaryKey)) {
            $condition = $primaryKey;
        } else {
            $condition = [$primaryKey => $data[$primaryKey]];
        }
        $search_string = '';
        if ($as !== 'string') {
            foreach ($condition as $key => $val) {
                if (str_contains($val, '%')) $search_string .= $key . " LIKE' " . $val . "' AND ";
                else if ($val !== NULL) $search_string .= $key . "='" . $val . "' AND ";
                else $search_string .= $key . " IS NULL AND ";
            }
        } else {
            $search_string = $as;
        }

        $query = "UPDATE " . $tableName . " SET " . $data1 . " WHERE " . $search_string;
        $query = rtrim($query, "AND ");
        if ($bango != NULL && $className != NULL && $function != NULL && $lineNo != NULL) {
            $query_log = date('Y-m-d H:i:s') . " " . $className . " " . $function . " " . $lineNo . " " . $query . "\n";
            QueryHandler::logger($bango, $query_log);
        }
        $update = pg_update($this->connection, $tableName, $data, $condition);
        if ($bango != NULL && $className != NULL && $function != NULL && $lineNo != NULL) {
            $query_log = date('Y-m-d H:i:s') . " " . $className . " " . $function . " " . $lineNo . " " . $tableName . " end\n";
            QueryHandler::logger($bango, $query_log);
        }
        if ($update) {
            try {
                if (is_array($primaryKey)) {
                    $sql = " SELECT * FROM $tableName where ";
                    $i = 0;
                    foreach ($primaryKey as $key => $val) {
                        $dataType = $columnArray[$key];
                        $dataValue = $data[$key];
                        $sql .= " $key = ";
                        $sql .= in_array($dataType, $integerArray) ? $dataValue : " '$dataValue' ";
                        if ($i < (count($primaryKey) - 1)) {
                            $sql .= " and ";
                        }
                        $i++;
                    }
                } else {
                    $dataType = $columnArray[$primaryKey];
                    $sql = "SELECT * FROM $tableName where $primaryKey = ";
                    $sql .= in_array($dataType, $integerArray) ? $data[$primaryKey] : " '$data[$primaryKey]' ";
                }
                return  $this->fetchSingleResult($sql);
            } catch (\Exception $e) {
                return  true;
            }
        }

        return  false;
    }
    /**
     *
     * @param $tableName
     * @param $data
     * @param $primaryKey
     * @return bool|mixed
     */
    public function deleteData($tableName, $data, $primaryKey, $bango = null, $className = null, $function = null, $lineNo = null, $as = null)
    {
        $data = $this->prepareData($data);
        if (is_array($primaryKey)) {
            $condition = $primaryKey;
        } else {
            $condition = [$primaryKey => $data[$primaryKey]];
        }
        $search_string = '';
        if ($as !== 'string') {
            foreach ($condition as $key => $val) {
                if ($val !== NULL) $search_string .= $key . " = '" . $val . "' AND ";
                else $search_string .= $key . " IS NULL AND ";
            }
        } else {
            $search_string = $as;
        }

        $query = " DELETE  FROM " . $tableName . " WHERE " . $search_string;
        $query  =  rtrim($query, "AND ");

        if ($bango != NULL && $className != NULL && $function != NULL && $lineNo != NULL) {
            $query_log = date('Y-m-d H:i:s') . " " . $className . " " . $function . " " . $lineNo . " " . $query . "\n";
            QueryHandler::logger($bango, $query_log);
        }
        $delete = $this->runQuery($query);
        if ($bango != NULL && $className != NULL && $function != NULL && $lineNo != NULL) {
            $query_log = date('Y-m-d H:i:s') . " " . $className . " " . $function . " " . $lineNo . " " . $tableName . " end\n";
            QueryHandler::logger($bango, $query_log);
        }
        return $delete;
    }

    public function disconnect()
    {
        pg_close($this->connection);
    }

    public function prepareData($data)
    {
        //        $filterData = array_filter($data, function ($value) {
        //            return $value !== null && $value !== '';
        //        });
        if (env('DB_HOST') === 'localhost' || env('DB_HOST') === '127.0.0.1') {
            $mapData = array_map(function ($item) {
                return $item;
            }, $data);
        } else {
            $mapData = array_map(function ($item) {
                return mb_convert_encoding($item, 'CP51932', 'utf-8');
            }, $data);
        }

        foreach ($mapData as $key => $value) {
            if ($value === "") {
                $mapData[$key] = null;
            }
        }
        return $mapData;
    }

    //    public function getClause($condition, $data, $table)
    //    {
    //        $columnTypes = $this->fetchResult("select column_name, data_type from information_schema.columns where table_name='$table';");
    //        $columnArray = [];
    //        foreach ($columnTypes as $key => $value) {
    //            $columnArray[$value->column_name] = strtoupper($value->data_type);
    //        }
    //        $integerArray = ['SMALLINT', 'INTEGER', 'BIGINT', 'NUMERIC', 'REAL', 'DOUBLE PRECISION'];
    //        $clauase = '';
    //        if (is_array($condition)) {
    //            $init = 0;
    //            foreach ($condition as $key => $value) {
    //                $clauase .= $init == 0 ? ' where ' : ' and ';
    //                $val = in_array($columnArray[$key], $integerArray) ? $value : " '$value' ";
    //                $clauase .= " $key  =  $val ";
    //                $init++;
    //            }
    //        }
    //        return $clauase;
    //    }

    //    /**
    //     * @param string $tableName
    //     * @param string $primaryKey
    //     * @param array $conditions
    //     * @param string $orderBy
    //     * @return array
    //     */
    //    public function fetchResultWithWhere(string $tableName, $primaryKey, array $conditions, string $orderBy = 'ASC')
    //    {
    //        $sql = "select * from $tableName";
    //        $init = 0;
    //
    //        foreach ($conditions as $condition) {
    //
    //            if ($init == 0) {
    //                $sql .= " WHERE " . $condition['column'] . " " . $condition['operator'] . " '" . $condition['value'] . "' ";
    //            } else {
    //                $sql .= " AND " . $condition['column'] . " " . $condition['operator'] . " '" . $condition['value'] . "' ";
    //            }
    //            $init++;
    //        }
    //        $sql .= " ORDER BY $primaryKey $orderBy ";
    //
    //        return $this->fetchResult($sql);
    //    }


}
