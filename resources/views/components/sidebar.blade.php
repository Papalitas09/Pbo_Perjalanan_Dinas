<div class="h-auto min-h-screen w-80 bg-emerald-400 flex flex-col justify-between">
    <!-- Bagian atas -->
    <div>
        <!-- Profile Admin -->
        <div class="flex items-center bg-emerald-900 p-3">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-500 font-bold">
            {{ strtoupper(substr(Auth::guard('pegawai')->user()->nama, 0, 1)) }}
        </div>
        <span class="ml-2 text-white font-medium">
            {{ Auth::guard('pegawai')->user()->nama }}
        </span>
    </div>

        <!-- Logo -->
        <div class="flex justify-center py-6">
            <img src="{{ asset('images/T7hz-r.png') }}" alt="Logo" class="w-32 h-32">
        </div>

        <!-- Menu -->
        <nav class="flex flex-col space-y-3 px-4">
            <a href="{{ route('admin.dashboard') }}" class="block text-center py-2 rounded-md bg-white hover:bg-gray-300 transition">
                Dashboard
            </a>
            <a href="{{ route('admin.pegawai.index') }}" class="block text-center py-2 rounded-md bg-white hover:bg-gray-200 transition">
                Pegawai
            </a>
            <a href="{{ route('admin.catatan.index') }}" class="block text-center py-2 rounded-md bg-white hover:bg-gray-200 transition">
                Data Perjalanan
            </a>
        </nav>
    </div>

    <!-- Bagian bawah (Logout) -->
    <div class="p-4">
        <form action="{{ route("logout.process") }}" method="POST">
            @csrf
            <button class="w-full bg-red-700 hover:bg-red-800 text-white py-2 rounded-md transition">
                Logout
            </button>
        </form>
    </div>
</div>
