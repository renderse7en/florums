<?php

namespace App\Models;

use App\Traits\TimestampsBy;
use App\Traits\SoftDeletesBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Thread extends Model
{
    ////////////
    // Traits //
    ////////////

    // Laravel traits
    use HasFactory, SoftDeletes;

    // First Party traits
    use TimestampsBy, SoftDeletesBy;

    ////////////////
    // Properties //
    ////////////////

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'locked',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];

    ///////////////////
    // Relationships //
    ///////////////////

    /**
     * A Thread belongs to one Forum.
     *
     * @return BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * A Thread has many Posts.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
