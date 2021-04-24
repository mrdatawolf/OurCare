<div class="billing">
    <div class="card {{ $displayClass }}">
        <div class="card-header">
            <select wire:model="childName" class="bg-indigo-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-indigo-700 leading-tight focus:outline-none focus:border-purple-500">
                @foreach($children as $thisChild)
                    <option value="{{ $thisChild->id }}">{{ $thisChild->first_name }} {{ $thisChild->last_name }}</option>
                @endforeach
            </select>
            <br>
            <div class="parentNames">
                <label class="text-ingio-500 font-bold">Parent1:</label>
                <input type="text" wire:model="firstParentName" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500" readonly>

                <label class="text-ingio-500 font-bold">Parent2:</label>
                <input type="text" wire:model="secondParentName" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
            </div>

        </div>
        <div class="card-body">
            <div>
                <button wire:click="decreaseMonth" value="1" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500"> < </button>
                <span class="text-ingio-500 font-bold">{{ $activeMonth->monthName }}</span>
                <button wire:click="increaseMonth" value="-1" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500"> > </button>
            </div>
            <div class="header">
                Current Due Information
            </div>
            <div>
                <label class="text-ingio-500 font-bold">Days</label>
                <input wire:model="days" type="text" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
                <br>
                <label class="text-ingio-500 font-bold">Amount Per Day</label>
                <input type="text" wire:model="billedAt" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
                <br>
                <label class="text-ingio-500 font-bold">Total Due</label>
                <input type="text" wire:model="totalDue" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
            </div>
            <div>
                @if($isPaid)
                    <span class="text-ingio-500 font-bold">Paid</span>
                    <button wire:click="markUnPaid" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500">Undo</button>
                @else
                    <button wire:click="markPaid" class="bg-ingio-200 appearance-none border-2 border-ingio-200 rounded py-2 px-4 text-ingio-700 leading-tight focus:outline-none focus:border-purple-500">Mark Paid</button>
                @endif
            </div>
        </div>
    </div>
</div>
