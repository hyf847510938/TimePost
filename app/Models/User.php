<?php

namespace App\Models;

use App\Events\UserRegiste;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Mailer\Mailer;
class User extends Authenticatable
{
    use Notifiable;
    protected $primaryKey='user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','confirm_token','email_active','sex','real_name','remember_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'confirm_token','email_active','remember_token'
    ];

    public static function register(array $attribute)
    {
        $user = static::create($attribute);
        //触发event事件 发送验证邮件
        event(new UserRegiste($user));

        return $user;
    }


    //重写重置密码发送邮件
    public function sendPasswordResetNotification($token)
    {
        $data=[
            'log'     => 'Send Reset Password Email To:',
            'to'      => $this->email,
            'title'   => config('app.name'),
            'template'=> 'reset_password',
            'data'    => [
                'url' => url('password/reset',$token),
                'email'=>$this->email,
                'appname'=>config('app.name')
            ]
        ];
        //发送邮件
        Mailer::SendEmail($data);
    }
}
