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
}
