<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistem Manajemen Pasien')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        <aside class="w-64 bg-blue-700 text-white flex flex-col">
            <div class="px-6 py-5 border-b border-blue-600">
                <h1 class="text-lg font-bold leading-tight">Management Pasien</h1>
                <p class="text-xs text-blue-200">Sistem Riwayat Kesehatan</p>
            </div>

            <nav class="flex-1 px-3 py-4 space-y-1 text-sm">
                @php
                    $menu = [
                        ['route' => 'dashboard',   'label' => 'Dashboard'],
                        ['route' => 'pasien',      'label' => 'Pasien'],
                        ['route' => 'dokter',      'label' => 'Dokter'],
                        ['route' => 'obat',        'label' => 'Obat'],
                        ['route' => 'riwayat',     'label' => 'Riwayat Kesehatan'],
                        ['route' => 'resep',       'label' => 'Resep Obat'],
                        ['route' => 'resep_item',  'label' => 'Item Resep Obat'],
                    ];
                @endphp

                @foreach ($menu as $m)
                    <a href="{{ route($m['route']) }}"
                       class="block px-3 py-2 rounded {{ request()->routeIs($m['route']) ? 'bg-blue-900 font-semibold' : 'hover:bg-blue-600' }}">
                        {{ $m['label'] }}
                    </a>
                @endforeach
            </nav>

            <div class="px-6 py-3 text-xs text-blue-200 border-t border-blue-600">
                &copy; {{ date('Y') }} Tugas Kuliah
            </div>
        </aside>

        {{-- Konten utama --}}
        <main class="flex-1 p-8">
            <h2 class="text-2xl font-semibold mb-6">@yield('title')</h2>

            @if (session('ok'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">{{ session('ok') }}</div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

</body>
</html>
