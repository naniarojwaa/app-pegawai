@extends('master')
@section('title', 'Data Absensi')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-clipboard-list me-2"></i>Data Absensi Pegawai
            </h1>
            <a href="{{ route('attendance.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>Tambah Absensi
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
                        <th>No</th>
                        <th>Pegawai</th>
                        <th>Tanggal</th>
                        <th>Jam Masuk</th>
                        <th>Jam Keluar</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($attendances as $attendance)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $attendance->employee->nama_lengkap ?? 'N/A' }}</strong>
                        </td>
                        <td>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</td>
                        <td>
                            <span class="badge bg-light text-dark">
                                <i class="fas fa-clock me-1"></i>{{ $attendance->jam_masuk }}
                            </span>
                        </td>
                        <td>
                            @if($attendance->jam_keluar)
                                <span class="badge bg-light text-dark">
                                    <i class="fas fa-clock me-1"></i>{{ $attendance->jam_keluar }}
                                </span>
                            @else
                                <span class="badge badge-warning">Belum Keluar</span>
                            @endif
                        </td>
                        <td>
                            @php
                                $statusClass = [
                                    'hadir' => 'badge-success',
                                    'izin' => 'badge-info', 
                                    'sakit' => 'badge-warning',
                                    'cuti' => 'badge-primary'
                                ][$attendance->status] ?? 'badge-secondary';
                            @endphp
                            <span class="badge {{ $statusClass }}">
                                {{ ucfirst($attendance->status) }}
                            </span>
                        </td>
                        <td>
                            <!-- ========== BAGIAN YANG DIUBAH ========== -->
                            <div class="action-buttons">
                                <a href="{{ route('attendance.edit', $attendance->id) }}" 
                                   class="btn btn-edit" 
                                   title="Edit Absensi"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-edit"></i>
                                    <span class="btn-text">Edit</span>
                                </a>
                                
                                <form action="{{ route('attendance.destroy', $attendance->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-delete" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data absensi ini?')"
                                            title="Hapus Absensi"
                                            data-bs-toggle="tooltip">
                                        <i class="fas fa-trash"></i>
                                        <span class="btn-text">Hapus</span>
                                    </button>
                                </form>
                                
                                <!-- TOMBOL DETAIL YANG BISA DIPENCET -->
                                <a href="{{ route('attendance.show', $attendance->id) }}" 
                                   class="btn btn-view" 
                                   title="Lihat Detail Absensi"
                                   data-bs-toggle="tooltip">
                                    <i class="fas fa-eye"></i>
                                    <span class="btn-text">Detail</span>
                                </a>
                            </div>
                            <!-- ========== AKHIR BAGIAN YANG DIUBAH ========== -->
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($attendances->isEmpty())
        <div class="text-center py-4">
            <i class="fas fa-clipboard-list fa-3x text-muted mb-3"></i>
            <p class="text-muted">Belum ada data absensi</p>
        </div>
        @endif
    </div>
</div>

<!-- ========== BAGIAN JAVASCRIPT BARU ========== -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // Jika route show belum ada, beri alert dulu
    document.querySelectorAll('.btn-view').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Cek apakah href-nya masih '#' (belum ada route)
            if (this.getAttribute('href') === '#') {
                e.preventDefault();
                alert('Fitur detail absensi akan segera tersedia!');
            }
        });
    });
});
</script>
<!-- ========== AKHIR BAGIAN JAVASCRIPT BARU ========== -->
@endsection