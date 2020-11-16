<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    public $timestamps = true;
    protected $guarded = [];


    public static function dc_reduceNum($id,$num){
        try {

            $date = self::where('product_id',$id)
                ->select('product_num')
                ->get();

               $A = $date[0]->product_num - $num;
                if($A< 10000){
                $st = '不足';
                }else if(10000 <=$A&&$A<=20000 ){
                $st = '比较充足';
                 }else{
                $st = '充足';
              }
               $up = self::where('product_id',$id)
                   ->update([
                      'product_num'=> $A,
                       'status'=>$st
                   ]);
               return $up;


        }catch (\Exception $e){
            logError('减少产品数量失败',[$e->getMessage()]);
        }

    }

    public static function dc_add($warehouse_name,$product_name,$product_id,$product_num){
        try {

            $date = self::where('product_id',$product_id)
                ->get();

            if(!$date->isEmpty()){

                $A = $date[0]->product_num + $product_num;
                if($A < 10000){
                    $st = '不足';
                }else if(10000 <=$A&&$A<=20000 ){
                    $st = '比较充足';
                }else{
                    $st = '充足';
                }
                $new = self::where('product_id',$product_id)
                    ->update([
                        'product_num' => $A,
                        'status'=>$st
                    ]);
                return $new;
            }
            else{
                if($product_num < 10000){
                    $st = '不足';
                }else if(10000 <=$product_num&&$product_num<=20000 ){
                    $st = '比较充足';
                }else{
                    $st = '充足';
                }

                $ne = self::create([
                    'product_id' => $product_id,
                    'warehouse_name' => $warehouse_name,
                    'product_name' => $product_name,
                    'product_num' => $product_num,
                    'status'=>$st
                ]);
                return $ne;
            }
        }catch (\Exception $e){
            logError('增加数量失败',[$e->getMessage()]);
        }
    }
}
