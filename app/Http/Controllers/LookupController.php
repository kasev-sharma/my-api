<?php
namespace App\Http\Controllers;

use App\Enums\UserEnum;
use App\Models\Lookup;
use Illuminate\Http\Request;

class LookupController extends Controller
{
    // Fetch data for dropdown based on lookup_type

    /**
     * @OA\Get(
     *     path="/api/company/lookups",
     *     summary="Fetch all lookup data",
     *     tags={"Lookup"},
     *     @OA\Response(
     *         response=200,
     *         description="Successfully fetched all lookup data",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="success"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="site_name", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="AHEMBDABAT"),
     *                         @OA\Property(property="value", type="string", example="Ahembdabad")
     *                     )
     *                 ),
     *                 @OA\Property(property="battery_bank", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="BANK1"),
     *                         @OA\Property(property="value", type="string", example="Battery Bank 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="battery_capacity", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="CAP1"),
     *                         @OA\Property(property="value", type="string", example="100Ah")
     *                     )
     *                 ),
     *                 @OA\Property(property="pg_gland", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="PG1"),
     *                         @OA\Property(property="value", type="string", example="PG Gland Type 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="thumbal", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="THUMB1"),
     *                         @OA\Property(property="value", type="string", example="Thumbal Type 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="nut_bolts", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="NB1"),
     *                         @OA\Property(property="value", type="string", example="Nut and Bolt Type 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="farsher_quality", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="FQ1"),
     *                         @OA\Property(property="value", type="string", example="Farsher Quality Type 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="battery_to_braker_cable", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="BB1"),
     *                         @OA\Property(property="value", type="string", example="Battery to Braker Cable 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="braker_to_ups", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="BU1"),
     *                         @OA\Property(property="value", type="string", example="Braker to UPS Cable 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="control_cable", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="CC1"),
     *                         @OA\Property(property="value", type="string", example="Control Cable Type 1")
     *                     )
     *                 ),
     *                 @OA\Property(property="ups_to_pannel_cable", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="key", type="string", example="UPC1"),
     *                         @OA\Property(property="value", type="string", example="UPS to Panel Cable 1")
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */


     public function getLookupData(Request $request)
     {
         // Fetch all lookups (non-deleted records)
         $lookups = Lookup::where('is_deleted', 0) // Ensure only non-deleted records are fetched
                         ->get();
     
         // If no lookups are found, return an empty array in the response
         if ($lookups->isEmpty()) {
            return $this->errorResponse(UserEnum::NO_DATA_FOUND);
         }
         
         // Group the lookups by lookup_type
         $groupedLookups = $lookups->groupBy('lookup_type')->map(function ($items) {
             return $items->map(function ($item) {
                 return [
                     'key' => $item->lookup_code,
                     'value' => $item->lookup_value,
                 ];
             });
         });
     
         // Format the response structure
         $formattedData = [
             'message' => 'success',
             'data' => $groupedLookups
         ];
         return $formattedData;
    
     }
     
}
