<?php

namespace App\Imports;

use App\Jobs\StatisticServiceJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class StatisticServiceImport implements ToCollection
{
    protected string $filePath;
    protected string $schoolName;

    public function __construct(string $filePath, string $schoolName)
    {
        $this->filePath = $filePath;
        $this->schoolName = $schoolName;

    }
    public function collection(Collection $rows)
    {
        // Se você quiser processar em chunks no job:
        $chunked = $rows->chunk(500); // mesma lógica do chunkSize

        foreach ($chunked as $chunk) {
            // Dispara um job para cada chunk

            StatisticServiceJob::dispatch($chunk->toArray(), $this->schoolName);

            broadcast(new \App\Events\CountJobsEvent(DB::table('jobs')->count()));

        }
    }
}
