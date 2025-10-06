<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class CrmController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('ImportExcel');
    }


    public function store(Request $request)
    {
        /*
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048', // Validate file type and size
        ]); */

        dd($request->all());

        $file = $request->file('file');

        // Process the file (e.g., store it, read its contents, etc.)
        // For demonstration, we'll just return a success message.

        return back()->with('success', 'File uploaded successfully!');
    }

}
