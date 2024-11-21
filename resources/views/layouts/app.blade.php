<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9fafb; /* Warna latar belakang */
        }
        .header {
            background: linear-gradient(to right, #3b82f6, #ea7933);
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .header h1 {
            font-weight: 700;
            margin: 0;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="content">
        @yield('content') <!-- Konten dari view lain -->
    </div>
</body>
</html>
