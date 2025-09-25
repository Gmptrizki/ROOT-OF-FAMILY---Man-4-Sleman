<x-app-layout>
    <link href="{{ asset('css/tree.css') }}" rel="stylesheet">


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if($rootFamily)
                    <div class="tree">
                        <ul>
                            <li>
                                <div class="family-member" style="background: #fff3cd; border-color: #ffc107;">
                                    @if($rootFamily->photo)
                                    <img src="{{ asset('storage/' . $rootFamily->photo) }}"
                                        alt="{{ $rootFamily->name }}">
                                    @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar">
                                    @endif
                                    <div>
                                        <strong>{{ $rootFamily->name }}</strong>
                                        <span class="current-user-badge">Anda</span>
                                        <br>
                                        <small>{{ $rootFamily->gender }}</small>
                                        <br>
                                        <small>{{ $rootFamily->birth_date }}</small>
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
                                <ul>
                                    <li>
                                        <div class="family-member">
                                            @if($rootFamily->spouse->photo)
                                            <img src="{{ asset('storage/' . $rootFamily->spouse->photo) }}"
                                                alt="{{ $rootFamily->spouse->name }}">
                                            @else
                                            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar">
                                            @endif
                                            <div>
                                                <strong>{{ $rootFamily->spouse->name }}</strong>
                                                <br>
                                                <small>{{ $rootFamily->spouse->gender }}</small>
                                                <br>
                                                <small>{{ $rootFamily->spouse->birth_date }}</small>
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
                                    </li>
                                </ul>
                                @endif

                                @if($rootFamily->children->count() > 0)
                                <ul>
                                    @foreach($rootFamily->children as $child)
                                    <li>
                                        <div class="family-member">
                                            @if($child->photo)
                                            <img src="{{ asset('storage/' . $child->photo) }}" alt="{{ $child->name }}">
                                            @else
                                            <img src="{{ asset('images/default-avatar.png') }}" alt="Default Avatar">
                                            @endif
                                            <div>
                                                <strong>{{ $child->name }}</strong>
                                                <br>
                                                <small>{{ $child->gender }}</small>
                                                <br>
                                                <small>{{ $child->birth_date }}</small>
                                                @if($child->relationship)
                                                <div class="text-xs text-gray-500">
                                                    {{ $child->relationship->label }}
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                            </li>
                        </ul>
                    </div>
                    @else
                    <p class="text-gray-500">Belum ada data keluarga.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>