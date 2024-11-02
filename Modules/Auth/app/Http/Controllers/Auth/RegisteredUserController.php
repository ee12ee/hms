<?php

namespace Modules\Auth\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use BenSampo\Enum\Rules\Enum;
use Modules\Auth\Enums\UserRoles;
use Modules\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'address' =>['required', 'string'],
            'phone'=>['required', 'string'],
            'role'=>'required|EnumValue:' .UserRoles::class
        ]);

        $user = User::query()->create([
            'name' => $request->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->string('password')),
            'address' => $request->address,
            'phone' => $request->phone,
        ]);
        $user->assignRole($request->role);

        event(new Registered($user));

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user
        ]);
    }
}
