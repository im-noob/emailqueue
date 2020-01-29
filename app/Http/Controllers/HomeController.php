<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use Log;
use Mail;


class HomeController extends Controller
{
    public function index()
    {
        return view()->make("home.index");
    }
    public function send()
    {
        Log::info("Request cycle without Queues started");
        Mail::send('email.welcome', ['data'=>'data'], function ($message) {

            $message->from('me@gmail.com', 'Christian Nwmaba');

            $message->to('chris@scotch.io');

        });
        Log::info("Request cycle without Queues finished");
    }
    public function sendqueue()
    {
        Log::info("Request Cycle with Queues Begins");
        $this->dispatch((new SendWelcomeEmail())->delay(60 * 5) ) ;
        Log::info("Request Cycle with Queues Ends");
    }
}
