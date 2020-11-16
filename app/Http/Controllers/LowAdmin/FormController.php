<?php

namespace App\Http\Controllers\LowAdmin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\InventoryRecords;
use App\Models\ShipentMassage;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function getForm(){
        $date = Form::dc_getAll();
        return $date?
            json_success('成功展示',$date,'200'):
            json_fail('展示失败',null,'100');
    }
//    public function deleteRecode(Request $request){
//        $date = Form::dc_delectRecode($request['recode_id']);
//        return $date?
//            json_success('成功添加',$date,'200'):
//            json_fail('添加失败',null,'100');
//    }

        public function checkRecode(Request $request){
           $id = $request['recode_id'];
           if (strpos($id,"B") !== false){
                $date = ShipentMassage::dc_selectRecode($id);
               return $date?
                   json_success('成功展示',$date,'200'):
                   json_fail('展示失败',null,'100');
           }else if(strpos($id,'C') !== false){
               $date = InventoryRecords::dc_selectRecode($id);
               return $date?
                   json_success('成功展示',$date,'200'):
                   json_fail('展示失败',null,'100');
           }

        }
}
