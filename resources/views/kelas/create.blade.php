@extends('layouts.app')
@section('content')
    <h2>Tambah Kelas Baru</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kelas" class="form-label">Nama Kelas</label>
            <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas') }}">
        </div>
        <div class="mb-3">
            <label for="wali_kelas" class="form-label">Wali Kelas</label>
            <input type="text" class="form-control" id="wali_kelas" name="wali_kelas" value="{{ old('wali_kelas') }}">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Batal</a>
    </form>
@endsection
