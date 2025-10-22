<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    @extends('master')
    @section('title', 'Daftar employee')
    @section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Daftar employee</h1>

        <div class="table-container">
            <table>
                    <thead>
                        <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Nomor Telepon</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->nama_lengkap }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->nomor_telepon }}</td>
                            <td>{{ $employee->tanggal_lahir }}</td>
                            <td>{{ $employee->alamat }}</td>
                            <td>{{ $employee->tanggal_masuk }}</td>
                            <td>{{ $employee->status }}</td>
                            <td>{{ $employee->departemen->nama_departemen ?? '-' }}</td>
                            <td>{{ $employee->jabatan->nama_jabatan ?? '-' }}</td>
                            <td>
                                <div class="button-container">
                                    <form action="{{ route('employees.show', $employee->id) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="btn">Detail</button>
                                    </form>

                                    <form action="{{ route('employees.edit', $employee->id) }}" method="GET" style="display:inline;">
                                        <button type="submit" class="btn">Edit</button>
                                    </form>

                                    <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn">Hapus</button>
                                    </form>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
</body>
</html>