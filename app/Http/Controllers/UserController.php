<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function userRegistration(Request $request){
        try{
            $validator= Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
            ]);

            if ($validator->fails()) {
                $fieldsWithErrorMessagesArray = $validator->errors()->all();
                return response()->json($fieldsWithErrorMessagesArray, Response::HTTP_UNPROCESSABLE_ENTITY);
            }
                $user  = new User();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();

            $token = $user->createToken('authToken');
            $data = [
                'user' => $user,
                'token' => $token->plainTextToken,
            ];
            return response()->json($data, Response::HTTP_CREATED);


        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        try{
            $validator= Validator::make($request->all(),[
                'email' => 'required',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                $fieldsWithErrorMessagesArray = $validator->errors()->all();
                return response()->json($fieldsWithErrorMessagesArray, Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            $user = User::query()->where('email',$request->email)->first();

            if(!$user){
                return response()->json('Invalid login credentials', Response::HTTP_UNAUTHORIZED);
            }

            if (!Hash::check($request->password, $user->password)) {
                return response()->json('Invalid login credentials', Response::HTTP_UNAUTHORIZED);
            }

            $token = $user->createToken('authToken');
            $data = [
                'user' => $user,
                'token' => $token->plainTextToken,
            ];

            return response()->json($data, Response::HTTP_OK);

        }catch (\Exception $exception){
            return response()->json($exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
