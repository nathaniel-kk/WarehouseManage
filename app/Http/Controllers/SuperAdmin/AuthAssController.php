<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\hwcRequest\fillPurchaseOrderLinkRequest;
use App\Http\Requests\hwcRequest\fillPurchaseOrderRequest;
use App\Http\Requests\hwcRequest\fillPurchaseProOrderLinkRequest;
use App\Http\Requests\hwcRequest\inboundInformationMaxRequest;
use App\Http\Requests\hwcRequest\outboundInformationMaxRequest;
use App\Http\Requests\hwcRequest\tranPurchaseOrderRequest;
use App\Http\Requests\hwcRequest\wareInformationDropDisRequest;
use App\Models\CargoInformation;
use App\Models\IncomingMessage;
use App\Models\InventoryRecords;
use App\Models\Management;
use App\Models\Product;
use App\Models\ShipentMassage;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AuthAssController extends Controller
{
    Public function outboundInformation(){
        $data = ShipentMassage::hwc_outboundInformation();
        return $data?
            json_success('出库信息页面展示成功!',$data,200) :
            json_fail('出库信息页面展示失败!',null,100);
    }

    Public function outboundSeInformation(Request $request){
        $product_id = $request['product_id'];
        if ($product_id == null){
            $data = ShipentMassage::hwc_outboundInformation();
        } else{
            $data = ShipentMassage::hwc_outboundSeInformation($product_id);
        }
        return $data?
            json_success('出库信息搜索页面展示成功!',$data,200) :
            json_fail('出库信息搜索页面展示失败!',null,100);
    }

    Public function outboundInformationMax(outboundInformationMaxRequest $request){
        $shipment_id = $request['shipment_id'];
        $data = ShipentMassage::hwc_outboundInformationMax($shipment_id);
        return $data?
            json_success('出库信息详情展示成功!',$data,200) :
            json_fail('出库信息详情展示失败!',null,100);
    }

    Public function inboundInformation(){
        $data = InventoryRecords::hwc_inboundInformation();
        return $data?
            json_success('入库信息页面展示成功!',$data,200) :
            json_fail('入库信息页面展示失败!',null,100);
    }

    Public function inboundSeInformation(Request $request){
        $product_id = $request['product_id'];
        if ($product_id == null){
            $data = InventoryRecords::hwc_inboundInformation();
        } else{
            $data = InventoryRecords::hwc_inboundSeInformation($product_id);
        }
        return $data?
            json_success('入库信息搜索页面展示成功!',$data,200) :
            json_fail('入库信息搜索页面展示失败!',null,100);
    }

    Public function inboundInformationMax(inboundInformationMaxRequest $request){
        $inventory_id = $request['inventory_id'];
        $data = InventoryRecords::hwc_inboundInformationMax($inventory_id);
        return $data?
            json_success('入库信息详情展示成功!',$data,200) :
            json_fail('入库信息详情展示失败!',null,100);
    }

    Public function wareInformationSearch(Request $request){
        $product_name = $request['product_name'];
        $data = Product::hwc_wareInformationSearch($product_name);
        return $data?
            json_success('仓库信息搜索成功!',$data,200) :
            json_fail('仓库信息搜索失败!',null,100);
    }

    Public function wareInformationDrop(){
        $data = Warehouse::hwc_wareInformationDrop();
        return $data?
            json_success('仓库信息下拉框展示成功!',$data,200) :
            json_fail('仓库信息下拉框展示失败!',null,100);
    }

    Public function wareInformationDropDis(wareInformationDropDisRequest $request){
        $product_name = $request['product_name'];
        $warehouse_name = $request['warehouse_name'];
        $data = Product::hwc_wareInformationDropDis($warehouse_name,$product_name);
        return $data?
            json_success('仓库信息搜索及下拉框回显详情展示成功!',$data,200) :
            json_fail('仓库信息搜索及下拉框回显详情展示失败!',null,100);
    }

    Public function fillPurchaseProOrderLink(fillPurchaseProOrderLinkRequest $request){
        $product_id = $request['product_id'];
        $data = Product::hwc_fillPurchaseProOrderLink($product_id);
        return $data?
            json_success('进货单填写产品编号显示产品名称成功!',$data,200) :
            json_fail('进货单填写产品编号显示产品名称失败!',null,100);
    }

    Public function fillPurchaseOrderDis(){
        $data = Management::hwc_fillPurchaseOrderDis();
        return $data?
            json_success('进货单填写普管编号下拉框展示成功!',$data,200) :
            json_fail('进货单填写普管编号下拉框展示失败!',null,100);
    }

    Public function fillPurchaseOrderLink(fillPurchaseOrderLinkRequest $request){
        $management_id = $request['management_id'];
        $data = Management::hwc_fillPurchaseOrderLink($management_id);
        return $data?
            json_success('进货单填写普管工号名字电话联动展示成功!',$data,200) :
            json_fail('进货单填写普管工号名字电话联动展示失败!',null,100);
    }

    Public function fillPurchaseOrder(fillPurchaseOrderRequest $request){
        $warehouse_name = $request['warehouse_name'];
        $management_id = $request['management_id'];
        $product_name = $request['product_name'];
        $product_id = $request['product_id'];
        $product_num = $request['product_num'];
        $data = IncomingMessage::hwc_fillPurchaseOrder($warehouse_name,$management_id,$product_name,$product_id,$product_num);
        return $data?
            json_success('进货单填写成功!',null,200) :
            json_fail('进货单填写失败!',null,100);
    }

    Public function tranInformationDropDis(Request $request){
        $warehouse_name = $request['warehouse_name'];
        $status = $request['status'];
        $data = Product::hwc_tranInformationDropDis($warehouse_name,$status);
        return $data?
            json_success('调货信息商品状态下拉框回显详情展示成功!',$data,200) :
            json_fail('调货信息商品状态下拉框回显详情展示失败!',null,100);
    }

    Public function tranPurchaseOrderDropDis(wareInformationDropDisRequest $request){
        $warehouse_name = $request['warehouse_name'];
        $data = Management::hwc_tranPurchaseOrderDropDis($warehouse_name);
        return $data?
            json_success('调货单填写仓库管理员姓名下拉框展示成功!',$data,200) :
            json_fail('调货单填写仓库管理员姓名下拉框展示失败!',null,100);
    }

    Public function tranPurchaseOrder(tranPurchaseOrderRequest $request){
        $unenough_warehouse =  $request['unenough_warehouse'];
        $enough_warehouse =  $request['enough_warehouse'];
        $management =  $request['management'];
        $product_id =  $request['product_id'];
        $product_name =  $request['product_name'];
        $product_num =  $request['product_num'];
        $management_id = Management::hwc_tranPurchaseOrder1($management);
        if($management_id == null){
            return json_fail('调货单填写失败!',null,100);
        }else{
            $data = CargoInformation::hwc_tranPurchaseOrder2($unenough_warehouse,$enough_warehouse,$management_id,$product_id,$product_name,$product_num);
            return $data?
                json_success('调货单填写成功!',null,200) :
                json_fail('调货单填写失败!',null,100);
        }
    }

    Public function inboundInformationPlus(){
        $data = IncomingMessage::hwc_inboundInformationPlus();
        return $data?
            json_success('进货信息详情展示成功!',$data,200) :
            json_fail('进货信息详情展示失败!',null,100);
    }
}
