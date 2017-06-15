<?php
/**
 * Created by PhpStorm.
 * User: hyf84
 * Date: 2017/6/14
 * Time: 9:41
 */

namespace App\Mailer;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class Mailer
{
    public static function SendEmail(array $data)
    {
        Log::info($data['log'].$data['to']);

        $template = new SendCloudTemplate($data['template'], $data['data']);

        Mail::raw($template, function ($message) use($data) {
            $message->from(env('SENDCLOUD_FROM_EMAIL'), $data['title']);
            $message->to($data['to']);
        });
    }

}