<?php

namespace App\Listeners;

use App\Events\UserRegiste;
use App\Mailer\Mailer;

class SendAuthEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer=$mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegiste  $event
     * @return void
     */
    public function handle(UserRegiste $event)
    {
        $data=[
            'log'     => 'Send Auth Email To:',
            'to'      => $event->user->email,
            'title'   => config('app.name'),
            'template'=> 'welcome',
            'data'    => [
                'url' => route('confirm_email',[
                    'confirm'=>$event->user->confirm_token,
                ]),
                'user'=>$event->user->name?:$event->user->email,
                'appname'=>config('app.name')
            ]
        ];
        //发送邮件
        $this->mailer->SendEmail($data);

    }
}
