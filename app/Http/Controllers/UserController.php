<?php

namespace App\Http\Controllers;

use App\Enums\UserEnum;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use UserValidator;

class UserController extends Controller
{


    /**
     * @OA\Post(
     *      path="/api/speech-to-text/register",
     *      tags={"SpeechToText"},
     *      description="Create User",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="username",
     *                  type="string",
     *                  example="admin"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="Staging123$"
     *              ),
     *              @OA\Property(
     *                  property="firstName",
     *                  type="string",
     *                  example="Admin"
     *              ),
     *              @OA\Property(
     *                  property="lastName",
     *                  type="string",
     *                  example="User"
     *              ),
     *              @OA\Property(
     *                  property="phone",
     *                  type="number",
     *                  example="1234567890"
     *              ),
     *              @OA\Property(
     *                  property="email",
     *                  type="email",
     *                  example="admin@svl.com"
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success Message And User Id",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="boolean",
     *                  example="true"
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example=""
     *               ),
     *          )
     *      ),
     * )
     */

    public function register(Request  $request): mixed
    {
      
        $error = self::createUserAccountValidation($request);
        if ($error) {
            return $this->errorResponse($error);
        }
        $retailerUserExists = User::where('username', $request->username)
            ->orderBy('id', 'DESC')
            ->first();


        if ($retailerUserExists && $retailerUserExists['is_signup_completed'] == 'Y') {
            return $this->errorResponse(UserEnum::ACCOUNT_ALREADY_EXIST);
        }


        $user = new User();
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->username = $request->username;
        $user->password = Hash::make($request->input('password'));
        $user->signup_time = Carbon::now();
        $user->first_name = $request->input('firstName');
        $user->last_name = $request->input('lastName');
        $user->is_signup_completed = 'Y';
        $user->save();

        return $this->successResponse(UserEnum::USER_CREATED_SUCCESSFULLY);
    }
    

     /**
     * @OA\Post(
     *      path="/api/speech-to-text/login",
     *      tags={"SpeechToText"},
     *      summary="login",
     *      description="For Login",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="username",
     *                  type="string",
     *                  example="admin"
     *              ),
     *              @OA\Property(
     *                  property="password",
     *                  type="string",
     *                  example="Staging123$"
     *              ),        
     *          ),
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful Operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="bool",
     *                  example=true
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example=""
     *              ),
     *              
     *          ),
     *      ),
     * )
     */

     public function login(Request $request)
    {
        $user = self::validateLogin($request);
        if (is_string($user)) {
           return $this->errorResponse(UserEnum::INVALID_USER_OR_PASS);
        }
        // Now that the user is validated, generate a new token for the user
        $tokenResponse = $user->createToken('SpeechToText', ['admin']); // Optionally define token scopes
        $token = $tokenResponse->token;
        $loginDuration = (int) env("LOGIN_EXPIRY", 20);  // Duration in minutes
        $token->expires_at = now()->addMinutes($loginDuration);
        $token->save();

        $user->last_login_timestamp = now();
        $user->save();
    
        // Prepare the response
        $response = [
            'token' => $tokenResponse->accessToken,  // The generated token
        ];
    
        // Return success response with the token
        return $this->successResponseWithData(UserEnum::LOGIN_SUCCESSFUL, $response);

    }
     public static function errorMessage($obj)
    {
        return $obj->errors()->first();
    }
    public static function validateLogin(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ],
        );

        if ($validation->fails()) {
            return self::errorMessage($validation);
        }

        $user = User::where('username', $request['username'])->first();
        
        if (empty($user) || !Hash::check($request['password'], $user->password)) {

            return UserEnum::INVALID_USER_OR_PASS;
        }
        if ($user->is_signup_completed != 'Y') {
            return UserEnum::USER_NOT_ACTIVE;
        }
        

        return $user;
    }

    public static function createUserAccountValidation($request)
    {
        $rules = [
            'username' => 'required',
            'password' => 'required',
        ];

        $errors = [
            //add custom error messages
        ];

        $validatorRequire = Validator::make(
            $request->all(),
            $rules,
            $errors
        );

        if ($validatorRequire->fails()) {
            return self::errorMessage($validatorRequire);
        }

        return false;
    }

    /**
     * @OA\Post(
     *      path="/api/speech-to-text/logout",
     *      tags={"SpeechToText"},
     *      security={{"passport": {}}},
     *      summary="logout",
     *      description="Admin Logout",
     *      @OA\Response(
     *          response=200,
     *          description="Successful Operation",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="success",
     *                  type="bool",
     *                  example=true
     *              ),
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="success"
     *              ),
     *              @OA\Property(
     *                  property="result",
     *                  type="object",
     *                  example="{}"
     *              ),
     *          ),
     *      ),
     * )
     */
    public function logout(Request $request)
    {
        $userToken = $request->user()->token();
        $userToken->revoke();

        if (!empty($userToken)) {
            return $this->successResponse(message: UserEnum::LOGOUT_SUCCESS);
        }
        return $this->errorResponse(message: UserEnum::PROCESS_REQ_ERROR);
    }
}
