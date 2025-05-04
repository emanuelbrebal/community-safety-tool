<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @routes
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @inertiaHead
    @vite(['resources/css/appBlade.css'])
</head>
<body class="font-sans antialiased full-size">
    @inertia
</body>
</html>
