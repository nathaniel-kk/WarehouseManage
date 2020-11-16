<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CargoInformation extends Model
{
    protected $table = "cargo_information";
    public $timestamps = true;
    protected $guarded = [];

    public static function dc_getCargo(){
        try {
            $date = self::all();
            return $date;
        }catch (\Exception $e){
            logError('获取记录失败',[$e->getMessage()]);
        }
    }

    public static function dc_checkCargo($id){
        try {
            $date = self::where('cargo_id',$id)
                ->get();
            return $date;
        }catch (\Exception $e){
            logError('展示记录失败',[$e->getMessage()]);
        }
    }

    public static function dc_updateType($management,$id,$name){
        try {
            $date = self::where('cargo_id',$id)
                ->get();
            if($date[0]->type == 0 && $date[0]->management_id == $management){
                    $d = self::where('cargo_id',$id)
                    ->update([
                      'type'=> 1
                    ]);
                    return $d;
            }elseif ($date[0]->type == 1 && $date[0]->unenough_warehouse == $name){
                    $d = self::where('cargo_id',$id)
                        ->update([
                            'type'=> 2
                        ]);
                    return $d;
            }
            return 1;
        }catch (\Exception $e){
            logError('修改type失败',[$e->getMessage()]);
        }
    }

}
