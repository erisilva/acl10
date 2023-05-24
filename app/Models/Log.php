<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Log extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'model',
        'model_id',
        'action',
        'changes',
    ];

    /**
     * Get the parent commentable model (post or video).
     */
    public function logable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the log.
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
