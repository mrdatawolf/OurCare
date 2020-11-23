<div>
    <div class="card">
        <div class="card-header {{ $signedInClass }}">
            <H1 class="text-gray-900 font-bold"><span wire:click="flipChildCard" class="pin-login__key material-icons">{{ $child->avatar }}</span>{{ $child->last_name }}, {{ $child->first_name }}&nbsp;&nbsp;&nbsp;&nbsp;<span wire:click="flipSignIn" class="pin-login__key material-icons">{{ $circleTypeSignIn }}</span></H1>
        </div>
        <div class="card-body {{ $displayClass }}">
            <div class="block border-indigo-400 border-2">
                <ul>
                    @if(! empty($lastPayment))
                        <li>
                            <label for="{{ $lastPayment->id }}-payment" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Payment Due</label>
                            <input type="text" name="payments" id="{{ $lastPayment->id }}-payment" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500" value="{{ $lastPayment->amount }}" readonly>
                            <span style="{{ ($lastPayment->paid === "true") ? 'color:green' : 'color:red' }}" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">  {{ ($lastPayment->paid === "true") ? 'Paid' : 'Unpaid' }}</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
