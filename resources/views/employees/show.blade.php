@extends('master')
@section('title', 'Detail Pegawai')
@section('content')
<div class="fade-in">
    <div class="content-card">
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-info-circle me-2"></i>Detail Pegawai
            </h1>
            {{-- Asumsi routing kembali ke index pegawai atau ke halaman edit --}}
            <div>
                <a href="{{ url('/employees/' . $employee->id . '/edit') }}" class="btn btn-primary me-2" style="background-color: #ffc107; border: none;"> 
                    <i class="fas fa-pen me-1"></i>Edit
                </a>
                <a href="{{ url('/employees') }}" class="btn btn-outline"> 
                    <i class="fas fa-arrow-left me-1"></i>Kembali
                </a>
            </div>
        </div>

        {{-- Menggunakan TABLE untuk detail data --}}
        <table class="detail-table">
            <tr>
                <th>Nama Lengkap</th>
                <td>{{ $employee->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $employee->email }}</td>
            </tr>
            <tr>
                <th>Nomor Telepon</th>
                <td>{{ $employee->nomor_telepon }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $employee->tanggal_lahir }}</td>
            </tr>
            <tr>
                <th>Tanggal Masuk</th>
                <td>{{ $employee->tanggal_masuk }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $employee->status }}</td>
            </tr>
            <tr>
                <th>Departemen</th>
                <td>{{ $employee->departemen->nama_departemen ?? '-' }}</td>
            </tr>
            <tr>
                <th>Jabatan</th>
                <td>{{ $employee->jabatan->nama_jabatan ?? '-' }}</td>
            </tr>
            <tr>
                <th>Alamat</th>
                <td>{{ $employee->alamat }}</td>
            </tr>
        </table>
        
    </div>
</div>
@endsection
