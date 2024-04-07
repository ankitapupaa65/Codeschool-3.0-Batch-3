<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(LoginRequest $request)
    {

        try {

            $email = $request->email;
            $password = $request->password;

            $userExist = User::where('email', $email)->first();

            if (!$userExist || !Hash::check($password, $userExist->password)) {
                throw new Exception("Invalid Credentials!");
            }

            $token = $userExist->createToken('api-token')->plainTextToken;

            return Response()->json(["status" => true, "message" => "Login successfully", "data" => ["token" => $token]]);
        } catch (Exception $e) {
            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }
    public function getuserInfo()
    {

        try {

            $userInfo = Auth::user();

            return Response()->json(["status" => true, "message" => "User info retrieved successfully", "data" => $userInfo]);

        } catch (Exception $e) {

            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }
    public function logout()
    {

        try {

            Auth::logout();

            return Response()->json(["status" => true, "message" => " Logout  successfully", "data" => null]);
        } catch (Exception $e) {

            return Response()->json(["status" => false, "message" => $e->getMessage(), "data" => null]);
        }
    }
}
