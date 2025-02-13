<!-- resources/views/auth/register.blade.php -->
@extends('layouts.app')  <!-- If you're using a layout -->

@section('content')
<div class="max-w-md mx-auto bg-white p-8 border shadow-md rounded-lg">
    <h2 class="text-2xl font-semibold text-center mb-6">Sign Up</h2>

    <form id="registerForm">
        @csrf
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
            <input type="text" id="username" name="username" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 mt-1 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-600" required>
        </div>

        <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Sign Up</button>
    </form>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-700">
            Already have an account? 
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-500">Login here</a>
        </p>
    </div>

    <div id="error" class="mt-4 text-red-500 text-sm hidden"></div>
</div>

<script>
// Add JavaScript for form submission, validation, etc. if needed.
</script>
@endsection
