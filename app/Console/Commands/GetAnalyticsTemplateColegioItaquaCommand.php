<?php

namespace App\Console\Commands;

use App\Models\Analytic;
use App\Models\Template;
use App\Services\AnalyticsColegioItaqua;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

use function Laravel\Prompts\error;
use function Laravel\Prompts\info;

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

        $templates = Template::where('school_id', 1)->get();




        foreach ($templates as $template) {


            $response = $analyticsService->getAnalyticsData($template->number, $dateStart,  $dateCurrent);


            if (isset($response->headers)) {
                error("Erro ao obter dados analíticos para o Template ID: {$template->id}");
                continue;
            }


            foreach ($response['data'] ?? [] as $group) {


                foreach ($group['data_points'] ?? [] as $point) {


                    $pointStartDate = Carbon::createFromTimestampUTC($point['start'])->format('Y-m-d');
                    $pointEndDate   = Carbon::createFromTimestampUTC($point['end'])->format('Y-m-d');

                    // dd($dateStart);

                    // ✅ Normalização defensiva do cost
                    $costs = collect($point['cost'] ?? [])
                        ->filter(
                            fn($item) =>
                            isset($item['type'], $item['value']) &&
                                is_numeric($item['value'])
                        )
                        ->keyBy('type')
                        ->map(fn($item) => (float) $item['value']);

                    $amountSpent = $costs->get('amount_spent', 0);
                    $costPerDelivered = $costs->get('cost_per_delivered', 0);
                    $costPerUrlButtonClick = $costs->get('cost_per_url_button_click', 0);



                    try {
                        Analytic::updateOrCreate(
                            [
                                'template_id' => $template->id,
                                'start_date' => $pointStartDate,


                            ],
                            [
                                'delivered' => $point['delivered'] ?? 0,
                                'url_button_clicks' => $point['url_button_clicks'] ?? 0,
                                'replied' => $point['replied'] ?? 0,
                                'read' => $point['read'] ?? 0,
                                'send' => $point['sent'] ?? 0,
                                'delivery' => $point['delivered'] ?? 0,
                                'amount_spent' => $amountSpent,
                                'cost_per_delivered' => $costPerDelivered,
                                'cost_per_url_button_click' => $costPerUrlButtonClick,
                                'end_date' => $pointEndDate
                            ]
                        );

                        info($template->school->name . " -- Template ID: $template->id Adicionado com sucesso, Data Início: $pointStartDate");
                    } catch (\Throwable $th) {
                        //throw $th;
                        error("Erro ao adicionar template - " . $th->getMessage());
                    }
                }
            }
        }
    }
}
