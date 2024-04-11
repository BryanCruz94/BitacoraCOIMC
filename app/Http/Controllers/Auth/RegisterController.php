<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
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
    protected $redirectTo = '/home';

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
{
    return Validator::make($data, [    
        'password' => ['required', 'string', 'min:5', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/'],
        'identification_card' => ['required', 'string', Rule::unique('users')],
        'email' => ['required', 'string', 'email', Rule::unique('users')],
    ]);
}

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

     
    protected function create(array $data)
    { 
    
        return User::create([
            'names' => $data['names'],
            'last_names' => $data['last_names'],
            'password' => Hash::make($data['password']),
            'identification_card' => $data['identification_card'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'phone' => $data['phone'],
            'rank_id' => $data['rank_id'],
            'military_unit_id' => $data['military_unit_id'],
            'is_active' => true,
        ]);
        
    } 

  
}

   
 