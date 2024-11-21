<?php

return [
    'broker' => env('MQTT_BROKER', 'localhost'), // Alamat MQTT broker
    'port' => env('MQTT_PORT', 1883),           // Port MQTT broker (default: 1883)
    'username' => env('MQTT_USERNAME', null),   // Username broker
    'password' => env('MQTT_PASSWORD', null),   // Password broker
    'client_id' => env('MQTT_CLIENT_ID', 'laravel_client'), // ID unik untuk client MQTT
];
