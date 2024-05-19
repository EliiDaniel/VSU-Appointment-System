<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Document;
use App\Models\DocumentProcess;
use App\Models\DocumentType;

class DocumentsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'processes' => 'array',
        ]);

        $document = Document::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'document_type_id' => $request->input('type'),
            'soft_copy_available' => $request->has('soft_copy_available'),
        ]);

        $document->processes()->sync($request->input('processes'));

        $request->session()->flash('status', 'Document Created');

        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'processes' => 'array',
        ]);

        $document = Document::findOrFail($id);

        $document->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'document_type_id' => $request->input('type'),
            'soft_copy_available' => $request->has('soft_copy_available'),
        ]);

        $document->updateLogs();

        $document->processes()->sync($request->input('processes'));

        $request->session()->flash('status', 'Document Updated');

        return redirect()->back();
    }
}
