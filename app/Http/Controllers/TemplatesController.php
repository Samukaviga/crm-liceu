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

        return Inertia::render('TemplateMessage')
            ->with('schools', School::all());
    }

    public function list()
    {
        $templates = Template::with('school')->orderBy('created_at', 'DESC')->paginate(3);

        return Inertia::render('TemplateList', ['templates' => $templates]);
    }

    public function edit(int $id)
    {
        $template = Template::find($id);

        return Inertia::render('TemplateEdit', ['template' => $template, 'schools' => School::all()]);
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

    public function update(Request $request, $id)
    {
        $template = Template::find($id);

        $template->name = $request->input('name') ?? $template->name;
        $template->number = $request->input('number') ?? $template->number;
        $template->type = $request->input('type') ?? $template->type;
        $template->campaign = $request->input('campaign') ?? $template->campaign;
        $template->category = $request->input('category') ?? $template->category;
        $template->save();

        return redirect()->back()->with('success', 'Template atualizado com sucesso!');
    }

    public function destroy($id)
    {

        $template = Template::find($id);
        $template->delete();

        return redirect()->back()->with('success', 'Template deletado com sucesso!');
    }
}
