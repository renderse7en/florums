<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait TimestampsBy
{
    /**
     * Automatically set created/updated by relationships upon creation.
     *
     * @return void
     */
    public static function bootTimestampsBy()
    {
        // Set [model].created_by_id when creating the model.
        static::creating(function ($model) {
            if (empty($model->created_by_id) && ($user = Auth::user())) {
                $model->createdBy()->associate($user);
            }
        });

        // Set [model].updated_by_id when updating the model.
        static::updateing(function ($model) {
            if (empty($model->updated_by_id) && ($user = Auth::user())) {
                $model->updatedBy()->associate($user);
            }
        });
    }

    /**
     * This Model was created by one User.
     *
     * @return BelongsTo
     */
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * This Model was last updated by one User.
     *
     * @return BelongsTo
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
