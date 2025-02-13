<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <!-- Add your stylesheets here -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <header>
        <!-- Navigation, logo, etc. -->
    </header>

    <main class="container mx-auto p-4">
        @yield('content') <!-- This is where page-specific content will go -->
    </main>

    <footer class="bg-gray-800 text-white p-4 text-center">
        <!-- Footer content -->
        <p>&copy; {{ date('Y') }} Your Company</p>
    </footer>
</body>
</html>
