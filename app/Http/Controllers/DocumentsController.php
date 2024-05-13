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
        ]);

        $document->processes()->sync($request->input('processes'));

        $request->session()->flash('status', 'document-created');

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
        ]);

        $document->updateLogs();

        $document->processes()->sync($request->input('processes'));

        $request->session()->flash('status', 'document-created');

        return redirect()->back();
    }

    public function createProcess(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:document_processes',
        ]);

        $supplier_type = DocumentProcess::create([
            'name' => $request->input('name'),
        ]);

        $request->session()->flash('status', 'process-created');

        return redirect()->back();
    }

    public function createType(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:document_types',
        ]);

        $supplier_type = DocumentType::create([
            'name' => $request->input('name'),
        ]);

        $request->session()->flash('status', 'process-created');

        return redirect()->back();
    }
}
