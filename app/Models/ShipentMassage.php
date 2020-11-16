<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipentMassage extends Model
{
    protected $table = "shipment_massage";
    public $timestamps = true;
    protected $guarded = [];

    public static function dc_addShipment($warehouse_name,$work_id,$product_name,$product_id,$product_num,$send_place,$id,$N){
        try {
            $rs = self::create([
                'shipment_id'=> $id,
                'warehouse_name'=>$warehouse_name,
                'management_name'=>$N,
                'worker_id'=>$work_id,
                'product_name'=>$product_name,
                'product_id'=>$product_id,
                'product_num'=>$product_num,
                'send_place'=>$send_place,

            ]);
            return $rs;
        }catch (\Exception $e){
            logError('出库记录添加失败',[$e->getMessage()]);
        }
    }

    public static function dc_selectRecode($id){
        try {
            $date = self::where('shipment_id',$id)
                ->get();
            return $date;
        }catch (\Exception $e){
            logError('出库记录查询失败',[$e->getMessage()]);
        }
    }
  
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
