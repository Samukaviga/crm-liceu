<?php

namespace App\Jobs;

use App\Imports\ExcelImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Queueable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Tempo máximo de execução do job em segundos
     */
    public $timeout = 600; // 10 minutos

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

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
