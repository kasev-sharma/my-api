<?php

namespace App\Enums;

enum UserEnum: string
{
    const LOGIN_SUCCESSFUL = 'Logged in Successfully';
    const INVALID_USER_OR_PASS = 'Invalid Username or Password';
    const USER_NOT_ACTIVE = 'User is not active';
    const PLS_RETAILER_NAME = 'Please provide retailer name.';
    const PROCESS_REQ_ERROR = 'There is an error processing your request. Please try again after sometime.';
    const PLS_PROVIDE_USERNAME = 'Please provide Username name.';
    const ACCOUNT_ALREADY_EXIST = 'Account already exists.';
    const SUCCESS = 'Success';
    const LOGOUT_SUCCESS = "Logout Success";
  
    const PATIENT_ID_REQUIRED = "Patient ID is required";
    const USER_CREATED_SUCCESSFULLY = "User created successfully";


    const NO_DATA_FOUND = "NO DATA FOUND";

    const TIME_FORMAT = 'Y-m-d H:i:s';

    const FILE_RECEIVED = 'File Received';
}
