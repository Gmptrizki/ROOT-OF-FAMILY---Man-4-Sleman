@php
    $isCurrentUser = auth()->id() === $member->user_id;
@endphp

<ul>
    <li>
        <div class="family-member" {{ $isCurrentUser ? 'style="background: #fff3cd; border-color: #ffc107;"' : '' }}>
            <img src="{{ $member->photo ? asset('storage/'.$member->photo) : asset('images/default-avatar.png') }}" 
                 alt="{{ $member->name }}">
            <div>
                <strong>{{ $member->name }}</strong>
                @if($isCurrentUser)<span class="current-user-badge">Anda</span>@endif
                <br>
                <small>{{ $member->gender }}</small>
                <br>
                <small>{{ $member->birth_date }}</small>
            </div>
        </div>

        @if($member->spouse)
            <ul>
                <li>
                    <div class="family-member">
                        <img src="{{ $member->spouse->photo ? asset('storage/'.$member->spouse->photo) : asset('images/default-avatar.png') }}" 
                             alt="{{ $member->spouse->name }}">
                        <div>
                            <strong>{{ $member->spouse->name }}</strong>
                            <br>
                            <small>{{ $member->spouse->gender }}</small>
                            <br>
                            <small>{{ $member->spouse->birth_date }}</small>
                        </div>
                    </div>
                </li>
            </ul>
        @endif

        @if($member->children->count() > 0)
            <ul>
                @foreach($member->children as $child)
                    @include('family.partials.member', ['member' => $child, 'level' => $level + 1])
                @endforeach
            </ul>
        @endif
    </li>
</ul>