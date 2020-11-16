<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Management extends Model
{
    protected $table = "management";
    public $timestamps = true;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $fillable = ['management_id', 'password'];
    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getJWTIdentifier()
    {
        return self::getKey();
    }

    /***
     * 跟新用户登陆时间
     * @param $login_id
     */
    public static function updateDate($management_id)
    {
        try {
            $model = self::where('management_id',$management_id)->select('*')->get();
            $model->login_date = now();
            return $model;
        } catch (\Exception $e) {
            logError("更新用户登陆时间出错！", $e->getMessage());
            return null;
        }
    }


    /**
     * 创建用户
     *
     * @param array $array
     * @return |null
     * @throws \Exception
     */
    public static function createUser($array = [])
    {
        try {
            return self::create($array) ?
                true :
                false;
        } catch (\Exception $e) {
            //\App\Utils\Logs::logError('添加用户失败!', [$e->getMessage()]);
            die($e->getMessage());
            return false;
        }
    }

    /**
     * 增加用户
     * @param $login_id
     * @param $password
     * @return bool
     * @throws \Exception
     */
    public static function accountAdd($login_id, $password)
    {
        try {
            $data = self::insert([
                'management_id' => $login_id,
                'password' => $password,
                'created_date' => now()
            ]);
            return $data;
        } catch (\Exception $e) {
            logError('新增用户信息错误', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * 禁用操作
     * @param $login_id
     * @param $login_status
     * @return |null
     */
    public static function accountState($login_id, $login_status)
    {

        try {
            if ($login_id == null) {
                $data = null;
            } else {
                if ($login_status == 1) {
                    $data = self::where('management_id', $login_id)
                        ->update(['login_status' => 0, 'login_date' => now()]);
                } else {
                    $data = self::where('management_id', $login_id)
                        ->update(['login_status' => 1, 'login_date' => now()]);
                }
            }
            return $data;
        } catch (\Exception $e) {
            logError('禁用用户错误', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * 数据展示
     * @return |null
     */
    public static function accountExhibition()
    {
        try {
            $data = management::join('user_information', 'login_id', 'information_id')
                ->select(['login_id', 'login_date', 'login_status', 'nichen', 'name', 'sex'])
                ->paginate(5);
            return $data;
        } catch (\Exception $e) {
            logError('禁用用户错误', [$e->getMessage()]);
            return null;
        }
    }

    /**
     * 增加
     * @param $id
     * @return |null
     */
    public static function signAdd($id)
    {
        try {
            $data = management::insert([
                'login_id' => $id,
                'password' => bcrypt(123456),
                'login_date' => now(),
            ]);
            return $data;
        } catch (\Exception $e) {
            logError('新增用户信息错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function dc_getwarehouse($id){
        try {
            $date = self::where('management_id',$id)
                ->select('warehouse_name')
                ->get();
            return $date;
        }catch (\Exception $e){
            logError('获取对应仓库名错误', [$e->getMessage()]);
        }
    }
    Public static function hwc_fillPurchaseOrderDis(){
        try {
            $data = self::where('type',1)
                ->select('management_id')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('进货单填写普管编号下拉框展示错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function dc_getname($id){
        try {
            $date = self::where('management_id',$id)
                ->select('management_name')
                ->get();
            return $date;
        }catch (\Exception $e){
            logError('获取管理员名错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function hwc_fillPurchaseOrderLink($management_id){
        try {
            $data = self::where('type',1)
                ->where('management_id',$management_id)
                ->select('management','phone')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('进货单填写普管工号名字电话联动展示错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function hwc_tranPurchaseOrderDropDis($warehouse_name){
        try {
            $data = self::where('type',1)
                ->where('warehouse_name',$warehouse_name)
                ->select('management')
                ->get();
            return $data;
        } catch (\Exception $e) {
            logError('调货单填写仓库管理员姓名下拉框展示错误', [$e->getMessage()]);
            return null;
        }
    }

    public static function hwc_tranPurchaseOrder1($management){
        try {
            $data = self::where('type',1)
                ->where('management',$management)
                ->pluck('management_id')[0];
            return $data;
        } catch (\Exception $e) {
            logError('调货单填写错误', [$e->getMessage()]);
            return null;
        }
    }
}
