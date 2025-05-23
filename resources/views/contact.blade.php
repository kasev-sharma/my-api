<!-- resources/views/contact.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 flex flex-col md:flex-row items-center justify-center">
    <!-- Contact Details -->
    <div class="md:w-1/2 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold mb-4">Contact Us</h2>
        <p class="text-gray-700"><strong>Location:</strong> New Jersey, USA</p>
        <p class="text-gray-700">185 Hudson St., Suite 2531, Jersey City, NJ 07311</p>
        <p class="text-gray-700"><strong>Email:</strong> <a href="mailto:info@newfieldstech.com" class="text-indigo-600">info@newfieldstech.com</a></p>
    </div>

    <!-- Contact Form -->
    <div class="md:w-1/2 p-6 bg-white shadow-md rounded-lg mt-6 md:mt-0 md:ml-6">
        <h2 class="text-2xl font-semibold mb-4">Send Us a Message</h2>
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Your Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-indigo-600" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Your Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-indigo-600" required>
            </div>
            <div class="mb-4">
                <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" name="message" rows="4" class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-indigo-600" required></textarea>
            </div>
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Send Message</button>
        </form>
    </div>
</div>
@endsection