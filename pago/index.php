<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Add meta tags for mobile and IE -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title> PayPal Checkout Integration | Server Demo </title>
</head>

<body>
    <!-- Set up a container element for the button -->
    <div id="paypal-button-container"></div>

    <!-- Include the PayPal JavaScript SDK -->
    <script src="https://www.paypal.com/sdk/js?client-id=AXc1S76V8UvVwtTkocBtikqo11TPhLeG6TFlPN9h_ETOCPPh3ASMFpXCPnaFrLGAXdmttYoCXXjqEy2O"></script>

    <script>
      paypal.Buttons({
       style: {
        color: 'blue',
        shape: 'pill',
        label: 'pay'
       },
       createOrder: function(data, actions){
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: 100
                }
            }]
        });
       },
        onApprove: function(data, actions) {
            actions.order.capture().then(function (detalles){
                windows.locations.href="Completado.html"
            });
          },
         onCancel: function(data){
            alert("Pago Cancelado");
            console.log(data);
         }
        }).render('#paypal-button-container');
    </script>
    <!-- Set up a container element for the button -->
	<!-- Google Map -->
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    	<script src="js/google-map.js"></script> -->
</body>

</html>
    