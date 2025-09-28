<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pohon Keluarga - Man 4 Sleman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Styling untuk pohon keluarga */
        .tree-container {
            position: relative;
            padding: 20px 0;
        }

        .tree ul {
            padding-top: 40px;
            position: relative;
            transition: all 0.5s;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tree li {
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 40px 10px 0 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .tree li::before,
        .tree li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 3px solid #94a3b8;
            width: 50%;
            height: 40px;
        }

        .tree li::after {
            right: auto;
            left: 50%;
            border-left: 3px solid #94a3b8;
        }

        .tree li:only-child::after,
        .tree li:only-child::before {
            display: none;
        }

        .tree li:only-child {
            padding-top: 0;
        }

        .tree li:first-child::before,
        .tree li:last-child::after {
            border: 0 none;
        }

        .tree li:last-child::before {
            border-right: 3px solid #94a3b8;
            border-radius: 0 5px 0 0;
        }

        .tree li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        .tree ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 3px solid #94a3b8;
            width: 0;
            height: 40px;
        }

        .person {
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            padding: 16px 24px;
            border-radius: 12px;
            text-decoration: none;
            color: #1e293b;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            font-weight: 500;
            min-width: 180px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
        }

        .person:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .person.male {
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
            border-color: #3b82f6;
        }

        .person.female {
            background: linear-gradient(135deg, #fce7f3 0%, #fdf2f8 100%);
            border-color: #ec4899;
        }

        .person.child {
            margin-top: 15px;
        }

        .name {
            font-weight: 600;
            color: #1e293b;
            font-size: 1.1rem;
            margin-bottom: 4px;
        }

        .relationship {
            font-size: 0.875rem;
            color: #64748b;
            font-weight: 500;
        }

        .connector {
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 3px;
            height: 40px;
            background-color: #94a3b8;
            z-index: 1;
        }

        .parents {
            display: flex;
            justify-content: center;
            gap: 60px;
            position: relative;
            margin-bottom: 40px;
        }

        .children {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        /* Responsif untuk perangkat kecil */
        @media (max-width: 768px) {
            .tree li {
                padding: 30px 5px 0 5px;
            }

            .person {
                min-width: 140px;
                padding: 12px 16px;
                font-size: 0.9rem;
            }

            .parents {
                flex-direction: column;
                gap: 20px !important;
            }

            .children {
                flex-direction: column;
                gap: 15px;
            }

            .tree li::before,
            .tree li::after {
                height: 30px;
            }
        }

        /* Styling untuk placeholder jika data belum diisi */
        .person.placeholder {
            background-color: #f1f5f9;
            border: 2px dashed #cbd5e1;
            color: #64748b;
        }

        .person.placeholder .name {
            color: #64748b;
            font-style: italic;
        }
    </style>
</head>

<body class="bg-gray-50">
    <x-app-layout>
        <div class="container mx-auto px-4 py-8">

            <div class="flex justify-between items-center mb-8">
                <div class="header text-left">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">Pohon Keluarga</h1>
                    <p class="text-gray-600 max-w-2xl">
                        Visualisasi hubungan keluarga dalam bentuk pohon silsilah yang menunjukkan hubungan antar
                        anggota keluarga.
                    </p>
                </div>

                <div class="flex gap-4">
                    <a href="{{route('family.create.brother')}}"
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow">
                        Tambah Anggota
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <div class="tree-container">
                    <div class="tree">
                        <ul>
                            <li>
                                <div class="family">
                                    <div class="parents">
                                        @if(!empty($grandFather?->name))
                                        <div class="person male hover-highlight">
                                            <div class="name">
                                                {{ collect(explode(' ', $grandFather->name))->take(2)->implode(' ') }}
                                            </div>
                                            <div class="relationship">
                                                {{ $grandFather->relationship->label }}
                                            </div>
                                        </div>
                                        @endif

                                        @if(!empty($grandMother?->name))
                                        <div class="person female hover-highlight">
                                            <div class="name">
                                                {{ collect(explode(' ', $grandMother->name))->take(2)->implode(' ') }}
                                            </div>
                                            <div class="relationship">
                                                {{ $grandMother->relationship->label }}
                                            </div>
                                        </div>
                                        @endif
                                    </div>

                                    <ul>
                                        <li>
                                            <div class="family">
                                                <div class="parents">
                                                    @if(!empty($father?->name))
                                                    <div class="person male hover-highlight">
                                                        <div class="name">
                                                            {{ collect(explode(' ', $father->name))->take(2)->implode('
                                                            ') }}
                                                        </div>
                                                        <div class="relationship">
                                                            {{ $father->relationship->label }}
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(!empty($mother?->name))
                                                    <div class="person female hover-highlight">
                                                        <div class="name">
                                                            {{ collect(explode(' ', $mother->name))->take(2)->implode('
                                                            ') }}
                                                        </div>
                                                        <div class="relationship">
                                                            {{ $mother->relationship->label }}
                                                        </div>
                                                    </div>
                                                    @endif

                                                    <div class="connector"></div>
                                                </div>

                                                <div class="children flex gap-4 mt-4">
                                                    <!-- Anda -->
                                                    <div class="person child male hover-highlight">
                                                        <div class="name">
                                                            {{ collect(explode(' ',
                                                            $rootFamily->name))->take(2)->implode(' ') }}
                                                        </div>
                                                        <div class="relationship">Anda</div>
                                                    </div>

                                                    @if(!empty($brother?->name))
                                                    <div class="person child male hover-highlight">
                                                        <div class="name">
                                                            {{ collect(explode(' ', $brother->name))->take(2)->implode('
                                                            ') }}
                                                        </div>
                                                        <div class="relationship">
                                                            {{ $brother->relationship->label }}
                                                        </div>
                                                    </div>
                                                    @endif

                                                    @if(!empty($sister?->name))
                                                    <div class="person child female hover-highlight">
                                                        <div class="name">
                                                            {{ collect(explode(' ', $sister->name))->take(2)->implode('
                                                            ') }}
                                                        </div>
                                                        <div class="relationship">
                                                            {{ $sister->relationship->label }}
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-gray-800">Daftar Anggota Keluarga</h2>
                    <a href="{{ route('family.edit.tree') }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
                        Edit Pohon
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if($grandFather)
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $grandFather->name }}</div>
                            <div class="text-sm text-gray-600">{{ $grandFather->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    @if($grandMother)
                    <div class="flex items-center p-4 bg-pink-50 rounded-lg border border-pink-200">
                        <div class="w-3 h-3 bg-pink-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $grandMother->name }}</div>
                            <div class="text-sm text-gray-600">{{ $grandMother->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    @if($father)
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $father->name }}</div>
                            <div class="text-sm text-gray-600">{{ $father->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    @if($mother)
                    <div class="flex items-center p-4 bg-pink-50 rounded-lg border border-pink-200">
                        <div class="w-3 h-3 bg-pink-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $mother->name }}</div>
                            <div class="text-sm text-gray-600">{{ $mother->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    <div class="flex items-center p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                        <div class="w-3 h-3 bg-indigo-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $rootFamily->name }}</div>
                            <div class="text-sm text-gray-600">Anda</div>
                        </div>
                    </div>
                    @if($brother)
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $brother->name }}</div>
                            <div class="text-sm text-gray-600">{{ $brother->relationship->label }}</div>
                        </div>
                    </div>
                    @endif
                    @if(!empty($sister?->name))
                    <div class="flex items-center p-4 bg-pink-50 rounded-lg border border-pink-200">
                        <div class="w-3 h-3 bg-pink-500 rounded-full mr-3"></div>
                        <div>
                            <div class="font-medium text-gray-800">{{ $sister->name }}</div>
                            <div class="text-sm text-gray-600">{{ $sister->relationship->label }}</div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </x-app-layout>
</body>

</html>