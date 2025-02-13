<!-- resources/views/auth/login.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-8 border shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

    <form id="loginForm">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        </div>

        <div class="flex items-center justify-between mb-6">
            <label class="inline-flex items-center text-sm text-gray-700">
                <input type="checkbox" name="remember" class="form-checkbox"> Remember me
            </label>
            <a href="{{ route('register') }}" class="text-sm text-indigo-600 hover:text-indigo-500">Don't have an account?</a>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Login</button>
    </form>

    <div id="error" class="mt-4 text-red-500 text-sm hidden"></div>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const errorDiv = document.getElementById('error');

    // Reset error
    errorDiv.classList.add('hidden');
    errorDiv.innerHTML = '';

    axios.post('/company/login', formData)
        .then(response => {
            // Save token to localStorage
            localStorage.setItem('auth_token', response.data.token);
            window.location.href = "/dashboard"; // Redirect to dashboard or another page after success
        })
        .catch(error => {
            errorDiv.classList.remove('hidden');
            if (error.response && error.response.data) {
                errorDiv.innerHTML = error.response.data.message || 'An error occurred';
            }
        });
});
</script>
@endsection
