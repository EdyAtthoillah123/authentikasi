<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use OwenIt\Auditing\Models\Audit;
use App\Exports\ProjectExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProjectImport;

class ProjectController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $userId = auth()->id();

        // Queue import dengan user ID untuk cache tracking
        Excel::queueImport(new ProjectImport($userId), $request->file('file'));

        return back()->with('success', '📦 Import sedang diproses di background. Anda akan diberi notifikasi saat selesai.');
    }


    public function export()
    {
        return Excel::download(new ProjectExport, 'projects.xlsx');
    }

    public function index()
    {
        $projects = Project::orderBy('created_at', 'desc')->get();
        $audits = Audit::where('auditable_type', Project::class)->get();

        return view('admin.project', compact('projects', 'audits'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'documents' => 'nullable|array',
            'documents.*' => 'mimes:pdf|max:2048',
        ]);

        $documentPaths = [];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('documents'), $filename);
                $documentPaths[] = $filename;
            }
        }

        Project::create([
            'uuid' => \Str::uuid(),
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => true,
            'documents' => json_encode($documentPaths),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil dibuat!');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'documents' => 'nullable|array',
            'documents.*' => 'mimes:jpg,jpeg,png,pdf,docx,xlsx|max:2048',
        ]);

        $documentPaths = json_decode($project->documents, true) ?: [];

        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time().'_'.$file->getClientOriginalName();
                $file->move(public_path('documents'), $filename);
                $documentPaths[] = $filename;
            }
        }

        $project->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'documents' => json_encode($documentPaths),
        ]);

        return redirect()->route('admin.projects.index')->with('success', 'Project berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('successhapus', 'Project berhasil dihapus!');
    }
}
