<?php

namespace App\Jobs;

use App\Imports\ExcelImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportExcelJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Garante o caminho absoluto correto
        $fullPath = Storage::path($this->filePath);

        if (!file_exists($fullPath)) {
            \Log::error("Arquivo não encontrado: " . $fullPath);
            return;
        }

        Excel::import(new ExcelImport, $fullPath);
    }
}
