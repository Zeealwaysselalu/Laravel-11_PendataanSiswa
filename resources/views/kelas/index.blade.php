@extends('layouts.app')
@section('content')
    <h2>Daftar Kelas</h2>
    <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3">Tambah Kelas
        Baru</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Kelas</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($semuaKelas as $kelas)
                <tr>
                    <td>{{ $kelas->id }}</td>
                    <td>{{ $kelas->nama_kelas }}</td>
                    <td>{{ $kelas->wali_kelas }}</td>
                    <td>
                        <a href="{{ route('kelas.edit', $kelas->id) }}" class="btnbtn-warning btn-sm">Edit</a>
                        <form action="{{ route('kelas.destroy', $kelas->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin hapus?')">Hapus</button>

                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
