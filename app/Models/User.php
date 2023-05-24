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
     * @var array
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
     ** @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'theme_id' => 1,
        'active' => 'n',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Verify if the user is active or not
    *
    */
    public function hasAccess() : bool
    {
        return ($this->active == 'y') ? true : false;
    }

    /**
     * Get the theme that owns the user.
     *
     */
    public function theme() : BelongsTo
    {
        return $this->belongsTo(Theme::class);
    }

    /**
     * Users roles relationship
     *
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Verify if a user has a role or roles
     *
     */
    public function hasRoles($roles) : bool
    {

        $userRoles = $this->roles;
        return $roles->intersect($userRoles)->count();

    }
    
    /**
     * Verify if a user has a role
     *
     */
    public function hasRole($role) : bool
    {
        if(is_string($role)){
          $role = Role::where('name','=',$role)->firstOrFail();
        }
        return (boolean) $this->roles()->find($role->id);
    }

    /**
     * Assign roles to a user
     *
     */
    public function assignRole($role) : void
    {
        $this->roles()->sync($role, false);
    }

    /**
     * Filter users by name or email
     *
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
