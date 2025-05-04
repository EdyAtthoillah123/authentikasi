@extends('partials.app')

@section('content')
    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between">
            <div class="mt-1">
                <h6 class="m-0 font-weight-bold text-secondary">Manajemen Member</h6>
            </div>
            <div>
                <div class="btn-group" role="group" aria-label="Export Import Excel">
                    <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modalTambahMember"
                        style="background-color: #121212; color: white">
                        <i class="bi bi-plus"></i> Tambah
                    </button>
                    <button type="button" class="btn btn-sm" id="importExcelButton"
                        style="background-color: #007bff; color: white">
                        <i class="bi bi-file-earmark-arrow-up"></i> Import Excel
                    </button>
                    <a href="{{ route('member.excel') }}" type="button" class="btn btn-sm" id="exportExcelButton"
                        style="background-color: #28a745; color: white">
                        <i class="bi bi-file-earmark-arrow-down"></i> Export Excel
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Bergabung</th>
                            <th>Admin?</th>
                            <th>Audit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $member)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->email }}</td>
                                <td>{{ $member->joined_at ? $member->joined_at->format('d-m-Y') : '-' }}</td>
                                <td>
                                    @if ($member->is_admin)
                                        <span class="badge badge-success">Ya</span>
                                    @else
                                        <span class="badge badge-secondary">Tidak</span>
                                    @endif
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#auditModal{{ $member->id }}">
                                        Lihat Audit
                                    </button>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- Edit -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditMember{{ $member->id }}">
                                            Edit
                                        </button>

                                        <!-- Hapus -->
                                        <form action="{{ route('admin.members.destroy', $member) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>

                            {{-- Modal Edit Member --}}
                            <div class="modal fade" id="modalEditMember{{ $member->id }}" tabindex="-1" role="dialog">
                                <div class="modal-dialog" role="document">
                                    <form action="{{ route('admin.members.update', $member) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Edit Member</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Nama</label>
                                                    <input type="text" name="name" value="{{ $member->name }}"
                                                        class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="email" name="email" value="{{ $member->email }}"
                                                        class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Batal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Audit -->
    @foreach ($members as $member)
        <div class="modal fade" id="auditModal{{ $member->id }}" tabindex="-1" role="dialog"
            aria-labelledby="auditModalLabel{{ $member->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auditModalLabel{{ $member->id }}">Audit Trail: {{ $member->name }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @php
                            $memberAudits = $audits->where('auditable_id', $member->id);
                        @endphp

                        @if ($memberAudits->isEmpty())
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
                                    @foreach ($memberAudits as $audit)
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

    {{-- Modal Tambah Member --}}
    <div class="modal fade" id="modalTambahMember" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Member</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
