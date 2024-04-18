<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

use Spatie\Permission\Models\Role; //roles de usuario
use Illuminate\Support\Facades\Auth; // importar la clase Auth NUEVO

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $fillable = [

        'names',
        'last_names',
        'password',
        'identification_card',
        'email',
        'email_verified_at',
        'phone',
        'rank_id',
        'military_unit_id',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function adminlte_image()
    {

        return 'vendor/adminlte/dist/img/user_log.png';
    }
    public function adminlte_desc()
    {

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario está autenticado y tiene nombre y apellidos
        if ($user && $user->names && $user->last_names) {

            return $user->names . ' ' . $user->last_names; // Devuelve nombre completo
        }

        return 'Usuario'; // En caso de no haber nombre o apellidos definidos

    }

    public function adminlte_profile_url()
    {

        return 'Perfil/username';
    }
}
