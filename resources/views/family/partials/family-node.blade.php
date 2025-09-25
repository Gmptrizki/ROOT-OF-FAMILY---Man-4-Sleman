<li>
    <a href="{{ route('dashboard', $family->user_id) }}">
        <div class="pair">
            <span>{{ $family->name }}</span>
        </div>
    </a>

    @if($family->children->count() > 0)
        <ul>
            @foreach($family->children as $child)
                @include('family.partials.family-node', ['family' => $child])
            @endforeach
        </ul>
    @endif
</li>
