<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipentMassage extends Model
{
    protected $table = "shipment_massage";
    public $timestamps = true;
    protected $guarded = [];

    Public static function hwc_outboundInformation(){
        try {
            $data = self::select('warehouse_name','product_id','created_at','shipment_id')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('出库信息页面展示错误',[$e->getMessage()]);
            return null;
        }
    }

    Public static function hwc_outboundSeInformation($product_id){
        try {
            $data = self::where('product_id','like','%'.$product_id.'%')
                ->select('warehouse_name','product_id','created_at','shipment_id')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('出库信息页面展示错误',[$e->getMessage()]);
            return null;
        }
    }

    Public static function hwc_outboundInformationMax($shipment_id){
        try {
            $data = self::join('management','shipment_massage.management_name','=','management.management')
                ->where('shipment_massage.shipment_id',$shipment_id)
                ->select('shipment_massage.warehouse_name','shipment_massage.product_id','shipment_massage.created_at','shipment_massage.send_place','shipment_massage.management_name','management.management_id','shipment_massage.worker_id','shipment_massage.product_num','shipment_massage.product_name')
                ->get();
            return $data;
        } catch(\Exception $e){
            logError('出库信息详情展示错误',[$e->getMessage()]);
            return null;
        }
    }
}
