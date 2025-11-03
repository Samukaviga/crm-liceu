<?php

namespace App\Jobs;

use App\Models\StatisticService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class StatisticServiceJob implements ShouldQueue
{
    use Queueable;

    protected array $rows;
    protected string $schoolName;

    public function __construct(array $rows, string $schoolName)
    {
        $this->rows = $rows;
        $this->schoolName = $schoolName;
    }

    public function handle(): void
    {

            // Pula a primeira linha (cabeçalho)
            $rows = array_slice($this->rows, 1);

            foreach ($rows as $index => $row) {

                if (empty($row) || empty($row[5])) {
                    continue;
                }

                // Loga linhas muito curtas
                if (count($row) < 16) {
                    Log::warning('Linha incompleta ignorada', [
                        'school' => $this->schoolName,
                        'row_index' => $index,
                        'data' => $row
                    ]);
                    continue;
                }

                // Cria identificador único seguro
                $unique = ($row[4] ?? '') . ($row[11] ?? '') . ($row[12] ?? '') . ($row[13] ?? '') . ($row[14] ?? '') . ($row[15] ?? '');


                StatisticService::updateOrCreate(
                    ['unique_sellflux' => $unique],
                    [
                    'start_of_service' => $row[0] ?? null,
                    'end_of_service' => $row[1] ?? null,
                    'person_start_service' => $row[2] ?? null,
                    'name_client' => $row[3] ?? null,
                    'phone' => $row[4] ?? null,
                    'email' => $row[5] ?? null,
                    'grade' => $row[6] ?? null,
                    'comment' => $row[7] ?? null,
                    'matter' => $row[8] ?? null,
                    'resume' => $row[9] ?? null,
                    'person_finished_service' => $row[10] ?? null,
                    'total_service_time' => $row[11] ?? null,
                    'total_after_person_start' => $row[12] ?? null,
                    'total_time_queue' => $row[13] ?? null,
                    'total_time_department' => $row[14] ?? null,
                    'time_between_responses' => $row[15] ?? null,
                    'during_working_hours' => $row[16] ?? 'Não informado',
                    'unique_sellflux' => $unique ?: null,
                    'school' => $this->schoolName,
                ]);
            }




            broadcast(new \App\Events\ImportCompletedEvent());

    }

    public $timeout = 600;
}
