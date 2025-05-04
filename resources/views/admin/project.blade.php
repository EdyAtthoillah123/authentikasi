@extends('partials.app')

@section('content')
    <script>
        let intervalId = setInterval(() => {
            fetch('/check-status')
                .then(res => res.json())
                .then(data => {
                    if (data.done) {
                        alert('✅ Import selesai!');
                        clearInterval(intervalId);
                    }
                });
        }, 3000);
    </script>



    <div class="mb-4 shadow card">
        <div class="py-3 card-header d-flex justify-content-between">
            <div class="mt-1">
                <h6 class="m-0 font-weight-bold text-secondary">Dashboard </h6>
            </div>
            <div class="btn-group" role="group" aria-label="Export Import Excel">
                <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modalTambah"
                    style="background-color: #121212; color: white">
                    <i class="bi bi-plus"></i> Tambah
                </button>
                <form id="importForm" action="{{ route('admin.projects.import') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" required id="fileInput" style="display: none;">
                    <button type="submit" style="display: none;"></button> <!-- Hidden submit button -->
                </form>

                <button type="button" class="btn btn-sm" id="importExcelButton"
                    style="background-color: #007bff; color: white">
                    <i class="bi bi-file-earmark-arrow-up"></i> Import Excel
                </button>

                <script>
                    document.getElementById('importExcelButton').addEventListener('click', function() {
                        document.getElementById('fileInput').click(); // Trigger file input click
                    });

                    document.getElementById('fileInput').addEventListener('change', function() {
                        if (this.files.length > 0) {
                            document.getElementById('importForm').submit(); // Submit the form when a file is selected
                        }
                    });
                </script>

                <a href="{{ route('admin.projects.export') }}" type="button" class="btn btn-sm" id="exportExcelButton"
                    style="background-color: #28a745; color: white">
                    <i class="bi bi-file-earmark-arrow-down"></i> Export Excel
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Project</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Audit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projects as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->description }}</td>
                                <td>{{ $item->start_date->format('d-m-Y') }}</td>
                                <td>{{ $item->end_date->format('d-m-Y') }}</td>
                                <td><button type="button" class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#auditModal{{ $item->id }}">
                                        Lihat Audit
                                    </button></td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Actions">
                                        <!-- Lihat Project Modal Trigger -->
                                        <button class="btn btn-info btn-sm" data-toggle="modal"
                                            data-target="#modalLihatProject{{ $item->id }}">
                                            Lihat
                                        </button>

                                        <!-- Edit Project Modal Trigger -->
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#modalEditProject{{ $item->id }}">
                                            Edit
                                        </button>

                                        <!-- Delete Project -->
                                        <form action="{{ route('admin.projects.destroy', $item->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
