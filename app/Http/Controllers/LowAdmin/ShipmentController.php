<?php

namespace App\Http\Controllers\LowAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LowAdmin\writeShipmentRequest;
use App\Models\Form;
use App\Models\Management;
use App\Models\Product;
use App\Models\ShipentMassage;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function writeShipment(writeShipmentRequest $request){

        $product_name = $request['product_name'];
        $product_id = $request['product_id'];
        $product_num = (int)$request['product_num'];
        $send_place = $request['send_place'];
        $warehouse_name = $request['warehouse_name'];
        $worker_id = $request['worker_id'];

        $id = 'B'.time();
        $ID = auth()->user()->management_id;
        $N = Management::dc_getname($ID);
        $datt = Form::dc_addShipmentrecode($warehouse_name,$worker_id,$product_name,$id,$N);
        $data = Product::dc_reduceNum($product_id,$product_num);
        $date = ShipentMassage::dc_addShipment($warehouse_name,$worker_id,$product_name,$product_id,$product_num,$send_place,$id,$N);
        return $datt&&$date&&$data?
            json_success('成功添加',null,'200'):
            json_fail('添加失败',null,'100');
    }


}
