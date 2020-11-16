<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public $timestamps = true;
    protected $guarded = [];

    public static function hwc_wareInformationSearch($product_name)
    {
        try {
            if ($product_name == null) {
                $data = self::orderBy('product_num','asc')
                    ->select('product_id','product_num','product_name','status')
                    ->get();
            } else {
                $data = self::orderBy('product_num','asc')
                    ->where('product_name','like','%'.$product_name.'%')
                    ->select('product_id','product_num','product_name','status')
                    ->get();
            }
            return $data;
        } catch (\Exception $e) {
            logError('仓库信息搜索错误', [$e->getMessage()]);
            return null;
        }
    }

    Public static function hwc_wareInformationDropDis($warehouse_name,$product_name){
        try {
            if ($product_name == null) {
                $data = self::orderBy('product_num','asc')
                    ->where('warehouse_name',$warehouse_name)
                    ->select('product_id','product_num','product_name','status')
                    ->get();
            } else {
                $data = self::orderBy('product_num','asc')
                    ->where('product_name','like','%'.$product_name.'%')
                    ->where('warehouse_name',$warehouse_name)
                    ->select('product_id','product_num','product_name','status')
                    ->get();
            }
            return $data;
        } catch (\Exception $e) {
            logError('仓库信息下拉框回显详情展示错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function hwc_tranInformationDropDis($warehouse_name,$status){
        try {
            if ($warehouse_name == null) {
                if ($status == null) {
                    $data = self::orderBy('product_num', 'asc')
                        ->select('product_id', 'warehouse_name', 'product_name', 'status')
                        ->get();
                } else {
                    $data = self::orderBy('product_num', 'asc')
                        ->where('status', $status)
                        ->select('product_id', 'warehouse_name', 'product_name', 'status')
                        ->get();
                }
            } else {
                if ($status == null) {
                    $data = self::orderBy('product_num', 'asc')
                        ->where('warehouse_name', $warehouse_name)
                        ->select('product_id', 'warehouse_name', 'product_name', 'status')
                        ->get();
                } else {
                    $data = self::orderBy('product_num', 'asc')
                        ->where('warehouse_name', $warehouse_name)
                        ->where('status', $status)
                        ->select('product_id', 'warehouse_name', 'product_name', 'status')
                        ->get();
                }
            }
            return $data;
        } catch (\Exception $e) {
            logError('调货信息商品状态下拉框回显详情展示错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function hwc_fillPurchaseProOrderLink($product_id){
        try {
            $data = self::where('product_id',$product_id)
                ->select('product_name')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('进货单填写产品编号显示产品名称错误', [$e->getMessage()]);
            return null;
        }
    }
}
