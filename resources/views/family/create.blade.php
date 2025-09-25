<x-app-layout>
    <div class="max-w-md mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Anggota Keluarga</h2>

        @if(session('success'))
            <div class="bg-green-200 p-3 rounded mb-4 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('family.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-4">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" class="w-full border rounded px-3 py-2" required>
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label class="block text-gray-700">Jenis Kelamin</label>
                <select name="gender" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Gender</option>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>

            <!-- Tanggal Lahir -->
            <div class="mb-4">
                <label class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="birth_date" class="w-full border rounded px-3 py-2">
            </div>

            <!-- Relationship -->
            <div class="mb-4">
                <label class="block text-gray-700">Hubungan</label>
                <select name="relationship_id" class="w-full border rounded px-3 py-2" required>
                    <option value="">Pilih Hubungan</option>
                    @foreach($relationships as $relation)
                        <option value="{{ $relation->id }}">{{ $relation->label }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
