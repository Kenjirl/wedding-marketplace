<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <div>{{ config('midtrans.client_key') }}</div>
    <button id="pay-button">Pay!</button>
    <div id="snap-container"></div>

    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function(){
            fetch('/payment')
                .then(response => response.json())
                .then(data => {
                    snap.embed(data.snap_token, {
                        embedId: 'snap-container'
                    });
                });
        };
    </script>
</body>
</html>
