<?php
/**
 * Created by PhpStorm.
 * User: hyf84
 * Date: 2017/6/6
 * Time: 18:15
 */

namespace App\Transformers;


use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'nickname'=>$user['name'],
            'email'=>$user['email'],
            'sex'=>$user['sex'],
            'phone_num'=>$user['phone'],
        ];
    }
}