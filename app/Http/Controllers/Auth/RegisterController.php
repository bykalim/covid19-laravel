<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $citizen = Role::all()->where('name', 'citizen')->first()->id;

        $validator = [
            'username' => ['required'],
            'password' => [
                'required',
                'min:8',
                'same:confirm_password',
            ]
        ];

        if ($data['role'] == $citizen) {
            $validator['phone'] = ['required'];
        } else {
            $validator['email'] = ['required', 'email'];
        }

        return Validator::make($data, $validator);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param RegisterRequest $request
     * @return User
     */
    protected function create($request): User
    {
        $role = Role::find($request['role']);

        // Create User
        $user = new User();
        $user->username = $request['username'];
        $user->password = Hash::make($request['password']);
        $user->role_id = $role->id;
        $user->save();

        // Create User Profile Based on Role
        $profile = new Profile();
        if ($role->name == 'citizen') {
            $profile->phone = $request['phone_number'];
        } else {
            $profile->email = $request['email'];
        }

        // Save Profile
        $profile->user_id = $user->id;
        $profile->save();

        // Update User Model
        $user->push();

        return $user;
    }
}
