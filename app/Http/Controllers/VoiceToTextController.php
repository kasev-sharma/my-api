<?php

namespace App\Http\Controllers;

use App\Enums\UserEnum;
use App\Models\AudioFileTracker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use GuzzleHttp\Client;
use Throwable;

class VoiceToTextController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/speech-to-text/transcribe",
     *     summary="Convert audio to text using AssemblyAI",
     *     tags={"VoiceToText"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="audio",
     *                     type="string",
     *                     format="binary",
     *                     description="The audio file to be converted to text"
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Success"),
     *             @OA\Property(property="result", type="object",
     *                 @OA\Property(property="transcript", type="string", example="This is the transcribed text from the audio file.")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Validation error")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Internal server error")
     *         )
     *     )
     * )
     */

    public function transcribe(Request $request)
    {
        // Validate the incoming file
        $this->validate($request, [
            'audio' => 'required|mimes:mp3,wav,aac',
        ]);

        try {
            // Save the uploaded file to the public/audio directory
            $file = $request->file('audio');
            $originalName = $file->getClientOriginalName();
            $ext= pathinfo($originalName, PATHINFO_EXTENSION);
            $filePath = $file->storeAs(
                'audio',
                 Carbon::now()->format('YmdHis') .'.'.$ext ,
                'public'
            );

            // Create a record in audio_file_tracker
            $audioTracker = AudioFileTracker::create([
                'file_name' => $originalName,
                'file_path' => $filePath,
                'status' => 'queued',
            ]);

            // Generate the full URL of the uploaded file
            $audioFileUrl = Storage::url($filePath);
            $baseUrl = env('AUDIO_URL');  // Get the base URL from .env (with port, like 'http://localhost:8000')
            $audioFileUrl = $baseUrl . '/storage/' . $filePath; 
            // return $audioFileUrl;
            // Transcribe the audio using Assembly AI
            $transcriptionResult = $this->handleTranscription($audioFileUrl, $audioTracker->id);

            if ($transcriptionResult['status'] === 'completed') {
                return $this->successResponseWithData(
                    'Transcription completed successfully.',
                    [
                        'file_name' => $originalName,
                        'transcript_text' => $transcriptionResult['text'],
                    ]
                );
            } else {
                return $this->errorResponseWithData(
                    $transcriptionResult['error'] ?? 'Transcription failed.',
                    500
                );
            }
        } catch (Throwable $e) {
            return $this->errorResponseWithData(
                $e->getMessage(),
                500,
                [
                    'error' => 'Error processing the request.',
                ]
            );
        }
    }

    protected function handleTranscription(string $fileUrl, int $trackerId): array
    {
        $apiKey = env('ASSEMBLYAI_API_KEY');
        $fileUrl=  "https://assembly.ai/wildfires.mp3";
        if (empty($apiKey)) {
            throw new \RuntimeException('ASSEMBLYAI_API_KEY is not configured.');
        }

        $client = new Client([
            'base_uri' => 'https://api.assemblyai.com/v2/',
            'headers' => [
                'Authorization' => $apiKey,
                'Content-Type' => 'application/json',
            ],
        ]);

        $data = [
            'audio_url' => $fileUrl,
            'speaker_labels' => true,
        ];

        try {
            // Submit the transcription request
            $response = $client->post('transcript', [
                'json' => $data,
            ]);

            $responseData = json_decode($response->getBody(), true);
            $transcriptId = $responseData['id'];

            // Update the tracker status to 'processing'
            AudioFileTracker::where('id', $trackerId)->update([
                'status' => 'processing',
            ]);

            // Polling logic to check transcription status
            $pollingEndpoint = "transcript/$transcriptId";
            while (true) {
                $pollResponse = $client->get($pollingEndpoint);
                $pollData = json_decode($pollResponse->getBody(), true);

                if ($pollData['status'] === 'completed') {
                    // Update the tracker with the transcribed text
                    AudioFileTracker::where('id', $trackerId)->update([
                        'status' => 'completed',
                        'transcript_text' => $pollData['text'],
                    ]);

                    return [
                        'status' => 'completed',
                        'text' => $pollData['text'],
                    ];
                } elseif ($pollData['status'] === 'error') {
                    // Update the tracker with the error message
                    AudioFileTracker::where('id', $trackerId)->update([
                        'status' => 'error',
                        'error_message' => $pollData['error'] ?? 'Unknown error.',
                    ]);

                    return [
                        'status' => 'error',
                        'error' => $pollData['error'] ?? 'Unknown error.',
                    ];
                }

                sleep(3);
            }
        } catch (Throwable $e) {
            // Log and update the tracker if the request fails
            \Log::error('Transcription failed: ' . $e->getMessage());
            AudioFileTracker::where('id', $trackerId)->update([
                'status' => 'error',
                'error_message' => $e->getMessage(),
            ]);

            return [
                'status' => 'error',
                'error' => $e->getMessage(),
            ];
        }
    }
}
