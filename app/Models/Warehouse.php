<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = "warehouse";
    public $timestamps = true;
    protected $guarded = [];

    Public static function hwc_wareInformationDrop(){
        try {
            $data = self::select('name')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('仓库信息下拉框展示错误', [$e->getMessage()]);
            return null;
        }
    }
}
