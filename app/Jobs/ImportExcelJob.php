<?php

namespace App\Jobs;

use App\Models\PricingSellflux;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;

class ImportExcelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;

    protected array $rows;

    public function __construct(array $rows)
    {
        $this->rows = $rows;
    }

    public function handle(): void
    {
        $data = [];

        foreach ($this->rows as $row) {
            $data[] = [
                'value' => $row[0],
                'project_id' => $row[1],
                'description' => $row[3],
                'type' => $row[4],
                'created_at_sellflux' => $row[5],
                'canceled' => $row[6],
            ];
        }

        // Bulk insert
        PricingSellflux::insert($data);
    }

    public $timeout = 600;
}
