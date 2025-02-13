@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10">
    <!-- Form -->
    <div class="max-w-4xl mx-auto mt-10 p-8 bg-white rounded-lg shadow-md">
        <h2 class="text-3xl font-semibold text-center mb-6">Site Form</h2>

        <form id="siteForm" enctype="multipart/form-data">
            @csrf
            <div class="space-y-4">
                <!-- Site Name -->
                <div>
                    <label for="site_name" class="block text-sm font-medium text-gray-700">Site Name</label>
                    <select id="site_name" name="site_name" class="w-full px-4 py-2 border rounded-md" required>
                        <option value="">Select Site</option>
                    </select>
                </div>

                <!-- UPS Rating -->
                <div>
                    <label for="ups_rating" class="block text-sm font-medium text-gray-700">UPS Rating</label>
                    <input type="number" id="ups_rating" name="ups_rating" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Battery Bank -->
                <div>
                    <label for="battery_bank" class="block text-sm font-medium text-gray-700">Battery Bank</label>
                    <select id="battery_bank" name="battery_bank" class="w-full px-4 py-2 border rounded-md" required>
                        <option value="">Select Battery Bank</option>
                    </select>
                </div>

                <!-- Battery Capacity -->
                <div>
                    <label for="battery_capacity" class="block text-sm font-medium text-gray-700">Battery Capacity</label>
                    <select id="battery_capacity" name="battery_capacity" class="w-full px-4 py-2 border rounded-md" required>
                        <option value="">Select Battery Capacity</option>
                    </select>
                </div>

                <!-- PG Gland -->
                <div>
                    <label for="pg_gland" class="block text-sm font-medium text-gray-700">PG Gland</label>
                    <input type="number" id="pg_gland" name="pg_gland" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Thumbal -->
                <div>
                    <label for="thumbal" class="block text-sm font-medium text-gray-700">Thumbal</label>
                    <input type="number" id="thumbal" name="thumbal" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Nut Bolts -->
                <div>
                    <label for="nut_bolts" class="block text-sm font-medium text-gray-700">Nut Bolts</label>
                    <input type="number" id="nut_bolts" name="nut_bolts" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Farsher Quality -->
                <div>
                    <label for="farsher_quality" class="block text-sm font-medium text-gray-700">Farsher Quality</label>
                    <input type="number" id="farsher_quality" name="farsher_quality" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Battery to Braker Cable -->
                <div>
                    <label for="battery_to_braker_cable" class="block text-sm font-medium text-gray-700">Battery to Braker Cable</label>
                    <input type="number" id="battery_to_braker_cable" name="battery_to_braker_cable" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Braker to UPS -->
                <div>
                    <label for="braker_to_ups" class="block text-sm font-medium text-gray-700">Braker to UPS</label>
                    <input type="number" id="braker_to_ups" name="braker_to_ups" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Control Cable -->
                <div>
                    <label for="control_cable" class="block text-sm font-medium text-gray-700">Control Cable</label>
                    <input type="number" id="control_cable" name="control_cable" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- UPS to Pannel Cable -->
                <div>
                    <label for="ups_to_pannel_cable" class="block text-sm font-medium text-gray-700">UPS to Pannel Cable</label>
                    <input type="number" id="ups_to_pannel_cable" name="ups_to_pannel_cable" class="w-full px-4 py-2 border rounded-md" required>
                </div>

                <!-- Images -->
                <div>
                    <label for="images" class="block text-sm font-medium text-gray-700">Images (Optional)</label>
                    <input type="file" id="images" name="images[]" multiple class="w-full px-4 py-2 border rounded-md">
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700">Submit</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch lookup data for dropdowns from the API
        fetchLookups();
    });

    function fetchLookups() {
        fetch('http://localhost:8000/api/company/lookups')
            .then(response => response.json())
            .then(data => {
                // Populate dropdowns
                populateDropdown('SITE_NAME', data.data.SITE_NAME, '#site_name');
                populateDropdown('BATTERY_BANK', data.data.BATTERY_BANK, '#battery_bank');
                populateDropdown('BATTERY_CAPACITY', data.data.BATTERY_CAPACITY, '#battery_capacity');
            })
            .catch(error => {
                console.error("Error fetching lookups:", error);
            });
    }

    // Function to populate the dropdown with data
    function populateDropdown(lookupType, lookupData, dropdownSelector) {
        const select = document.querySelector(dropdownSelector);
        lookupData.forEach(item => {
            const option = document.createElement('option');
            option.value = item.key;
            option.textContent = item.value;
            select.appendChild(option);
        });
    }

    // Handle form submission
    document.getElementById('siteForm').addEventListener('submit', function(e) {
        e.preventDefault();  // Prevent default form submission

        let formData = new FormData(this);  // Create a FormData object for sending form data

        axios.post('/api/company/form', formData)
            .then(response => {
                alert('Form submitted successfully!');
                // Handle success (e.g., redirect or clear form)
            })
            .catch(error => {
                alert('Something went wrong!');
                // Handle error
            });
    });
</script>
@endsection
