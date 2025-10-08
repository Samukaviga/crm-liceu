<?php

namespace App\Jobs;

use App\Imports\ExcelImport;
use Illuminate\Bus\Queueable; // ← aqui estava errado
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected string $filePath;

    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    public function handle(): void
    {
        $fullPath = Storage::path($this->filePath);

        if (!file_exists($fullPath)) {
            \Log::error("Arquivo não encontrado: " . $fullPath);
            return;
        }

        Excel::import(new ExcelImport, $fullPath);
    }

    public $timeout = 600;
}
