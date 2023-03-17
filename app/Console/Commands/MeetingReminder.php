<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MeetingReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:meeting-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remind customer & experts just before their meeting';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $reminders = Reminder::whereMonth('datetime', date('m'))
                    ->whereDay('datetime', date('d'))
                    ->get();
  
        if ($reminders->count() > 0) {
            foreach ($reminders as $reminder) {
                Mail::to($reminder)->send(new ReminderSendEmail($reminder));
            }
        }
  
        return 0;
}
}
