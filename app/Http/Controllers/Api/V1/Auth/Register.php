<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Models\User;
use App\Models\Token;
use App\Mail\ResetPhone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


class Register extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where(['phone' => $request->phone])->first();

        if ($user != null) {

            $user_id = User::where(['phone' => $request->phone])->value('id');

            $token = Token::where('tokenable_id', $user_id)->count();
            if ($token != 0) {
                $user->tokens()->delete();
            }

            $token = $user->createToken($request->device_name)->plainTextToken;
            return response()->json(['stutus' => true, 'token' => $token, 'Data' => $user], 200);
        } else {
            return response()->json(['Stutus' => false, 'Message' => 'Your Number Phone Is Wrong'], 200);
        }
    }


    public function Sigin(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'address' => 'string|min:3',
            'email' => 'sometimes|nullable|email|unique:users',
            'phone' => 'required|unique:users|numeric',
            'type' => 'numeric',
            'pic' => 'sometimes|nullable|file|image',
        ]);

        $user = User::create($data);

        if (request()->hasFile('pic')) {
            $user->pic = it()->upload('pic', 'users/' . $user->id);
            $user->save();
        }

        $token = $user->createToken($request->device_name)->plainTextToken;

        $dataa = User::where('id', $user->id)->first();

        return response()->json(['stutus' => true, 'token' => $token, 'Data' => $dataa], 200);
    }

    public function otp()
    {
        $up = User::where('id', auth('sanctum')->id())->update(['otp' => rand(1, 99999)]);
        $user =  User::where('id', auth('sanctum')->id())->first();

        Mail::to($user->email)
            ->send(new ResetPhone([
                'otp' => $user->otp,
                'name' => $user->first_name . " " . $user->last_name,
            ]));

        return response()->json([
            'status' => true,
            'message' => 'Verification code send to your email'
        ], 200);
    }

    public function ResetPhone(Request $req)
    {

        $data = $req->validate([
            'phone' => 'required|unique:users|numeric',
            'otp' => 'required',
        ]);

        $otp = User::where(['id' => auth('sanctum')->id(), 'otp' => $req->otp])->first();

        if (!$otp)
            return response()->json([
                'status' => false,
                'message' => 'your Verification code is not vilad'
            ], 200);

        $up = User::where(['id' => auth('sanctum')->id(), 'otp' => $req->otp])
            ->update(['phone' => $req->phone, 'otp' => '']);

        if ($up)
            return response()->json([
                'status' => true,
                'message' => 'Successfully Updated your phone'
            ], 200);



        return response()->json([
            'status' => false,
            'message' => 'your phone not updated try later'
        ], 200);
    }


    public function upgradeAccount(Request $request)
    {
        $request->validate([
            'other_phone' => 'required|string',
            'id_image' => 'required|file',
        ]);

        if (request()->hasFile('id_image')) {
            $image = it()->upload('id_image', 'users_id/' . auth('sanctum')->id());
        }

    
        User::where('id',auth('sanctum')->id())->update(['other_phone' => $request->other_phone , 'id_image' => $image]);
    }
    public function UserUpdate(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'first_name' => 'required|string|min:3',
            'last_name' => 'required|string|min:3',
            'address' => 'string|min:3',
            'email' => 'nullable|email|unique:users,email,' . $id,
        ]);
        
        if ($request->email == null) {
            $email = User::where('id', $id)->value('email');
        } else {
            $email = $request->email;
        }

        if ($request->first_name == null) {
            $first_name = User::where('id', $id)->value('first_name');
        } else {
            $first_name = $request->first_name;
        }
        
        if ($request->last_name == null) {
            $last_name = User::where('id', $id)->value('last_name');
        } else {
            $last_name = $request->last_name;
        }

        $user = User::find($id);
        
        if (request()->hasFile('pic')) {
            it()->delete($user->pic);
            $pic = it()->upload('pic', 'users/' . $id);;
        }
        
        
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->pic = $pic;
        $user->save();


        return response(['stuts' => 'Success Data Updated', 'Data' => $user]);
    }
}
