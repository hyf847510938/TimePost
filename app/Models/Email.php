<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

    protected $primaryKey="email_id";

    protected $fillable=[
      'title','subject','content','to','status','send_time','scope','user_id'
    ];

    public static function PostEmail(array $attrbute){
        $email = static::create($attrbute);
        return $email;
    }
}
