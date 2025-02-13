<?php

namespace App\Http\Controllers;

use App\Enums\UserEnum;
use App\Models\Patient;
use App\Models\PatientsConsultationData;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/speech-to-text/patients",
     *     summary="Get list of all patients",
     *     tags={"SpeechToText"},
     *     security={{"passport": {}}},
     *      @OA\Response(
     *         response=200,
     *         description="List of all patients fetched successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Success"),
     *             @OA\Property(property="result", type="object",
     *                 @OA\Property(property="data", type="array",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="integer", example = 1),
     *                         @OA\Property(property="firstName", type="string", example = "JOhn"),
     *                         @OA\Property(property="lastName", type="string", example = "Doe"),
     *                         @OA\Property(property="address", type="string", example = "Street"),
     *                         @OA\Property(property="phone", type="string", example = "34324134132"),
     *                         @OA\Property(property="gender", type="string", example = "male"),
     *                         @OA\Property(property="age", type="integer", example = 1)
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No patients found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="No patients found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function getPatients(Request $request)
    {
        // Fetch all patients from the database
        $patients = Patient::all();
        
        $formattedPatients = $patients->map(function ($patient) {
            return [
                'id' => $patient->id,
                'firstName' => $patient->first_name, // Modify to match your column name
                'lastName' => $patient->last_name,   // Modify to match your column name
                'address' => $patient->address,
                'phone'=> $patient->phone,
                'gender'=>$patient->gender,
                'age'=>$patient->age
            ];
        });
    
        // Structure the response
        $response['data'] = $formattedPatients;
        return $this->successResponseWithData(UserEnum::SUCCESS , $response );
    }

    /**
     * @OA\Get(
     *     path="/api/speech-to-text/patients/{id}",
     *     summary="Get Data of Patient by ID",
     *     security={{"passport": {}}},
     *     description="Fetch the consultation data of a patient based on the patient's ID.",
     *     operationId="getPatientDataById",
     *     tags={"SpeechToText"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the patient to fetch data",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Patient data fetched successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="first_name", type="string"),
     *             @OA\Property(property="last_name", type="string"),
     *             @OA\Property(property="address", type="string"),
     *             @OA\Property(property="phone", type="string"),
     *             @OA\Property(property="consultations", type="array",
     *                 @OA\Items(
     *                     type="object",
     *                     @OA\Property(property="doctor_name", type="string"),
     *                     @OA\Property(property="data", type="string")
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Patient not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Patient not found")
     *         )
     *     )
     * )
     */
    public function getDataOfPatientById(Request $request, $id)
    {
        // Fetch patient by ID
      
        $patient = Patient::find($id);

        // If patient not found
        if (!$patient) {
            $this->errorResponse(UserEnum::NO_DATA_FOUND);
        }

        // Fetch consultation data for the patient
        $consultations = PatientsConsultationData::where('patient_id', $id)->get();

        // Prepare response data
        $patientData = [
            'id' => $patient->id,
            'firstName' => $patient->first_name,
            'lastName' => $patient->last_name,
            'address' => $patient->address,
            'phone' => $patient->phone,
            'consultations' => $consultations->map(function ($consultation) {
                return [
                    'doctorName' => $consultation->doctor_name,
                    'data' => json_decode($consultation->data ,true)
                ];
            })
        ];

        // Return the patient data
        return $this->successResponseWithData(UserEnum::SUCCESS, $patientData);
    }

}
