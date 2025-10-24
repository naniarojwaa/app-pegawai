@extends('master')
@section('title', 'Daftar Pegawai')
@section('content')
<div class="container fade-in"> {{-- Container dan efek fade-in --}}
    <div class="content-card"> {{-- Card utama yang memiliki efek lift/hover --}}
        
        <div class="page-header">
            <h2 class="page-title">Daftar Pegawai</h2>
            <a href="{{ route('employees.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> + Tambah Pegawai
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success"> {{-- Menggunakan class alert yang stylish --}}
                {{ session('success') }}
            </div>
        @endif

        <div class="table-container">
            <table class="table"> {{-- Menggunakan class table untuk header dan hover row --}}
                <thead>
                    <tr>
                        {{-- LEBAR KOLOM SESUAI YANG ANDA INGINKAN --}}
                        <th style="width: 5%; text-align: center;">No</th>
                        <th style="width: 20%;">Nama Lengkap</th>
                        <th style="width: 15%;">Email</th>
                        <th style="width: 10%;">Telepon</th>
                        <th style="width: 15%;">Departemen</th>
                        <th style="width: 10%;">Jabatan</th>
                        <th style="width: 10%; text-align: center;">Status</th>
                        <th style="width: 15%; text-align: center;">Aksi</th>
                        {{-- TOTAL: 5+20+15+10+15+10+10+15 = 100% --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse($employees as $employee)
                        <tr> {{-- Baris ini memiliki efek hover/scale dari CSS .table tbody tr:hover --}}
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><strong>{{ $employee->nama_lengkap }}</strong></td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->nomor_telepon }}</td>
                            <td>
                                {{-- Menggunakan badge untuk Department --}}
                                <span class="badge" style="background: var(--info); color: var(--white); padding: 4px 8px; border-radius: 12px; font-size: 12px;">
                                    {{ $employee->departemen->nama_departemen ?? 'Tidak Ada' }}
                                </span>
                            </td>
                            <td>
                                {{-- Menggunakan badge untuk Jabatan --}}
                                <span class="badge" style="background: var(--secondary); color: var(--white); padding: 4px 8px; border-radius: 12px; font-size: 12px;">
                                    {{ $employee->jabatan->nama_jabatan ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{-- Menggunakan badge class yang sudah didefinisikan --}}
                                <span class="badge badge-{{ $employee->status }}">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </td>
                            <td class="action-buttons" style="display: flex; justify-content: center; gap: px;"> 
                                
                                {{-- Perubahan: Tambahkan Teks "Detail" --}}
                                <a href="{{ route('employees.show', $employee->id) }}" class="btn btn-view btn-sm" title="Detail">
                                    <i class="fas fa-eye"></i> Detail 
                                </a>
                                
                                {{-- Perubahan: Tambahkan Teks "Edit" --}}
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-edit btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                {{-- Perubahan: Tambahkan Teks "Hapus" --}}
                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete btn-sm" title="Hapus" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center p-3">Belum ada data pegawai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($employees->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3 p-3 bg-light" style="border-radius: 8px;">
            <div style="color: #666;">
                Menampilkan {{ $employees->firstItem() }} - {{ $employees->lastItem() }} dari {{ $employees->total() }} data
            </div>
            <div>
                {{ $employees->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
