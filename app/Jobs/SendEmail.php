<?php

namespace App\Jobs;

use App\Mailer\Mailer;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Naux\Mail\SendCloudTemplate;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $email;

    //失败重试次数
    public $tries=3;

    public function __construct($email)
    {
        $this->email  = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'log'     => 'send email to:',
            'to'      => $this->email->to,
            'template'=> 'post_mail',
            'title'   => '来自过去的信',
            'data'    => [
                'posttime'=> date('Y-m-d H:i:s',$this->email->created_at->getTimestamp()),
                'content' => $this->email->content,
            ]
        ];
        Mailer::SendEmail($data);
    }
}
