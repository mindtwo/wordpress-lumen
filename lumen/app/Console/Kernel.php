<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Install\InstallCommand::class,
        \App\Console\Commands\RefreshBackupSettingsCommand::class,
        \App\Console\Commands\RefreshDotenvFileCommand::class,
        \App\Console\Commands\BackupCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('wp-lumen:backup')->daily();
    }
}
