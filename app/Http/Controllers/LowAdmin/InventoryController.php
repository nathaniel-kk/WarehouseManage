<?php

namespace App\Http\Controllers\LowAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LowAdmin\writeInventoryRequest;
use App\Models\Form;
use App\Models\InventoryRecords;
use App\Models\Management;
use App\Models\Product;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function writeInventory(writeInventoryRequest $request){
        $product_name = $request['product_name'];
        $product_id = $request['product_id'];
        $product_num = (int)$request['product_num'];
        $company = $request['company'];
        $warehouse_name = $request['warehouse_name'];
        $worker_id = $request['worker_id'];
        $id = 'C'.time();

        $manage = auth()->user()->management_id;
        $name=Management::dc_getname($manage);
        $datt = Form::dc_addInventoryrecode($warehouse_name,$product_name,$worker_id,$id,$name);
        $data = Product::dc_add($warehouse_name,$product_name,$product_id,$product_num);
       $date = InventoryRecords::dc_writeInventory($warehouse_name,$worker_id,$product_name,$product_id,$product_num,$company,$id,$name);
        return $datt&&$date&&$data?
            json_success('成功添加',null,'200'):
            json_fail('添加失败',null,'100');

    }
}
