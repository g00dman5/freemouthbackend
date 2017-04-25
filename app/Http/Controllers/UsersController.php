<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Purifier;
use Hash;
use App\User;


class UsersController extends Controller
{
    public function signUp(Request $request)
    {
      $rules=[
        "email" => "required",
        "name" => "required",
        "password"=> "required",
      ];

      $validator = Validator::make(Purifier::clean($request->all()), $rules);

      if($validator->fails())
      {
        return Response::json(["error"=> "All fields must be completed"]);
      }
      //makes sure email hasnt already been used
      $check = User::where("email","=",$request->input("email"))->first();

      if(!empty($check))
      {
        return Response::json(["error"=> "Email address already in use."]);
      }

      //Creates and saves new User table
      $user = new User;
      $user->name= $request->input("name");
      $user->email= $request->input("email");
      $user->password= Hash::make($request->input("password"));

      $user->save();



      return Response::json(['success'=> "Welcome to the team."]);


    }
}
