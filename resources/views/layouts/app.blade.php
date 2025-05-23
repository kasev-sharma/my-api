<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

   
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#" class="text-white text-2xl font-bold">Galaxy Infra & Engineering</a>
            <ul class="hidden md:flex space-x-6 text-white">
                <li><a href="/" class="hover:text-gray-200">Home</a></li>
                <li><a href="/about" class="hover:text-gray-200">About Us</a></li>
                <li><a href="/contact" class="hover:text-gray-200">Contact Us</a></li>
            </ul>
            <button id="menuBtn" class="md:hidden text-white text-2xl">&#9776;</button>
        </div>
        <ul id="mobileMenu" class="hidden flex flex-col items-center bg-indigo-600 text-white md:hidden">
            <li class="py-2"><a href="/" class="hover:text-gray-200">Home</a></li>
            <li class="py-2"><a href="/about" class="hover:text-gray-200">About Us</a></li>
            <li class="py-2"><a href="/contact" class="hover:text-gray-200">Contact Us</a></li>
        </ul>
    </nav>

    <main class="container mx-auto p-4 flex-grow flex items-center justify-center">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white text-center py-6 mt-auto">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center px-6">
            <p>&copy; {{ date('Y') }} MyWebsite. All rights reserved.</p>
            <div class="flex space-x-4 mt-4 md:mt-0">
                <a href="https://maps.google.com" target="_blank" class="hover:text-gray-400">Google Maps</a>
                <a href="https://instagram.com" target="_blank" class="hover:text-gray-400">Instagram</a>
                <a href="https://facebook.com" target="_blank" class="hover:text-gray-400">Facebook</a>
                <a href="https://linkedin.com" target="_blank" class="hover:text-gray-400">LinkedIn</a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menuBtn').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
