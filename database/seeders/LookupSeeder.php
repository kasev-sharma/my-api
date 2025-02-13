<?php

namespace Database\Seeders;

use App\Models\Lookup;
use Illuminate\Database\Seeder;
use DB;

class LookupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Array of dummy lookup data
        $lookups = [
            [
                'lookup_type' => 'SITE_NAME',
                'lookup_code' => 'AHEMBDABAT',
                'lookup_value' => 'Ahembdabad',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'SITE_NAME',
                'lookup_code' => 'DELHI',
                'lookup_value' => 'Delhi',
                'sequence' => 2,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'BATTERY_BANK',
                'lookup_code' => 'BANK1',
                'lookup_value' => 'Battery Bank 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'BATTERY_BANK',
                'lookup_code' => 'BANK2',
                'lookup_value' => 'Battery Bank 2',
                'sequence' => 2,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'BATTERY_CAPACITY',
                'lookup_code' => 'CAP1',
                'lookup_value' => '100Ah',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'BATTERY_CAPACITY',
                'lookup_code' => 'CAP2',
                'lookup_value' => '200Ah',
                'sequence' => 2,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'PG_GLAND',
                'lookup_code' => 'PG1',
                'lookup_value' => 'PG Gland Type 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'THUMBAL',
                'lookup_code' => 'THUMB1',
                'lookup_value' => 'Thumbal Type 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'NUT_BOLTS',
                'lookup_code' => 'NB1',
                'lookup_value' => 'Nut and Bolt Type 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'FASHER_QUALITY',
                'lookup_code' => 'FQ1',
                'lookup_value' => 'Farsher Quality Type 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'BATTERY_TO_BRAKER_CABLE',
                'lookup_code' => 'BB1',
                'lookup_value' => 'Battery to Braker Cable 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'BRAKER_TO_UPS',
                'lookup_code' => 'BU1',
                'lookup_value' => 'Braker to UPS Cable 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'CONTROL_CABLE',
                'lookup_code' => 'CC1',
                'lookup_value' => 'Control Cable Type 1',
                'sequence' => 1,
                'is_deleted' => 0
            ],
            [
                'lookup_type' => 'UPS_TO_PANEL_CABLE',
                'lookup_code' => 'UPC1',
                'lookup_value' => 'UPS to Panel Cable 1',
                'sequence' => 1,
                'is_deleted' => 0
            ]
        ];

        // Insert the dummy data into the 'lookups' table
        Lookup::truncate();
        Lookup::insert($lookups);
    }
}
