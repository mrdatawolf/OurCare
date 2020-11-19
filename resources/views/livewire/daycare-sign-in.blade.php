<div class="card-columns">
@foreach($childrenIds as $id)
    @livewire('child-sign-in-row', ['childId' => $id])
@endforeach
</div>
