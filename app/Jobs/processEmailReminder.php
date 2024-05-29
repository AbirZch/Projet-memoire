<?php

namespace App\Jobs;

use App\Mail\MeetingReminder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class processEmailReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
   public MeetingReminder  $meetingReminder;
   public $reciever;
    public function __construct(MeetingReminder $meetingReminder,$reciever)
    {
        $this->meetingReminder=$meetingReminder;
        $this->reciever=$reciever;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info(('sending email to '.$this->reciever));
        Mail::to($this->reciever)->send($this->meetingReminder);

    }
}
