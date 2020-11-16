<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryRecords extends Model
{
    protected $table = "Inventory_records";
    public $timestamps = true;
    protected $guarded = [];


    public static function dc_writeInventory($warehouse_name,$worker_id,$product_name,$product_id,$product_num,$company,$id,$n){
        try {

            $rs = self::create([
                'inventory_id'=> $id,
                'warehouse_name'=>$warehouse_name,
                'management_name'=>$n,
                'worker_id'=>$worker_id,
                'product_name'=>$product_name,
                'product_id'=>$product_id,
                'product_num'=>$product_num,
                'company'=>$company,


            ]);
            return $rs;
        }catch (\Exception $e){
            logError('入库记录添加失败',[$e->getMessage()]);
        }
    }

    public static function dc_selectRecode($id){
        try {
            $date = self::where('inventory_id',$id)
                ->get();
            return $date;
        }catch (\Exception $e){
            logError('入库记录查询失败',[$e->getMessage()]);
        }
    }


}
