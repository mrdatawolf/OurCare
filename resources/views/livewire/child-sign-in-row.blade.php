<div>
    <div class="card">
        <div class="card-header">
            <H1>{{ $child->last_name }}, {{ $child->first_name }}</H1>
        </div>
        <div class="card-body">
            <div class="block border-indigo-400 border-2">

                <input wire:modal="isSignedIn" type="checkbox" id="sign_in" name="sign_in" {{ ($isSignedIn) ? 'checked=checked' : ''  }}> <label for="sign_in" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Sign In</label>
                <ul>
                    @if(! empty($lastPayment))
                    <li>
                        <label for="{{ $lastPayment->id }}-payment" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Payment</label>
                        <input type="text" name="payments" id="{{ $lastPayment->id }}-payment" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500" value="{{ $lastPayment->amount }}" readonly>
                        <span style="{{ ($lastPayment->paid === "true") ? 'color:green' : 'color:red' }}" class="text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">  {{ ($lastPayment->paid === "true") ? 'Paid' : 'Unpaid' }}</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
