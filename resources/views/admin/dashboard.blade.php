@extends('partials.app')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Member Info -->
            <div class="mb-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Members</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($members as $member)
                                <li class="list-group-item">
                                    {{ $member->name }}
                                    <span class="float-right badge badge-info">{{ $member->email }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Project Info -->
            <div class="mb-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Projects</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($projects as $project)
                                <li class="list-group-item">
                                    {{ $project->name }}
                                    <span class="float-right badge badge-success">{{ $project->status }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Task Info -->
            <div class="mb-4 col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Tasks</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            @foreach ($tasks as $task)
                                <li class="list-group-item">
                                    <strong>{{ $task->title }}</strong><br>
                                    <small>Project: {{ $task->project->name }}</small><br>
                                    <small>Assigned to:</small>
                                    @foreach ($task->members as $member)
                                        <span class="badge badge-primary">{{ $member->name }}</span>
                                    @endforeach
                                    <span class="float-right badge badge-secondary">
                                        {{ $task->is_done ? 'Completed' : 'Pending' }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
