<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Schedule;
use App\CallSubmission;

class MakeSchedules extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:make';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Makes Schedules of employees for every day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Making Schedules');
        $Schedules = Schedule::where('day',date('l'))->get();
        foreach ($Schedules as $schedule) {
            foreach ($schedule->docters() as $docter) {
                \
                Log::info($docter);
                
                CallSubmission::firstOrCreate([
                    'employe_id'    => $schedule->employee_id,
                    'docter_id'     => $docter->id,
                    'day'           => date('l'),
                    'x'             => 0,
                    'y'             => 0,
                    'detail'        => '',
                    'product'       => 0,
                    'gift'          => 0,
                    'sample'        => 0,
                    'visited'       => 0
                ]);
            }
        }
        $this->info('Schedules Ready');
    }
}
