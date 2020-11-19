<div>
    <div class="card-columns {{ $displayClass }}">
        @if(empty($children))
            <div class="card">
                <div class="card-body">
                    No children found!
                </div>
            </div>
        @else
        @foreach($children as $child)
            <div class="card">
                <div class="card-header">
                    <H1><span title="{{ json_encode($childrenGuardians[$child->id]) }}">{{ $child->first_name }}, {{ $child->last_name }}</span></H1>
                </div>
                <div class="card-body">
                    <div class="block border-indigo-400 border-2">
                        <ul>
                            <li>Sign In/Out <button class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">Manage</button></li>
                            <li>Billing <button class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">Billing</button></li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
    <div class="{{ $displayClass }}">
    <hr><hr>
    </div>
    <div class="card {{ $displayClass }}">
        <div class="card-header">
            <h2>New Kid</h2>
        </div>
        <div class="card-body">
            <label for="add-child-first-name" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">First</label>
            <input type="text" id="add-child-first-name" name="add-child-first-name" class="bg-gray-200 appearane-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">
            <label for="add-child-last-name" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Last</label>
            <input type="text" id="add-child-last-name" name="add-child-last-name" class="bg-gray-200 appearane-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">
            <label for="add-parent" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Guardians</label>
            <ul>
                @if(empty($guardiansOfChild))
                    <li>N/A</li>
                @else
                    @foreach($guardiansOfChild as $guardian)
                        <li>
                            <span class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">{{ $guardian->last_name ?? 'n/a' }}, {{ $guardian->first_name ?? 'n/a' }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button wire:click="removeGuardianId({{ $guardian->id }})">remove</button></span>
                        </li>
                    @endforeach
                @endif
            </ul>

            @if(empty($potentialGuardians))
                No potential parents found!
            @else
                <select id="add-parent" name="add-parent" wire:model="addGuardianId">
                    <option value="0"> - Add a parent - </option>
                    @foreach($potentialGuardians as $potentialGuardian)
                        <option value="{{ $potentialGuardian->id }}">{{ $potentialGuardian->last_name }}, {{ $potentialGuardian->first_name }}</option>
                    @endforeach
                </select>

                <br>
                <button class="bg-gray-200 appearane-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">Add</button>
            @endif
        </div>
    </div>
</div>
