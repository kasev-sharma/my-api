<?php

namespace App\Http\Controllers;

use App\Enums\UserEnum;
use App\Models\SiteForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiteFormController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/company/add-form-data",
     *     summary="Store a new site form",
     *     tags={"SiteForm"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             required={"site_name", "ups_rating", "battery_bank", "battery_capacity", "pg_gland", "thumbal", "nut_bolts", "farsher_quality", "battery_to_braker_cable", "braker_to_ups", "control_cable", "ups_to_pannel_cable"},
     *             @OA\Property(property="site_name", type="string", example="Ahembdabad"),
     *             @OA\Property(property="ups_rating", type="integer", example=100),
     *             @OA\Property(property="battery_bank", type="integer", example=2),
     *             @OA\Property(property="battery_capacity", type="integer", example=150),
     *             @OA\Property(property="pg_gland", type="integer", example=10),
     *             @OA\Property(property="thumbal", type="integer", example=5),
     *             @OA\Property(property="nut_bolts", type="integer", example=50),
     *             @OA\Property(property="farsher_quality", type="integer", example=2),
     *             @OA\Property(property="battery_to_braker_cable", type="integer", example=20),
     *             @OA\Property(property="braker_to_ups", type="integer", example=10),
     *             @OA\Property(property="control_cable", type="integer", example=30),
     *             @OA\Property(property="ups_to_pannel_cable", type="integer", example=25),
     *             @OA\Property(property="images", type="array", @OA\Items(type="string", format="binary"))
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Site form created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Site form created successfully!"),
     *             @OA\Property(property="data", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validation failed"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function addFormData(Request $request)
    {
        // Validate request (all fields are now optional)
        $validator = Validator::make($request->all(), [
            'site_name' => 'nullable|required|string|max:255',
            'ups_rating' => 'nullable|required|integer',
            'battery_bank' => 'nullable',
            'battery_capacity' => 'nullable|integer',
            'pg_gland' => 'nullable|integer',
            'thumbal' => 'nullable|integer',
            'nut_bolts' => 'nullable|integer',
            'farsher_quality' => 'nullable|integer',
            'battery_to_braker_cable' => 'nullable|integer', 
            'braker_to_ups' => 'nullable|integer',
            'control_cable' => 'nullable|integer',
            'ups_to_pannel_cable' => 'nullable|integer',
            'images' => 'nullable|array', // Images can be optional
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image formats
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // Store each image in the public folder and get the file path
                $imagePath = $image->store('uploads', 'public'); // 'uploads' is the directory under 'public/storage'
                $imagePaths[] = $imagePath; // Store the relative path to the image
            }
        }

        // Create new SiteForm entry with image paths

        try{
            $siteForm = SiteForm::create([
                'site_name' => $request->site_name,
                'ups_rating' => (int)$request->ups_rating,
                'battery_bank' => (int)$request->battery_bank,
                'battery_capacity' => (int)$request->battery_capacity,
                'pg_gland' => (int)$request->pg_gland,
                'thumbal' => (int)$request->thumbal,
                'nut_bolts' => (int)$request->nut_bolts,
                'farsher_quality' => (int)$request->farsher_quality,
                'battery_to_braker_cable' => (int)$request->battery_to_braker_cable,
                'braker_to_ups' => (int)$request->braker_to_ups,
                'control_cable' => (int)$request->control_cable,
                'ups_to_pannel_cable' => (int)$request->ups_to_pannel_cable,
                'images' => json_encode($imagePaths), // Store image paths as a JSON array
            ]);
    
            return $this->successResponse(UserEnum::SUCCESS);
        }catch(Exception $e){
            $this->errorResponse($e->getMessage())  ;
        }
    }
}
