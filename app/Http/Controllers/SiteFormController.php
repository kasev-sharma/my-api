<?php

namespace App\Http\Controllers;

use App\Enums\UserEnum;
use App\Models\SiteForm;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


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
        $validator = Validator::make($request->all(), [
            // 'user_id' => 'required|exists:users,id',
            'customer_name' => 'required|string',
            'customer_mobile' => 'required|string',
            'site_address' => 'required|string',
            'ups_make' => 'required|string',
            'ups_model' => 'required|string',
            'ups_rating' => 'required|integer',
            'no_of_ups' => 'required|integer',
            'battery_bank' => 'required|string',
            'battery_ah' => 'required|string',
            'battery_volt' => 'required|string',
            'battery_type' => 'required|string',
            'no_of_bank' => 'required|integer',
            'no_of_battery' => 'required|integer',
            'control_cable_in_meters' => 'required|integer',
            'pg_gland' => 'required|integer',
            'thumbal' => 'required|integer',
            'nut_bolts' => 'required|integer',
            'images.*' => 'nullable|image|max:2048'
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        // Handle Image Uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public');
                $imagePaths[] = $path;
            }
        }
        try {
            $siteDetail = SiteForm::create([
                'user_id' => 1,
                'customer_name' => $request->customer_name,
                'customer_mobile' => $request->customer_mobile,
                'site_address' => $request->site_address,
                'ups_make' => $request->ups_make,
                'ups_model' => $request->ups_model,
                'ups_rating' => $request->ups_rating,
                'no_of_ups' => $request->no_of_ups,
                'battery_bank' => $request->battery_bank,
                'battery_ah' => $request->battery_ah,
                'battery_volt' => $request->battery_volt,
                'battery_type' => $request->battery_type,
                'no_of_bank' => $request->no_of_bank,
                'no_of_battery' => $request->no_of_battery,
                'control_cable_in_meters' => $request->control_cable_in_meters,
                'pg_gland' => $request->pg_gland,
                'thumbal' => $request->thumbal,
                'nut_bolts' => $request->nut_bolts,
                'images' => $imagePaths
            ]);

            return $this->successResponse(UserEnum::SUCCESS);
        } catch (Exception $e) {
            $this->errorResponse($e->getMessage());
        }
    }


    public function getMetaDataInformation(Request $request)
    {
       
        $type1=$request['type1'];
        $type2=$request['type2'];
       
          $locations = json_decode(Storage::get('locations.json'), true);
          $metadata = json_decode(Storage::get('metadata.json'), true);
  
          // Merge data based on 'id'
          $mergedData = [];
          foreach ($locations as $loc) {
              foreach ($metadata as $meta) {
                  if ($loc['id'] === $meta['id']) {
                      $mergedData[] = array_merge($loc, $meta);
                      break;
                  }
              }
          }
  
          // Count valid points per type
          $typeCount = [];
          $ratings = [];
          $maxReviews = ["reviews" => 0, "location" => null];
          $incompleteData = [];


  
          foreach ($mergedData as $data) {
              // Count types
              $typeCount[$data['type']] = ($typeCount[$data['type']] ?? 0) + 1;
              
              // Calculate rating averages
              $ratings[$data['type']][] = $data['rating'];
  
              // Find highest reviews
              if ($data['reviews'] > $maxReviews['reviews']) {
                  $maxReviews = ["reviews" => $data['reviews'], "location" => $data];
              }
  
              // Identify incomplete data
              if (!isset($data['type'], $data['rating'], $data['reviews'])) {
                  $incompleteData[] = $data;
              }
          }
  
          // Calculate average ratings
          $averageRatings = [];
          foreach ($ratings as $type => $ratingList) {
              $averageRatings[$type] = array_sum($ratingList) / count($ratingList);


          }
          $avg=0;
          foreach ($averageRatings as $type => $ratingList) {


            if($type=$type1)
            {
                $avg+=$ratingList;
            }
            if($type=$type2)
            {
                $avg+=$ratingList;
            }
            


        }
  
         return $this->successResponseWithData($avg);
        // Output results
        //   $this->info("Valid Points per Type: " . json_encode($typeCount, JSON_PRETTY_PRINT));
        //   $this->info("Average Ratings per Type: " . json_encode($averageRatings, JSON_PRETTY_PRINT));
        //   $this->info("Location with Highest Reviews: " . json_encode($maxReviews, JSON_PRETTY_PRINT));
        //   $this->info("Incomplete Data Entries: " . json_encode($incompleteData, JSON_PRETTY_PRINT));
    }
}
