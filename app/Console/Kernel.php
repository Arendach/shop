<?php

namespace App\Console;

use App\Console\Commands\AdminGenerateUser;
use App\Console\Commands\GenerateMinify;
use App\Console\Commands\GenerateRedirectRoutes;
use App\Console\Commands\GenerateTranslations;
use App\Console\Commands\MakeDirective;
use App\Console\Commands\ReloadNewPostWarehouses;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        AdminGenerateUser::class,
        MakeDirective::class,
        ReloadNewPostWarehouses::class,
        GenerateTranslations::class,
        GenerateMinify::class,
        GenerateRedirectRoutes::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('backup:clean')->daily()->at('01:00');
        $schedule->command('backup:run')->daily()->at('01:30');
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
