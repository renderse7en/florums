<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait SoftDeletesBy
{
    /**
     * Automatically set created/updated by relationships upon creation.
     *
     * @return void
     */
    public static function bootSoftDeletesBy()
    {
        // Set [model].del;eted_by_id when creating the model.
        static::deleting(function ($model) {
            if (empty($model->deleted_by_id) && ($user = Auth::user())) {
                $model->deletedBy()->associate($user);
            }
        });
    }

    /**
     * This Model was deleted by one User.
     *
     * @return BelongsTo
     */
    public function deletedBy()
    {
        return $this->belongsTo(User::class, 'deleted_by_id');
    }
}
