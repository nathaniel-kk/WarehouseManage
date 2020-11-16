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
}
