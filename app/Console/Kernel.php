<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command("backup:clean")->daily()->at('01:00');

        /**
         * php artisan backup:run --only-to-disk=
         * php artisan backup:run --only-db     ／／只备份数据库
         * php artisan backup:run --only-files  //只备份文件
         */
        $schedule->command("backup:run")->daily()->at('2:00');
        $schedule->command("backup:monitor")->daily()->at('2:30');



        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
