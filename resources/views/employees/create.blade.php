<!DOCTYPE html>
<html>
<head>
    <title>Form Input Pegawai</title>
</head>
<body>
    <h1 class="mb-4">Form Pegawai</h1>
    
    @if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('employees.store') }}" method="POST">
    @csrf
        <table>
            <tr>
                <td><label for="nama_lengkap">Nama Lengkap:</label></td>
                <td><input type="text" id="nama_lengkap" name="nama_lengkap" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td><label for="nomor_telepon">Nomor Telepon:</label></td>
                <td><input type="text" id="nomor_telepon" name="nomor_telepon" required></td>
            </tr>
            <tr>
                <td><label for="tanggal_lahir">Tanggal Lahir:</label></td>
                <td><input type="date" id="tanggal_lahir" name="tanggal_lahir" required></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat:</label></td>
                <td><textarea id="alamat" name="alamat" required></textarea></td>
            </tr>
            <tr>
                <td><label for="tanggal_masuk">Tanggal Masuk:</label></td>
                <td><input type="date" id="tanggal_masuk" name="tanggal_masuk" required></td>
            </tr>
            <tr>
                <td><label for="status">Status:</label></td>
                <td>
                    <select id="status" name="status" required>
                        <option value="">-- Pilih Status --</option>
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="departemen_id">Department:</label></td>
                <td>
                    <select id="departemen_id" name="departemen_id" required>
                        <option value="">-- Pilih Departemen --</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->nama_departemen }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="jabatan_id">Position:</label></td>
                <td>
                    <select id="jabatan_id" name="jabatan_id" required>
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}">{{ $position->nama_jabatan }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:right;">
                    <button type="submit">Simpan</button>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>