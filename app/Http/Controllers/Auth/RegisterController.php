<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Laravel\Prompts\Table;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:5', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/'],
            'identification_card' => ['required', 'string', Rule::unique('users')],
            'email' => ['required', 'string', 'email', Rule::unique('users')],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
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

        DB::table('model_has_roles')->insert([
            'role_id' =>4,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id,
        ]);

        return $user;
    }
}
