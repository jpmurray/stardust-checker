<?php

namespace App\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Check extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'check';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Check if there is any Stardust instance available at Scaleway.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $paris_availability = Http::withHeaders([
            'X-Auth-Token' => env('SCW_SECRET_KEY'),
        ])->get("https://api.scaleway.com/instance/v1/zones/fr-par-1/products/servers/availability")['servers']['STARDUST1-S']['availability'];

        $amsterdam_availability = Http::withHeaders([
            'X-Auth-Token' => env('SCW_SECRET_KEY'),
        ])->get("https://api.scaleway.com/instance/v1/zones/nl-ams-1/products/servers/availability")['servers']['STARDUST1-S']['availability'];

        if($paris_availability == "available") {
            $this->notify("fr-par-1", "Stardust instance available !");
        }

        if($amsterdam_availability == "available") {
            $this->notify("nl-ams-1", "Stardust instance available !");
        }
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        $schedule->command(static::class)->everyMinute();
    }
}
