<div id="optionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-40">
    <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
        <h2 class="text-lg font-semibold mb-4">Pilih Opsi</h2>
        <div class="flex flex-col space-y-3">
            <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Lihat Profile
            </a>
            <button onclick="openFormModal()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Tambah Data Anggota
            </button>
        </div>
        <button onclick="closeOptionModal()" class="mt-4 px-3 py-1 bg-gray-300 rounded">Batal</button>
    </div>
</div>