<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pohon Keluarga - Man 4 Sleman</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
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
            padding: 20px;
            border-radius: 16px;
            text-decoration: none;
            color: #1e293b;
            background-color: #f8fafc;
            border: 2px solid #e2e8f0;
            font-weight: 500;
            min-width: 200px;
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

        .person-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            margin-bottom: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .person.male .person-photo {
            border-color: #3b82f6;
        }

        .person.female .person-photo {
            border-color: #ec4899;
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
            background-color: rgba(255, 255, 255, 0.7);
            padding: 2px 8px;
            border-radius: 12px;
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

        @media (max-width: 768px) {
            .tree li {
                padding: 30px 5px 0 5px;
            }

            .person {
                min-width: 160px;
                padding: 16px;
                font-size: 0.9rem;
            }

            .person-photo {
                width: 60px;
                height: 60px;
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

        .person.placeholder {
            background-color: #f1f5f9;
            border: 2px dashed #cbd5e1;
            color: #64748b;
        }

        .person.placeholder .name {
            color: #64748b;
            font-style: italic;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .person-photo {
            animation: fadeIn 0.5s ease-out;
        }

        .family-member-card {
            display: flex;
            align-items: center;
            padding: 16px;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .family-member-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .family-member-photo {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 16px;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .member-male {
            background: linear-gradient(135deg, #dbeafe 0%, #eff6ff 100%);
            border-color: #3b82f6;
        }

        .member-female {
            background: linear-gradient(135deg, #fce7f3 0%, #fdf2f8 100%);
            border-color: #ec4899;
        }

        .member-self {
            background: linear-gradient(135deg, #ede9fe 0%, #f5f3ff 100%);
            border-color: #8b5cf6;
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
                        class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow-md transition-all flex items-center gap-2">
                        <i class="fas fa-user-plus"></i>
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
                                        @if(!empty($grandfa?->name))
                                        <div class="person male hover-highlight">
                                            <img src="{{ $grandfa->photo ? asset('storage/' . $grandfa->photo) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' }}"
                                                alt="Foto {{ $grandfa->name }}" class="person-photo">
                                            <div class="name">
                                                {{ collect(explode(' ', $grandfa->name))->take(2)->implode('
                                                ') }}
                                            </div>
                                            <div class="relationship">
                                                {{ $grandfa->relationship->label }}
                                            </div>
                                        </div>
                                        @endif

                                        @if(!empty($grandmom?->name))
                                        <div class="person female hover-highlight">
                                            <img src="{{ $grandmom->photo ? asset('storage/' . $grandmom->photo) : 'https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                                                alt="Foto {{ $grandmom->name }}" class="person-photo">
                                            <div class="name">
                                                {{ collect(explode(' ', $grandmom->name))->take(2)->implode('
                                                ') }}
                                            </div>
                                            <div class="relationship">
                                                {{ $grandmom->relationship->label }}
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
                                                        <img src="{{ $father->photo ? asset('storage/' . $father->photo) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80' }}"
                                                            alt="Foto {{ $father->name }}" class="person-photo">
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
                                                        <img src="{{ $mother->photo ? asset('storage/' . $mother->photo) : 'https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                                                            alt="Foto {{ $mother->name }}" class="person-photo">
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
                                                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80"
                                                            alt="Foto {{ $rootFamily->name }}" class="person-photo">
                                                        <div class="name">
                                                            {{ collect(explode(' ',
                                                            $rootFamily->name))->take(2)->implode(' ') }}
                                                        </div>
                                                        <div class="relationship">Anda</div>
                                                    </div>

                                                    @if(!empty($brother?->name))
                                                    <div class="person male hover-highlight">
                                                        <img src="{{ $brother->photo ? asset('storage/' . $brother->photo) : asset('images/family/brother.jpg') }}"
                                                            alt="Foto {{ $brother->name }}" class="person-photo">
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
                                                    <div class="person female hover-highlight">
                                                        <img src="{{ $sister->photo ? asset('storage/' . $sister->photo) : asset('images/family/sister.jpg') }}"
                                                            alt="Foto {{ $sister->name }}" class="person-photo">

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
                        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition-all flex items-center gap-2">
                        <i class="fas fa-edit"></i>
                        Edit Pohon
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @if($grandfa)
                    <div class="family-member-card member-male">
                        <img src="{{ $grandfa->photo ? asset('storage/' . $grandfa->photo) : 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                            alt="Foto {{ $grandfa->name }}" class="family-member-photo">
                        <div>
                            <div class="font-medium text-gray-800">{{ $grandfa->name }}</div>
                            <div class="text-sm text-gray-600">{{ $grandfa->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    @if($grandmom)
                    <div class="family-member-card member-female">
                        <img src="{{ $grandmom->photo ? asset('storage/' . $grandmom->photo) : 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                            alt="Foto {{ $grandmom->name }}" class="family-member-photo">
                        <div>
                            <div class="font-medium text-gray-800">{{ $grandmom->name }}</div>
                            <div class="text-sm text-gray-600">{{ $grandmom->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    @if($father)
                    <div class="family-member-card member-male">
                        <img src="{{ $father->photo ? asset('storage/' . $father->photo) : 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                            alt="Foto {{ $father->name }}" class="family-member-photo">
                        <div>
                            <div class="font-medium text-gray-800">{{ $father->name }}</div>
                            <div class="text-sm text-gray-600">{{ $father->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    @if($mother)
                    <div class="family-member-card member-female">
                        <img src="{{ $mother->photo ? asset('storage/' . $mother->photo) : 'https://images.unsplash.com/photo-1554151228-14d9def656e4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                            alt="Foto {{ $mother->name }}" class="family-member-photo">
                        <div>
                            <div class="font-medium text-gray-800">{{ $mother->name }}</div>
                            <div class="text-sm text-gray-600">{{ $mother->relationship->label }}</div>
                        </div>
                    </div>
                    @endif

                    <div class="family-member-card member-self">
                        <img src="{{ $rootFamily->photo ? asset('storage/' . $rootFamily->photo) : 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=200&q=80' }}"
                            alt="Foto {{ $rootFamily->name }}" class="family-member-photo">
                        <div>
                            <div class="font-medium text-gray-800">{{ $rootFamily->name }}</div>
                            <div class="text-sm text-gray-600">Anda</div>
                        </div>
                    </div>

                    @if($brother)
                    <div class="family-member-card member-male">
                        <img src="{{ $brother->photo ? asset('storage/' . $brother->photo) : asset('images/family/brother.jpg') }}"
                            alt="Foto {{ $brother->name }}" class="family-member-photo">
                        <div>
                            <div class="font-medium text-gray-800">{{ $brother->name }}</div>
                            <div class="text-sm text-gray-600">{{ $brother->relationship->label }}</div>
                        </div>
                    </div>
                    @endif
                    @if(!empty($sister?->name))
                    <div class="family-member-card member-female">
                        <img src="{{ $sister->photo ? asset('storage/' . $sister->photo) : asset('images/family/sister.jpg') }}"
                            alt="Foto {{ $sister->name }}" class="family-member-photo">
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