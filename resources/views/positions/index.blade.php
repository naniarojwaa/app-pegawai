@extends('master')
@section('title', 'Daftar Jabatan')
@section('content')
<div class="container fade-in"> {{-- Container dan efek fade-in --}}
    <div class="content-card"> {{-- Card utama yang memiliki efek lift/hover --}}
        
        <div class="page-header">
            <h2 class="page-title">Daftar Jabatan (Positions)</h2>
            <a href="{{ url('/positions/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> + Tambah Jabatan Baru
            </a>
        </div>
        
        {{-- Tampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="table-container">
            <table class="table"> {{-- Menggunakan class table dari CSS Anda --}}
                <thead>
                    <tr>
                        {{-- LEBAR KOLOM DISESUAIKAN: Aksi dibuat lebih lebar (15%) --}}
                        <th style="width: 5%; text-align: center;">No</th>
                        <th style="width: 55%;">Nama Jabatan</th>
                        <th style="width: 25%; text-align: right;">Gaji Pokok</th>
                        <th style="width: 15%; text-align: center;">Aksi</th> {{-- Dibuat 15% untuk tombol berteks --}}
                        {{-- TOTAL: 5+55+25+15 = 100% --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($positions as $position)
                        <tr> {{-- Efek hover ada di class .table tbody tr:hover --}}
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td><strong>{{ $position->nama_jabatan }}</strong></td>
                            <td class="text-right">
                                Rp {{ number_format($position->gaji_pokok, 0, ',', '.') }}
                            </td>
                            {{-- Menggunakan teks penuh, pastikan kolom Aksi cukup lebar --}}
                            <td class="action-buttons" style="display: flex; justify-content: center; gap: 7px; height: 100%; align-items: center; white-space: nowrap;"> 
                                
                                {{-- Tombol Edit --}}
                                <a href="{{ url('positions/' . $position->id . '/edit') }}" class="btn btn-edit" title="Edit">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                
                                {{-- Tombol Hapus --}}
                                <form action="{{ url('positions/' . $position->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete" title="Hapus"
                                        onclick="return confirm('Yakin ingin menghapus {{ $position->nama_jabatan }}?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center p-3">Belum ada data jabatan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination (asumsi ada) --}}
        @if(isset($positions) && $positions->hasPages())
        <div class="d-flex justify-content-between align-items-center mt-3 p-3 bg-light" style="border-radius: 8px;">
            <div style="color: #666;">
                Menampilkan {{ $positions->firstItem() }} - {{ $positions->lastItem() }} dari {{ $positions->total() }} data
            </div>
            <div>
                {{ $positions->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection
