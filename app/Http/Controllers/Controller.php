<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponseTrait;
use App\Traits\AuthTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

/**
 * @OA\Info(
 *     title="Speech To Text",
 *     version="1.0.0"
 * )
 */
abstract class Controller
{
    use ApiResponseTrait, AuthorizesRequests, DispatchesJobs, ValidatesRequests, AuthTrait;
}
