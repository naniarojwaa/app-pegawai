@extends('master')
@section('title', 'Tambah Jabatan Baru')

@section('content')
<div class="container fade-in">
    <div class="content-card wide-card"> {{-- Menggunakan wide-card agar form lebih lega --}}
        
        <div class="page-header mb-4">
            <h2 class="page-title">Tambah Jabatan Baru</h2>
        </div>

        <form action="{{ url('/positions') }}" method="POST" class="styled-form">
            @csrf
            
            <div class="form-group">
                <label for="nama_jabatan">Nama Jabatan</label>
                <input 
                    type="text" 
                    id="nama_jabatan" 
                    name="nama_jabatan" 
                    class="form-control @error('nama_jabatan') is-invalid @enderror" 
                    value="{{ old('nama_jabatan') }}"
                    placeholder="Contoh: Senior Developer"
                    required>
                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="gaji_pokok_display">Gaji Pokok (Rp)</label>
                <input 
                    type="text" 
                    id="gaji_pokok_display" 
                    class="form-control"
                    placeholder="Contoh: 5.000.000"
                    inputmode="numeric" {{-- Memudahkan input angka pada mobile --}}
                    value="{{ old('gaji_pokok') ? number_format(old('gaji_pokok'), 0, ',', '.') : '' }}"
                    required>
                
                {{-- Hidden input untuk menyimpan nilai angka murni ke database --}}
                <input type="hidden" name="gaji_pokok" id="gaji_pokok_hidden" value="{{ old('gaji_pokok') }}">

                @error('gaji_pokok')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions mt-5">
                <a href="{{ url('/positions') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Simpan Jabatan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const gajiPokokDisplay = document.getElementById('gaji_pokok_display');
    const gajiPokokHidden = document.getElementById('gaji_pokok_hidden');

    // Fungsi untuk memformat angka menjadi format Rupiah
    function formatRupiah(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString();
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return rupiah;
    }

    // Fungsi untuk menghilangkan format (mengambil angka murni)
    function removeFormat(rupiah) {
        return rupiah.replace(/[^0-9]/g, '');
    }

    // Event listener saat user mengetik
    gajiPokokDisplay.addEventListener('keyup', function(e) {
        // Ambil angka murni dari input display
        let rawValue = removeFormat(this.value);
        
        // Simpan nilai angka murni ke hidden input (untuk dikirim ke backend)
        gajiPokokHidden.value = rawValue;

        // Tampilkan nilai terformat di input display
        this.value = formatRupiah(this.value);
    });

    // Jalankan format saat halaman dimuat (untuk old value jika ada error)
    if (gajiPokokDisplay.value) {
        gajiPokokDisplay.value = formatRupiah(gajiPokokDisplay.value);
    }
});
</script>
@endsection
