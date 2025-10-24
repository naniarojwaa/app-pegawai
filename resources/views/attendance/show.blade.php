@extends('master')
@section('title', 'Detail Absensi')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-eye me-2"></i>Detail Absensi
            </h1>
            <a href="{{ route('attendance.index') }}" class="btn btn-outline">
                <i class="fas fa-arrow-left me-1"></i>Kembali
            </a>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="detail-card">
                    <div class="detail-header">
                        <h4>Informasi Absensi</h4>
                    </div>
                    <div class="detail-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Nama Pegawai</label>
                                    <p>{{ $attendance->employee->nama_lengkap ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Tanggal</label>
                                    <p>{{ \Carbon\Carbon::parse($attendance->tanggal)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Status</label>
                                    <span class="badge {{ [
                                        'hadir' => 'badge-success',
                                        'izin' => 'badge-info', 
                                        'sakit' => 'badge-warning',
                                        'cuti' => 'badge-primary'
                                    ][$attendance->status] ?? 'badge-secondary' }}">
                                        {{ ucfirst($attendance->status) }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Jam Masuk</label>
                                    <p>
                                        <span class="badge bg-success bg-opacity-10 text-success">
                                            <i class="fas fa-sign-in-alt me-1"></i>{{ $attendance->jam_masuk }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="detail-item">
                                    <label>Jam Keluar</label>
                                    <p>
                                        @if($attendance->jam_keluar)
                                            <span class="badge bg-danger bg-opacity-10 text-danger">
                                                <i class="fas fa-sign-out-alt me-1"></i>{{ $attendance->jam_keluar }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning">
                                                <i class="fas fa-clock me-1"></i>Belum Keluar
                                            </span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        @if($attendance->status != 'hadir')
                        <div class="row">
                            <div class="col-12">
                                <div class="detail-item">
                                    <label>Keterangan</label>
                                    <p class="text-muted">
                                        @if($attendance->status == 'izin')
                                            <i class="fas fa-envelope me-1"></i>Pegawai mengajukan izin
                                        @elseif($attendance->status == 'sakit')
                                            <i class="fas fa-heart-pulse me-1"></i>Pegawai sedang sakit
                                        @elseif($attendance->status == 'cuti')
                                            <i class="fas fa-umbrella-beach me-1"></i>Pegawai sedang cuti
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection