<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
        'created_by_id',
        'updated_by_id',
        'deleted_by_id',
    ];
}
