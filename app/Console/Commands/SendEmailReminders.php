<?php

namespace App\Console\Commands;

use App\Jobs\processEmailReminder;
use App\Mail\MeetingReminder;
use App\Models\Reminder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendEmailReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send-meeting-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email reminders for upcoming meetings';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $meetingsReminders=Reminder::all();
        foreach ($meetingsReminders as $meetingReminder){
            if (Carbon::parse($meetingReminder->remind_at)->lessThanOrEqualTo(Carbon::now()))
            {
                $meetingReminderMail=new MeetingReminder($meetingReminder->enrollment->meeting_date,
                $meetingReminder->attendeeName,$meetingReminder->meetingOrganizer);
                processEmailReminder::dispatch($meetingReminderMail,$meetingReminder->enrollment->student->user->email);
                processEmailReminder::dispatch($meetingReminderMail,$meetingReminder->enrollment->classroom->teacher->user->email);
                $meetingReminder->delete();
            }
      

       
    }
}



}
