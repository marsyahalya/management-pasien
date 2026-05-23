@extends('layouts.app')

@section('title', 'Data Dokter')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="font-semibold mb-3">Tambah Dokter</h3>
        <form action="/dokter" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @csrf
            <input type="text" name="nama" placeholder="Nama" class="border rounded px-3 py-2" required>
            <input type="text" name="spesialis" placeholder="Spesialis" class="border rounded px-3 py-2" required>
            <input type="text" name="nomor_telepon" placeholder="No. Telepon" class="border rounded px-3 py-2" required>
            <button class="md:col-span-3 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Tambah</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-3">Daftar Dokter</h3>
        <table class="w-full text-sm border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nama</th>
                    <th class="p-2 border">Spesialis</th>
                    <th class="p-2 border">Telepon</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($dokter as $d)
                    <tr>
                        <td class="p-2 border text-center">{{ $d->id }}</td>
                        <td class="p-2 border">{{ $d->nama }}</td>
                        <td class="p-2 border">{{ $d->spesialis }}</td>
                        <td class="p-2 border">{{ $d->nomor_telepon }}</td>
                        <td class="p-2 border text-center">
                            <form action="/dokter/{{ $d->id }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center p-3">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
