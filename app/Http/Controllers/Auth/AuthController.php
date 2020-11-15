<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Management;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth()->attempt($credentials)) {
                return json_fail('账号或者用户名错误!',null, 100);
            }else{
                $management_id = auth()->user()->management_id;
                $type = auth()->user()->type;
                if ($type!=1){
                    auth()->logout();
                    return json_fail('账号或者用户名错误!',null, 100);
                }
                $res = Management::updateDate($management_id);
                if($res!=null){
                    return json_success('登陆成功！',array(
                        'token' => $token,
                        'token_type' =>'bearer',
                        'expires_in' => auth()->factory()->getTTL() * 60
                    ),200);
                }else{
                    $this->logout();
                    return json_fail("登陆失败!",null,500);
                }
            }
        }
        catch (\Exception $e) {
            return json_fail('登陆失败!',$e->getMessage(),500);
        }
    }

    public function adminLogin(Request $loginRequest)
    {
        try {
            $credentials = self::credentials($loginRequest);
            if (!$token = auth()->attempt($credentials)) {
                return json_fail('账号或者用户名错误!',null, 100 );
            }else{
                $management_id = auth()->user()->management_id;
                $type = auth()->user()->type;
                if ($type!=0){
                    auth()->logout();
                    return json_fail('账号或者用户名错误!',null, 100 );
                }
                $res = Management::updateDate($management_id);
                if($res!=null){
                    return json_success('登陆成功！',array(
                        'token' => $token,
                        'token_type' =>'bearer',
                        'expires_in' => auth()->factory()->getTTL() * 60
                    ),200);
                }else{
                    $this->logout();
                    return  json_fail("登陆失败!",null,500);
                }
            }
        } catch (\Exception $e) {
            return json_fail('登陆失败!',$e->getMessage(),500,500);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();
        } catch (\Exception $e) {
        }
        return auth()->check() ?
            json_fail('注销登陆失败!',null, 100 ):
            json_success('注销登陆成功!',null,  200);
    }
    public function refresh()
    {
        try {
            $newToken = auth()->refresh();
        } catch (\Exception $e) {
        }
        return $newToken != null ?
            self::respondWithToken($newToken, '刷新成功!') :
            json_fail(100, null,'刷新token失败!');
    }

    protected function credentials($request)
    {
        return ['management_id' => $request['management_id'], 'password' => $request['password']];
    }

    protected function respondWithToken($token, $msg)
    {
        return json_success($msg, array(
            'token' => $token,
            'token_type' =>'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ),200);
    }
    public function test(Request $request){
        $user  = auth('api')->user();

        echo $user->work_id;
    }

    public function registered(Request $registeredRequest)
    {
        return management::createUser(self::userHandle($registeredRequest)) ?
            json_success('注册成功!',null,200  ) :
            json_success('注册失败!',null,100  ) ;

    }
    protected function userHandle($request)
    {
        $registeredInfo = $request->except('password_confirmation');
        $registeredInfo['password'] = bcrypt($registeredInfo['password']);
        $registeredInfo['login_id'] = $registeredInfo['login_id'];
        return $registeredInfo;
    }
}
