<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OwenIt\Auditing\Models\Audit;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::with(['project', 'members'])->get();
        $projects = Project::all();
        $members = Member::all();

        // Mengambil semua audit untuk Task
        $audits = Audit::where('auditable_type', \App\Models\Task::class)->get();

        return view('admin.tasks', compact('tasks', 'projects', 'members', 'audits'));
    }


    public function create()
    {
        $projects = Project::all();
        $members = Member::all();

        return view('tasks.create', compact('projects', 'members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'is_done' => 'nullable|boolean',
            'members' => 'nullable|array',
            'members.*' => 'exists:members,id',
        ]);

        $data = $request->only(['project_id', 'title', 'description', 'deadline']);
        $data['is_done'] = $request->has('is_done');
        $data['uuid'] = (string) Str::uuid(); // ← Tambahkan UUID

        $task = Task::create($data);

        // Tambah relasi member jika ada
        $task->members()->attach($request->members ?? []);

        return redirect()->route('admin.tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task)
    {
        $projects = Project::all();
        $members = Member::all();

        return view('tasks.edit', compact('task', 'projects', 'members'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'deadline' => 'required|date',
            'attachment' => 'nullable|file|mimes:pdf,docx,jpg,png',
            'members' => 'nullable|array',
            // 'members.*' => 'exists:members,id',
            'is_done' => 'nullable',  // Tidak perlu validasi boolean
        ]);

        $data = $request->only(['project_id', 'title', 'description', 'deadline']);

        // Handle file update
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('attachments', 'public');
        }

        // Tangani status is_done (cek apakah checkbox dicentang)
        $data['is_done'] = $request->has('is_done');

        $task->update($data);

        // Sync anggota
        $task->members()->sync($request->members ?? []);

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil diperbarui');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.tasks.index')->with('success', 'Task berhasil dihapus');
    }

    public function show(Task $task)
    {
        $task->load('project', 'members');

        return view('tasks.show', compact('task'));
    }
}
