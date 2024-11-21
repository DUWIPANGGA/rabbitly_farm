<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>
    <script type="text/javascript" language="javascript">
        var mqtt;
        var reconnectTimeout = 2000;
        var host = "broker.emqx.io";
        var port = 8083;
        var username = "rabbit_polindra"; // Replace with your username
        var password = "rabbit_polindra"; // Replace with your password

        // Function to handle successful connection
        function onConnect() {
            console.log("Connected to MQTT broker");

            mqtt.subscribe("rabbit_polindra/#", {
                onSuccess: function() {
                    console.log("Successfully subscribed to 'rabbit_polindra/#' topic");
                },
                onFailure: function(e) {
                    console.log("Failed to subscribe to 'rabbit_polindra/#' topic", e);
                }
            });

            // Publish a test message to the 'control/test' topic (just for testing)
            var message = new Paho.MQTT.Message("hello");
            message.destinationName = "rabbit_polindra";
            mqtt.send(message);
        }

        function onMessageArrived(message) {
            console.log("Message received on topic: " + message.destinationName);
            console.log("Message payload: " + message.payloadString);

            if (message.payloadString === "turn_on") {
                console.log("Turning on the device...");
            } else if (message.payloadString === "turn_off") {
                console.log("Turning off the device...");
            }
        }

        // Function to connect to the MQTT broker
        function mqttConnect() {
            console.log("Connecting to " + host + ":" + port);
            mqtt = new Paho.MQTT.Client(host, port, "clientjs");

            // Set up the message arrival handler
            mqtt.onMessageArrived = onMessageArrived;

            var options = {
                timeout: 3,
                userName: username, // Include username
                password: password,
                onSuccess: onConnect, // Callback for successful connection
                onFailure: function(message) {
                    console.log("Connection failed: " + message.errorMessage);
                    setTimeout(mqttConnect, reconnectTimeout); 
                }
            };

            // Connect to the MQTT broker
            mqtt.connect(options);
        }

        // Automatically attempt to connect when the page loads
        window.onload = function() {
            mqttConnect();
        };
    </script>
</head>

<body>
    <h1>MQTT Client</h1>
    <p>Attempting to connect to MQTT broker...</p>
</body>

</html>
