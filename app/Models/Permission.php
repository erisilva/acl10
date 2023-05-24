<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Permission extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name', 'description',
    ];

    /**
     * Filter users by name or email
     *
     */
    public function scopeFilter($query, array $filters) : void
    {
        // start session values if not yet initialized
        if (!session()->exists('permission_name')){
            session(['permission_name' => '']);
        }
        if (!session()->exists('permission_description')){
            session(['permission_description' => '']);
        }

        // update session values if the request has a value
        if (Arr::exists($filters, 'name')) {
            session(['permission_name' => $filters['name'] ?? '']);
        }
        
        if (Arr::exists($filters, 'description')) {
            session(['permission_description' => $filters['description'] ?? '']);
        }
        
        // query if session filters are not empty
        if (trim(session()->get('permission_name')) !== '') {
            $query->where('name', 'like', '%' . session()->get('permission_name') . '%');
        }

        if (trim(session()->get('permission_description')) !== '') {
            $query->where('description', 'like', '%' . session()->get('permission_description') . '%');
        }
    }

    /**
     * Roles that belong to the permission.
     *
     */
    public function roles() : BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
