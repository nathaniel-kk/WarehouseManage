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

    Public static function hwc_inboundInformation(){
        try {
            $data = self::select('warehouse_name','product_id','created_at','inventory_id')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('入库信息页面展示错误',[$e->getMessage()]);
            return null;
        }
    }

    Public static function hwc_inboundSeInformation($product_id){
        try {
            $data = self::where('product_id','like','%'.$product_id.'%')
                ->select('warehouse_name','product_id','created_at','inventory_id')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('入库信息页面展示错误',[$e->getMessage()]);
            return null;
        }
    }

    Public static function hwc_inboundInformationMax($inventory_id){
        try {
            $data = self::join('management','Inventory_records.management_name','=','management.management')
                ->where('Inventory_records.inventory_id',$inventory_id)
                ->select('Inventory_records.warehouse_name','Inventory_records.product_id','Inventory_records.created_at','Inventory_records.company','Inventory_records.management_name','management.management_id','Inventory_records.worker_id','Inventory_records.product_num','Inventory_records.product_name')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('入库信息详情展示错误',[$e->getMessage()]);
            return null;
        }
    }
}
