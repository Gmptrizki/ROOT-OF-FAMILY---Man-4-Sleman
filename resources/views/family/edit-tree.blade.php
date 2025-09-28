<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-5xl mx-auto">
            <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Seluruh Anggota Keluarga</h1>

            <form action="{{ route('family.update.tree') }}" method="POST">
                @csrf
                <div class="overflow-x-auto bg-white rounded-xl shadow-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Nama</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Hubungan</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Tanggal Lahir</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Status</th>
                                <th class="px-4 py-3 text-left text-sm font-medium text-gray-700">Catatan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($familyMembers as $i => $member)
                                <tr>
                                    <input type="hidden" name="families[{{ $i }}][id]" value="{{ $member->id }}">
                                    
                                    <td class="px-4 py-3">
                                        <input type="text" name="families[{{ $i }}][name]"
                                            value="{{ old("families.$i.name", $member->name) }}"
                                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </td>

                                    <td class="px-4 py-3">
                                        <select name="families[{{ $i }}][relationship_id]"
                                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                            @foreach($relationships as $r)
                                                <option value="{{ $r->id }}"
                                                    {{ old("families.$i.relationship_id", $member->relationship_id) == $r->id ? 'selected' : '' }}>
                                                    {{ $r->label }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td class="px-4 py-3">
                                        <input type="date" name="families[{{ $i }}][birth_date]"
                                            value="{{ old("families.$i.birth_date", $member->birth_date) }}"
                                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </td>

                                    <td class="px-4 py-3">
                                        <input type="text" name="families[{{ $i }}][status]"
                                            value="{{ old("families.$i.status", $member->status) }}"
                                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </td>

                                    <td class="px-4 py-3">
                                        <textarea name="families[{{ $i }}][notes]" rows="2"
                                            class="w-full border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ old("families.$i.notes", $member->note) }}</textarea>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end mt-6">
                    <a href="{{ route('dashboard') }}" 
                       class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Kembali
                    </a>
                    <button type="submit" 
                            class="ml-4 px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
