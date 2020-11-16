<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomingMessage extends Model
{
    protected $table = "incoming_message";
    public $timestamps = true;
    protected $guarded = [];

    public static function hwc_fillPurchaseOrder($warehouse_name,$management_id,$product_name,$product_id,$product_num){
        try {
            $data = self::create([
                'Incoming_id' => 'A'.time(),
                'warehouse_name' => $warehouse_name,
                'super_id' => auth()->user()->management_id,
                'manage_id' => $management_id,
                'product_name' => $product_name,
                'product_id' => $product_id,
                'product_num' => $product_num,
                'created_at' => now(),
            ]);
            return $data;
        } catch (\Exception $e) {
            logError('进货单填写错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function hwc_inboundInformationPlus(){
        try {
            $data = self::Join('management','incoming_message.manage_id','=','management.management_id')
                ->select('incoming_message.warehouse_name','management.management','incoming_message.super_id','incoming_message.product_num','incoming_message.product_name')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('进货信息详情展示错误', [$e->getMessage()]);
            return null;
        }
    }
}
