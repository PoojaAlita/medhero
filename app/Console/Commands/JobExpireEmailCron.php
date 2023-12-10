<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\{Http,Auth,Mail};
use App\Models\{User,JobPost};
use Carbon\Carbon;



class JobExpireEmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
            $jobs = JobPost::where('created_at','<',Carbon::now()->subDays(30))->with('User')->where('status',1)->get();
            foreach($jobs as $job){
                //Send mail 
                $data = ['data' => $job]; 
                $email = $job->User->email;
             $user['to'] =$email;
              Mail::send('layouts.expire_job_mail',['data' => $data], function ($messages) use ($user) {
                 $messages->to($user['to']);
                 $messages->subject('Job Expire Mail');
             });
            }
   
    }
}
