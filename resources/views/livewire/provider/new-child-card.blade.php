<div class="card">
    <div class="card-header">
        <h2 class="block text-gray-900 font-bold md:text-center mb-1 md:mb-0 pr-4"><span wire:click="flipNewChildCard" class="pin-login__key material-icons">{{ $circleNewChildCardBodyShowHide }}</span> Add a New Child</h2>
    </div>
    <div class="card-body {{ $displayNewChildCardClass }}">
        <label for="add-child-first-name" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4"><span title="required">*</span>First</label>
        <input wire:model="newChildFirstName" type="text" id="add-child-first-name" name="add-child-first-name" class="bg-gray-200 appearane-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">
        <label for="add-child-last-name" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4"><span title="required">*</span>Last</label>
        <input wire:model="newChildLastName" type="text" id="add-child-last-name" name="add-child-last-name" class="bg-gray-200 appearane-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">
        <label for="add-parent" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Guardians</label>
        <ul>
            @if(! empty($guardiansOfChild))
                @foreach($guardiansOfChild as $guardian)
                    <li>
                        <div class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">{{ $guardian->last_name ?? 'n/a' }}, {{ $guardian->first_name ?? 'n/a' }}<span wire:click="removeGuardianId({{ $guardian->id }})" class="pin-login__key__small material-icons">clear</span></div>
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
            <div wire:click="addChild" class="pin-login__key material-icons {{ $allowNewChildAdd }}" {{ $allowNewChildAdd }}>add</div>
        @endif
    </div>
</div>
