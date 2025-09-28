<x-app-layout>
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h2 class="text-xl font-bold mb-4">Step 2: Tambah Saudara Perempuan</h2>

        <form action="{{ route('families.store.sister') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-gray-700">Nama</label>
                <input type="text" name="name" class="w-full border-gray-300 rounded-lg" required>
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Tanggal Lahir</label>
                <input type="date" name="birth_date" class="w-full border-gray-300 rounded-lg">
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Status</label>
                <input type="text" name="status" class="w-full border-gray-300 rounded-lg">
            </div>
            <div class="mb-3">
                <label class="block text-gray-700">Catatan</label>
                <textarea name="notes" class="w-full border-gray-300 rounded-lg"></textarea>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Selesai & Simpan</button>
        </form>
    </div>

    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif
</x-app-layout>
