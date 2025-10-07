<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Imports\ExcelImport;
use App\Jobs\ImportExcelJob;
use App\Models\PricingSellflux;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Maatwebsite\Excel\Facades\Excel;

class CrmController extends Controller
{
    public function index(): Response
    {
        // return Inertia::render('ImportExcel');

        return Inertia::render('ImportExcel');
    }


    public function store(Request $request)
    {
        $uploadedFile = $request->file('file');
        $filename = time() . '_' . $uploadedFile->getClientOriginalName();

        // Salva no disco local (storage/app/imports)
        $path = $uploadedFile->storeAs('imports', $filename);

        // Dispara o job
        ImportExcelJob::dispatch($path);

        return response()->json([
            'message' => 'Arquivo enviado com sucesso! A importação será processada em segundo plano.',
        ]);
    }

    public function data()
    {

        return response()->json(PricingSellflux::orderBy('id', 'desc')->get());
    }
}
