<x-app-layout>
    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold mb-6">Edit Anggota Keluarga</h2>

                <form action="{{ route('family.update', $family->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700">Nama</label>
                        <input type="text" name="name" value="{{ old('name', $family->name) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                        @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Jenis Kelamin</label>
                        <select name="gender"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                            <option value="male" {{ old('gender', $family->gender) == 'male' ? 'selected' : ''
                                }}>Laki-laki</option>
                            <option value="female" {{ old('gender', $family->gender) == 'female' ? 'selected' : ''
                                }}>Perempuan</option>
                        </select>
                        @error('gender')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="birth_date" value="{{ old('birth_date', $family->birth_date) }}"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                        @error('birth_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-700">Hubungan</label>
                        <select name="relationship_id"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                            @foreach($relationships as $relationship)
                            <option value="{{ $relationship->id }}" {{ old('relationship_id', $family->relationship_id
                                ?? '') == $relationship->id ? 'selected' : '' }}>
                                {{ $relationship->label }}
                            </option>
                            @endforeach
                        </select>
                        @error('relationship_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>


                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('dashboard') }}"
                            class="px-4 py-2 bg-gray-200 rounded-lg shadow hover:bg-gray-300 transition">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-gray-50 shadow rounded-lg p-6 mt-8">
                <h3 class="text-xl font-semibold mb-4">Daftar Anggota Keluarga</h3>
                <ul class="divide-y divide-gray-200">
                    @foreach($families as $f)
                    <li class="py-3 flex justify-between items-center">
                        <div>
                            <span class="font-medium">{{ $f->name }}</span>
                            <span class="text-sm text-gray-500">({{ $f->relationship->name ?? '-' }})</span>
                        </div>
                        <a href="{{ route('family.edit', $f->id) }}"
                            class="px-3 py-1 bg-blue-500 text-white rounded text-sm hover:bg-blue-600">
                            ✏️ Edit
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>