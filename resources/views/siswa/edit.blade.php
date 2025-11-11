@extends('layouts.app')
@section('content')
    <h2>Tambah Siswa Baru</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('siswa.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nis" class="form-label">NIS</label>
            <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
        </div>
        <div class="mb-3">
            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                value="{{ old('nama_lengkap') }}">
        </div>
        <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select name="kelas_id" id="kelas_id" class="form-select">
                <option value="">Pilih Kelas</option>
                @foreach ($semuaKelas as $kelas)
                    <option value="{{ $kelas->id }}" {{ old('kelas_id') == $kelas->id ? 'selected' : '' }}>

                        {{ $kelas->nama_kelas }} (Wali: {{ $kelas->wali_kelas }})
                    </option>
                @endforeach
            </select>

        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="L" value="L"
                    {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}>

                <label class="form-check-label" for="L">Laki-laki</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="jenis_kelamin" id="P" value="P"
                    {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}>

                <label class="form-check-label" for="P">Perempuan</label>
            </div>
        </div>
        <div class="mb-3">
            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                value="{{ old('tanggal_lahir') }}">
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
