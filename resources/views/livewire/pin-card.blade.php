<div class="card">
    <link rel="stylesheet" href="{{ asset('css/pinPad.css') }}">
    <script src="js/pin-login.js"></script>
    <div class="card-header">
        <H2>Enter Pin</H2>
    </div>
    <div class="card-body">
        <label for="provider-pin" class="block text-gray-500 font-bold md:text-left mb-1 md:mb-0 pr-4">Input pin</label>



        <div class="pin-login" id="mainPinLogin">
            <input type="password" id="provider-pin" name="provider-pin" class="pin-login__text bg-gray-200 appearance-none border-2 border-gray-200 rounded py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:border-purple-500" readonly>
            <div class="pin-login__numpad">

            </div>
        </div>
    </div>
    <script>
        new PinLogin({
            el: document.getElementById('mainPinLogin'),
            loginEndpoint: "login.php",
            redirectTo: "dashboard.html",
            maxNumbers: 4
        })
    </script>
</div>
