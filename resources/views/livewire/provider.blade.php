<div class="{{ $displayClass }}">
    <div class="card-columns ">
        @if(empty($children))
            <div class="card">
                <div class="card-body">
                    No children found!
                </div>
            </div>
        @else
            @foreach($children as $child)
                @livewire('provider.child-card', ['childId' => $child->id])
            @endforeach
        @endif
    </div>
    <div>
        <hr><hr>
    </div>
    @livewire('provider.new-child-card')
</div>
