<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Arr;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active',
        'theme_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Verifica se o operador está ativo.
    *
    * @var active
    */
    public function hasAccess() : bool
    {
        return ($this->active == 'y') ? true : false;
    }

    public function theme() : BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

        /**
     * Perifs do operador
     *
     * @var Role
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Verifica se um operador tem determinado(s) perfil(is)
     *
     * @var Bool
     */
    public function hasRoles($roles) : bool
    {

        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();

    }
    
    /**
     * Verifica se um operador tem determinado perfil
     *
     * @var Bool
     */
    public function hasRole($role) : bool
    {
        if(is_string($role)){
          $role = Role::where('name','=',$role)->firstOrFail();
        }
        return (boolean) $this->roles()->find($role->id);
    }

    /**
     * Filtra os registros de acordo com os filtros passados
     *
     * @var Query
     */
    public function scopeFilter($query, array $filters) : void
    {
        // start session values if not yet initialized
        if (!session()->exists('user_name')){
            session(['user_name' => '']);
        }
        if (!session()->exists('user_email')){
            session(['user_email' => '']);
        }

        // update session values if the request has a value
        if (Arr::exists($filters, 'name')) {
            session(['user_name' => $filters['name'] ?? '']);
        }
        
        if (Arr::exists($filters, 'email')) {
            session(['user_email' => $filters['email'] ?? '']);
        }
        
        // query if session filters are not empty
        if (trim(session()->get('user_name')) !== '') {
            $query->where('name', 'like', '%' . session()->get('user_name') . '%');
        }

        if (trim(session()->get('user_email')) !== '') {
            $query->where('email', 'like', '%' . session()->get('user_email') . '%');
        }
    }
}
