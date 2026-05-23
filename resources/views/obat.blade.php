@extends('layouts.app')

@section('title', 'Data Obat')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="font-semibold mb-3">Tambah Obat</h3>
        <form action="/obat" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @csrf
            <input type="text" name="nama_obat" placeholder="Nama Obat" class="border rounded px-3 py-2" required>
            <input type="text" name="dosis" placeholder="Dosis (mis. 500mg)" class="border rounded px-3 py-2" required>
            <button class="md:col-span-2 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Tambah</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-3">Daftar Obat</h3>
        <table class="w-full text-sm border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Nama Obat</th>
                    <th class="p-2 border">Dosis</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($obat as $o)
                    <tr>
                        <td class="p-2 border text-center">{{ $o->id }}</td>
                        <td class="p-2 border">{{ $o->nama_obat }}</td>
                        <td class="p-2 border">{{ $o->dosis }}</td>
                        <td class="p-2 border text-center">
                            <form action="/obat/{{ $o->id }}" method="POST" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center p-3">Belum ada data</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
