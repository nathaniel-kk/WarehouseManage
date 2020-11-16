<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryRecords extends Model
{
    protected $table = "Inventory_records";
    public $timestamps = true;
    protected $guarded = [];

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
