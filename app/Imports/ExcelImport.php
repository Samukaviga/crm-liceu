<?php

namespace App\Imports;

use App\Models\PricingSellflux;
use Maatwebsite\Excel\Concerns\ToModel;

class ExcelImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new PricingSellflux([
            'value' => $row[0],
            'project_id' => $row[1],
            'description' => $row[3],
            'type' => $row[4],
            'created_at_sellflux' => $row[5],
            'canceled' => $row[6],
        ]);
    }

    // Quantos registros são inseridos de uma vez
    public function batchSize(): int
    {
        return 500;
    }

    // Quantas linhas são lidas do Excel por vez
    public function chunkSize(): int
    {
        return 500;
    }

}
