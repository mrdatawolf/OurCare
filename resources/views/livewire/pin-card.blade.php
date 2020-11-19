<div class="card">
    <div class="card-header {{ $pinClass }}">
        <H2>Enter Pin</H2>
    </div>
    <div class="card-body" {{ $pinClass }}>
        <label for="provider-pin" class="{{ $pinClass }} block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Input pin</label>
        <div class="{{ $pinClass }} pin-login" id="mainPinLogin">
            <input type="password" id="provider-pin" name="provider-pin" class="{{ $errorClass }} pin-login__text bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
            <div class="pin-login__numpad" id="mainNumpad"></div>
        </div>
    </div>

    <div class="card-header {{ $mainClass }}">
        Lock Billing
    </div>
    <div class="card-body {{ $mainClass }}">
        <button wire:click="lock" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500"> Lock Page</button>
    </div>

    <script>

        if ( document.getElementById('mainNumpad').innerHTML === "") {
            new PinLogin({
                el: document.getElementById('mainPinLogin'),
                maxNumbers: 4
            });
        } else {
            console.log( document.getElementById('mainNumpad').innerHTML);
        }

        Livewire.on('lock', postId => {
            if ( document.getElementById('mainNumpad').innerHTML.trim() === "") {
                new PinLogin({
                    el: document.getElementById('mainPinLogin'),
                    maxNumbers: 4
                });
            }
        });
    </script>
</div>
