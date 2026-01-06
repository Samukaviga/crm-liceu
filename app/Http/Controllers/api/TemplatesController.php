<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemplatesController extends Controller
{
    public function index()
    {
//   return Inertia::render('ImportStatistics');

        return Inertia::render('TemplateMessage');

    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'name' => 'required|max:255',
            'number' => 'required',
            'id_school' => 'required',
        ]);

        Template::create([
            'school_id' => $request->input('id_school'),
            'name' => $request->input('name'),
            'number' => $request->input('number'),
        ]);

        return response()->json([
            'message' => 'Template criado com sucesso!',
        ], 201);

    }
}
