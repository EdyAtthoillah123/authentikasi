<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\Project;
use App\Models\Task;
class HomeController extends Controller
{
    public function index()
    {
        $members = Member::all();
        $projects = Project::all();
        $tasks = Task::with(['project', 'members'])->get();
        return view('admin.dashboard', compact('members', 'projects', 'tasks'));
    }

    public function user()
    {
        return view('dashboard');
    }

    public function manager()
    {
        $members = Member::all();
        $projects = Project::all();
        $tasks = Task::with(['project', 'members'])->get();
        return view('manager.dashboard', compact('members', 'projects', 'tasks'));
    }
}
