<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class EmailController extends Controller
{

    //核对邮箱
    public function confirm_email(Request $request)
    {
        $confirm = $request->get('confirm');
        $user = User::where('confirm_token',$confirm)->first();

        if(is_null($user)){
            flash()->error('邮箱验证失败，令牌已过期')->important();
            return redirect(Auth::check()?'/home':'/login');
        }

        $user->email_active=1;
        $user->confirm_token=str_random(80);
        $user->save();
        flash()->success('邮箱验证成功')->important();
        Auth::login($user);
        return redirect('/home');
    }

}
