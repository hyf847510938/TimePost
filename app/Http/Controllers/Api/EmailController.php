<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmailCreateRequest;
use App\Jobs\SendEmail;
use App\Models\Email;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    //创建邮件
    public function create(EmailCreateRequest $request)
    {
        
        $data =[
            'title'    => $request->get('title'),
            'subject'  => $request->get('subject'),
            'content  '=> $request->get('content'),
            'to'       => $request->get('to'),
            'status'   => $request->get('status'),
            'scope'    => $request->get('scope'),
            'send_time'=> $request->get('send_time'),
            'user_id  '=> $request->get('user')->user_id
        ];

        $email = Email::PostEmail($data);

        //创建任务
        $job = (new SendEmail($email))
            ->delay(Carbon::createFromTimestamp(strtotime($email->send_time)));
        dispatch($job);

        return  ['status'=>'success'];
    }
}
