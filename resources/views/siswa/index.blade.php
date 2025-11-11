@extends('layouts.app')
@section('content')
    <h2>Daftar Siswa</h2>
    <a href="{{ route('siswa.create') }}" class="btn btn-primary mb-3">Tambah Siswa
        Baru</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIS</th>
                <th>Nama Lengkap</th>
                <th>L/P</th>
                <th>Kelas</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($semuaSiswa as $siswa)
                <tr>
                    <td>{{ $siswa->nis }}</td>
                    <td>{{ $siswa->nama_lengkap }}</td>
                    <td>{{ $siswa->jenis_kelamin }}</td>
                    <td>{{ $siswa->kelas->nama_kelas ?? 'Belum ada kelas' }}</td>

                    <td>{{ $siswa->kelas->wali_kelas ?? '-' }}</td>
                    <td>
                        <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn

btn-warning btn-sm">Edit</a>

                        <form action="{{ route('siswa.destroy', $siswa->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Yakin ingin hapus?')">Hapus</button>

                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data siswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
