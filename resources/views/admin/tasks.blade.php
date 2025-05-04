@extends('partials.app')

@section('content')
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-secondary">Daftar Tugas</h6>
            <button class="btn btn-sm" style="background-color: #121212; color: white" data-toggle="modal"
                data-target="#modalTambah">
                <i class="bi bi-plus"></i> Tambah Tugas
            </button>
        </div>

        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Judul</th>
                            <th>Project</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Anggota</th>
                            <th>Audit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->project->name ?? '-' }}</td>
                                <td>{{ $task->deadline->format('d-m-Y') }}</td>
                                <td>
                                    @if ($task->is_done)
                                        <span class="badge badge-success">Selesai</span>
                                    @else
                                        <span class="badge badge-warning">Belum Selesai</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach ($task->members as $member)
                                        <span class="badge badge-primary">{{ $member->name }}</span>
                                    @endforeach
                                </td>
                                <td> <button type="button" class="btn btn-info" data-toggle="modal"
                                        data-target="#auditModal{{ $task->id }}">
                                        Lihat Audit
                                    </button></td>
                                <td>
                                    <button class="btn btn-warning btn-sm" data-toggle="modal"
                                        data-target="#modalEdit{{ $task->id }}">Edit</button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modalHapus{{ $task->id }}">Hapus</button>
                                </td>
                            </tr>
                            {{-- Modal Edit --}}
                            <div class="modal fade" id="modalEdit{{ $task->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('admin.tasks.update', $task) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Tugas</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="text" name="title" class="mb-2 form-control"
                                                    placeholder="Judul" value="{{ $task->title }}" required>

                                                <textarea name="description" class="mb-2 form-control" placeholder="Deskripsi">{{ $task->description }}</textarea>

                                                <input type="date" name="deadline" class="mb-2 form-control"
                                                    value="{{ $task->deadline->format('Y-m-d') }}" required>

                                                <select name="project_id" class="mb-2 form-control" required>
                                                    <option value="">Pilih Project</option>
                                                    @foreach ($projects as $project)
                                                        <option value="{{ $project->id }}"
                                                            {{ $task->project_id == $project->id ? 'selected' : '' }}>
                                                            {{ $project->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                {{-- Multiple Select untuk Member --}}
                                                <label for="members">Anggota:</label>
                                                <select name="members[]" class="mb-2 form-control" multiple>
                                                    @foreach ($members as $member)
                                                        <option value="{{ $member->id }}"
                                                            {{ $task->members->contains($member->id) ? 'selected' : '' }}>
                                                            {{ $member->name }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                                <label>
                                                    <input type="checkbox" name="is_done"
                                                        {{ $task->is_done ? 'checked' : '' }}> Selesai
                                                </label>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" type="submit">Simpan</button>
                                                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            {{-- Modal Hapus --}}
                            <div class="modal fade" id="modalHapus{{ $task->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('admin.tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin ingin menghapus tugas <strong>{{ $task->title }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-danger" type="submit">Hapus</button>
                                                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada tugas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    @foreach ($tasks as $task)
        <div class="modal fade" id="auditModal{{ $task->id }}" tabindex="-1" role="dialog"
            aria-labelledby="auditModalLabel{{ $task->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditModalLabel{{ $task->id }}">Audit Trail: {{ $task->title }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            $taskAudits = $audits->where('auditable_id', $task->id);
                        @endphp

                        @if ($taskAudits->isEmpty())
                            <p><em>Tidak ada audit ditemukan.</em></p>
                        @else
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>User</th>
                                        <th>Event</th>
                                        <th>Perubahan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($taskAudits as $audit)
                                        <tr>
                                            <td>{{ $audit->created_at->format('d M Y H:i') }}</td>
                                            <td>{{ optional($audit->user)->name ?? 'System' }}</td>
                                            <td>{{ ucfirst($audit->event) }}</td>
                                            <td>
                                                @foreach ($audit->new_values as $field => $new)
                                                    @php
                                                        $old = $audit->old_values[$field] ?? null;
                                                    @endphp
                                                    <div><strong>{{ $field }}</strong>: <span
                                                            class="text-danger">{{ $old }}</span> → <span
                                                            class="text-success">{{ $new }}</span></div>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- Modal Tambah --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.tasks.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Tugas</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="text" name="title" class="mb-2 form-control" placeholder="Judul" required>
                        <textarea name="description" class="mb-2 form-control" placeholder="Deskripsi"></textarea>
                        <input type="date" name="deadline" class="mb-2 form-control" required>
                        <select name="project_id" class="mb-2 form-control" required>
                            <option value="">Pilih Project</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                            @endforeach
                        </select>
                        <label>Anggota Tugas</label>
                        <select name="members[]" class="mb-2 form-control" multiple>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}">{{ $member->name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
