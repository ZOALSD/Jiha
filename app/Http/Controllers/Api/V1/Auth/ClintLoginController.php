<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Token;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ClintLoginController extends Controller
{

    public function Register(Request $request)
    {
        return response()->json("hi", 200);

        $data = $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            // 'password' => 'nullable',
            'phone' => 'required|unique:users|numeric',
            // 'year' => 'required|numeric',
            // 'type' => 'required|numeric',
            'device_name' => 'required',
        ]);

        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        $token = $user->createToken($request->device_name)->plainTextToken;

        $dataa = User::where('id', $user->id)->first();

        return response()->json(['stutus' => true, 'token' => $token, 'Data' => $dataa], 200);

    }

    public function UserUpdate(Request $request)
    {
        $id = Auth::user()->id;

        $request->validate([
            'name' => 'nullable|string|min:3',
            'email' => 'nullable|email|unique:users,email,' . $id,
            'password' => 'nullable',
            'phone' => 'nullable|numeric|unique:users,phone,' . $id,
            'year' => 'nullable|numeric',
        ]);

        // $data['password'] = Hash::make($request->password);
        // $user = User::create($data);

        if ($request->email == null) {
            $email = User::where('id', $id)->value('email');
        } else {
            $email = $request->email;
        }

        if ($request->name == null) {
            $name = User::where('id', $id)->value('name');
        } else {
            $name = $request->name;
        }

        if ($request->phone == null) {
            $phone = User::where('id', $id)->value('phone');
        } else {
            $phone = $request->phone;
        }

        if ($request->year == null) {
            $year = User::where('id', $id)->value('year');
        } else {
            $year = $request->year;
        }

        if ($request->old_password) {
            $user = User::where('id', $id)->first();

            $check = Hash::check($request->old_password, $user->password);

            if ($check) {

                $user = User::find($id);
                $user->name = $name;
                $user->email = $email;
                $user->phone = $phone;
                $user->year = $year;
                if ($request->new_password) {
                    $user->password = Hash::make($request->new_password);
                }
                $user->save();

                return response(['stuts' => 'Success Data Updated', 'Data' => $user]);

            } else {
                return response('old Password incorrect');
            }

        } else {
            $user = User::find($id);
            $user->name = $name;
            $user->email = $email;
            $user->phone = $phone;
            $user->year = $year;
            $user->save();

            return response(['stuts' => 'Success Data Updated', 'Data' => $user]);

        }

        return response()->json(['stutus' => 'Successfully Data Updated'], 200);

    }

    public function data()
    {

        return response()->json(['Data' => User::where('id', 1)->get()]);

    }
    public function UserData()
    {
        return Auth::user();
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where(['phone' => $request->phone, 'stuts' => 1])->first();
        if ($user != null) {
            if ($user->type == 1) {
                $user_id = User::where(['phone' => $request->phone, 'stuts' => 1])->value('id');

                $token = Token::where('tokenable_id', $user_id)->count();
                if ($token != 0) {
                    $user->tokens()->delete();
                }

                if (!$user || !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'phone' => ['The provided phone number are incorrect.'],
                    ]);
                }

                $token = $user->createToken($request->device_name)->plainTextToken;
                return response()->json(['stutus' => true, 'token' => $token, 'Data' => $user], 200);
            } else {
                return response()->json(['Stutus' => false, 'Message' => 'This App Only For Clint'], 200);

            }
        } else {
            return response()->json(['Stutus' => false, 'Message' => 'Your Number Phone Is Wrong'], 200);

        }

    }

    public function login_seller(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'device_name' => 'required',
        ]);
        $user = User::where(['phone' => $request->phone, 'stuts' => 1])->first();
        if ($user != null) {
            if ($user->type == 2) {
                $user_id = User::where(['phone' => $request->phone, 'stuts' => 1])->value('id');
                $token = Token::where('tokenable_id', $user_id)->count();
                if ($token != 0) {
                    $user->tokens()->delete();
                }
                if (!$user || !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'phone' => ['The provided phone number are incorrect.'],
                    ]);
                }
                $token = $user->createToken($request->device_name)->plainTextToken;
                return response()->json(['stutus' => true, 'token' => $token, 'Data' => $user], 200);
            } else {
                return response()->json(['Stutus' => false, 'Message' => 'This App Only For Seller'], 200);
            }
        } else {
            return response()->json(['Stutus' => false, 'Message' => 'Your Number Phone Is Wrong'], 200);

        }

    }

    public function login_deliver(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'phone' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where(['phone' => $request->phone, 'stuts' => 1])->first();
        if ($user != null) {
            if ($user->type == 3) {
                $user_id = User::where(['phone' => $request->phone, 'stuts' => 1])->value('id');

                $token = Token::where('tokenable_id', $user_id)->count();
                if ($token != 0) {
                    $user->tokens()->delete();
                }

                if (!$user || !Hash::check($request->password, $user->password)) {
                    throw ValidationException::withMessages([
                        'phone' => ['The provided phone number are incorrect.'],
                    ]);
                }

                $token = $user->createToken($request->device_name)->plainTextToken;
                return response()->json(['stutus' => true, 'token' => $token, 'Data' => $user], 200);
            } else {
                return response()->json(['Stutus' => false, 'Message' => 'This App Only For Delivery'], 200);

            }
        } else {
            return response()->json(['Stutus' => false, 'Message' => 'Your Number Phone Is Wrong'], 200);

        }

    }

    public function logout()
    {

        // Auth::user()->currentAccessToken()->delete();
        $data = "We will miss you, don't be late to me !!";
        return response()->json($data, 200);
    }

}
