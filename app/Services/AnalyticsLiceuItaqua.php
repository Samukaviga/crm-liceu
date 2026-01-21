<?php


namespace App\Services;

use Illuminate\Support\Facades\Http;

class AnalyticsLiceuItaqua
{


    public $templatesId;
    public $dateStart;

    public $dateEnd;



    protected $apiUrl = "https://graph.facebook.com/v24.0/1667901623877149/template_analytics";
    protected $token;


    function __construct()
    {
        $this->token = env('LICEU_ITAQUA_API_TOKEN');

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
