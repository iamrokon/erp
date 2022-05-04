<?php

namespace App\Http\Controllers\dbManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Validator;
use  App\AllClass\db\QueryHelperFacade as QueryHelper;

class getqueryController extends Controller
{
    public function showTables(Request $request){
        $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
        
        return view('dbManager.getData',["tables" => $tables,"selected_table"=>""]);
    }

    
    public function postTables(Request $request){
        if (request('table_name') != null) {
            // if (request('Uniquetype') == 'show'){
            //     $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
            //     $table = $request->table_name;
            //     $column=DB::getSchemaBuilder()->getColumnListing($table);
            //     $data = DB::table($table)->select('*')->paginate(5);
            //     return view('dbManager.getData',['column'=>$column, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables]);
            // }
            if (request('Uniquetype') == 'show'){
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                $table = $request->table_name;
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                $column=DB::getSchemaBuilder()->getColumnListing($table);
                $data = DB::table($table)->select('*')->paginate($pagination);
                return view('dbManager.getData',['column'=>$column, 'pagination'=> $pagination, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables]);
            }
            if (request('Uniquetype') == 'khojThesearch' || request('Uniquetype') == 'sort'){
                $data_from_view=$request->all();
                $removeKeys = ["_token","edit_string","Uniquetype","table_name","page", "pagination"];
                $temp_table = $request->table_name;
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                $query = "Select * from $temp_table";
                $bango = 0001;
                try{
                    $data = $this->removeDataFromView($data_from_view, $removeKeys);
                    $companyInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);
                    if ($companyInfo->items() == null && $companyInfo->currentPage() != 1) {
                        $currentPage = ($companyInfo->lastPage());
                        Paginator::currentPageResolver(function () use ($currentPage) {
                            return $currentPage;
                        });
                        $companyInfo = $this->searchDataFetch($query, $data, $bango, $temp_table, $pagination);

                    }
                    if ($companyInfo->total() == 0) {
                        $err = 'There is no applicable data.';
                    } else {
                        $err = '';
                    }
                }
                catch (\Exception $e) {
                    $err = $e->getMessage();
                    $companyInfo = QueryHelper::fetchResult($query);
                    $companyInfo = collect($companyInfo)->paginate($pagination);
                }
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                $table = $request->table_name;
                if (request()->has('page')){
                    $old_data = array_slice($request->all(),8);
                }
                else {
                    $old_data = array_slice($request->all(),6);
                }
                // Passing sortField and sortType For keep Track
                $sortField = $request->sortField;
                $sortType = $request->sortType;
                $column=DB::getSchemaBuilder()->getColumnListing($table);
                return view('dbManager.getData',['column'=>$column,'pagination'=> $pagination, 'data'=>$companyInfo, 'old_data'=> $old_data, 'selected_table'=>$table, 'tables'=>$tables, 'sortField'=>$sortField, 'sortType'=>$sortType, 'error'=>$err ?? '']);
            }
            if (request('Uniquetype') == 'insert'){
                $table = $request->table_name;
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                try {
                    if (request()->has('page')){
                    $value = array_slice($request->all(),8);
                    }
                    else {
                        $value = array_slice($request->all(),6);
                    }
                    
                    if (!array_filter($value)){
                        $err = "No Data Inserted";
                    }
                    else {
                    $tabledata= DB::table($table)->insert($value);
                    }
                }
                catch (\Exception $e){
                    DB::beginTransaction();
                    //$err="No Data";
                    $err = $e->getMessage();
                }
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                $column=DB::getSchemaBuilder()->getColumnListing($table);
                $data = DB::table($table)->select('*')->paginate($pagination);
                return view('dbManager.getData',['column'=>$column,'pagination'=> $pagination, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables, 'error'=>$err ?? '']);
            }
            if (request('Uniquetype')=='doEdit'){ 
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                $table = $request->table_name;
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                $column=DB::getSchemaBuilder()->getColumnListing($table);
                $data = DB::table($table)->select('*')->paginate($pagination);
        //if edit string
                if (request('edit_string') != null){
                    $pizza=$request->edit_string;
                    $tabledatas = explode("##", $pizza);
                    foreach ($tabledatas as $key => $value) {
                        $tabledatas[$key] = explode("%%", $value);
                        $tabledatas[$key]= array_slice($tabledatas[$key], 1);
                    }
                    $tabledata=[];
                
                    foreach ($tabledatas as $k=>$value) {
                        $i=0;
                    foreach ($value as $key => $val) {
                        $tabledata[$k][$column[$i]]=isset($val)?(($val=='0' or $val != null)?$val:null):null;
                            $i++;
                        }   
                    } 
                    return view('dbManager.editData',['column'=>$column,'pagination'=> $pagination, 'tabledata'=>$tabledata, 'selected_table'=>$table, 'tables'=>$tables]);
                }
                else {
                    $err = "No Data Selected";
                    return view('dbManager.getData',['column'=>$column,'pagination'=> $pagination, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables, 'error'=>$err ?? '']);
                }
            }
            if (request('Uniquetype')=='delete'){
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                $table = $request->table_name;
                $column = DB::getSchemaBuilder()->getColumnListing($table);
                if (request('edit_string') != null){
                    $pizza=$request->edit_string;
                    $tabledatas = explode("##", $pizza);
                    foreach ($tabledatas as $key => $value) {
                        $tabledatas[$key] = explode("%%", $value);
                        $tabledatas[$key]= array_slice($tabledatas[$key], 1);
                    }
                    $tabledata=[];
                
                    foreach ($tabledatas as $k=>$value) {
                        $i=0;
                    foreach ($value as $key => $val) {
                        $tabledata[$k][$column[$i]]=isset($val)?(($val=='0' or $val != null)?$val:null):null;
                            $i++;
                        }   
                    } 
                    
                    try {
                        foreach($tabledata as $key=>$value){
                            DB::table($table)->where($value)->delete();
                        }
                    }
                    catch (\Exception $e){
                        $err = $e->getMessage();
                    }
                }
                else{
                    $err = "No Data Selected";
                }
                $data = DB::table($table)->select('*')->paginate($pagination);
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                return view('dbManager.getData',['column'=>$column,'pagination'=> $pagination, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables, 'error'=>$err ?? '']);
            }
            if (request('Uniquetype')=='update'){
                $table = $request->table_name;
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                $obj = array_slice($request->all(),4);
                $data = [];
                foreach($obj as $key => $value){
                    if($key == "old_data")
                        break;
                    else{
                        $data[$key]= $value;
                    }
                }
                $length = count($data) + 5;
                $variable = array_slice($request->all(),$length);
                
                $old_data = json_decode($request->old_data);
                $column=[];
                $var=[];
                foreach ($variable as $key => $value) {
                    $q= explode("%%", $key);
                    $var[$q[0]][$q[2]]=$value;
                    $column[]=$q[0];
                }
                $col=array_unique($column);

                $data=[];
                foreach ($var as $k => $value) {
                    foreach ($value as $key => $val) {
                        $data[$key][$k]=isset($val)?(($val=='0' or $val != null)?$val:null):null;
                    }   
                }
                try{
                    foreach ($old_data as $keu => $valo) { 
                        foreach ($valo as $key => $val) {
                        $old[$key]=isset($val)?(($val=='0' or $val != null)?$val:null):null;
                        }
        
                    $da=$data[$keu];
                    //dd($shacho[0],$data);
                    $r= DB::table($table)->where($old)->update($da);
                
                    }
                }
                catch (\Exception $e){
                    DB::beginTransaction();
                    $err = $e->getMessage();
                }
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                $column=DB::getSchemaBuilder()->getColumnListing($table);
                $data = DB::table($table)->select('*')->paginate($pagination);
                return view('dbManager.getData',['column'=>$column,'pagination'=> $pagination, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables, 'error'=>$err ?? '']);
            
            }
            //pagination reload
            if (request('Uniquetype')=='doRefresh'){
                return $request->all();
            }
            else{
                $err = "No Operation Done";
                $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
                $table = $request->table_name;
                $pagination = request()->has('pagination') ? $request->pagination : 20;
                $column=DB::getSchemaBuilder()->getColumnListing($table);
                $data = DB::table($table)->select('*')->paginate($pagination);
                return view('dbManager.getData',['column'=>$column,'pagination'=> $pagination, 'data'=>$data, 'selected_table'=>$table, 'tables'=>$tables, 'error'=>$err ?? '']);
            }
        }
        else{
            $tables = DB::select("SELECT table_name FROM information_schema.tables where table_type = 'BASE TABLE' AND table_schema = 'public' ORDER BY table_name;");
            return view('dbManager.getData',["tables" => $tables,"selected_table"=>""]);
        }
    }
}
