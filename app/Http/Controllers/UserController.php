<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MilitaryUnit;
use App\Models\Rank;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $unitUser = $user->military_unit_id;
        $roleUser = $user->roles->first()->name;


        $users = User::join('military_units as MU', 'users.military_unit_id', '=', 'MU.id')
            ->join('ranks as R', 'users.rank_id', '=', 'R.code')
            ->join('model_has_roles as MR', 'MR.model_id', '=', 'users.id')
            ->join('roles as Ro', 'MR.role_id', '=', 'Ro.id')
            ->select(
                'users.id',
                'Ro.name as role',
                'MU.abbreviation as unit',
                'R.name as ranks',
                DB::raw("CONCAT(users.last_names, '  ', users.names) as user"),
                'users.identification_card',
                'users.email',
                'users.is_active'
            )
            ->orderBy('is_active', 'desc')
            ->orderBy('unit')
            ->orderBy('ranks')
            ->orderBy('user')
            ->get();
        return view('admin.user.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $ranks = Rank::all();
        $military_units = MilitaryUnit::all()->where('is_active', true);
        $roles = DB::table('roles')->get();
        $role_id = DB::table('model_has_roles')->where('model_id', $id)->first();
        return view('admin.user.edit', compact('user', 'ranks', 'military_units', 'roles', 'role_id'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->names = $request->names;
        $user->last_names = $request->last_names;
        $user->email = $request->email;
        $user->identification_card = $request->identification_card;
        $user->rank_id = $request->rank_id;
        $user->military_unit_id = $request->military_unit_id;
        $user->is_active = $request->is_active;

        if ($request->password != null) {
            if ($request->password == $request->password_confirmation) {
                $user->password = Hash::make('admin');
            } else {
                $ranks = Rank::all();
                $military_units = MilitaryUnit::all();
                $roles = DB::table('roles')->get();
                $role_id = DB::table('model_has_roles')->where('model_id', $request->id)->first();
                return view('admin.user.edit', compact('user', 'ranks', 'military_units', 'roles', 'role_id'))->withErrors(['password' => 'Las contraseñas no coinciden']);
            }
        }

        $user->updated_at = now();
        $user->save();
        DB::table('model_has_roles')->where('model_id', $request->id)->update(['role_id' => $request->role_id]);
        return redirect()->route('users.index');
    }
}
