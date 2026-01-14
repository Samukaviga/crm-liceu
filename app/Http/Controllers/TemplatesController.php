<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\Template;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TemplatesController extends Controller
{
    public function index()
    {
//   return Inertia::render('ImportStatistics');

        return Inertia::render('TemplateMessage')
                    ->with('schools', School::all());

    }

    public function store(Request $request)
    {
        $request->validate(rules: [
            'name' => 'required|max:255',
            'number' => 'required',
            'school_id' => 'required',
        ]);

        Template::create([
            'school_id' => $request->input('school_id'),
            'name' => $request->input('name'),
            'number' => $request->input('number'),
            'type' => $request->input('type'),
            'campaign' => $request->input('campaign'),
            'category' => $request->input('category'),
        ]);

        return redirect()->back()->with('success', 'Template criado com sucesso!');

    }
}
