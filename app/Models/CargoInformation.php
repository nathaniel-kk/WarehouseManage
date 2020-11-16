<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoInformation extends Model
{
    protected $table = "cargo_information";
    public $timestamps = true;
    protected $guarded = [];

    public static function hwc_tranPurchaseOrder2($unenough_warehouse,$enough_warehouse,$management_id,$product_id,$product_name,$product_num){
        try {
            $data = self::create([
                'cargo_id' => 'D'.time(),
                'super_id' => auth()->user()->management_id,
                'management_id' => $management_id,
                'unenough_warehouse' => $unenough_warehouse,
                'enough_warehouse' => $enough_warehouse,
                'product_name' => $product_name,
                'product_id' => $product_id,
                'product_num' => $product_num,
                'type' => 0,
                'created_at' => now(),
            ]);
            return $data;
        } catch (\Exception $e) {
            logError('调货单填写错误', [$e->getMessage()]);
            return null;
        }
    }
}
