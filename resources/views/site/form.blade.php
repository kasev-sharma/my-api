@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <!-- Error Card (hidden initially) -->
    <div id="errorCard" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/2">
            <h3 class="text-xl font-semibold text-red-600">Error</h3>
            <ul id="errorList" class="mt-4 text-sm text-gray-700">
                <!-- Errors will be inserted here -->
            </ul>
            <button id="closeErrorCard" class="mt-4 bg-red-600 text-white py-2 px-4 rounded-lg hover:bg-red-700">
                Close
            </button>
        </div>
    </div>
    <!-- Form -->
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-center mb-6">Site Form</h2>

        <form id="siteForm" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <!-- Site Information -->
                <fieldset class="border p-4 rounded-md">
                    <legend class="text-lg font-semibold">Site Information</legend>
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer</label>
                        <input type="text" id="customer_name" name="customer_name" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="site_address" class="block text-sm font-medium text-gray-700">Site Address</label>
                        <input type="text" id="site_address" name="site_address" class="w-full px-4 py-2 border rounded-md">
                    </div>
                </fieldset>

                <fieldset class="border p-4 rounded-md">
                    <legend class="text-lg font-semibold">Customer Details</legend>
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="customer_mobile" class="block text-sm font-medium text-gray-700">Customer Mobile</label>
                        <input type="text" id="customer_mobile" name="customer_mobile" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="customer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="customer_mobile" class="block text-sm font-medium text-gray-700">Customer Mobile</label>
                        <input type="text" id="customer_mobile" name="customer_mobile" class="w-full px-4 py-2 border rounded-md">
                    </div>

                </fieldset>

                <!-- UPS Section -->
                <fieldset class="border p-4 rounded-md">
                    <legend class="text-lg font-semibold">UPS Details</legend>
                    <div>
                        <label for="ups_make" class="block text-sm font-medium text-gray-700">UPS Make</label>
                        <input type="text" id="ups_make" name="ups_make" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="ups_model" class="block text-sm font-medium text-gray-700">UPS Model</label>
                        <input type="text" id="ups_model" name="ups_model" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="ups_rating" class="block text-sm font-medium text-gray-700">UPS Rating</label>
                        <input type="number" id="ups_rating" name="ups_rating" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="no_of_ups" class="block text-sm font-medium text-gray-700">No of UPS</label>
                        <input type="number" id="no_of_ups" name="no_of_ups" class="w-full px-4 py-2 border rounded-md">
                    </div>

                </fieldset>

                <!-- Battery Section -->
                <fieldset class="border p-4 rounded-md">
                    <legend class="text-lg font-semibold">Battery Details</legend>
                    <div>
                        <label for="battery_bank" class="block text-sm font-medium text-gray-700">Battery Make</label>
                        <input type="text" id="battery_bank" name="battery_bank" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="battery_ah" class="block text-sm font-medium text-gray-700">Battery Ah</label>
                        <input type="text" id="battery_ah" name="battery_ah" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="battery_volt" class="block text-sm font-medium text-gray-700">Battery Volt</label>
                        <input type="text" id="battery_volt" name="battery_volt" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="battery_type" class="block text-sm font-medium text-gray-700">Battery Type</label>
                        <input type="text" id="battery_type" name="battery_type" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="no_of_bank" class="block text-sm font-medium text-gray-700">No of Banks</label>
                        <input type="number" id="no_of_bank" name="no_of_bank" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="no_of_battery" class="block text-sm font-medium text-gray-700">No of Battery</label>
                        <input type="number" id="no_of_battery" name="no_of_battery" class="w-full px-4 py-2 border rounded-md">
                    </div>
                </fieldset>

                <!-- Miscellaneous Section -->
                <fieldset class="border p-4 rounded-md">
                    <legend class="text-lg font-semibold">Miscellaneous</legend>
                    <div>
                        <label for="control_cable_in_meters" class="block text-sm font-medium text-gray-700">Control Cable in Meters</label>
                        <input type="number" id="control_cable_in_meters" name="control_cable_in_meters" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="pg_gland" class="block text-sm font-medium text-gray-700">PG Gland</label>
                        <input type="number" id="pg_gland" name="pg_gland" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="thumbal" class="block text-sm font-medium text-gray-700">Thumbal</label>
                        <input type="number" id="thumbal" name="thumbal" class="w-full px-4 py-2 border rounded-md">
                    </div>
                    <div>
                        <label for="nut_bolts" class="block text-sm font-medium text-gray-700">Nut Bolts</label>
                        <input type="number" id="nut_bolts" name="nut_bolts" class="w-full px-4 py-2 border rounded-md">
                    </div>
                </fieldset>

                <!-- Images Upload -->
                <fieldset class="border p-4 rounded-md">
                    <legend class="text-lg font-semibold">Image Upload</legend>
                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700">Images (Optional)</label>
                        <input type="file" id="images" name="images[]" multiple class="w-full px-4 py-2 border rounded-md">
                    </div>
                </fieldset>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Submit</button>
            </div>
        </form>

    </div>
</div>

<script>
    const API_BASE_URL = @json(env('API_BASE_URL'));

    document.addEventListener('DOMContentLoaded', function() {
        fetchLookups();
    });

    function fetchLookups() {
        fetch(`${API_BASE_URL}/api/company/lookups`)
            .then(response => response.json())
            .then(data => {
                populateDropdown('SITE_NAME', data.data.SITE_NAME, '#site_name');
                populateDropdown('BATTERY_BANK', data.data.BATTERY_BANK, '#battery_bank');
                populateDropdown('BATTERY_CAPACITY', data.data.BATTERY_CAPACITY, '#battery_capacity');
            })
            .catch(error => {
                console.error("Error fetching lookups:", error);
            });
    }

    function populateDropdown(lookupType, lookupData, dropdownSelector) {
        const select = document.querySelector(dropdownSelector);
        lookupData.forEach(item => {
            const option = document.createElement('option');
            option.value = item.key;
            option.textContent = item.value;
            select.appendChild(option);
        });
    }

    document.getElementById('siteForm').addEventListener('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);

        fetch(`${API_BASE_URL}/api/company/add-form-data`, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success != true) {
                    // Show error card if validation fails
                    displayErrors(data.message);
                } else {
                    alert('Form submitted successfully!');
                    // You can redirect or reset the form as needed
                }
            })
            .catch(error => {
                alert('Something went wrong!');
                console.error(error);
            });
    });

    function displayErrors(errorMessage) {
        const errorCard = document.getElementById('errorCard');
        const errorList = document.getElementById('errorList');
        errorList.innerHTML = ''; // Clear previous errors

        // Parse the error message object
        const errors = JSON.parse(errorMessage);

        // Loop through each field and display only the error messages (values)
        for (const field in errors) {
            errors[field].forEach(error => {
                const li = document.createElement('li');
                li.textContent = error; // Only display the error message (not the field name)
                errorList.appendChild(li);
            });
        }

        // Show the error card
        errorCard.classList.remove('hidden');
    }
    // Close error card
    document.getElementById('closeErrorCard').addEventListener('click', function() {
        document.getElementById('errorCard').classList.add('hidden');
    });
</script>

@endsection