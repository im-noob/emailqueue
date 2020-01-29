<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendMailable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        Mail::to('aaravonly4you@gmail.com')->send(new SendMailable());
        echo 'email sent';
    }

    public function sendEmailWithQueue()
    {
        $emailJob = (new SendEmailJob())->delay(Carbon::now()->addMinute(1));
        dispatch($emailJob);

        echo 'email sent';
    }
}
