<?php

namespace App\Traits;

use App\Models\ConsumerUser;
use App\Models\AdminUser;
use App\Models\RetailerHubUser;
use Illuminate\Support\Facades\Auth;

trait AuthTrait
{
    
    /**
     * @return UserAuth|null
     */
    protected function auth()
    {
        return Auth::user();
    }
    
    /**
     * @return UserAuth|null
     */
    protected function userAuth()
    {
        return Auth::guard('user-api')->user();
    }

}
