<div class="card">
    <div class="card-header text-center">
        <H1 class="text-gray-900 font-bold"><span wire:click="flipChildCard" class="pin-login__key material-icons" title="{{ $childGuardians }}">{{ $child->avatar }}</span>{{ $child->first_name }} {{ $child->last_name }}<span wire:click="flipChildCard" class="pin-login__key material-icons">{{ $circleChildCardBodyShowHide }}</span></H1>
    </div>
    <div class="card-body {{ $displayChildCardClass }}">
        <div class="block border-gray-400 border-2">
            <ul>
                <li class="md:text-center"><button class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">Manage Sign In/Out</button></li>
                <li class="md:text-center"><button class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500">Billing</button></li>
            </ul>
        </div>
    </div>
</div>
