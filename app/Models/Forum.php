<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Forum extends Model
{
    ////////////
    // Traits //
    ////////////

    // Laravel traits
    use HasFactory, SoftDeletes;

    ////////////////
    // Properties //
    ////////////////

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'rules',
        'category',
        'private',
        'locked',
        'locked_by_id',
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    ///////////////////
    // Relationships //
    ///////////////////

    /**
     * A Forum has many Posts.
     *
     * @return HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * A Forum has many Threads.
     *
     * @return HasMany
     */
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
