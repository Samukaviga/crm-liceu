<?php

namespace App\Imports;

use App\Jobs\ImportExcelJob;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ExcelImport implements ToCollection
{
    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function collection(Collection $rows)
    {
        // Se você quiser processar em chunks no job:
        $chunked = $rows->chunk(500); // mesma lógica do chunkSize

        foreach ($chunked as $chunk) {
            // Dispara um job para cada chunk
            ImportExcelJob::dispatch($chunk->toArray());
        }
    }
}
