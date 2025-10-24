@extends('master')
@section('title', 'Data Departemen')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-building me-2"></i>Data Departemen
            </h1>
            <a href="{{ route('departments.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tambah Departemen
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Departemen</th>
                        <th width="20%">Jumlah Pegawai</th>
                        <th width="20%">Dibuat Pada</th>
                        <th width="15%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $department)
                    <tr>
                        <td>{{ $loop->iteration + ($departments->currentPage() - 1) * $departments->perPage() }}</td>
                        <td>
                            <strong>{{ $department->nama_departemen }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-primary">
                                {{ $department->employees_count ?? 0 }} Pegawai
                            </span>
                        </td>
                        <td>
                            <small class="text-muted">
                                {{ $department->created_at ? $department->created_at->format('d/m/Y H:i') : '-' }}
                            </small>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <form action="{{ route('departments.destroy', $department->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Hapus departemen?')">
                                        <i class="fas fa-trash me-1"></i>Hapus
                                    </button>
                                    <a href="#" 
                                        class="btn btn-sm btn-primary"
                                        onclick="alert('Detail coming soon!')">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </form>
                                
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($departments->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-4">
            <div class="text-muted">
                Menampilkan {{ $departments->firstItem() ?? 0 }} - {{ $departments->lastItem() ?? 0 }} dari {{ $departments->total() }} departemen
            </div>
            {{ $departments->links() }}
        </div>
        @endif

        @if($departments->isEmpty())
        <div class="text-center py-5">
            <div class="empty-state">
                <i class="fas fa-building fa-4x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada data departemen</h5>
                <p class="text-muted mb-4">Silakan tambah departemen untuk mengelola data pegawai</p>
                <a href="{{ route('departments.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Departemen Pertama
                </a>
            </div>
        </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });
});
</script>
@endsection