<?php

namespace App\Models;

use App\Traits\TimestampsBy;
use App\Traits\SoftDeletesBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
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
        'forum_id',
        'thread_id',
        'content',
        'ip_address',
        'hidden',
        'hidden_by_id',
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
     * A Post belongs to one Forum.
     *
     * @return BelongsTo
     */
    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    /**
     * A Post belongs to one Thread.
     *
     * @return BelongsTo
     */
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }
}
