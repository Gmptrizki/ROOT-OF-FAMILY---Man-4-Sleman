<x-app-layout>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .tree-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-bottom: 30px;
            overflow-x: auto;
        }

        .tree {
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 500px;
            position: relative;
        }

        .generation {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-bottom: 60px;
            position: relative;
        }

        .family-member {
            background-color: #fff;
            border: 2px solid #3498db;
            border-radius: 10px;
            padding: 15px;
            width: 200px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            position: relative;
            z-index: 2;
            margin: 0 10px;
        }

        .family-member:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .family-member.current-user {
            background-color: #fff3cd;
            border-color: #ffc107;
        }

        .member-photo {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 10px;
            border: 3px solid #3498db;
        }

        .member-name {
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .current-user-badge {
            background-color: #ffc107;
            color: #856404;
            font-size: 0.7rem;
            padding: 2px 6px;
            border-radius: 10px;
            margin-left: 5px;
        }

        .member-details {
            font-size: 0.85rem;
            color: #666;
        }

        .relationship-code {
            margin-top: 5px;
            font-size: 0.75rem;
            color: #3498db;
            font-weight: bold;
        }

        .actions {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
            margin: 0 10px;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-add {
            background-color: #2ecc71;
        }

        .btn-add:hover {
            background-color: #27ae60;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }

        .edit-form {
            background: #fefefe;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }

        .edit-form h2 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .edit-form label {
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
        }

        .edit-form input,
        .edit-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .edit-form button {
            background: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .edit-form button:hover {
            background: #2980b9;
        }
    </style>

    <div class="container">
        <div class="header">
            <h1>Pohon Keluarga</h1>
            <p>Visualisasi hubungan keluarga dalam bentuk pohon silsilah</p>
        </div>

        <div class="tree-container">
            @if($rootFamily)
            <div class="tree">
                <div class="generation">
                    <div class="family-member current-user">
                        <img src="{{ $rootFamily->photo ? asset('storage/' . $rootFamily->photo) : asset('images/default-avatar.png') }}"
                            alt="{{ $rootFamily->name }}" class="member-photo">
                        <div class="member-name">
                            {{ $rootFamily->name }}
                            <span class="current-user-badge">Anda</span>
                        </div>
                        <div class="member-details">
                            <div>{{ $rootFamily->gender }}</div>
                            <div>Lahir: {{ $rootFamily->birth_date }}</div>
                        </div>
                        @if($rootFamily->relationship)
                        <div class="relationship-code">
                            Code: {{ $rootFamily->relationship->code }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Label: {{ $rootFamily->relationship->label }}
                        </div>
                        @endif
                    </div>
                </div>

                @if($rootFamily->spouse)
                <div class="generation">
                    <div class="family-member">
                        <img src="{{ $rootFamily->spouse->photo ? asset('storage/' . $rootFamily->spouse->photo) : asset('images/default-avatar.png') }}"
                            alt="{{ $rootFamily->spouse->name }}" class="member-photo">
                        <div class="member-name">{{ $rootFamily->spouse->name }}</div>
                        <div class="member-details">
                            <div>{{ $rootFamily->spouse->gender }}</div>
                            <div>Lahir: {{ $rootFamily->spouse->birth_date }}</div>
                        </div>
                        @if($rootFamily->spouse->relationship)
                        <div class="relationship-code">
                            Code: {{ $rootFamily->spouse->relationship->code }}
                        </div>
                        <div class="text-xs text-gray-500">
                            Label: {{ $rootFamily->spouse->relationship->label }}
                        </div>
                        @endif
                    </div>
                </div>
                @endif

                @if($rootFamily->children->count() > 0)
                <div class="generation">
                    @foreach($rootFamily->children as $child)
                    <div class="family-member">
                        <img src="{{ $child->photo ? asset('storage/' . $child->photo) : asset('images/default-avatar.png') }}"
                            alt="{{ $child->name }}" class="member-photo">
                        <div class="member-name">{{ $child->name }}</div>
                        <div class="member-details">
                            <div>{{ $child->gender }}</div>
                            <div>Lahir: {{ $child->birth_date }}</div>
                        </div>
                        @if($child->relationship)
                        <div class="relationship-code">{{ $child->relationship->label }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            <div class="actions">
                <a href="{{ route('family.show', $rootFamily->id) }}" class="btn btn-add">
                    + Tambah Anggota Keluarga
                </a>
                <a href="{{ route('family.edit', $rootFamily->id) }}" class="btn">
                    ✏️ Edit Data Keluarga
                </a>
            </div>


            @else
            <div class="no-data">
                <p>Belum ada data keluarga.</p>
                <a href="{{ route('family.show', 0) }}" class="btn btn-add">Tambah Data Pertama</a>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>