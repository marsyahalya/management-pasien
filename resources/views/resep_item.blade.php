@extends('layouts.app')

@section('title', 'Item Resep Obat')

@section('content')
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="font-semibold mb-3">Tambah Item Resep</h3>
        <form action="/resep-item" method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-3">
            @csrf
            <select name="resep_obat_id" class="border rounded px-3 py-2" required>
                <option value="">-- Pilih Resep --</option>
                @foreach ($resep as $rp)
                    <option value="{{ $rp->id }}">Resep #{{ $rp->id }} ({{ $rp->tanggal_resep }})</option>
                @endforeach
            </select>
            <select name="obat_id" class="border rounded px-3 py-2" required>
                <option value="">-- Pilih Obat --</option>
                @foreach ($obat as $o)
                    <option value="{{ $o->id }}">{{ $o->nama_obat }} ({{ $o->dosis }})</option>
                @endforeach
            </select>
            <input type="number" name="jumlah" placeholder="Jumlah" min="1" class="border rounded px-3 py-2" required>
            <button class="md:col-span-3 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded">Tambah</button>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="font-semibold mb-3">Daftar Item Resep</h3>
        <table class="w-full text-sm border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2 border">ID</th>
                    <th class="p-2 border">Resep</th>
                    <th class="p-2 border">Obat</th>
                    <th class="p-2 border">Jumlah</th>
                    <th class="p-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($items as $it)
                    <tr>
                        <td class="p-2 border text-center">{{ $it->id }}</td>
                        <td class="p-2 border">Resep #{{ $it->resep_obat_id }}</td>
                        <td class="p-2 border">{{ $it->obat->nama_obat ?? '-' }}</td>
                        <td class="p-2 border text-center">{{ $it->jumlah }}</td>
                        <td class="p-2 border text-center">
                            <form action="/resep-item/{{ $it->id }}" method="POST" onsubmit="return confirm('Hapus?')">
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
