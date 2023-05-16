<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

use Illuminate\Support\Arr;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description',
    ];

    public function scopeFilter($query, array $filters) : void
    {
        // start session values if not yet initialized
        if (!session()->exists('role_name')){
            session(['role_name' => '']);
        }
        if (!session()->exists('role_description')){
            session(['role_description' => '']);
        }

        // update session values if the request has a value
        if (Arr::exists($filters, 'name')) {
            session(['role_name' => $filters['name'] ?? '']);
        }
        
        if (Arr::exists($filters, 'description')) {
            session(['role_description' => $filters['description'] ?? '']);
        }
        
        // query if session filters are not empty
        if (trim(session()->get('role_name')) !== '') {
            $query->where('name', 'like', '%' . session()->get('role_name') . '%');
        }

        if (trim(session()->get('role_description')) !== '') {
            $query->where('description', 'like', '%' . session()->get('role_description') . '%');
        }
    }

    /**
     * Operadores desse perfil
     *
     * @var User
     */
    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Permissões desse perfil
     *
     * @var Permissions
     */
    public function permissions() : BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    
}
