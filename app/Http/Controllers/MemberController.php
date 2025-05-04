<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use OwenIt\Auditing\Models\Audit;
use App\Exports\MemberExport;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function export()
    {
        return Excel::download(new MemberExport, 'members.xlsx');
    }

    public function index()
    {
        $members = Member::all();
        $audits = Audit::all();
        return view('admin.member', compact('members', 'audits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
        ]);

        Member::create([
            'uuid' => Str::uuid(),
            'name' => $request->name,
            'email' => $request->email,
            'joined_at' => now(),
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,'.$member->id,
        ]);

        $member->update($request->only(['name', 'email']));

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil diperbarui.');
    }

    public function destroy(Member $member)
    {
        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus.');
    }

    public function assignProject(Request $request, Member $member)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
        ]);

        $member->projects()->attach($request->project_id);

        return back()->with('success', 'Member berhasil ditambahkan ke proyek.');
    }

    public function assignTask(Request $request, Member $member)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        $member->tasks()->attach($request->task_id);

        return back()->with('success', 'Member berhasil ditambahkan ke tugas.');
    }
}
