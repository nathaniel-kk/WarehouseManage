<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = "form";
    public $timestamps = true;
    protected $guarded = [];


    public static function dc_addShipmentrecode($warehouse_name,$id,$product_name,$time,$N){
        try {
            $date = self::create([
                'recode_id'=>$time,
                'warehouse_name'=>$warehouse_name,
                'management_name'=>$N,
                'product_name'=>$product_name,
                'worker_id'=>$id,
                'info'=>'出库',
            ]);
            return $date;
        }catch (\Exception $e){
            logError('出库记录添加失败',[$e->getMessage()]);
        }

    }

    public static function dc_addInventoryrecode($warehouse_name,$product_name,$worker_id,$id,$N){
        try {
            $date = self::create([
                'recode_id'=>$id,
                'warehouse_name'=>$warehouse_name,
                'management_name'=>$N,
                'product_name'=>$product_name,
                'worker_id'=>$worker_id,
                'info'=>'入库'
            ]);
            return $date;
        }catch (\Exception $e){
            logError('入库记录添加失败',[$e->getMessage()]);
        }
    }

    public static function dc_getAll(){
        try {
            $date = self::all();
            return $date;
        }catch (\Exception $e){
            logError('获取记录失败',[$e->getMessage()]);
        }

    }
//
//    public static function dc_delectRecode($id){
//        try {
//            $date = self::where('recode_id',$id)
//                ->delect();
//            return $date;
//        }catch (\Exception $e){
//            logError('删除记录失败',[$e->getMessage()]);
//        }
//
//    }
}


