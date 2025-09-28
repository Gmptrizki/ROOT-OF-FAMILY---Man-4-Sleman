<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Family Tree Wizard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-3xl w-full bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-indigo-600 text-white p-6">
            <h1 class="text-2xl font-bold text-center">Family Tree - Man 4 Sleman</h1>
        </div>

        <div class="p-6">
            <form id="wizard-form" method="POST" action="{{ route('families.store.father') }}">
                @csrf
                <div class="step" data-step="1">
                    <div class="flex items-center mb-4">
                        <div class="bg-indigo-100 p-3 rounded-full mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-xl font-semibold text-gray-800">Data Ayah</h2>
                            <p class="text-gray-600">Mulailah dengan mengisi data ayah Anda</p>
                        </div>
                    </div>

                    <div class="space-y-4 mt-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Nama Lengkap Ayah</label>
                                <input type="text" name="name"
                                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                                    placeholder="Nama lengkap ayah" required>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="birth_date"
                                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-700">Status</label>
                                <select name="status"
                                    class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500">
                                    <option value="">Pilih status</option>
                                    <option value="hidup">Masih Hidup</option>
                                    <option value="meninggal">Meninggal</option>
                                    <option value="tidak_diketahui">Tidak Diketahui</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-700">Catatan (Opsional)</label>
                            <textarea name="notes"
                                class="w-full border border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-indigo-200 focus:border-indigo-500"
                                rows="2" placeholder="Tambahkan catatan tentang ayah"></textarea>
                        </div>
                    </div>

                    <input type="hidden" name="relationship_id" value="1">

                    <div class="mt-6 text-right">
                        <button type="submit"
                            class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                            Simpan Data Ayah
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>