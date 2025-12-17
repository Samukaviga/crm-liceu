<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class AnalyticsColegioItaqua
{


    public $templatesId;
    public $dateStart;

    public $dateEnd;



    protected $apiUrl = "https://graph.facebook.com/v24.0/224890660713486/template_analytics";
    protected $token;


    function __construct()
    {
        $this->token = env('COLEGIO_ITAQUA_API_TOKEN');

    }

    public function getAnalyticsData($templatesId, $dateStart, $dateEnd)
    {

        $response = Http::withToken($this->token)
            ->get($this->apiUrl, [
                'template_ids' => $templatesId,
                'start' => $dateStart,
                'end' => $dateEnd,
                'granularity' => 'daily',
                'limit' => 100,
                'pretty' => 0
            ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Erro ao buscar',
                'status' => $response->status(),
                'body' => $response->body()
            ], 500);
        }

        return $response->json();
    }
}
