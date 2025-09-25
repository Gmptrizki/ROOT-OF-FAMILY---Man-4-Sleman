{{-- resources/views/components/form-modal.blade.php --}}
<div id="popupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-semibold mb-4">Tambah Anggota Keluarga (Dummy)</h2>
        <form>
            <div class="mb-3">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="name" class="w-full border px-3 py-2 rounded" placeholder="Nama anggota">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Jenis Kelamin</label>
                <select name="gender" class="w-full border px-3 py-2 rounded">
                    <option value="">-- Pilih Gender --</option>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Tanggal Lahir</label>
                <input type="date" name="birth_date" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Foto</label>
                <input type="file" name="photo" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Hubungan</label>
                <select name="relationship_id" class="w-full border px-3 py-2 rounded">
                    <option value="">-- Pilih Hubungan --</option>
                    <option value="1">Ayah</option>
                    <option value="2">Ibu</option>
                    <option value="3">Anak</option>
                    <option value="4">Saudara</option>
                    <option value="5">Pasangan</option>
                </select>
            </div>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeFormModal()"
                    class="px-4 py-2 bg-gray-300 rounded">Batal</button>
                <button type="button" onclick="alert('Data dummy tersimpan!')"
                    class="px-4 py-2 bg-blue-600 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>