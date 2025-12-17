<?php

namespace App\Console\Commands;

use App\Services\AnalyticsColegioItaqua;
use Illuminate\Console\Command;

class GetAnalyticsTemplateColegioItaquaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytics-template-colegio-itaqua';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Obter dados analíticos dos templates do Colégio Itaqua';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $dateCurrent = now()->format('Y-m-d');

        $dateStart = now()->subDays(80)->format('Y-m-d');

        //$dateUTC = Carbon::createFromTimestampUTC($unixTimestamp);

        $analyticsService = new AnalyticsColegioItaqua();

        $response = $analyticsService->getAnalyticsData('1723393465022698', $dateStart,  $dateCurrent);

        dd($response);



    }
}
