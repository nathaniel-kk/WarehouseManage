<?php

namespace App\Http\Controllers\LowAdmin;

use App\Http\Controllers\Controller;
use App\Models\CargoInformation;
use App\Models\Management;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function getCargo(){
        $date = CargoInformation::dc_getCargo();
        return $date?
            json_success('成功展示',$date,'200'):
            json_fail('展示失败',null,'100');
    }

    public function checkCargo(Request $request){
        $id = $request['cargo_id'];
        $date = CargoInformation::dc_checkCargo($id);
        return $date?
            json_success('成功展示',$date,'200'):
            json_fail('展示失败',null,'100');
    }

    public function updateType(Request $request){
        $management = auth()->user()->management_id;
        $id = $request['cargo_id'];
        $name = Management::dc_getwarehouse($id);
        $date = CargoInformation::dc_updateType($management,$id,$name);
        return $date?
            json_success('成功修改',null,'200'):
            json_fail('修改失败',null,'100');
    }

}
