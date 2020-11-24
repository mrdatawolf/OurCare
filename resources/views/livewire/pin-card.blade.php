<div class="card text-center">
    <div class="card-header {{ $pinClass }}">
        <H2><label for="provider-pin" class="{{ $pinClass }} block text-gray-500 font-bold md:text-center mb-1 md:mb-0 pr-4">Enter Pin to <span class="material-icons">lock_open</span></label></H2>
    </div>
    <div class="card-body" {{ $pinClass }}>

        <div class="{{ $pinClass }} pin-login" id="mainPinLogin">
            <input type="password" id="provider-pin" name="provider-pin" class="{{ $errorClass }} pin-login__text bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
            <div class="pin-login__numpad" id="mainNumpad"></div>
        </div>
    </div>

    <div class="card-body {{ $mainClass }}">
        <button wire:click="lock" class="bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-900 leading-tight focus:outline-none focus:border-purple-500"><span class="material-icons">lock</span></button>
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
